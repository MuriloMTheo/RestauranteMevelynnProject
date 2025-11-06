<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cidade;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $clientes = Cliente::with('cidade')->orderBy('nome')->paginate(20);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $cidades = Cidade::orderBy('nome')->get();
        return view('clientes.create', compact('cidades'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'rg' => 'nullable|string|max:50',
            'cpf' => 'required|string|max:25|unique:clientes,cpf',
            'data_nasc' => 'nullable|date',
            'endereco' => 'nullable|string',
            'numero' => 'nullable|string|max:10',
            'bairro' => 'nullable|string',
            'cod_cidade' => 'required|exists:cidades,cod_cidade',
            'cep' => 'nullable|string|max:9',
            'celular' => 'nullable|string|max:15',
            'email' => 'nullable|email',
        ]);

        Cliente::create($data);
        return redirect()->route('clientes.index')->with('success', 'Cliente criado.');
    }

    public function show(Cliente $cliente)
    {
        $cliente->load('cidade');
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        $cidades = Cidade::orderBy('nome')->get();
        return view('clientes.edit', compact('cliente', 'cidades'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'rg' => 'nullable|string|max:50',
            'cpf' => "required|string|max:25|unique:clientes,cpf,{$cliente->cod_cliente},cod_cliente",
            'data_nasc' => 'nullable|date',
            'endereco' => 'nullable|string',
            'numero' => 'nullable|string|max:10',
            'bairro' => 'nullable|string',
            'cod_cidade' => 'required|exists:cidades,cod_cidade',
            'cep' => 'nullable|string|max:9',
            'celular' => 'nullable|string|max:15',
            'email' => 'nullable|email',
        ]);

        $cliente->update($data);
        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente excluído.');
    }
}
