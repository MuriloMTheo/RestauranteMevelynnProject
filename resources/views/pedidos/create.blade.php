@extends('layouts.app')

@section('content')
<h1>Novo Pedido</h1>

<form action="{{ route('pedidos.store') }}" method="POST">
    @include('pedidos._form')
</form>

@endsection
