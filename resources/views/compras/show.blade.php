@extends('layouts.app')

@section('content')
<h1>Compra: {{ $compra->cod_compra }}</h1>

<p><strong>Data:</strong> {{ $compra->data }}</p>
<p><strong>Fornecedor:</strong> {{ $compra->fornecedor->nome_social ?? '-' }}</p>
<p><strong>Valor total:</strong> {{ number_format($compra->valor_total, 2, ',', '.') }}</p>

<h3>Itens</h3>
@if($compra->itensCompra->isEmpty())
    <p>Sem itens.</p>
@else
    <table class="table table-sm">
    <thead><tr><th>Ingrediente</th><th class="text-right">Quantidade</th><th class="text-right">Valor unit.</th></tr></thead>
        <tbody>
        @foreach($compra->itensCompra as $item)
            <tr>
                <td>{{ $item->ingrediente->descricao ?? '-' }}</td>
                <td class="text-right">{{ $item->quantidade }}</td>
                <td class="text-right">{{ number_format($item->valor_unitario, 2, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

<a href="{{ route('compras.index') }}" class="btn btn-secondary">Voltar</a>

<hr>
<h4>Adicionar item</h4>
<form action="{{ route('itens-compra.store') }}" method="POST" class="row g-2">
    @csrf
    <input type="hidden" name="cod_compra" value="{{ $compra->cod_compra }}">
    <div class="col-md-5">
        <select name="cod_ingrediente" class="form-select" required>
            <option value="">-- ingrediente --</option>
            @foreach(\App\Models\Ingrediente::orderBy('descricao')->get() as $ing)
                <option value="{{ $ing->cod_ingrediente }}">{{ $ing->descricao }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <input type="number" step="0.01" name="quantidade" class="form-control" placeholder="Qtd" required>
    </div>
    <div class="col-md-3">
        <input type="number" step="0.01" name="valor_unitario" class="form-control" placeholder="Valor unit." required>
    </div>
    <div class="col-md-2">
        <button class="btn btn-success">Adicionar</button>
    </div>
</form>

@endsection
