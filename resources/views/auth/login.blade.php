@extends('layouts.guest')

@section('content')
<div class="auth-card">
    <h2>Entrar no ERP</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">E-mail</label>
            <input id="email" type="email"
                class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autofocus>
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

        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                Lembrar-me
            </label>
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Entrar
        </button>

        <div class="text-center text-muted mt-3">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
            @endif
        </div>
        <div class="text-center text-muted mt-2">
            <a href="{{ route('register') }}">Não tem conta? Registrar</a>
        </div>
    </form>
</div>

@endsection
