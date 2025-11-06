@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-3">
    <h1>Garçons</h1>
    <a href="{{ route('garcons.create') }}" class="btn btn-primary">Novo Garçom</a>
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
    @foreach($garcons as $g)
        <tr>
            <td>{{ $g->nome }}</td>
            <td>{{ $g->celular }}</td>
            <td class="text-right">
                <a href="{{ route('garcons.edit', $g) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('garcons.destroy', $g) }}" method="POST" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $garcons->links() }}

@endsection
