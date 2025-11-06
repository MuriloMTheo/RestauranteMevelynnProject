<?php

namespace App\Http\Controllers;

use App\Models\Prato;
use App\Models\Categoria;
use App\Models\Composicao;
use App\Models\Ingrediente;
use Illuminate\Http\Request;

class PratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 10;
        $query = Prato::with('categoria');

        if ($term = $request->query('q')) {
            $query->where('descricao', 'like', "%{$term}%");
        }

        $pratos = $query->orderBy('descricao')->paginate($perPage)->withQueryString();

        return view('pratos.index', compact('pratos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::orderBy('descricao')->get();
        return view('pratos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'descricao' => 'required|string|max:255',
            'cod_cat' => 'required|exists:categorias,cod_cat',
            'valor_unitario' => 'required|numeric',
        ]);

        $prato = Prato::create($data);

        return redirect()->route('pratos.index')
            ->with('success', "Prato '{$prato->descricao}' cadastrado com sucesso.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Prato $prato)
    {
        $prato->load('categoria', 'composicoes.ingrediente');
        $ingredientes = Ingrediente::orderBy('descricao')->get();
        return view('pratos.show', compact('prato', 'ingredientes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prato $prato)
    {
        $categorias = Categoria::orderBy('descricao')->get();
        return view('pratos.edit', compact('prato', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prato $prato)
    {
        $data = $request->validate([
            'descricao' => 'required|string|max:255',
            'cod_cat' => 'required|exists:categorias,cod_cat',
            'valor_unitario' => 'required|numeric',
        ]);

        $prato->update($data);

        return redirect()->route('pratos.index')
            ->with('success', "Prato '{$prato->descricao}' atualizado com sucesso.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prato $prato)
    {
        // make sure any dependent records are handled by DB cascade or manually
        $prato->delete();

        return redirect()->route('pratos.index')
            ->with('success', "Prato '{$prato->descricao}' excluído com sucesso.");
    }
}
