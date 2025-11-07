<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Entregador;
use App\Models\Mesa;
use App\Models\Prato;
use App\Models\ItemPedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function __construct()
    {
        // Require authentication for creating orders and viewing "my orders"
        $this->middleware('auth')->only(['create', 'store', 'meusPedidos']);
    }
    public function index()
    {
        $pedidos = Pedido::with('cliente', 'mesa', 'entregador')->orderBy('datahora', 'desc')->paginate(20);
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        // If an authenticated user has a linked Cliente (by email), only show/select that cliente
        $clientes = Cliente::orderBy('nome')->get();
        if (auth()->check()) {
            $user = auth()->user();
            $cliente = Cliente::where('email', $user->email)->first();
            if ($cliente) {
                $clientes = collect([$cliente]);
            }
        }
        $entregadores = Entregador::orderBy('nome')->get();
        $mesas = Mesa::orderBy('descricao')->get();
        $pratos = Prato::orderBy('descricao')->get();
        return view('pedidos.create', compact('clientes', 'entregadores', 'mesas', 'pratos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'datahora' => 'required|date',
            'cod_cliente' => 'required|exists:clientes,cod_cliente',
            'tipo_pedido' => 'required|in:PRESENCIAL,DELIVERY',
            'cod_entregador' => 'nullable|exists:entregadores,cod_entregador',
            'valor_entrega' => 'nullable|numeric',
            'cod_mesa' => 'nullable|exists:mesas,cod_mesa',
            'desconto' => 'nullable|numeric',
            'taxa_servico' => 'nullable|numeric',
            'items' => 'required|array|min:1',
            'items.*.cod_prato' => 'required|exists:pratos,cod_prato',
            'items.*.quantidade' => 'required|numeric|min:1',
            'items.*.valor_unitario' => 'required|numeric|min:0',
        ]);

        // If authenticated and there's a linked Cliente, ensure the pedido is created for that cliente
        if (auth()->check()) {
            $user = auth()->user();
            $cliente = Cliente::where('email', $user->email)->first();
            if ($cliente) {
                $data['cod_cliente'] = $cliente->cod_cliente;
            }
        }

        // Create pedido and itens in a transaction
        $pedido = null;
        DB::transaction(function () use ($data, $request, &$pedido) {
            $items = $data['items'] ?? [];
            // Remove items from data before creating pedido
            unset($data['items']);
            $pedido = Pedido::create($data);

            foreach ($items as $it) {
                ItemPedido::create([
                    'cod_pedido' => $pedido->cod_pedido,
                    'cod_prato' => $it['cod_prato'],
                    'quantidade' => $it['quantidade'],
                    'valor_unitario' => $it['valor_unitario'],
                    // ensure data_hora is set to current timestamp to satisfy NOT NULL constraint
                    'data_hora' => now(),
                ]);
            }
        });

        return redirect()->route('pedidos.show', $pedido)->with('success', 'Pedido criado com itens.');
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('cliente', 'itensPedido.prato');
        return view('pedidos.show', compact('pedido'));
    }

    public function edit(Pedido $pedido)
    {
        $clientes = Cliente::orderBy('nome')->get();
        $entregadores = Entregador::orderBy('nome')->get();
        $mesas = Mesa::orderBy('descricao')->get();
        return view('pedidos.edit', compact('pedido', 'clientes', 'entregadores', 'mesas'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $data = $request->validate([
            'datahora' => 'required|date_format:Y-m-d H:i:s',
            'cod_cliente' => 'required|exists:clientes,cod_cliente',
            'tipo_pedido' => 'required|in:PRESENCIAL,DELIVERY',
            'cod_entregador' => 'nullable|exists:entregadores,cod_entregador',
            'valor_entrega' => 'nullable|numeric',
            'cod_mesa' => 'nullable|exists:mesas,cod_mesa',
            'desconto' => 'nullable|numeric',
            'taxa_servico' => 'nullable|numeric',
        ]);

        $pedido->update($data);
        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado.');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido excluído.');
    }

    /**
     * Show orders for the currently authenticated client.
     */
    public function meusPedidos()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $cliente = Cliente::where('email', $user->email)->first();

        if (!$cliente) {
            $pedidos = collect();
        } else {
            $pedidos = Pedido::where('cod_cliente', $cliente->cod_cliente)
                ->with('itensPedido.prato')
                ->orderBy('datahora', 'desc')
                ->get();
        }

        return view('pedidos.meus', compact('pedidos'));
    }

    /**
     * Finalize a pedido by the authenticated client.
     * Marks the pedido as encerrado and records the encerramento time.
     */
    public function finalizar(Pedido $pedido)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Find the cliente linked to this user by email
        $cliente = Cliente::where('email', $user->email)->first();
        if (!$cliente || $pedido->cod_cliente != $cliente->cod_cliente) {
            abort(403, 'Não autorizado');
        }

        // Mark as encerrado and set encerramento time
        $pedido->encerrado = 1;
        $pedido->datahora_encerramento = now();
        $pedido->save();

        return redirect()->route('pedidos.meus')->with('success', 'Um atendente está indo a sua mesa para realização do pagamento.');
    }
}
