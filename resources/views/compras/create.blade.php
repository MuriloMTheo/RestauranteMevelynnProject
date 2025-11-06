@extends('layouts.app')

@section('content')
<h1>Nova Compra</h1>

<form action="{{ route('compras.store') }}" method="POST">
    @include('compras._form')
</form>

@endsection
