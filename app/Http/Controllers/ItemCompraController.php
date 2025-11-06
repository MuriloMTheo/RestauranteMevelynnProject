<?php

namespace App\Http\Controllers;

use App\Models\ItemCompra;
use App\Models\Ingrediente;
use Illuminate\Http\Request;

class ItemCompraController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'cod_compra' => 'required|exists:compras,cod_compra',
            'cod_ingrediente' => 'required|exists:ingredientes,cod_ingrediente',
            'quantidade' => 'required|numeric',
            'valor_unitario' => 'required|numeric',
        ]);

        $item = ItemCompra::create($data);

        // update stock if controle_estoque
        $ingrediente = Ingrediente::find($data['cod_ingrediente']);
        if ($ingrediente && $ingrediente->controle_estoque) {
            $ingrediente->quantidade_estoque += $data['quantidade'];
            $ingrediente->save();
        }

        return redirect()->back()->with('success', 'Item de compra adicionado.');
    }

    public function destroy(ItemCompra $item)
    {
        // decrease stock if needed
        $ingrediente = $item->ingrediente;
        if ($ingrediente && $ingrediente->controle_estoque) {
            $ingrediente->quantidade_estoque -= $item->quantidade;
            if ($ingrediente->quantidade_estoque < 0) $ingrediente->quantidade_estoque = 0;
            $ingrediente->save();
        }

        $item->delete();
        return redirect()->back()->with('success', 'Item removido.');
    }
}
