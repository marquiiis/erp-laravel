@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Configuração do Usuário</h3>

    <div class="row">
        <!-- Card 1 - Atualizar E-mail -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Alterar E-mail</div>
                <div class="card-body">
                    @if(session('success_email'))
                        <div class="alert alert-success">{{ session('success_email') }}</div>
                    @endif
                    <form method="POST" action="{{ route('config.usuario.email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Novo E-mail</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Atualizar E-mail</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Card 2 - Atualizar Senha -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">Alterar Senha</div>
                <div class="card-body">
                    @if(session('success_senha'))
                        <div class="alert alert-success">{{ session('success_senha') }}</div>
                    @endif
                    <form method="POST" action="{{ route('config.usuario.senha') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nova_senha">Nova Senha</label>
                            <input type="password" class="form-control" name="nova_senha" required>
                        </div>
                        <div class="form-group">
                            <label for="nova_senha_confirmation">Confirmar Senha</label>
                            <input type="password" class="form-control" name="nova_senha_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-warning mt-2">Atualizar Senha</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
