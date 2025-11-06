@csrf
<div class="mb-3">
    <label class="form-label">Descrição</label>
    <input type="text" name="descricao" value="{{ old('descricao', $ingrediente->descricao ?? '') }}" class="form-control" required>
    @error('descricao')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Unidade</label>
    <select name="cod_unidade" class="form-select" required>
        <option value="">-- selecione --</option>
        @foreach($unidades as $u)
            <option value="{{ $u->cod_unidade }}" {{ (old('cod_unidade', $ingrediente->cod_unidade ?? '') == $u->cod_unidade) ? 'selected' : '' }}>{{ $u->descricao }} ({{ $u->sigla }})</option>
        @endforeach
    </select>
    @error('cod_unidade')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Controle estoque</label>
        <select name="controle_estoque" class="form-select">
            <option value="1" {{ old('controle_estoque', $ingrediente->controle_estoque ?? 1) ? 'selected' : '' }}>Sim</option>
            <option value="0" {{ !old('controle_estoque', $ingrediente->controle_estoque ?? 1) ? 'selected' : '' }}>Não</option>
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Quantidade em estoque</label>
        <input type="number" step="0.01" name="quantidade_estoque" class="form-control" value="{{ old('quantidade_estoque', $ingrediente->quantidade_estoque ?? 0) }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Valor unitário</label>
        <input type="number" step="0.01" name="valor_unitario" class="form-control" value="{{ old('valor_unitario', $ingrediente->valor_unitario ?? 0) }}">
    </div>
</div>

<button class="btn btn-primary">Salvar</button>
