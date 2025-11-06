@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-3">
    <h1>Compras</h1>
    <a href="{{ route('compras.create') }}" class="btn btn-primary">Nova Compra</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Data</th>
            <th>Fornecedor</th>
            <th class="text-right">Valor Total</th>
            <th class="text-right">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($compras as $c)
        <tr>
            <td>{{ $c->data }}</td>
            <td>{{ $c->fornecedor->nome_social ?? '-' }}</td>
            <td class="text-right">{{ number_format($c->valor_total, 2, ',', '.') }}</td>
            <td class="text-right">
                <a href="{{ route('compras.show', $c) }}" class="btn btn-sm btn-secondary">Ver</a>
                <a href="{{ route('compras.edit', $c) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('compras.destroy', $c) }}" method="POST" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $compras->links() }}

@endsection
