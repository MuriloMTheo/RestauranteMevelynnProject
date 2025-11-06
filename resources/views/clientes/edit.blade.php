@extends('layouts.app')

@section('content')
<h1>Editar Cliente</h1>

<form action="{{ route('clientes.update', $cliente) }}" method="POST">
    @method('PUT')
    @include('clientes._form')
</form>

@endsection
