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
        $empresa = Empresa::find(auth()->user()->empresa_id); // <- FORÇA RECARREGAR

        if (!$empresa) {
            return redirect()->route('empresa.criar')->with('error', 'Você precisa criar uma empresa antes de acessar as configurações.');
        }

        $emails = EmailPermitido::where('empresa_id', $empresa->id)->get();
        $usuarios = User::where('empresa_id', $empresa->id)->get();

        return view('empresa.configuracoes', compact('empresa', 'emails', 'usuarios'));
    }


    public function atualizarDados(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:20',
        ]);

        $empresa = Empresa::find(auth()->user()->empresa_id);

        if (auth()->id() !== $empresa->empresa_admin_id) {
            abort(403);
        }

        $empresa->update([
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'endereco' => $request->endereco,
            'telefone' => $request->telefone,
        ]);

        return redirect()->route('empresa.configuracoes')->with('success', 'Dados da empresa atualizados com sucesso!');
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

    public function criar()
    {
        return view('empresa.criar');
    }

    
    public function salvar(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:20',
        ]);

        $empresa = Empresa::create([
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'endereco' => $request->endereco,
            'telefone' => $request->telefone,
            'empresa_admin_id' => auth()->id(),
        ]);

        $user = User::find(auth()->id());
        $user->empresa_id = $empresa->id;
        $user->save();

        return redirect()->route('empresa.configuracoes')->with('success', 'Empresa criada com sucesso!');
    }



}
