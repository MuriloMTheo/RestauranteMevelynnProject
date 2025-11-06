@extends('layouts.app')

@section('content')
<h1>Novo Prato</h1>

<form action="{{ route('pratos.store') }}" method="POST">
    @include('pratos._form')
</form>

@endsection
