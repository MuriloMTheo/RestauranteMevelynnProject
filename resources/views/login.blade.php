<!-- resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Restaurante</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <h1>Login</h1>
        <nav>
            <a href="{{ route('cardapio') }}">Voltar ao Cardápio</a>
            <a href="{{ route('login') }}">Login</a>
        </nav>
    </header>
    <main>
        <form>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Entrar</button>
        </form>
        <a href="{{ route('login') }}">Sem login? Cadastre-se</a>
    </main>
</body>
</html>
