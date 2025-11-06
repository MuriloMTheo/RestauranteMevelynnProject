@extends('layouts.app')

@section('content')
<h1>Prato: {{ $prato->descricao }}</h1>

<p><strong>Categoria:</strong> {{ $prato->categoria->descricao ?? '-' }}</p>
<p><strong>Valor unitário:</strong> {{ number_format($prato->valor_unitario, 2, ',', '.') }}</p>

<h3>Composição</h3>
@if($prato->composicoes->isEmpty())
    <p>Sem ingredientes cadastrados.</p>
@else
    <ul>
    @foreach($prato->composicoes as $comp)
        <li>{{ $comp->ingrediente->descricao ?? '—' }}: {{ $comp->quantidade }}</li>
    @endforeach
    </ul>
@endif

<a href="{{ route('pratos.edit', $prato) }}" class="btn btn-warning">Editar</a>
<a href="{{ route('pratos.index') }}" class="btn btn-secondary">Voltar</a>

@endsection
