@extends('layouts.app')

@section('content')
<h2>Nova Empresa</h2>

<form action="{{ route('empresas.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nome">Nome da Empresa</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <button class="btn btn-primary">Salvar</button>
    <a href="{{ route('empresas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
