@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h5 class="mb-0">Produtos</h5>
            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalCriarProduto">
                <i class="fas fa-plus-circle me-1"></i> Cadastrar Produto
            </button>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-borderless align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Marca</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                        <tr>
                            <td>{{ $produto->codigointerno }}</td>
                            <td>{{ $produto->descr }}</td>
                            <td>{{ $produto->marca }}</td>
                            <td>R$ {{ number_format($produto->precomax, 2, ',', '.') }}</td>
                            <td>{{ $produto->estoque }}</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#editarProdutoModal-{{ $produto->id }}">
                                    <i class="fas fa-pen text-primary"></i>
                                </button>

                                <!-- Modal Editar Produto -->
                                <div class="modal fade" id="editarProdutoModal-{{ $produto->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-xl">
                                        <form method="POST" action="{{ route('produtos.update', $produto->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Editar Produto</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body container-fluid">
                                                <h6 class="fw-bold mb-2 text-start">Informações do Produto</h6>
                                                    <div class="row">
                                                        @php
                                                            $camposProduto = [
                                                                'codigointerno' => 'Código Interno',
                                                                'codreferencia' => 'Código Referência',
                                                                'descr' => 'Descrição',
                                                                'tipoprod' => 'Tipo Produto',
                                                                'subtipoprod' => 'Subtipo Produto',
                                                                'marca' => 'Marca',
                                                                'submarca' => 'Submarca',
                                                                'ncm' => 'NCM',
                                                                'codtipoprod' => 'Código Tipo Produto',
                                                                'codigoprodanvisa' => 'Cód. Prod. Anvisa',
                                                                'cnpjfamilia' => 'CNPJ Família',
                                                                'prazovalidade' => 'Prazo Validade',
                                                                'prazocomercializacao' => 'Prazo Comercialização',
                                                                'prazocritico' => 'Prazo Crítico',
                                                                'precomax' => 'Preço Máximo',
                                                                'estoque' => 'Estoque'
                                                            ];
                                                            $emb = $produto->embalagem ?? null;
                                                        @endphp
                                                        
                                                        @foreach ($camposProduto as $campo => $label)
                                                        <div class="col-md-4 mb-2">
                                                            <label class="form-label text-start d-block">{{ $label }}</label>
                                                            <input type="text" name="{{ $campo }}" class="form-control" value="{{ $produto->$campo }}">
                                                        </div>
                                                        @endforeach
                                                        
                                                        <div class="col-md-4 mb-2">
                                                            <label class="form-label text-start d-block">Ativo</label>
                                                            <select name="ativo" class="form-control">
                                                                <option value="1" {{ $produto->ativo ? 'selected' : '' }}>Sim</option>
                                                                <option value="0" {{ !$produto->ativo ? 'selected' : '' }}>Não</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 mb-2">
                                                            <label class="form-label text-start d-block">Manufaturado</label>
                                                            <select name="manufaturado" class="form-control">
                                                                <option value="1" {{ $produto->manufaturado ? 'selected' : '' }}>Sim</option>
                                                                <option value="0" {{ !$produto->manufaturado ? 'selected' : '' }}>Não</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 mb-2">
                                                            <label class="form-label text-start d-block">Sazonal</label>
                                                            <select name="sazonal" class="form-control">
                                                                <option value="1" {{ $produto->sazonal ? 'selected' : '' }}>Sim</option>
                                                                <option value="0" {{ !$produto->sazonal ? 'selected' : '' }}>Não</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                        
                                                    <hr class="my-3">
                                                        
                                                    <h6 class="fw-bold mb-2 text-start">Informações da Embalagem</h6>
                                                    <div class="row">
                                                        @php
                                                            $camposEmbalagem = [
                                                                'barra' => 'Código de Barras',
                                                                'descrereduzida' => 'Descrição Reduzida',
                                                                'embalagem_descr' => 'Descrição Completa',
                                                                'apresentacao' => 'Apresentação',
                                                                'fatorconv' => 'Fator Conversão',
                                                                'altura' => 'Altura',
                                                                'largura' => 'Largura',
                                                                'comprimento' => 'Comprimento',
                                                                'unidadevenda' => 'Unidade Venda',
                                                                'unidadecompra' => 'Unidade Compra',
                                                                'lastro' => 'Lastro',
                                                                'qtdecamada' => 'Qtd. Camada',
                                                                'pesobruto' => 'Peso Bruto',
                                                                'pesoliquido' => 'Peso Líquido',
                                                                'empmax' => 'Empilhamento Máx',
                                                            ];
                                                        @endphp
                                                        
                                                        @foreach ($camposEmbalagem as $campo => $label)
                                                        <div class="col-md-4 mb-2">
                                                            <label class="form-label text-start d-block">{{ $label }}</label>
                                                            <input type="text" name="{{ $campo }}" class="form-control" value="{{ $emb->$campo ?? '' }}">
                                                        </div>
                                                        @endforeach
                                                        
                                                        <div class="col-md-4 mb-2">
                                                            <label class="form-label text-start d-block">Caixa Fechada</label>
                                                            <select name="caixafechada" class="form-control">
                                                                <option value="1" {{ $emb && $emb->caixafechada ? 'selected' : '' }}>Sim</option>
                                                                <option value="0" {{ !$emb || !$emb->caixafechada ? 'selected' : '' }}>Não</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 mb-2">
                                                            <label class="form-label text-start d-block">Controle de Estoque</label>
                                                            <select name="controleestoque" class="form-control">
                                                                <option value="1" {{ $emb && $emb->controleestoque ? 'selected' : '' }}>Sim</option>
                                                                <option value="0" {{ !$emb || !$emb->controleestoque ? 'selected' : '' }}>Não</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover este produto?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Criação -->
@include('produtos.create-modal')
@endsection
