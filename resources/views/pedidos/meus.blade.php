@extends('layouts.app')

@section('content')
<h1>Meus Pedidos</h1>

@if($pedidos->isEmpty())
    <p>Você ainda não tem pedidos.</p>
@else
    <div class="list-group">
    @foreach($pedidos as $pedido)
        <div class="card mb-3">
            <div class="card-body">
                <h5>Pedido #{{ $pedido->cod_pedido }} - {{ $pedido->datahora }}</h5>
                <p>Tipo: {{ $pedido->tipo_pedido }} | Encerrado: {{ $pedido->encerrado ? 'Sim' : 'Não' }} | Pago: {{ $pedido->pago ? 'Sim' : 'Não' }}</p>
                <ul>
                    @foreach($pedido->itensPedido as $item)
                        <li>{{ $item->prato->descricao ?? '—' }} x {{ $item->quantidade }} — R$ {{ number_format($item->valor_unitario,2,',','.') }}</li>
                    @endforeach
                </ul>
                <a href="{{ route('pedidos.show', $pedido) }}" class="btn btn-sm btn-primary">Detalhes</a>
                @if(!$pedido->encerrado)
                    <form action="{{ route('pedidos.finalizar', $pedido) }}" method="POST" style="display:inline-block">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-warning">Finalizar Pedido</button>
                    </form>
                @else
                    <span class="badge bg-secondary">Pedido finalizado</span>
                @endif
            </div>
        </div>
    @endforeach
    </div>
@endif

@endsection
