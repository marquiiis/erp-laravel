<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transportadora;

class TransportadoraController extends Controller
{
    public function index()
    {
        $empresaId = auth()->user()->empresa_id;
        $transportadoras = Transportadora::where('empresa_id', $empresaId)->get();
        return view('transportadoras.index', compact('transportadoras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigointerno' => 'required',
            'razaosocial' => 'required',
            'cnpj' => 'required',
        ]);

        $data = $request->all();
        $data['empresa_id'] = auth()->user()->empresa_id;

        Transportadora::create($data);

        return redirect()->route('transportadoras.index')->with('success', 'Transportadora cadastrada com sucesso.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigointerno' => 'required',
            'razaosocial' => 'required',
            'cnpj' => 'required',
        ]);

        $transportadora = Transportadora::findOrFail($id);

        // Opcional: garantir que só edita se for da mesma empresa
        if ($transportadora->empresa_id != auth()->user()->empresa_id) {
            abort(403, 'Acesso não autorizado.');
        }

        $transportadora->update($request->all());

        return redirect()->route('transportadoras.index')->with('success', 'Transportadora atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $transportadora = Transportadora::findOrFail($id);

        // Opcional: garantir que só exclui se for da mesma empresa
        if ($transportadora->empresa_id != auth()->user()->empresa_id) {
            abort(403, 'Acesso não autorizado.');
        }

        $transportadora->delete();

        return redirect()->route('transportadoras.index')->with('success', 'Transportadora removida com sucesso.');
    }
}
