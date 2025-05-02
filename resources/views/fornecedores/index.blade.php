@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/fornecedores.css') }}">

<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h5 class="mb-0">Fornecedores</h5>
            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalCriarFornecedor">
                <i class="fas fa-plus-circle me-1"></i> Cadastrar Fornecedor
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
                            <th>Razão Social</th>
                            <th>CNPJ</th>
                            <th>Cidade</th>
                            <th>Telefone</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fornecedores as $fornecedor)
                        <tr>
                            <td>{{ $fornecedor->codigointerno }}</td>
                            <td>{{ $fornecedor->razaosocial }}</td>
                            <td>{{ $fornecedor->cnpj }}</td>
                            <td>{{ $fornecedor->cidade }}</td>
                            <td>{{ $fornecedor->telefone }}</td>
                            <td class="text-end">
                                <!-- Botão Editar -->
                                <button class="btn btn-sm btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#editarFornecedorModal-{{ $fornecedor->id }}">
                                    <i class="fas fa-pen text-primary"></i>
                                </button>

                                <!-- Modal Editar -->
                                @include('fornecedores.modal-editar', ['fornecedor' => $fornecedor])

                                <!-- Botão Excluir -->
                                <form method="POST" action="{{ route('fornecedores.destroy', $fornecedor->id) }}" class="d-inline" onsubmit="return confirm('Remover este fornecedor?')">
                                    @csrf
                                    @method('DELETE')
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

<!-- Modal Criar Fornecedor -->
@include('fornecedores.modal-criar')

<script src="{{ asset('js/fornecedores.js') }}"></script>
@endsection
