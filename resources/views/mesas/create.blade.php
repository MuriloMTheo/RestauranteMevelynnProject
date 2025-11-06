@extends('layouts.app')

@section('content')
<h1>Nova Mesa</h1>

<form action="{{ route('mesas.store') }}" method="POST">
    @include('mesas._form')
</form>

@endsection
