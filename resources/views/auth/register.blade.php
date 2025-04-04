@extends('layouts.guest')

@section('content')
<div class="auth-card">
    <h2>Criar Conta</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nome</label>
            <input id="name" type="text"
                class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autofocus>
            @error('name')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input id="email" type="email"
                class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required>
            @error('email')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input id="password" type="password"
                class="form-control @error('password') is-invalid @enderror" name="password" required>
            @error('password')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm">Confirmar senha</label>
            <input id="password-confirm" type="password" class="form-control"
                name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Registrar
        </button>

        <div class="text-center text-muted mt-2">
            <a href="{{ route('login') }}">Já tem conta? Entrar</a>
        </div>
    </form>
</div>
@endsection
