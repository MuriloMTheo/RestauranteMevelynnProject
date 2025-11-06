@extends('layouts.app')

@section('content')
<h1>Editar Compra</h1>

<form action="{{ route('compras.update', $compra) }}" method="POST">
    @method('PUT')
    @include('compras._form')
</form>

@endsection
