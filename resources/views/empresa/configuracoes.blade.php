@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Configurações</h2>

    @php
        $isAdmin = auth()->id() === $empresa->empresa_admin_id;
    @endphp

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- ===================== ADMIN - Nome da Empresa ===================== -->
    @if($isAdmin)
    <form action="{{ route('empresa.atualizarNome') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group">
            <label>Nome da Empresa</label>
            <input type="text" name="nome" class="form-control" value="{{ $empresa->nome }}" required>
        </div>
        <button class="btn btn-primary">Salvar Nome</button>
    </form>
    @endif

    <!-- ===================== ADMIN - E-mails Permitidos ===================== -->
    @if($isAdmin)
    <h4>E-mails Permitidos</h4>
    <form action="{{ route('empresa.adicionarEmail') }}" method="POST" class="form-inline mb-3">
        @csrf
        <input type="email" name="email" class="form-control mr-2" placeholder="email@exemplo.com" required>
        <button class="btn btn-success">Adicionar</button>
    </form>

    <ul class="list-group mb-4">
        @forelse($emails as $email)
            <li class="list-group-item d-flex justify-content-between">
                {{ $email->email }}
                <form action="{{ route('empresa.removerEmail', $email->id) }}" method="POST" onsubmit="return confirm('Remover esse e-mail?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Remover</button>
                </form>
            </li>
        @empty
            <li class="list-group-item">Nenhum e-mail liberado.</li>
        @endforelse
    </ul>
    @endif

    <!-- ===================== TODOS - Funcionários ===================== -->
    <h4>Funcionários</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Senha</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        @if(auth()->id() === $u->id)
                            <form action="{{ route('empresa.atualizarSenha', $u->id) }}" method="POST" class="form-inline">
                                @csrf
                                <input type="password" name="nova_senha" class="form-control form-control-sm mr-1" placeholder="Nova senha" required>
                                <input type="password" name="nova_senha_confirmation" class="form-control form-control-sm mr-1" placeholder="Confirme" required>
                                <button class="btn btn-sm btn-warning">Alterar</button>
                            </form>
                        @else
                            <span class="text-muted">Somente o usuário pode alterar</span>
                        @endif
                    </td>
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
@endsection
