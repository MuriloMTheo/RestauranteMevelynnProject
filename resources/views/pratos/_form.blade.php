@csrf
<div class="mb-3">
    <label class="form-label">Descrição</label>
    <input type="text" name="descricao" value="{{ old('descricao', $prato->descricao ?? '') }}" class="form-control" required>
    @error('descricao')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Categoria</label>
    <select name="cod_cat" class="form-select" required>
        <option value="">-- selecione --</option>
        @foreach($categorias as $cat)
            <option value="{{ $cat->cod_cat }}" {{ (old('cod_cat', $prato->cod_cat ?? '') == $cat->cod_cat) ? 'selected' : '' }}>{{ $cat->descricao }}</option>
        @endforeach
    </select>
    @error('cod_cat')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Valor unitário</label>
    <input type="number" step="0.01" name="valor_unitario" value="{{ old('valor_unitario', $prato->valor_unitario ?? '') }}" class="form-control" required>
    @error('valor_unitario')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<button class="btn btn-primary">Salvar</button>
