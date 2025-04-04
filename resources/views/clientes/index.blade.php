@extends('layouts.app')

@push('styles')
<style>
    label.form-label {
        text-align: left !important;
        display: block !important;
        width: 100% !important;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h5 class="mb-0">Clientes</h5>
            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalCriarCliente">
                <i class="fas fa-plus-circle me-1"></i> Cadastrar Cliente
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
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>CPF/CNPJ</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->codigointerno }}</td>
                            <td>{{ $cliente->razaosocial }}</td>
                            <td>{{ $cliente->fantasia }}</td>
                            <td>{{ $cliente->pessoa === 'J' ? $cliente->cnpj : $cliente->cpf }}</td>
                            <td>{{ $cliente->cidade }}</td>
                            <td>{{ $cliente->estado }}</td>
                            <td class="text-end">
                                <!-- Botão Editar -->
                                <button class="btn btn-sm btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#editarClienteModal-{{ $cliente->id }}">
                                    <i class="fas fa-pen text-primary"></i>
                                </button>

                                <!-- Modal Editar -->
                                <div class="modal fade" id="editarClienteModal-{{ $cliente->id }}" tabindex="-1">
                                  <div class="modal-dialog modal-lg">
                                    <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Cliente</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    @php $campos = [
                                                        'codigointerno' => 'Código Interno',
                                                        'razaosocial' => 'Nome',
                                                        'fantasia' => 'Sobrenome',
                                                        'pessoa' => 'Pessoa (F ou J)',
                                                        'cnpj' => 'CNPJ',
                                                        'cpf' => 'CPF',
                                                        'rg' => 'RG',
                                                        'cep' => 'CEP',
                                                        'endereco' => 'Endereço',
                                                        'numero' => 'Número',
                                                        'bairro' => 'Bairro',
                                                        'cidade' => 'Cidade',
                                                        'estado' => 'Estado',
                                                        'pais' => 'País',
                                                        'complemento' => 'Complemento',
                                                        'telefone' => 'Telefone'
                                                    ]; @endphp

                                                    @foreach ($campos as $campo => $label)
                                                    <div class="col-md-6 mb-2">
                                                        <label class="form-label text-start d-block">{{ $label }}</label>
                                                        <input type="text" name="{{ $campo }}" class="form-control" value="{{ $cliente->$campo }}">
                                                    </div>
                                                    @endforeach


                                                    <div class="col-md-6 mb-2">
                                                        <label class="form-label text-start d-block">Ativo</label>
                                                        <select name="ativo" class="form-control">
                                                            <option value="Sim" {{ $cliente->ativo === 'Sim' ? 'selected' : '' }}>Sim</option>
                                                            <option value="Não" {{ $cliente->ativo === 'Não' ? 'selected' : '' }}>Não</option>
                                                        </select>
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

                                <!-- Botão Excluir -->
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover este cliente?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Excluir">
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

<!-- Modal de Criação -->
<div class="modal fade" id="modalCriarCliente" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="{{ route('clientes.store') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach ($campos as $campo => $label)
                    <div class="col-md-6 mb-2">
                        <label class="form-label">{{ $label }}</label>
                        <input type="text" name="{{ $campo }}" class="form-control">
                    </div>
                    @endforeach

                    <div class="col-md-6 mb-2">
                        <label class="form-label">Ativo</label>
                        <select name="ativo" class="form-control">
                            <option value="Sim">Sim</option>
                            <option value="Não">Não</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Salvar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection
