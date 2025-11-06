<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Cliente;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $cidades = \App\Models\Cidade::all(); // pegar todas as cidades
        return view('auth.register', compact('cidades'));
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'cpf' => 'required|unique:clientes,cpf',
            'data_nasc' => 'nullable|date',
            'celular' => 'nullable|string|max:15',
            'cod_cidade' => 'required|exists:cidades,cod_cidade',
            // outros campos que quiser
        ]);

        // Criar usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Criar cliente
        $cliente = Cliente::create([
            'nome' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'data_nasc' => $request->data_nasc,
            'celular' => $request->celular,
            'cod_cidade' => $request->cod_cidade,
            // demais campos
        ]);

        // Evento de registro
        event(new Registered($user));

        // Logar usuário
        Auth::login($user);

        // Redirecionar
        return redirect(route('dashboard'));
    }
}
