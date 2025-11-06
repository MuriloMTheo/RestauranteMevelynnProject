@extends('layouts.app')

@section('content')
<h1>Editar Cidade</h1>

<form action="{{ route('cidades.update', $cidade) }}" method="POST">
    @method('PUT')
    @include('cidades._form')
</form>

@endsection
