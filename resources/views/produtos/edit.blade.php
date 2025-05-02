@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Produto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('produtos.update', $produto->id) }}">
        @csrf
        @method('PUT')

        <!-- Dados do Produto -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Dados do Produto</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label class="form-label text-start">Código Interno</label>
                    <input type="text" name="codigointerno" class="form-control" value="{{ $produto->codigointerno }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-start">Descrição</label>
                    <input type="text" name="descr" class="form-control" value="{{ $produto->descr }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-start">Marca</label>
                    <input type="text" name="marca" class="form-control" value="{{ $produto->marca }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label text-start">NCM</label>
                    <input type="text" name="ncm" class="form-control" value="{{ $produto->ncm }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label text-start">Preço Máximo</label>
                    <input type="number" step="0.01" name="precomax" class="form-control" value="{{ $produto->precomax }}">
                </div>
            </div>
        </div>

        <!-- Dados da Embalagem -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">Dados da Embalagem</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label class="form-label text-start">Código de Barras</label>
                    <input type="text" name="barra" class="form-control" value="{{ $produto->embalagem->barra ?? '' }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label text-start">Descrição Reduzida</label>
                    <input type="text" name="descrereduzida" class="form-control" value="{{ $produto->embalagem->descrereduzida ?? '' }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label text-start">Descrição da Embalagem</label>
                    <input type="text" name="embalagem_descr" class="form-control" value="{{ $produto->embalagem->descr ?? '' }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label text-start">Estoque</label>
                    <input type="number" name="estoque" class="form-control" value="{{ old('estoque', $produto->estoque ?? 0) }}">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
