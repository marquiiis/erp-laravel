<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

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
            'codigointerno' => 'required|string|max:255',
            'descr' => 'required|string|max:255',
            'precomax' => 'nullable|numeric',
            'barra' => 'nullable|string|max:255',
            'embalagem_descr' => 'nullable|string|max:255',
        ]);

        try {
            $produto = Produto::create([
                'codigointerno' => $request->codigointerno,
                'codreferencia' => $request->codreferencia,
                'descr' => $request->descr,
                'tipoprod' => $request->tipoprod,
                'subtipoprod' => $request->subtipoprod,
                'marca' => $request->marca,
                'submarca' => $request->submarca,
                'ncm' => $request->ncm,
                'ativo' => $request->ativo ? 1 : 0,
                'manufaturado' => $request->manufaturado ? 1 : 0,
                'sazonal' => $request->sazonal ? 1 : 0,
                'codtipoprod' => $request->codtipoprod,
                'codigoprodanvisa' => $request->codigoprodanvisa,
                'cnpjfamilia' => $request->cnpjfamilia,
                'prazovalidade' => $request->prazovalidade,
                'prazocomercializacao' => $request->prazocomercializacao,
                'prazocritico' => $request->prazocritico,
                'precomax' => $request->precomax,
                'user_id' => auth()->id(),
                'empresa_id' => auth()->user()->empresa_id,
                'estoque' => $request->estoque,
            ]);

            $produto->embalagem()->create([
                'barra' => $request->barra,
                'descrereduzida' => $request->descrereduzida,
                'descr' => $request->embalagem_descr,
                'apresentacao' => $request->apresentacao,
                'fatorconv' => $request->fatorconv,
                'altura' => $request->altura,
                'largura' => $request->largura,
                'comprimento' => $request->comprimento,
                'unidadevenda' => $request->unidadevenda,
                'unidadecompra' => $request->unidadecompra,
                'lastro' => $request->lastro,
                'qtdecamada' => $request->qtdecamada,
                'pesobruto' => $request->pesobruto,
                'pesoliquido' => $request->pesoliquido,
                'empmax' => $request->empmax,
                'caixafechada' => $request->caixafechada ? 1 : 0,
                'controleestoque' => $request->controleestoque ? 1 : 0,
                'user_id' => auth()->id(),
                'empresa_id' => auth()->user()->empresa_id,
            ]);

            return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()
                    ->withErrors(['codigointerno' => 'Código interno já existe.'])
                    ->withInput();
            }

            throw $e;
        }
    }

    public function edit($id)
    {
        $produto = Produto::where('empresa_id', auth()->user()->empresa_id)->findOrFail($id);
        return view('produtos.edit', compact('produto'));
    }

    public function destroy($id)
    {
        $produto = Produto::where('empresa_id', auth()->user()->empresa_id)->findOrFail($id);

        if ($produto->embalagem) {
            $produto->embalagem->delete();
        }

        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigointerno' => 'required|string|max:255',
            'descr' => 'required|string|max:255',
            'precomax' => 'nullable|numeric',
            'barra' => 'nullable|string|max:255',
            'embalagem_descr' => 'nullable|string|max:255',
        ]);

        $produto = Produto::where('empresa_id', auth()->user()->empresa_id)->findOrFail($id);

        $produto->update([
            'codigointerno' => $request->codigointerno,
            'codreferencia' => $request->codreferencia,
            'descr' => $request->descr,
            'tipoprod' => $request->tipoprod,
            'subtipoprod' => $request->subtipoprod,
            'marca' => $request->marca,
            'submarca' => $request->submarca,
            'ncm' => $request->ncm,
            'ativo' => $request->ativo ? 1 : 0,
            'manufaturado' => $request->manufaturado ? 1 : 0,
            'sazonal' => $request->sazonal ? 1 : 0,
            'codtipoprod' => $request->codtipoprod,
            'codigoprodanvisa' => $request->codigoprodanvisa,
            'cnpjfamilia' => $request->cnpjfamilia,
            'prazovalidade' => $request->prazovalidade,
            'prazocomercializacao' => $request->prazocomercializacao,
            'prazocritico' => $request->prazocritico,
            'precomax' => $request->precomax,
            'estoque' => $request->estoque,
        ]);

        // Atualizar a embalagem (se existir)
        if ($produto->embalagem) {
            $produto->embalagem->update([
                'barra' => $request->barra,
                'descrereduzida' => $request->descrereduzida,
                'descr' => $request->embalagem_descr,
                'apresentacao' => $request->apresentacao,
                'fatorconv' => $request->fatorconv,
                'altura' => $request->altura,
                'largura' => $request->largura,
                'comprimento' => $request->comprimento,
                'unidadevenda' => $request->unidadevenda,
                'unidadecompra' => $request->unidadecompra,
                'lastro' => $request->lastro,
                'qtdecamada' => $request->qtdecamada,
                'pesobruto' => $request->pesobruto,
                'pesoliquido' => $request->pesoliquido,
                'empmax' => $request->empmax,
                'caixafechada' => $request->caixafechada ? 1 : 0,
                'controleestoque' => $request->controleestoque ? 1 : 0,
            ]);
        }

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }
}
