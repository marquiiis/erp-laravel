@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Produtos</h2>
        <a href="{{ route('produtos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i> Cadastrar Produto
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
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
                        <!-- Botão de Editar -->
                        <button class="btn btn-sm btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#editarProdutoModal-{{ $produto->id }}">
                            <i class="fas fa-pen"></i>
                        </button>
                        <!-- Modal de Edição -->
                        <div class="modal fade" id="editarProdutoModal-{{ $produto->id }}" tabindex="-1" aria-labelledby="editarProdutoLabel-{{ $produto->id }}" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <form method="POST" action="{{ route('produtos.update', $produto->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarProdutoLabel-{{ $produto->id }}">Editar Produto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label>Código Interno</label>
                                                <input type="text" name="codigointerno" class="form-control" value="{{ $produto->codigointerno }}">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label>Descrição</label>
                                                <input type="text" name="descr" class="form-control" value="{{ $produto->descr }}">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label>Marca</label>
                                                <input type="text" name="marca" class="form-control" value="{{ $produto->marca }}">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label>Preço Máx</label>
                                                <input type="number" step="0.01" name="precomax" class="form-control" value="{{ $produto->precomax }}">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label>Estoque</label>
                                                <input type="number" name="estoque" class="form-control" value="{{ $produto->estoque }}">
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
                            <button class="btn btn-sm btn-outline-danger" title="Excluir">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
