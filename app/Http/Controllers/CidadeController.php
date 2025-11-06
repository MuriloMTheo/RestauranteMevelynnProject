<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function index()
    {
        $cidades = Cidade::orderBy('nome')->paginate(20);
        return view('cidades.index', compact('cidades'));
    }

    public function create()
    {
        return view('cidades.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'uf' => 'required|string|size:2',
        ]);

        Cidade::create($data);
        return redirect()->route('cidades.index')->with('success', 'Cidade criada.');
    }

    public function show(Cidade $cidade)
    {
        return view('cidades.show', compact('cidade'));
    }

    public function edit(Cidade $cidade)
    {
        return view('cidades.edit', compact('cidade'));
    }

    public function update(Request $request, Cidade $cidade)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'uf' => 'required|string|size:2',
        ]);

        $cidade->update($data);
        return redirect()->route('cidades.index')->with('success', 'Cidade atualizada.');
    }

    public function destroy(Cidade $cidade)
    {
        $cidade->delete();
        return redirect()->route('cidades.index')->with('success', 'Cidade excluída.');
    }
}
