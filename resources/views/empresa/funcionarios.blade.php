@extends('layouts.app')

@section('content')
<h2>Funcionários da Empresa</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('empresa.funcionarios.adicionar') }}" method="POST" class="mb-4">
    @csrf
    <div class="form-row">
        <div class="col">
            <input type="text" name="nome" placeholder="Nome" class="form-control" required>
        </div>
        <div class="col">
            <input type="email" name="email" placeholder="E-mail" class="form-control" required>
        </div>
        <div class="col">
            <input type="password" name="senha" placeholder="Senha" class="form-control" required>
        </div>
        <div class="col">
            <input type="password" name="senha_confirmation" placeholder="Confirmar Senha" class="form-control" required>
        </div>
        <div class="col">
            <button class="btn btn-success">Adicionar</button>
        </div>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
