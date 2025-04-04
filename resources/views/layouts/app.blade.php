<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ERP') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <!-- Custom CSS -->
    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }

        .sidebar a {
            color: #ddd;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: background-color 0.2s ease;
        }

        .sidebar a:hover,
        .sidebar .active {
            background-color: #495057;
            color: #fff;
        }

        /* Animação do submenu */
        .submenu {
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease-in-out;
        }

        .submenu.show {
            max-height: 500px; /* suficiente pra mostrar os itens dentro */
        }

    </style>

</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h5 class="text-white mb-4">ERP</h5>

            <a href="{{ route('home') }}">
                <i class="fas fa-home me-2"></i> Home
            </a>

            <a href="{{ route('produtos.index') }}">
                <i class="fas fa-box-open me-2"></i> Produtos
            </a>

            <!-- Configurações com submenu -->
            <a href="#submenuConfig" data-bs-toggle="collapse" class="d-flex justify-content-between align-items-center">
                <span><i class="fas fa-cog me-2"></i> Configurações</span>
                <i class="fas fa-chevron-down"></i>
            </a>
            <div class="submenu ps-3 collapse" id="submenuConfig" data-bs-parent=".sidebar">
                <a href="{{ route('empresa.configuracoes') }}">
                    <i class="fas fa-building me-2"></i> Empresa
                </a>
                <a href="{{ route('config.usuario') }}">
                    <i class="fas fa-user me-2"></i> Usuário
                </a>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button class="btn btn-danger w-100"><i class="fas fa-sign-out-alt me-2"></i> Sair</button>
            </form>
        </div>

        <!-- Main content -->
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
