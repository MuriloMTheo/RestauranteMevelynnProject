@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h1>Bem-vindo ao Mevelynn!</h1>
        <p>Explore nossos pratos deliciosos e gerencie o restaurante pelo painel.</p>
        <p>
            <a href="{{ route('cardapio') }}" class="btn btn-primary">Ir para Cardápio</a>
            <a href="{{ route('pratos.index') }}" class="btn btn-outline-secondary">Gerenciar Pratos</a>
        </p>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Resumo</h5>
                <ul class="list-unstyled">
                    <li>Pratos: {{ \App\Models\Prato::count() }}</li>
                    <li>Ingredientes: {{ \App\Models\Ingrediente::count() }}</li>
                    <li>Fornecedores: {{ \App\Models\Fornecedor::count() }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
