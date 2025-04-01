@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Produtos</h2>
    <a href="{{ route('produtos.create') }}" class="btn btn-success">Novo Produto</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Código</th>
            <th>Estoque Mínimo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $produto)
            <tr>
                <td>{{ $produto->id }}</td>
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->codigo }}</td>
                <td>{{ $produto->estoque_minimo }}</td>
                <td>
                    <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('produtos.destroy', $produto) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Tem certeza?')" class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
