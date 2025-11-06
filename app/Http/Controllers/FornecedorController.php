<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\Cidade;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::with('cidade')->orderBy('nome_social')->paginate(20);
        return view('fornecedores.index', compact('fornecedores'));
    }

    public function create()
    {
        $cidades = Cidade::orderBy('nome')->get();
        return view('fornecedores.create', compact('cidades'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome_social' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'cnpj' => 'required|string|max:18|unique:fornecedores,cnpj',
            'endereco' => 'nullable|string',
            'numero' => 'nullable|string|max:10',
            'bairro' => 'nullable|string',
            'cod_cidade' => 'required|exists:cidades,cod_cidade',
            'cep' => 'nullable|string|max:9',
            'celular' => 'nullable|string|max:15',
            'email' => 'nullable|email',
        ]);

        Fornecedor::create($data);
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor criado.');
    }

    public function edit(Fornecedor $fornecedor)
    {
        $cidades = Cidade::orderBy('nome')->get();
        return view('fornecedores.edit', compact('fornecedor', 'cidades'));
    }

    public function update(Request $request, Fornecedor $fornecedor)
    {
        $data = $request->validate([
            'nome_social' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'cnpj' => "required|string|max:18|unique:fornecedores,cnpj,{$fornecedor->cod_fornecedor},cod_fornecedor",
            'endereco' => 'nullable|string',
            'numero' => 'nullable|string|max:10',
            'bairro' => 'nullable|string',
            'cod_cidade' => 'required|exists:cidades,cod_cidade',
            'cep' => 'nullable|string|max:9',
            'celular' => 'nullable|string|max:15',
            'email' => 'nullable|email',
        ]);

        $fornecedor->update($data);
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado.');
    }

    public function destroy(Fornecedor $fornecedor)
    {
        $fornecedor->delete();
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor excluído.');
    }
}
