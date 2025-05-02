<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::all();
        return view('fornecedores.index', compact('fornecedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigointerno' => 'required',
            'razaosocial' => 'required',
            'cnpj' => 'required',
        ]);

        $fornecedor = new Fornecedor($request->all());
        $fornecedor->save();

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor cadastrado com sucesso.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigointerno' => 'required',
            'razaosocial' => 'required',
            'cnpj' => 'required',
        ]);

        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->update($request->all());

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor removido com sucesso.');
    }
}
