<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserConfigController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('configuracao.usuario', compact('user'));
    }

    public function atualizarEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = \App\Models\User::find(Auth::id());
        $user->email = $request->email;
        $user->save();

        return back()->with('success_email', 'E-mail atualizado com sucesso!');
    }

    public function atualizarSenha(Request $request)
    {
        $request->validate([
            'nova_senha' => 'required|min:6|confirmed',
        ]);

        $user = \App\Models\User::find(Auth::id());
        $user->password = Hash::make($request->nova_senha);
        $user->save();

        return back()->with('success_senha', 'Senha atualizada com sucesso!');
    }
}
