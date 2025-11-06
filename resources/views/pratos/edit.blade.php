@extends('layouts.app')

@section('content')
<h1>Editar Prato</h1>

<form action="{{ route('pratos.update', $prato) }}" method="POST">
    @method('PUT')
    @include('pratos._form')
</form>

@endsection
