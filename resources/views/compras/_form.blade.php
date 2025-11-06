@csrf
<div class="mb-3">
    <label class="form-label">Data</label>
    <input type="date" name="data" value="{{ old('data', $compra->data ?? '') }}" class="form-control" required>
    @error('data')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Fornecedor</label>
    <select name="cod_fornecedor" class="form-select" required>
        <option value="">-- selecione --</option>
        @foreach($fornecedores as $f)
            <option value="{{ $f->cod_fornecedor }}" {{ (old('cod_fornecedor', $compra->cod_fornecedor ?? '') == $f->cod_fornecedor) ? 'selected' : '' }}>{{ $f->nome_social }}</option>
        @endforeach
    </select>
    @error('cod_fornecedor')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Valor Total</label>
    <input type="number" step="0.01" name="valor_total" value="{{ old('valor_total', $compra->valor_total ?? '') }}" class="form-control" required>
    @error('valor_total')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<button class="btn btn-primary">Salvar</button>
