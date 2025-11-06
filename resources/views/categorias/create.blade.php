@extends('layouts.app')

@section('content')
<h1>Nova Categoria</h1>

<form action="{{ route('categorias.store') }}" method="POST">
    @include('categorias._form')
</form>

@endsection
