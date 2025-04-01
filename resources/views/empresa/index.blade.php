@extends('layouts.app')

@section('content')
<h2>Empresas</h2>

<a href="{{ route('empresas.create') }}" class="btn btn-success mb-3">Nova Empresa</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empresas as $empresa)
            <tr>
                <td>{{ $empresa->id }}</td>
                <td>{{ $empresa->nome }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
