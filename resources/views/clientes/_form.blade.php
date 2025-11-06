@csrf
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" value="{{ old('nome', $cliente->nome ?? '') }}" class="form-control" required>
            @error('nome')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">CPF</label>
            <input type="text" name="cpf" value="{{ old('cpf', $cliente->cpf ?? '') }}" class="form-control" required>
            @error('cpf')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Cidade</label>
            <select name="cod_cidade" class="form-select" required>
                <option value="">-- selecione --</option>
                @foreach($cidades as $cidade)
                    <option value="{{ $cidade->cod_cidade }}" {{ (old('cod_cidade', $cliente->cod_cidade ?? '') == $cidade->cod_cidade) ? 'selected' : '' }}>{{ $cidade->nome }} / {{ $cidade->uf }}</option>
                @endforeach
            </select>
            @error('cod_cidade')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Celular</label>
            <input type="text" name="celular" value="{{ old('celular', $cliente->celular ?? '') }}" class="form-control">
            @error('celular')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" value="{{ old('email', $cliente->email ?? '') }}" class="form-control">
    @error('email')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<button class="btn btn-primary">Salvar</button>
