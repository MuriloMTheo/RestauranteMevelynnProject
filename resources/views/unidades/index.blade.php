@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-3">
    <h1>Unidades</h1>
    <a href="{{ route('unidades.create') }}" class="btn btn-primary">Nova Unidade</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Sigla</th>
            <th class="text-right">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($unidades as $u)
        <tr>
            <td>{{ $u->descricao }}</td>
            <td>{{ $u->sigla }}</td>
            <td class="text-right">
                <a href="{{ route('unidades.edit', $u) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('unidades.destroy', $u) }}" method="POST" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $unidades->links() }}

@endsection
