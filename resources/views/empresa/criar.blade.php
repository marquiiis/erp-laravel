@extends('layouts.app')

@section('content')
<h2>Cadastre sua Empresa</h2>

<form action="{{ route('empresa.salvar') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nome">Nome da Empresa</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <button class="btn btn-primary">Criar Empresa</button>
</form>
@endsection
