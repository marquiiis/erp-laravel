<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel ERP</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 4 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding-top: 70px;
        }

        .navbar-custom {
            background-color: #1f4037;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link,
        .navbar-custom .btn {
            color: #fff;
        }

        .navbar-custom .btn:hover {
            background-color: #168f69;
            border-color: #168f69;
        }
    </style>
</head>
<body>
    @auth
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                CHAYDOW
            </a>
            <a class="nav-link" href="{{ route('produtos.index') }}">Produtos</a>
            <a href="{{ route('empresa.configuracoes') }}" class="nav-link">Configurações</a>
            <a class="nav-link" href="{{ route('config.usuario') }}">Configurações do Usuário</a>

            <div class="ml-auto d-flex align-items-center">
                <span class="mr-3">Olá, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-light">Sair</button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    <main class="container py-4">
        @yield('content')
    </main>
</body>
</html>
