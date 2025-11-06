@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-3">
    <h1>Pratos</h1>
    <a href="{{ route('pratos.create') }}" class="btn btn-primary">Novo Prato</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Categoria</th>
            <th class="text-right">Valor</th>
            <th class="text-right">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pratos as $p)
        <tr>
            <td>{{ $p->descricao }}</td>
            <td>{{ $p->categoria->descricao ?? '-' }}</td>
            <td class="text-right">{{ number_format($p->valor_unitario, 2, ',', '.') }}</td>
            <td class="text-right">
                <a href="{{ route('pratos.show', $p) }}" class="btn btn-sm btn-secondary">Ver</a>
                <a href="{{ route('pratos.edit', $p) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('pratos.destroy', $p) }}" method="POST" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $pratos->links() }}

@endsection
