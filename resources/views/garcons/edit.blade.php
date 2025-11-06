@extends('layouts.app')

@section('content')
<h1>Editar Garçom</h1>

<form action="{{ route('garcons.update', $garcon) }}" method="POST">
    @method('PUT')
    @include('garcons._form')
</form>

@endsection
