@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Configurações</h2>

    @php
        $isAdmin = auth()->id() === $empresa->empresa_admin_id;
    @endphp

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">

        {{-- ===================== DADOS DA EMPRESA ===================== --}}
        @if($isAdmin)
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Dados da Empresa</div>
                <div class="card-body">
                    <form action="{{ route('empresa.atualizarDados') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" value="{{ $empresa->nome }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>CNPJ</label>
                            <input type="text" name="cnpj" class="form-control" value="{{ old('cnpj', $empresa->cnpj) }}">
                        </div>
                        <div class="form-group mb-2">
                            <label>Endereço</label>
                            <input type="text" name="endereco" class="form-control" value="{{ old('endereco', $empresa->endereco) }}">
                        </div>
                        <div class="form-group mb-2">
                            <label>Telefone</label>
                            <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $empresa->telefone) }}">
                        </div>

                        <button class="btn btn-primary mt-2">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
        @endif

        {{-- ===================== E-MAILS PERMITIDOS ===================== --}}
        @if($isAdmin)
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">E-mails Permitidos</div>
                <div class="card-body">
                    <form action="{{ route('empresa.adicionarEmail') }}" method="POST" class="form-inline mb-3">
                        @csrf
                        <input type="email" name="email" class="form-control mr-2" placeholder="email@exemplo.com" required>
                        <button class="btn btn-success">Adicionar</button>
                    </form>

                    @if($emails->count())
                        <ul class="list-group">
                            @foreach($emails as $email)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $email->email }}
                                    <form action="{{ route('empresa.removerEmail', $email->id) }}" method="POST" onsubmit="return confirm('Remover esse e-mail?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Remover</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Nenhum e-mail liberado.</p>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- ===================== FUNCIONÁRIOS ===================== --}}
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">Funcionários da Empresa</div>
                <div class="card-body">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $u)
                                <tr>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>
                                        @if($isAdmin && auth()->id() !== $u->id)
                                            <form action="{{ route('empresa.removerFuncionario', $u->id) }}" method="POST" onsubmit="return confirm('Deseja remover este funcionário?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Remover</button>
                                            </form>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
