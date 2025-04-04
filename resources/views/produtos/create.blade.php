@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Cadastrar Produto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erros:</strong>
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf

        <div class="card mb-4">
            <div class="card-header">Dados do Produto</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label>Código Interno</label>
                    <input type="text" name="codigointerno" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label>Descrição</label>
                    <input type="text" name="descr" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label>Preço Máximo</label>
                    <input type="number" step="0.01" name="precomax" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Marca</label>
                    <input type="text" name="marca" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Tipo Produto</label>
                    <input type="text" name="tipoprod" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>NCM</label>
                    <input type="text" name="ncm" class="form-control">
                </div>

                <div class="col-md-4">
                    <label>Ativo</label>
                    <input type="checkbox" name="ativo" checked>
                </div>

                <div class="col-md-4">
                    <label>Manufaturado</label>
                    <input type="checkbox" name="manufaturado">
                </div>

                <div class="col-md-4">
                    <label>Sazonal</label>
                    <input type="checkbox" name="sazonal">
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">Dados da Embalagem</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label>Descrição Reduzida</label>
                    <input type="text" name="descrereduzida" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Descrição</label>
                    <input type="text" name="embalagem_descr" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Apresentação</label>
                    <input type="text" name="apresentacao" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Código de Barras</label>
                    <input type="text" name="barra" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Fator Conversão</label>
                    <input type="number" name="fatorconv" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Altura</label>
                    <input type="number" name="altura" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Largura</label>
                    <input type="number" name="largura" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Comprimento</label>
                    <input type="number" name="comprimento" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Unidade Venda</label>
                    <input type="text" name="unidadevenda" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Unidade Compra</label>
                    <input type="text" name="unidadecompra" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Peso Bruto</label>
                    <input type="number" name="pesobruto" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Peso Líquido</label>
                    <input type="number" name="pesoliquido" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Caixa Fechada</label>
                    <input type="checkbox" name="caixafechada">
                </div>

                <div class="col-md-6">
                    <label>Controla Estoque</label>
                    <input type="checkbox" name="controleestoque">
                </div>

                <div class="form-group mb-2" style="max-width: 150px;">
                    <label>Estoque</label>
                    <input type="number" name="estoque" class="form-control form-control-sm" value="{{ old('estoque', $produto->estoque ?? 0) }}">
                </div>
            </div>
        </div>

        <button class="btn btn-success">Salvar Produto</button>
    </form>
</div>
@endsection
