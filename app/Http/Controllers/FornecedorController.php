<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index()
    {
        $empresaId = auth()->user()->empresa_id;
        $fornecedores = Fornecedor::where('empresa_id', $empresaId)->get();

        return view('fornecedores.index', compact('fornecedores'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'codigointerno' => 'required',
            'razaosocial' => 'required',
            'cnpj' => 'required',
        ]);

        $dados = $request->all();
        $dados['empresa_id'] = auth()->user()->empresa_id;

        Fornecedor::create($dados);

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor cadastrado com sucesso.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'codigointerno' => 'required',
            'razaosocial' => 'required',
            'cnpj' => 'required',
        ]);

        $empresaId = auth()->user()->empresa_id;
        $fornecedor = Fornecedor::where('empresa_id', $empresaId)->findOrFail($id);

        $fornecedor->update($request->all());

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso.');
    }


    public function destroy($id)
    {
        $empresaId = auth()->user()->empresa_id;
        $fornecedor = Fornecedor::where('empresa_id', $empresaId)->findOrFail($id);
    
        $fornecedor->delete();
    
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor removido com sucesso.');
    }

}
