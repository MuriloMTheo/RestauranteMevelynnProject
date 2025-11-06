<?php

namespace App\Http\Controllers;

use App\Models\Entregador;
use Illuminate\Http\Request;

class EntregadorController extends Controller
{
    public function index()
    {
        $entregadores = Entregador::orderBy('nome')->paginate(20);
        return view('entregadores.index', compact('entregadores'));
    }

    public function create()
    {
        return view('entregadores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'celular' => 'nullable|string|max:15',
        ]);

        Entregador::create($data);
        return redirect()->route('entregadores.index')->with('success', 'Entregador criado.');
    }

    public function edit(Entregador $entregador)
    {
        return view('entregadores.edit', compact('entregador'));
    }

    public function update(Request $request, Entregador $entregador)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'celular' => 'nullable|string|max:15',
        ]);

        $entregador->update($data);
        return redirect()->route('entregadores.index')->with('success', 'Entregador atualizado.');
    }

    public function destroy(Entregador $entregador)
    {
        $entregador->delete();
        return redirect()->route('entregadores.index')->with('success', 'Entregador excluído.');
    }
}
