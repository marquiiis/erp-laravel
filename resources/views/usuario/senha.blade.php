@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Alterar minha senha</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('user.alterarSenha') }}">
        @csrf
        <div class="form-group">
            <input type="password" name="nova_senha" placeholder="Nova senha" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="password" name="nova_senha_confirmation" placeholder="Confirmar senha" class="form-control" required>
        </div>
        <button class="btn btn-primary">Alterar</button>
    </form>
</div>
@endsection
