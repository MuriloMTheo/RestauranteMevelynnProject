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
                <label class="form-label">RG</label>
                <input type="text" name="rg" class="form-control" value="{{ old('rg') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">CPF</label>
                <input type="text" name="cpf" class="form-control" value="{{ old('cpf') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Data de Nascimento</label>
                <input type="date" name="data_nasc" class="form-control" value="{{ old('data_nasc') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Endereço</label>
                <input type="text" name="endereco" class="form-control" value="{{ old('endereco') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Número</label>
                <input type="text" name="numero" class="form-control" value="{{ old('numero') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Bairro</label>
                <input type="text" name="bairro" class="form-control" value="{{ old('bairro') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Cidade</label>
                <select name="cod_cidade" class="form-select" required>
                    <option value="">-- selecione --</option>
                    @foreach($cidades as $cidade)
                        <option value="{{ $cidade->cod_cidade }}" {{ old('cod_cidade') == $cidade->cod_cidade ? 'selected' : '' }}>{{ $cidade->nome }} / {{ $cidade->uf }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">CEP</label>
                <input type="text" name="cep" class="form-control" value="{{ old('cep') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Celular</label>
                <input type="text" name="celular" class="form-control" value="{{ old('celular') }}">
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
