@extends('layouts.app')

@section('content')
<h1>Novo Garçom</h1>

<form action="{{ route('garcons.store') }}" method="POST">
    @include('garcons._form')
</form>

@endsection
