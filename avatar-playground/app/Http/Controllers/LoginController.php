<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;



class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('login', 'senha');

        $usuario = User::where('login', $credentials['login'])->first();

        if(!$usuario || !password_verify($credentials['senha'], $usuario->senha)) {
            return redirect()->back()->withErrors(['login' => 'Credenciais inválidas'])->withInput();
        }
        
        session(['usuario_id' => $usuario->id, 'nivelAcesso' => $usuario->nivelAcesso]);

    }
}
