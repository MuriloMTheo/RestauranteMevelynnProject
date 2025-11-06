<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use App\Models\Unidade;
use Illuminate\Http\Request;

class IngredienteController extends Controller
{
    public function index()
    {
        $ingredientes = Ingrediente::with('unidade')->orderBy('descricao')->paginate(20);
        return view('ingredientes.index', compact('ingredientes'));
    }

    public function create()
    {
        $unidades = Unidade::orderBy('descricao')->get();
        return view('ingredientes.create', compact('unidades'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'descricao' => 'required|string|max:255',
            'cod_unidade' => 'required|exists:unidades,cod_unidade',
            'controle_estoque' => 'nullable|boolean',
            'quantidade_estoque' => 'nullable|numeric',
            'valor_unitario' => 'nullable|numeric',
        ]);

        Ingrediente::create($data);
        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente criado.');
    }

    public function edit(Ingrediente $ingrediente)
    {
        $unidades = Unidade::orderBy('descricao')->get();
        return view('ingredientes.edit', compact('ingrediente', 'unidades'));
    }

    public function update(Request $request, Ingrediente $ingrediente)
    {
        $data = $request->validate([
            'descricao' => 'required|string|max:255',
            'cod_unidade' => 'required|exists:unidades,cod_unidade',
            'controle_estoque' => 'nullable|boolean',
            'quantidade_estoque' => 'nullable|numeric',
            'valor_unitario' => 'nullable|numeric',
        ]);

        $ingrediente->update($data);
        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente atualizado.');
    }

    public function destroy(Ingrediente $ingrediente)
    {
        $ingrediente->delete();
        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente excluído.');
    }
}
