@extends('layouts.app')

@section('content')
<h1>Categoria: {{ $categoria->descricao }}</h1>

<p><strong>Descrição:</strong> {{ $categoria->descricao }}</p>

<a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-warning">Editar</a>
<a href="{{ route('categorias.index') }}" class="btn btn-secondary">Voltar</a>

@endsection
