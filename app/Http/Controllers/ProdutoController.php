<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::where('empresa_id', auth()->user()->empresa_id)->get();
        return view('produtos.index', compact('produtos'));
    }


    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'codigo' => 'required|unique:produtos,codigo',
            'estoque_minimo' => 'required|integer',
        ]);

        $produto = new Produto($request->all());
        $produto->user_id = auth()->id();
        $produto->empresa_id = auth()->user()->empresa_id;
        $produto->save();


        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso.');
    }

    public function edit(Produto $produto)
    {
        abort_unless($produto->user_id == auth()->id(), 403);
        return view('produtos.create', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required',
            'codigo' => 'required|unique:produtos,codigo,' . $produto->id,
            'estoque_minimo' => 'required|integer',
        ]);

        $produto->update($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso.');
    }
}
