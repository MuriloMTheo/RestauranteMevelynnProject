@csrf
<div class="mb-3">
    <label class="form-label">Data/Hora</label>
    <input type="datetime-local" name="datahora" value="{{ old('datahora', isset($pedido) ? date('Y-m-d\TH:i', strtotime($pedido->datahora)) : '') }}" class="form-control" required>
    @error('datahora')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Cliente</label>
    @if(auth()->check() && isset($clientes) && count($clientes) === 1)
        @php $c = $clientes->first(); @endphp
        <input type="hidden" name="cod_cliente" value="{{ $c->cod_cliente }}">
        <div class="form-control-plaintext">{{ $c->nome }}</div>
    @else
        <select name="cod_cliente" class="form-select" required>
            <option value="">-- selecione --</option>
            @foreach($clientes as $c)
                <option value="{{ $c->cod_cliente }}" {{ (old('cod_cliente', $pedido->cod_cliente ?? '') == $c->cod_cliente) ? 'selected' : '' }}>{{ $c->nome }}</option>
            @endforeach
        </select>
        @error('cod_cliente')<div class="text-danger">{{ $message }}</div>@enderror
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Tipo</label>
    <select name="tipo_pedido" class="form-select" required>
        @php $tipoOld = old('tipo_pedido', $pedido->tipo_pedido ?? ''); @endphp
        <option value="">-- selecione --</option>
        <option value="PRESENCIAL" {{ $tipoOld === 'PRESENCIAL' ? 'selected' : '' }}>PRESENCIAL</option>
        <option value="DELIVERY" {{ $tipoOld === 'DELIVERY' ? 'selected' : '' }}>DELIVERY</option>
    </select>
    @error('tipo_pedido')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Entregador (opcional)</label>
        <select name="cod_entregador" class="form-select">
            <option value="">-- selecione --</option>
            @foreach($entregadores as $e)
                <option value="{{ $e->cod_entregador }}" {{ (old('cod_entregador', $pedido->cod_entregador ?? '') == $e->cod_entregador) ? 'selected' : '' }}>{{ $e->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Mesa (opcional)</label>
        <select name="cod_mesa" class="form-select">
            <option value="">-- selecione --</option>
            @foreach($mesas as $m)
                <option value="{{ $m->cod_mesa }}" {{ (old('cod_mesa', $pedido->cod_mesa ?? '') == $m->cod_mesa) ? 'selected' : '' }}>{{ $m->descricao }}</option>
            @endforeach
        </select>
    </div>
</div>

<!-- Items (pratos) -->
<h5>Itens do Pedido</h5>
@error('items')<div class="text-danger">{{ $message }}</div>@enderror
<div id="items-container">
    <!-- existing rows will be injected by JS -->
</div>

<button type="button" id="add-item" class="btn btn-secondary mb-2">Adicionar prato</button>

<div class="mb-3">
    <label class="form-label">Total do pedido:</label>
    <div id="pedido-total" class="fs-5">R$ 0,00</div>
    <input type="hidden" name="pedido_total" id="pedido_total_input" value="0">
</div>

<button class="btn btn-primary">Fazer pedido</button>

<!-- Item row template -->
<template id="item-row-template">
    <div class="item-row mb-2 border rounded p-2">
        <div class="row align-items-end">
            <div class="col-md-6 mb-2">
                <label class="form-label">Prato</label>
                <select name="__NAME_PREFIX__[cod_prato]" class="form-select item-prato" required>
                    <option value="">-- selecione --</option>
                    @foreach($pratos as $p)
                        <option value="{{ $p->cod_prato }}" data-price="{{ $p->valor_unitario }}">{{ $p->descricao }} - R$ {{ number_format($p->valor_unitario, 2, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <label class="form-label">Qtd</label>
                <input type="number" name="__NAME_PREFIX__[quantidade]" class="form-control item-quantidade" min="1" value="1" required>
            </div>
            <div class="col-md-2 mb-2">
                <label class="form-label">Valor unit.</label>
                <input type="number" step="0.01" name="__NAME_PREFIX__[valor_unitario]" class="form-control item-valor" min="0" value="0" required readonly>
            </div>
            <div class="col-md-1 mb-2">
                <label class="form-label">Subtotal</label>
                <div class="form-control-plaintext item-subtotal">R$ 0,00</div>
            </div>
            <div class="col-md-1 mb-2 text-end">
                <button type="button" class="btn btn-danger btn-sm remove-item">X</button>
            </div>
        </div>
    </div>
</template>

@push('scripts')
<script>
    (function(){
        const container = document.getElementById('items-container');
        const addBtn = document.getElementById('add-item');
        const template = document.getElementById('item-row-template').content;
        const totalDisplay = document.getElementById('pedido-total');
        const totalInput = document.getElementById('pedido_total_input');
        let index = 0;

        function moneyBR(value){
            return 'R$ ' + Number(value).toFixed(2).replace('.', ',');
        }

        function calcRowSubtotal(row){
            const qty = parseFloat(row.querySelector('.item-quantidade').value) || 0;
            const price = parseFloat(row.querySelector('.item-valor').value) || 0;
            const sub = qty * price;
            row.querySelector('.item-subtotal').textContent = moneyBR(sub);
            return sub;
        }

        function calcTotal(){
            let total = 0;
            container.querySelectorAll('.item-row').forEach(r => {
                total += calcRowSubtotal(r);
            });
            totalDisplay.textContent = moneyBR(total);
            totalInput.value = total.toFixed(2);
        }

        function bindRowEvents(row){
            row.querySelector('.item-prato').addEventListener('change', function(e){
                const opt = this.selectedOptions[0];
                if(opt && opt.dataset.price){
                    const p = parseFloat(opt.dataset.price) || 0;
                    row.querySelector('.item-valor').value = p.toFixed(2);
                }
                calcTotal();
            });
            row.querySelector('.item-quantidade').addEventListener('input', calcTotal);
            row.querySelector('.item-valor').addEventListener('input', calcTotal);
            row.querySelector('.remove-item').addEventListener('click', function(){
                row.remove();
                calcTotal();
            });
        }

        function addRow(prefill){
            const frag = document.importNode(template, true);
            const wrapper = frag.querySelector('.item-row');
            // replace name placeholders
            frag.querySelectorAll('[name]').forEach(el => {
                const name = el.getAttribute('name');
                const newName = name.replace('__NAME_PREFIX__', `items[${index}]`);
                el.setAttribute('name', newName);
            });
            container.appendChild(frag);
            const newRow = container.querySelectorAll('.item-row')[container.querySelectorAll('.item-row').length - 1];
            bindRowEvents(newRow);
            if(prefill){
                if(prefill.cod_prato) newRow.querySelector('.item-prato').value = prefill.cod_prato;
                if(prefill.quantidade) newRow.querySelector('.item-quantidade').value = prefill.quantidade;
                if(prefill.valor_unitario) newRow.querySelector('.item-valor').value = prefill.valor_unitario;
                calcRowSubtotal(newRow);
            }
            index++;
            calcTotal();
        }

        // Add initial row(s) from old input if present
        const oldItems = @json(old('items', []));
        if(Array.isArray(oldItems) && oldItems.length){
            oldItems.forEach(it => addRow(it));
        } else {
            // one empty row by default
            addRow();
        }

        addBtn.addEventListener('click', function(){ addRow(); });
    })();
</script>
@endpush
