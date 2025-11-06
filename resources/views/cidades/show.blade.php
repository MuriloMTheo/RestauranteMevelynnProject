@extends('layouts.app')

@section('content')
<h1>Cidade: {{ $cidade->nome }} / {{ $cidade->uf }}</h1>

<a href="{{ route('cidades.edit', $cidade) }}" class="btn btn-warning">Editar</a>
<a href="{{ route('cidades.index') }}" class="btn btn-secondary">Voltar</a>

@endsection
