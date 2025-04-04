@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="card-title">Dashboard</h3>
        <p class="card-text">Bem-vindo, {{ Auth::user()->name }}. Você está logado!</p>
    </div>
</div>
@endsection
