<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $senha = $request->input('senha');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($senha),
        ]);

        return redirect()->route('/')->with('success', 'Usuário registrado com sucesso!');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'senha');

        $usuario = User::where('email', $credentials['email'])->first();

        if(!$usuario || !password_verify($credentials['senha'], $usuario->password)) {
            return redirect()->back()->withErrors(['login-index' => 'Credenciais inválidas'])->withInput();
        }

        return redirect()->route('avatar-edit');

    }
}
