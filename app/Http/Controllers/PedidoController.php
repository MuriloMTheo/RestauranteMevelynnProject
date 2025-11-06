<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Entregador;
use App\Models\Mesa;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('cliente', 'mesa', 'entregador')->orderBy('datahora', 'desc')->paginate(20);
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get();
        $entregadores = Entregador::orderBy('nome')->get();
        $mesas = Mesa::orderBy('descricao')->get();
        return view('pedidos.create', compact('clientes', 'entregadores', 'mesas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'datahora' => 'required|date_format:Y-m-d H:i:s',
            'cod_cliente' => 'required|exists:clientes,cod_cliente',
            'tipo_pedido' => 'required|string|max:20',
            'cod_entregador' => 'nullable|exists:entregadores,cod_entregador',
            'valor_entrega' => 'nullable|numeric',
            'cod_mesa' => 'nullable|exists:mesas,cod_mesa',
            'desconto' => 'nullable|numeric',
            'taxa_servico' => 'nullable|numeric',
        ]);

        Pedido::create($data);
        return redirect()->route('pedidos.index')->with('success', 'Pedido criado.');
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
            'tipo_pedido' => 'required|string|max:20',
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
}
