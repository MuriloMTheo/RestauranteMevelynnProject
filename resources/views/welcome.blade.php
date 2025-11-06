<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante Mevelynn - Bem-vindo</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <h1>Bem-vindo ao Mevelynn!</h1>
        <nav>
            <a href="{{ route('cardapio') }}">Cardápio</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Cadastrar-se</a>
        </nav>
    </header>
    <main>
        <h2>Explore nossos pratos deliciosos!</h2>
        <p>Escolha seus itens favoritos e faça seu pedido!</p>
    </main>
</body>
</html>
