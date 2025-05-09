@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/transportadoras.css') }}">

<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h5 class="mb-0">Transportadoras</h5>
            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalCriarTransportadora">
                <i class="fas fa-plus-circle me-1"></i> Cadastrar Transportadora
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
                        @foreach ($transportadoras as $transportadora)
                        <tr>
                            <td>{{ $transportadora->codigointerno }}</td>
                            <td>{{ $transportadora->razaosocial }}</td>
                            <td>{{ $transportadora->cnpj }}</td>
                            <td>{{ $transportadora->cidade }}</td>
                            <td>{{ $transportadora->telefone }}</td>
                            <td class="text-end">
                                <!-- Botão Editar -->
                                <button class="btn btn-sm btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#editarTransportadoraModal-{{ $transportadora->id }}">
                                    <i class="fas fa-pen text-primary"></i>
                                </button>

                                <!-- Modal Editar -->
                                @include('transportadoras.modal-editar', ['transportadora' => $transportadora])

                                <!-- Botão Excluir -->
                                <form method="POST" action="{{ route('transportadoras.destroy', $transportadora->id) }}" class="d-inline" onsubmit="return confirm('Remover esta transportadora?')">
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

<!-- Modal Criar Transportadora -->
@include('transportadoras.modal-criar')

<script src="{{ asset('js/transportadoras.js') }}"></script>
@endsection
