@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-3">
    <h1>Entregadores</h1>
    <a href="{{ route('entregadores.create') }}" class="btn btn-primary">Novo Entregador</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Celular</th>
            <th class="text-right">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($entregadores as $e)
        <tr>
            <td>{{ $e->nome }}</td>
            <td>{{ $e->celular }}</td>
            <td class="text-right">
                <a href="{{ route('entregadores.edit', $e) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('entregadores.destroy', $e) }}" method="POST" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $entregadores->links() }}

@endsection
