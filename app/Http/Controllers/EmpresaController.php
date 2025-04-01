<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use App\Models\EmailPermitido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmpresaController extends Controller
{
    public function configuracoes()
    {
        $empresa = auth()->user()->empresa;

        if (!$empresa) {
            return redirect()->route('empresa.criar')->with('error', 'Você precisa criar uma empresa antes de acessar as configurações.');
        }

        $emails = \App\Models\EmailPermitido::where('empresa_id', $empresa->id)->get();
        $usuarios = \App\Models\User::where('empresa_id', $empresa->id)->get();

        return view('empresa.configuracoes', compact('empresa', 'emails', 'usuarios'));
    }

    public function atualizarNome(Request $request)
    {
        $request->validate(['nome' => 'required|string|max:255']);

        $empresa = auth()->user()->empresa;
        $empresa->nome = $request->nome;
        $empresa->save();

        return back()->with('success', 'Nome da empresa atualizado com sucesso!');
    }

    public function adicionarEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:emails_permitidos,email',
        ]);

        $empresaId = auth()->user()->empresa_id;

        // Cria o e-mail permitido
        $emailPermitido = \App\Models\EmailPermitido::create([
            'email' => $request->email,
            'empresa_id' => $empresaId,
        ]);

        // Verifica se já existe um usuário com esse e-mail
        $user = \App\Models\User::whereRaw('LOWER(email) = ?', [strtolower($request->email)])->first();

        if ($user && is_null($user->empresa_id)) {
            $user->empresa_id = $empresaId;
            $user->save();
        }

        return back()->with('success', 'E-mail adicionado com sucesso!');
    }

    public function removerEmail($id)
    {
        $email = EmailPermitido::findOrFail($id);
        if ($email->empresa_id !== auth()->user()->empresa_id) {
            abort(403);
        }
        $email->delete();

        return back()->with('success', 'E-mail removido com sucesso.');
    }

    public function removerFuncionario($id)
    {
        $user = User::findOrFail($id);

        if ($user->empresa_id !== auth()->user()->empresa_id) {
            abort(403);
        }

        // Proteção: não pode se remover
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Você não pode se remover.');
        }

        $user->delete();

        return back()->with('success', 'Funcionário removido com sucesso.');
    }

    public function atualizarSenhaFuncionario(Request $request, $id)
    {
        $request->validate([
            'nova_senha' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);

        if ($user->empresa_id !== auth()->user()->empresa_id) {
            abort(403);
        }

        $user->password = Hash::make($request->nova_senha);
        $user->save();

        return back()->with('success', 'Senha do funcionário atualizada!');
    }

    public function criar()
    {
        return view('empresa.criar');
    }

    public function salvar(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);
    
        // Cria a empresa e já define o usuário como admin
        $empresa = Empresa::create([
            'nome' => $request->nome,
            'empresa_admin_id' => auth()->id(), // 👈 MUITO IMPORTANTE
        ]);
    
        // Atualiza o usuário logado para pertencer à empresa
        $user = User::find(auth()->id());
        $user->empresa_id = $empresa->id;
        $user->save();
    
        return redirect()->route('empresa.configuracoes')->with('success', 'Empresa criada com sucesso!');
    }
}
