@csrf
<div class="mb-3">
    <label class="form-label">Descrição</label>
    <input type="text" name="descricao" value="{{ old('descricao', $categoria->descricao ?? '') }}" class="form-control" required>
    @error('descricao')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<button class="btn btn-primary">Salvar</button>
