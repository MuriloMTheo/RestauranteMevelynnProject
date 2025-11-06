@extends('layouts.app')

@section('content')
<h1>Editar Unidade</h1>

<form action="{{ route('unidades.update', $unidade) }}" method="POST">
    @method('PUT')
    @include('unidades._form')
</form>

@endsection
