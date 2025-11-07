<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurante Mevelynn</title>
    <link rel="stylesheet" href="/css/app.css">
    @stack('styles')
</head>
<body>
<header>
  <div class="brand">
    <a href="/" class="brand-link"><h1>Mevelynn</h1></a>
  </div>
  <nav class="flex items-center" role="navigation">
    <div class="nav-left">
      <a class="nav-link" href="{{ route('cardapio') }}">Cardápio</a>
      @auth
          @if(auth()->user()->email === 'admin@hotmail.com')
              <!-- Admin only links -->
              <a class="nav-link" href="{{ route('pratos.index') }}">Pratos</a>
              <a class="nav-link" href="{{ route('categorias.index') }}">Categorias</a>
              <a class="nav-link" href="{{ route('ingredientes.index') }}">Ingredientes</a>
              <a class="nav-link" href="{{ route('fornecedores.index') }}">Fornecedores</a>
              <a class="nav-link" href="{{ route('compras.index') }}">Compras</a>
              <a class="nav-link" href="{{ route('pedidos.index') }}">Pedidos</a>
          @else
              <!-- Authenticated non-admin (client) -->
              <a class="nav-link" href="{{ route('pedidos.create') }}">Fazer pedido</a>
          @endif
      @endauth
    </div>
    <div class="nav-right">
      @guest
        <a class="nav-link" href="{{ route('login') }}">Login</a>
        <a class="nav-link" href="{{ route('register') }}">Registrar</a>
      @else
        <span class="text-muted">Olá, {{ auth()->user()->name }}</span>
        @if(auth()->user()->email !== 'admin@hotmail.com')
            <a class="nav-link" href="{{ route('pedidos.meus') }}">Meus pedidos</a>
        @endif
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline-block;margin-left:0.5rem">
            @csrf
            <button type="submit" class="btn btn-link">Sair</button>
        </form>
      @endguest
    </div>
  </nav>
</header>

<main>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
</main>

@stack('scripts')
</body>
</html>
