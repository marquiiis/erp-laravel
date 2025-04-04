@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de Produtos</h2>
        <a href="{{ route('produtos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Produto
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($produtos->isEmpty())
        <div class="alert alert-warning">Nenhum produto cadastrado ainda.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Código Interno</th>
                    <th>Descrição</th>
                    <th>Estoque</th>
                    <th>Preço Máx</th>
                    <th class="text-center" width="150">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <td>{{ $produto->codigointerno }}</td>
                        <td>{{ $produto->descr }}</td>
                        <td>{{ $produto->estoque ?? '-' }}</td>
                        <td>R$ {{ number_format($produto->precomax, 2, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja remover este produto?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
