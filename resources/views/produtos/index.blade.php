@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Lista de Produtos</h2>
        <a href="{{ route('produtos.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-1"></i> Novo Produto
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse ($produtos as $produto)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produto->descr }}</h5>
                        <p class="card-text">
                            Código: <strong>{{ $produto->codigointerno }}</strong><br>
                            Marca: {{ $produto->marca }}<br>
                            Preço Máx: R$ {{ number_format($produto->precomax, 2, ',', '.') }}<br>
                            NCM: {{ $produto->ncm }}
                        </p>
                        @if ($produto->embalagem)
                            <hr>
                            <small>Embalagem: {{ $produto->embalagem->descrereduzida }}</small><br>
                            <small>Barras: {{ $produto->embalagem->barra }}</small>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    
                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este produto?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i> Excluir
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">Nenhum produto encontrado.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
