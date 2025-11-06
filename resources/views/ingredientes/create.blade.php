@extends('layouts.app')

@section('content')
<h1>Novo Ingrediente</h1>

<form action="{{ route('ingredientes.store') }}" method="POST">
    @include('ingredientes._form')
</form>

@endsection
