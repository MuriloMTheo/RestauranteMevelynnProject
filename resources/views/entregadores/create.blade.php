@extends('layouts.app')

@section('content')
<h1>Novo Entregador</h1>

<form action="{{ route('entregadores.store') }}" method="POST">
    @include('entregadores._form')
</form>

@endsection
