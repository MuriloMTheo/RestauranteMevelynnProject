<!-- resources/views/cardapio.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio - Restaurante</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <h1>Cardápio</h1>
        <nav>
            <a href="{{ route('login') }}">Login</a>
        </nav>
    </header>
    <main>
        <h2>Nossos pratos:</h2>
        <ul>
            <li>Feijoada - R$ 25,00</li>
            <li>Churrasco - R$ 35,00</li>
            <li>Pizza - R$ 20,00</li>
        </ul>
    </main>
</body>
</html>
