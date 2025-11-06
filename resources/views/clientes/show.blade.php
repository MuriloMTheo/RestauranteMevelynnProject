@extends('layouts.app')

@section('content')
<h1>Cliente: {{ $cliente->nome }}</h1>

<p><strong>CPF:</strong> {{ $cliente->cpf }}</p>
<p><strong>Telefone:</strong> {{ $cliente->celular }}</p>
<p><strong>Cidade:</strong> {{ $cliente->cidade->nome ?? '-' }} / {{ $cliente->cidade->uf ?? '' }}</p>

<a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning">Editar</a>
<a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>

@endsection
