@extends('layouts.app')

@section('content')
<h1>Pedido: {{ $pedido->cod_pedido }}</h1>

<p><strong>Data/Hora:</strong> {{ $pedido->datahora }}</p>
<p><strong>Cliente:</strong> {{ $pedido->cliente->nome ?? '-' }}</p>
<p><strong>Tipo:</strong> {{ $pedido->tipo_pedido }}</p>

<h3>Itens</h3>
@if($pedido->itensPedido->isEmpty())
    <p>Sem itens.</p>
@else
    <table class="table table-sm">
    <thead><tr><th>Prato</th><th class="text-right">Quantidade</th><th class="text-right">Valor unit.</th></tr></thead>
        <tbody>
        @foreach($pedido->itensPedido as $item)
            <tr>
                <td>{{ $item->prato->descricao ?? '-' }}</td>
                <td class="text-right">{{ $item->quantidade }}</td>
                <td class="text-right">{{ number_format($item->valor_unitario,2,',','.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

<a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Voltar</a>

<hr>
<h4>Adicionar item</h4>
<form action="{{ route('itens-pedido.store') }}" method="POST" class="row g-2">
    @csrf
    <input type="hidden" name="cod_pedido" value="{{ $pedido->cod_pedido }}">
    <div class="col-md-5">
        <select name="cod_prato" id="add-item-prato" class="form-select" required>
            <option value="">-- prato --</option>
            @foreach(\App\Models\Prato::orderBy('descricao')->get() as $pr)
                <option value="{{ $pr->cod_prato }}" data-price="{{ $pr->valor_unitario }}">{{ $pr->descricao }} - R$ {{ number_format($pr->valor_unitario,2,',','.') }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <input type="number" name="quantidade" class="form-control" placeholder="Qtd" value="1" required>
    </div>
    <div class="col-md-3">
        <input type="number" step="0.01" name="valor_unitario" id="add-item-valor" class="form-control" placeholder="Valor unit." required readonly>
    </div>
    <div class="col-md-2">
        <button class="btn btn-success">Adicionar</button>
    </div>
</form>

@push('scripts')
<script>
    (function(){
        const pratoSelect = document.getElementById('add-item-prato');
        const valorInput = document.getElementById('add-item-valor');
        if(pratoSelect && valorInput){
            pratoSelect.addEventListener('change', function(){
                const opt = this.selectedOptions[0];
                if(opt && opt.dataset.price){
                    valorInput.value = parseFloat(opt.dataset.price).toFixed(2);
                }
            });
            // initialize if something is preselected
            if(pratoSelect.selectedIndex > 0){
                const opt = pratoSelect.selectedOptions[0];
                if(opt && opt.dataset.price) valorInput.value = parseFloat(opt.dataset.price).toFixed(2);
            }
        }
    })();
</script>
@endpush

@endsection
