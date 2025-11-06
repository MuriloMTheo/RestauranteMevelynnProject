@extends('layouts.app')

@section('content')
<h1>Editar Mesa</h1>

<form action="{{ route('mesas.update', $mesa) }}" method="POST">
    @method('PUT')
    @include('mesas._form')
</form>

@endsection
