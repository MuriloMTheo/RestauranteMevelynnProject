@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h1>Bem-vindo ao Mevelynn!</h1>

        <p>
            <a href="{{ route('cardapio') }}" class="btn btn-primary">Ir para Cardápio</a>
            <a href="{{ route('pedidos.create') }}" class="btn btn-outline-primary">Fazer pedido</a>
        </p>
    </div>
</div>

@endsection
