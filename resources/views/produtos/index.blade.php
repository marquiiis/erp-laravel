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
                        <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-sm btn-outline-secondary me-1" title="Editar">
                            <i class="fas fa-pen"></i>
                        </a>
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
