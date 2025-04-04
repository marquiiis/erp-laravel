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

    <style>
        body {
            margin: 0;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar a {
            color: #ddd;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar .active {
            background-color: #495057;
            color: #fff;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }

        #toggleMenu {
            position: fixed;
            top: 10px;
            left: 10px;
            background-color: #343a40;
            color: white;
            border: none;
            padding: 10px 12px;
            border-radius: 4px;
            z-index: 1100;
        }

        /* MOBILE: menu escondido */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                transform: translateX(-100%);
                z-index: 1050;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                padding-top: 60px;
            }
        }

        /* DESKTOP: permitir ocultar também */
        @media (min-width: 769px) {
            .sidebar.collapsed {
                transform: translateX(-250px);
            }

            .content.expanded {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

@if(auth()->check())
    <!-- Botão visível em todas resoluções -->
    <button id="toggleMenu">
        <i class="fas fa-bars"></i>
    </button>

    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <h5 class="text-white mb-4 text-end">ERP</h5>

            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="fas fa-home me-2"></i> Home
            </a>

            <!-- Cadastro com submenu -->
            <a href="#submenuCadastro" data-bs-toggle="collapse" class="d-flex justify-content-between align-items-center {{ request()->is('produtos*') || request()->is('clientes*') ? 'active' : '' }}">
                <span><i class="fas fa-folder-plus me-2"></i> Cadastro</span>
                <i class="fas fa-chevron-down"></i>
            </a>
            <div class="submenu ps-3 collapse {{ request()->is('produtos*') || request()->is('clientes*') ? 'show' : '' }}" id="submenuCadastro" data-bs-parent=".sidebar">
                <a href="{{ route('produtos.index') }}" class="{{ request()->is('produtos*') ? 'active' : '' }}">
                    <i class="fas fa-box-open me-2"></i> Produtos
                </a>
                <a href="{{ route('clientes.index') }}" class="{{ request()->is('clientes*') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i> Clientes
                </a>
            </div>


            <!-- Configurações com submenu -->
            <a href="#submenuConfig" data-bs-toggle="collapse" class="d-flex justify-content-between align-items-center">
                <span><i class="fas fa-cog me-2"></i> Configurações</span>
                <i class="fas fa-chevron-down"></i>
            </a>
            <div class="submenu collapse ps-3 {{ request()->is('configuracoes') || request()->is('configuracao*') ? 'show' : '' }}" id="submenuConfig">
                <a href="{{ route('empresa.configuracoes') }}" class="{{ request()->is('configuracoes') ? 'active' : '' }}">
                    <i class="fas fa-building me-2"></i> Empresa
                </a>
                <a href="{{ route('config.usuario') }}" class="{{ request()->is('configuracao/usuario') ? 'active' : '' }}">
                    <i class="fas fa-user me-2"></i> Usuário
                </a>
            </div>


            <form action="{{ route('logout') }}" method="POST" class="mt-3 px-3">
                @csrf
                <button class="btn btn-danger w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Sair
                </button>
            </form>
        </div>

        <!-- Conteúdo -->
        <main class="content" id="mainContent">
            @yield('content')
        </main>
    </div>
@else
    <!-- Layout público -->
    <main class="p-4">
        @yield('content')
    </main>
@endif

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('toggleMenu');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('mainContent');

        toggle.addEventListener('click', () => {
            // Mobile
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('show');
            } else {
                // Desktop
                sidebar.classList.toggle('collapsed');
                content.classList.toggle('expanded');
            }
        });
    });
</script>
</body>
</html>
