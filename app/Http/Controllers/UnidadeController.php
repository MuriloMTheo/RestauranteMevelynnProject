<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    public function index()
    {
        $unidades = Unidade::orderBy('descricao')->paginate(20);
        return view('unidades.index', compact('unidades'));
    }

    public function create()
    {
        return view('unidades.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'descricao' => 'required|string|max:255',
            'sigla' => 'required|string|max:10',
        ]);

        Unidade::create($data);
        return redirect()->route('unidades.index')->with('success', 'Unidade criada.');
    }

    public function edit(Unidade $unidade)
    {
        return view('unidades.edit', compact('unidade'));
    }

    public function update(Request $request, Unidade $unidade)
    {
        $data = $request->validate([
            'descricao' => 'required|string|max:255',
            'sigla' => 'required|string|max:10',
        ]);

        $unidade->update($data);
        return redirect()->route('unidades.index')->with('success', 'Unidade atualizada.');
    }

    public function destroy(Unidade $unidade)
    {
        $unidade->delete();
        return redirect()->route('unidades.index')->with('success', 'Unidade excluída.');
    }
}
