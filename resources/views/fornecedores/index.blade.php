@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-3">
    <h1>Fornecedores</h1>
    <a href="{{ route('fornecedores.create') }}" class="btn btn-primary">Novo Fornecedor</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Razão Social</th>
            <th>CNPJ</th>
            <th>Cidade</th>
            <th class="text-right">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($fornecedores as $f)
        <tr>
            <td>{{ $f->nome_social }}</td>
            <td>{{ $f->cnpj }}</td>
            <td>{{ $f->cidade->nome ?? '-' }}</td>
            <td class="text-right">
                <a href="{{ route('fornecedores.show', $f) }}" class="btn btn-sm btn-secondary">Ver</a>
                <a href="{{ route('fornecedores.edit', $f) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('fornecedores.destroy', $f) }}" method="POST" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $fornecedores->links() }}

@endsection
