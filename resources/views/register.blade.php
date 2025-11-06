@extends('layouts.app')

@section('content')
<div class="row justify-center">
    <div class="col-md-6">
        <h1>Registrar</h1>
        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirmar Senha</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button class="btn btn-primary">Criar conta</button>
            <a href="{{ route('login') }}" class="btn btn-link">Já tenho conta</a>
        </form>
    </div>
</div>

@endsection
