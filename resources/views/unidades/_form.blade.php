@csrf
<div class="mb-3">
    <label class="form-label">Descrição</label>
    <input type="text" name="descricao" value="{{ old('descricao', $unidade->descricao ?? '') }}" class="form-control" required>
    @error('descricao')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Sigla</label>
    <input type="text" name="sigla" value="{{ old('sigla', $unidade->sigla ?? '') }}" class="form-control" required>
    @error('sigla')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<button class="btn btn-primary">Salvar</button>
