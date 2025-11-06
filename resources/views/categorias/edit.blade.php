@extends('layouts.app')

@section('content')
<h1>Editar Categoria</h1>

<form action="{{ route('categorias.update', $categoria) }}" method="POST">
    @method('PUT')
    @include('categorias._form')
</form>

@endsection
