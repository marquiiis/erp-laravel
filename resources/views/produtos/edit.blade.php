@extends('layouts.app')

@section('content')
<h2>{{ isset($produto) ? 'Editar' : 'Novo' }} Produto</h2>

<form method="POST" action="{{ isset($produto) ? route('produtos.update', $produto) : route('produtos.store') }}">
    @csrf
    @if(isset($produto))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="nome">Nome</label>
        <input class="form-control" name="nome" value="{{ old('nome', $produto->nome ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="codigo">Código</label>
        <input class="form-control" name="codigo" value="{{ old('codigo', $produto->codigo ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="estoque_minimo">Estoque Mínimo</label>
        <input type="number" class="form-control" name="estoque_minimo" value="{{ old('estoque_minimo', $produto->estoque_minimo ?? 0) }}" required>
    </div>

    <button class="btn btn-success">Salvar</button>
    <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
