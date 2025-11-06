@extends('layouts.app')

@section('content')
<h1>Ingrediente: {{ $ingrediente->descricao }}</h1>

<p><strong>Unidade:</strong> {{ $ingrediente->unidade->descricao ?? '-' }} ({{ $ingrediente->unidade->sigla ?? '' }})</p>
<p><strong>Estoque:</strong> {{ $ingrediente->quantidade_estoque }}</p>
<p><strong>Valor unitário:</strong> {{ number_format($ingrediente->valor_unitario,2,',','.') }}</p>

<a href="{{ route('ingredientes.edit', $ingrediente) }}" class="btn btn-warning">Editar</a>
<a href="{{ route('ingredientes.index') }}" class="btn btn-secondary">Voltar</a>

@endsection
