@extends('layouts.app')

@section('content')
<h1>Fornecedor: {{ $fornecedor->nome_social }}</h1>

<p><strong>CNPJ:</strong> {{ $fornecedor->cnpj }}</p>
<p><strong>Cidade:</strong> {{ $fornecedor->cidade->nome ?? '-' }} / {{ $fornecedor->cidade->uf ?? '' }}</p>

<a href="{{ route('fornecedores.edit', $fornecedor) }}" class="btn btn-warning">Editar</a>
<a href="{{ route('fornecedores.index') }}" class="btn btn-secondary">Voltar</a>

@endsection
