<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Cidade;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Handle a login POST request.
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Autenticado com sucesso');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas'])->withInput();
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',

            // cliente fields
            'rg' => 'nullable|string|max:50',
            'cpf' => 'required|string|unique:clientes,cpf',
            'data_nasc' => 'nullable|date',
            'endereco' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:10',
            'bairro' => 'nullable|string|max:255',
            'cod_cidade' => 'required|exists:cidades,cod_cidade',
            'cep' => 'nullable|string|max:9',
            'celular' => 'nullable|string|max:15',
        ]);

        // create both Cliente and User inside a transaction to keep data consistent
        DB::beginTransaction();
        try {
            $cliente = Cliente::create([
                'nome' => $data['name'],
                'rg' => $data['rg'] ?? null,
                'cpf' => $data['cpf'],
                'data_nasc' => $data['data_nasc'] ?? null,
                'endereco' => $data['endereco'] ?? null,
                'numero' => $data['numero'] ?? null,
                'bairro' => $data['bairro'] ?? null,
                'cod_cidade' => $data['cod_cidade'],
                'cep' => $data['cep'] ?? null,
                'celular' => $data['celular'] ?? null,
                'email' => $data['email'] ?? null,
            ]);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            DB::commit();

            Auth::login($user);
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Conta criada e logado');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao criar conta.'])->withInput();
        }
    }

    /**
     * Show registration form with cidades list
     */
    public function showRegister()
    {
        $cidades = Cidade::orderBy('nome')->get();
        return view('register', compact('cidades'));
    }

    /**
     * Logout the current user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
