@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-3">
    <h1>Cidades</h1>
    <a href="{{ route('cidades.create') }}" class="btn btn-primary">Nova Cidade</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>UF</th>
            <th class="text-right">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($cidades as $c)
        <tr>
            <td>{{ $c->nome }}</td>
            <td>{{ $c->uf }}</td>
            <td class="text-right">
                <a href="{{ route('cidades.show', $c) }}" class="btn btn-sm btn-secondary">Ver</a>
                <a href="{{ route('cidades.edit', $c) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('cidades.destroy', $c) }}" method="POST" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $cidades->links() }}

@endsection
