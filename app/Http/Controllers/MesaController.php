<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    public function index()
    {
        $mesas = Mesa::orderBy('descricao')->paginate(20);
        return view('mesas.index', compact('mesas'));
    }

    public function create()
    {
        return view('mesas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'descricao' => 'required|string|max:255',
        ]);

        Mesa::create($data);
        return redirect()->route('mesas.index')->with('success', 'Mesa criada.');
    }

    public function edit(Mesa $mesa)
    {
        return view('mesas.edit', compact('mesa'));
    }

    public function update(Request $request, Mesa $mesa)
    {
        $data = $request->validate([
            'descricao' => 'required|string|max:255',
        ]);

        $mesa->update($data);
        return redirect()->route('mesas.index')->with('success', 'Mesa atualizada.');
    }

    public function destroy(Mesa $mesa)
    {
        $mesa->delete();
        return redirect()->route('mesas.index')->with('success', 'Mesa excluída.');
    }
}
