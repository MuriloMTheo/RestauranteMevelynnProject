@extends('layouts.app')

@section('content')
<h1>Novo Cliente</h1>

<form action="{{ route('clientes.store') }}" method="POST">
    @include('clientes._form')
</form>

@endsection
