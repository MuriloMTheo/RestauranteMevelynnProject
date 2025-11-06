@extends('layouts.app')

@section('content')
<h1>Editar Ingrediente</h1>

<form action="{{ route('ingredientes.update', $ingrediente) }}" method="POST">
    @method('PUT')
    @include('ingredientes._form')
</form>

@endsection
