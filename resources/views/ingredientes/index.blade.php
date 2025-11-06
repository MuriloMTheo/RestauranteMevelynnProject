@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-3">
    <h1>Ingredientes</h1>
    <a href="{{ route('ingredientes.create') }}" class="btn btn-primary">Novo Ingrediente</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Unidade</th>
            <th class="text-right">Estoque</th>
            <th class="text-right">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($ingredientes as $i)
        <tr>
            <td>{{ $i->descricao }}</td>
            <td>{{ $i->unidade->descricao ?? '-' }}</td>
            <td class="text-right">{{ $i->quantidade_estoque }}</td>
            <td class="text-right">
                <a href="{{ route('ingredientes.show', $i) }}" class="btn btn-sm btn-secondary">Ver</a>
                <a href="{{ route('ingredientes.edit', $i) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('ingredientes.destroy', $i) }}" method="POST" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $ingredientes->links() }}

@endsection
