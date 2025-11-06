<?php

namespace App\Http\Controllers;

use App\Models\Garcon;
use Illuminate\Http\Request;

class GarconController extends Controller
{
    public function index()
    {
        $garcons = Garcon::orderBy('nome')->paginate(20);
        return view('garcons.index', compact('garcons'));
    }

    public function create()
    {
        return view('garcons.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'celular' => 'nullable|string|max:15',
        ]);

        Garcon::create($data);
        return redirect()->route('garcons.index')->with('success', 'Garçom criado.');
    }

    public function edit(Garcon $garcon)
    {
        return view('garcons.edit', compact('garcon'));
    }

    public function update(Request $request, Garcon $garcon)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'celular' => 'nullable|string|max:15',
        ]);

        $garcon->update($data);
        return redirect()->route('garcons.index')->with('success', 'Garçom atualizado.');
    }

    public function destroy(Garcon $garcon)
    {
        $garcon->delete();
        return redirect()->route('garcons.index')->with('success', 'Garçom excluído.');
    }
}
