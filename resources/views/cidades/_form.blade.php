@csrf
<div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" name="nome" value="{{ old('nome', $cidade->nome ?? '') }}" class="form-control" required>
    @error('nome')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">UF</label>
    <input type="text" name="uf" value="{{ old('uf', $cidade->uf ?? '') }}" class="form-control" required maxlength="2">
    @error('uf')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<button class="btn btn-primary">Salvar</button>
