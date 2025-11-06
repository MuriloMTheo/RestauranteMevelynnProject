<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cardapio', function () {
    return view('cardapio');
})->name('cardapio');

// ROTAS DE CLIENTES 
Route::resource('clientes', ClienteController::class)->middleware(['auth']);

require __DIR__.'/auth.php';