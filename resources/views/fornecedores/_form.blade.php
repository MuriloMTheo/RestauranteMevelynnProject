@csrf
<div class="mb-3">
    <label class="form-label">Razão Social</label>
    <input type="text" name="nome_social" value="{{ old('nome_social', $fornecedor->nome_social ?? '') }}" class="form-control" required>
    @error('nome_social')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">CNPJ</label>
    <input type="text" name="cnpj" value="{{ old('cnpj', $fornecedor->cnpj ?? '') }}" class="form-control" required>
    @error('cnpj')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Cidade</label>
    <select name="cod_cidade" class="form-select" required>
        <option value="">-- selecione --</option>
        @foreach($cidades as $cidade)
            <option value="{{ $cidade->cod_cidade }}" {{ (old('cod_cidade', $fornecedor->cod_cidade ?? '') == $cidade->cod_cidade) ? 'selected' : '' }}>{{ $cidade->nome }} / {{ $cidade->uf }}</option>
        @endforeach
    </select>
    @error('cod_cidade')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<button class="btn btn-primary">Salvar</button>
