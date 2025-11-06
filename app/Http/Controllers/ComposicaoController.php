<?php

namespace App\Http\Controllers;

use App\Models\Composicao;
use App\Models\Ingrediente;
use App\Models\Prato;
use Illuminate\Http\Request;

class ComposicaoController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'cod_prato' => 'required|exists:pratos,cod_prato',
            'cod_ingrediente' => 'required|exists:ingredientes,cod_ingrediente',
            'quantidade' => 'required|numeric',
        ]);

        // upsert composition
        Composicao::updateOrCreate([
            'cod_prato' => $data['cod_prato'],
            'cod_ingrediente' => $data['cod_ingrediente'],
        ], ['quantidade' => $data['quantidade']]);

        return redirect()->back()->with('success', 'Composição salva.');
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'cod_prato' => 'required|exists:pratos,cod_prato',
            'cod_ingrediente' => 'required|exists:ingredientes,cod_ingrediente',
        ]);

        Composicao::where('cod_prato', $validated['cod_prato'])
            ->where('cod_ingrediente', $validated['cod_ingrediente'])
            ->delete();

        return redirect()->back()->with('success', 'Ingrediente removido da composição.');
    }
}
