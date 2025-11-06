@extends('layouts.app')

@section('content')
<h1>Editar Fornecedor</h1>

<form action="{{ route('fornecedores.update', $fornecedor) }}" method="POST">
    @method('PUT')
    @include('fornecedores._form')
</form>

@endsection
