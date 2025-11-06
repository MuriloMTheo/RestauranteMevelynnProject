<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::with('fornecedor')->orderBy('data', 'desc')->paginate(20);
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        $fornecedores = Fornecedor::orderBy('nome_social')->get();
        return view('compras.create', compact('fornecedores'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'data' => 'required|date',
            'nota_fiscal' => 'nullable|string',
            'valor_total' => 'required|numeric',
            'cod_fornecedor' => 'required|exists:fornecedores,cod_fornecedor',
        ]);

        Compra::create($data);
        return redirect()->route('compras.index')->with('success', 'Compra registrada.');
    }

    public function show(Compra $compra)
    {
        $compra->load('fornecedor', 'itensCompra.ingrediente');
        return view('compras.show', compact('compra'));
    }

    public function edit(Compra $compra)
    {
        $fornecedores = Fornecedor::orderBy('nome_social')->get();
        return view('compras.edit', compact('compra', 'fornecedores'));
    }

    public function update(Request $request, Compra $compra)
    {
        $data = $request->validate([
            'data' => 'required|date',
            'nota_fiscal' => 'nullable|string',
            'valor_total' => 'required|numeric',
            'cod_fornecedor' => 'required|exists:fornecedores,cod_fornecedor',
        ]);

        $compra->update($data);
        return redirect()->route('compras.index')->with('success', 'Compra atualizada.');
    }

    public function destroy(Compra $compra)
    {
        $compra->delete();
        return redirect()->route('compras.index')->with('success', 'Compra excluída.');
    }
}
