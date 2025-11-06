@extends('layouts.app')

@section('content')
<h1>Editar Pedido</h1>

<form action="{{ route('pedidos.update', $pedido) }}" method="POST">
    @method('PUT')
    @include('pedidos._form')
</form>

@endsection
