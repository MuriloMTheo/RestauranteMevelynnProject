@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-3">
    <h1>Cardápio</h1>
    <a href="{{ route('pratos.index') }}" class="btn btn-primary">Ver Pratos (Admin)</a>
</div>

<h2>Nossos pratos</h2>
@php
    $pratos = \App\Models\Prato::orderBy('descricao')->limit(10)->get();
@endphp

@if($pratos->isEmpty())
    <p>Cardápio vazio por enquanto.</p>
@else
    <div class="row">
    @foreach($pratos as $p)
                    <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $p->descricao }}</h5>
                    <p class="card-text">{{ $p->categoria->descricao ?? '-' }}</p>
                    <p class="text-right">R$ {{ number_format($p->valor_unitario,2,',','.') }}</p>
                    <a href="{{ route('pratos.show', $p) }}" class="btn btn-sm btn-outline-primary">Detalhes</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endif

@endsection
