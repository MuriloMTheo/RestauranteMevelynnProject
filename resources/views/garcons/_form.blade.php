@csrf
<div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" name="nome" value="{{ old('nome', $garcon->nome ?? '') }}" class="form-control" required>
    @error('nome')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Celular</label>
    <input type="text" name="celular" value="{{ old('celular', $garcon->celular ?? '') }}" class="form-control">
    @error('celular')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<button class="btn btn-primary">Salvar</button>
