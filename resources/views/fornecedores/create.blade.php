@extends('layouts.app')

@section('content')
<h1>Novo Fornecedor</h1>

<form action="{{ route('fornecedores.store') }}" method="POST">
    @include('fornecedores._form')
</form>

@endsection
