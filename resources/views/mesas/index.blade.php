@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-3">
    <h1>Mesas</h1>
    <a href="{{ route('mesas.create') }}" class="btn btn-primary">Nova Mesa</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Descrição</th>
            <th class="text-right">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($mesas as $m)
        <tr>
            <td>{{ $m->descricao }}</td>
            <td class="text-right">
                <a href="{{ route('mesas.edit', $m) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('mesas.destroy', $m) }}" method="POST" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $mesas->links() }}

@endsection
