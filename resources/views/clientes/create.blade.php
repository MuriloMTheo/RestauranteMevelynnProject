<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            
            <h1 class="text-2xl font-bold mb-6 text-yellow-400 border-b border-gray-700 pb-2">Cadastrar Cliente</h1>

            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf

                @php
                    // Classes comuns para Input/Select
                    $input_classes = 'w-full px-4 py-2 border border-gray-700 bg-gray-900 text-gray-100 rounded-md focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50 transition duration-150 ease-in-out';
                    // Classes comuns para Label
                    $label_classes = 'block font-medium text-sm text-yellow-400 mb-1';
                @endphp
                
                <div class="mb-4">
                    <label for="nome" class="{{ $label_classes }}">Nome:</label>
                    <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required class="{{ $input_classes }}">
                    @error('nome')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="rg" class="{{ $label_classes }}">RG:</label>
                    <input type="text" name="rg" id="rg" value="{{ old('rg') }}" class="{{ $input_classes }}">
                    @error('rg')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="cpf" class="{{ $label_classes }}">CPF:</label>
                    <input type="text" name="cpf" id="cpf" value="{{ old('cpf') }}" required class="{{ $input_classes }}">
                    @error('cpf')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="data_nasc" class="{{ $label_classes }}">Data de Nascimento:</label>
                    <input type="date" name="data_nasc" id="data_nasc" value="{{ old('data_nasc') }}" class="{{ $input_classes }}">
                    @error('data_nasc')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="endereco" class="{{ $label_classes }}">Endereço:</label>
                    <input type="text" name="endereco" id="endereco" value="{{ old('endereco') }}" class="{{ $input_classes }}">
                    @error('endereco')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="numero" class="{{ $label_classes }}">Número:</label>
                    <input type="text" name="numero" id="numero" value="{{ old('numero') }}" class="{{ $input_classes }}">
                    @error('numero')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="bairro" class="{{ $label_classes }}">Bairro:</label>
                    <input type="text" name="bairro" id="bairro" value="{{ old('bairro') }}" class="{{ $input_classes }}">
                    @error('bairro')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="cod_cidade" class="{{ $label_classes }}">Cidade:</label>
                    <select name="cod_cidade" id="cod_cidade" required class="{{ $input_classes }}">
                        <option value="">Selecione uma cidade</option>
                        @foreach($cidades as $cidade)
                            <option value="{{ $cidade->cod_cidade }}" {{ old('cod_cidade') == $cidade->cod_cidade ? 'selected' : '' }}>
                                {{ $cidade->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('cod_cidade')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="cep" class="{{ $label_classes }}">CEP:</label>
                    <input type="text" name="cep" id="cep" value="{{ old('cep') }}" class="{{ $input_classes }}">
                    @error('cep')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="celular" class="{{ $label_classes }}">Celular:</label>
                    <input type="text" name="celular" id="celular" value="{{ old('celular') }}" class="{{ $input_classes }}">
                    @error('celular')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="{{ $label_classes }}">Email:</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="{{ $input_classes }}">
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="w-full py-3 bg-gradient-to-r from-yellow-500 to-purple-600 text-gray-900 font-bold uppercase rounded-md hover:from-yellow-400 hover:to-purple-500 transition duration-150 ease-in-out shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-purple-500 focus:ring-opacity-50">
                    Cadastrar
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>