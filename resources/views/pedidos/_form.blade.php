@csrf
<div class="mb-3">
    <label class="form-label">Data/Hora</label>
    <input type="datetime-local" name="datahora" value="{{ old('datahora', isset($pedido) ? date('Y-m-d\TH:i', strtotime($pedido->datahora)) : '') }}" class="form-control" required>
    @error('datahora')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Cliente</label>
    <select name="cod_cliente" class="form-select" required>
        <option value="">-- selecione --</option>
        @foreach($clientes as $c)
            <option value="{{ $c->cod_cliente }}" {{ (old('cod_cliente', $pedido->cod_cliente ?? '') == $c->cod_cliente) ? 'selected' : '' }}>{{ $c->nome }}</option>
        @endforeach
    </select>
    @error('cod_cliente')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Tipo</label>
    <input type="text" name="tipo_pedido" value="{{ old('tipo_pedido', $pedido->tipo_pedido ?? '') }}" class="form-control" required>
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

<button class="btn btn-primary">Salvar</button>
