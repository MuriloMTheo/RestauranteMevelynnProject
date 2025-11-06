@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-3">
    <h1>Categorias</h1>
    <a href="{{ route('categorias.create') }}" class="btn btn-primary">Nova Categoria</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Descrição</th>
            <th class="text-right">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($categorias as $c)
        <tr>
            <td>{{ $c->descricao }}</td>
            <td class="text-right">
                <a href="{{ route('categorias.show', $c) }}" class="btn btn-sm btn-secondary">Ver</a>
                <a href="{{ route('categorias.edit', $c) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('categorias.destroy', $c) }}" method="POST" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $categorias->links() }}

@endsection
