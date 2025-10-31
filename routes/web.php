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