@extends('layouts.app')

@section('content')
<h1>Nova Unidade</h1>

<form action="{{ route('unidades.store') }}" method="POST">
    @include('unidades._form')
</form>

@endsection
