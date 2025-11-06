@extends('layouts.app')

@section('content')
<h1>Editar Entregador</h1>

<form action="{{ route('entregadores.update', $entregador) }}" method="POST">
    @method('PUT')
    @include('entregadores._form')
</form>

@endsection
