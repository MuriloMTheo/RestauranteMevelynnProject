<?php

namespace App\Http\Controllers;

use App\Models\ItemPedido;
use App\Models\Prato;
use Illuminate\Http\Request;

class ItemPedidoController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'cod_pedido' => 'required|exists:pedidos,cod_pedido',
            'cod_prato' => 'required|exists:pratos,cod_prato',
            'quantidade' => 'required|integer|min:1',
            'valor_unitario' => 'nullable|numeric',
            'cod_garcom' => 'nullable|exists:garcons,cod_garcom',
        ]);

        // If valor_unitario wasn't provided or is empty/zero, use the prato's registered price
        if (empty($data['valor_unitario'])) {
            $prato = Prato::find($data['cod_prato']);
            $data['valor_unitario'] = $prato ? $prato->valor_unitario : 0;
        }

        $data['data_hora'] = now();

        ItemPedido::create($data);

        return redirect()->back()->with('success', 'Item de pedido adicionado.');
    }

    public function destroy(ItemPedido $item)
    {
        $item->delete();
        return redirect()->back()->with('success', 'Item de pedido removido.');
    }
}
