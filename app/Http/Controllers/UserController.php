<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function senha()
    {
        return view('usuario.senha');
    }

    public function alterarSenha(Request $request)
    {
        $request->validate([
            'nova_senha' => 'required|min:6|confirmed',
        ]);

        $user = User::find(auth()->id());
        $user->password = Hash::make($request->nova_senha);
        $user->save();

        return back()->with('success', 'Senha alterada com sucesso!');
    }
}
