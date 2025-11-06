@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-3">
    <h1>Clientes</h1>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">Novo Cliente</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Cidade</th>
            <th class="text-right">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($clientes as $c)
        <tr>
            <td>{{ $c->nome }}</td>
            <td>{{ $c->cpf }}</td>
            <td>{{ $c->cidade->nome ?? '-' }}</td>
            <td class="text-right">
                <a href="{{ route('clientes.show', $c) }}" class="btn btn-sm btn-secondary">Ver</a>
                <a href="{{ route('clientes.edit', $c) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('clientes.destroy', $c) }}" method="POST" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $clientes->links() }}

@endsection
