@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-3">
    <h1>Pedidos</h1>
    <a href="{{ route('pedidos.create') }}" class="btn btn-primary">Novo Pedido</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Data/Hora</th>
            <th>Cliente</th>
            <th>Tipo</th>
            <th class="text-right">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pedidos as $p)
        <tr>
            <td>{{ $p->datahora }}</td>
            <td>{{ $p->cliente->nome ?? '-' }}</td>
            <td>{{ $p->tipo_pedido }}</td>
            <td class="text-right">
                <a href="{{ route('pedidos.show', $p) }}" class="btn btn-sm btn-secondary">Ver</a>
                <a href="{{ route('pedidos.edit', $p) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('pedidos.destroy', $p) }}" method="POST" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $pedidos->links() }}

@endsection
