<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificaEmpresa
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // Se estiver logado, mas sem empresa, e não estiver acessando a criação
        if ($user && is_null($user->empresa_id) && !$request->is('empresa/criar') && !$request->is('empresa/salvar')) {
            return redirect()->route('empresa.criar');
        }

        return $next($request);
    }

}

