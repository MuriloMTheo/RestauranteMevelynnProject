@extends('layouts.app')

@section('content')
<div class="row justify-center">
    <div class="col-md-6">
        <h1>Login</h1>
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-primary">Entrar</button>
            <a href="{{ route('register') }}" class="btn btn-link">Criar conta</a>
            <a href="{{ route('cardapio') }}" class="btn btn-link">Voltar</a>
        </form>
    </div>
</div>

@endsection
