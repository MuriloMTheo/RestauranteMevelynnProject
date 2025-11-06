<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');  // Página inicial
});

Route::get('/cardapio', function () {
    return view('cardapio');  // Página do cardápio
})->name('cardapio');  // Definindo o nome da rota como 'cardapio'

Route::get('/login', function () {
    return view('login');  // Página de login
})->name('login');  // Definindo o nome da rota como 'login'

// Auth endpoints (simple implementation)
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', function () { return view('register'); })->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Resource routes for CRUD
use App\Http\Controllers\PratoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\GarconController;
use App\Http\Controllers\EntregadorController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\PedidoController;

Route::resources([
    'pratos' => PratoController::class,
    'categorias' => CategoriaController::class,
    'cidades' => CidadeController::class,
    'clientes' => ClienteController::class,
    'fornecedores' => FornecedorController::class,
    'compras' => CompraController::class,
    'ingredientes' => IngredienteController::class,
    'unidades' => UnidadeController::class,
    'garcons' => GarconController::class,
    'entregadores' => EntregadorController::class,
    'mesas' => MesaController::class,
    'pedidos' => PedidoController::class,
]);

// Items and composition
use App\Http\Controllers\ItemCompraController;
use App\Http\Controllers\ItemPedidoController;
use App\Http\Controllers\ComposicaoController;

Route::post('itens-compra', [ItemCompraController::class, 'store'])->name('itens-compra.store');
Route::delete('itens-compra/{item}', [ItemCompraController::class, 'destroy'])->name('itens-compra.destroy');

Route::post('itens-pedido', [ItemPedidoController::class, 'store'])->name('itens-pedido.store');
Route::delete('itens-pedido/{item}', [ItemPedidoController::class, 'destroy'])->name('itens-pedido.destroy');

Route::post('composicao', [ComposicaoController::class, 'store'])->name('composicao.store');
Route::delete('composicao', [ComposicaoController::class, 'destroy'])->name('composicao.destroy');