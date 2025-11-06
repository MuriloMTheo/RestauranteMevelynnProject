@extends('layouts.app')

@section('content')
<h1>Nova Cidade</h1>

<form action="{{ route('cidades.store') }}" method="POST">
    @include('cidades._form')
</form>

@endsection
