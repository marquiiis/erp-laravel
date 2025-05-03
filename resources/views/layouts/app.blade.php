<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ERP') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .top-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: #212529;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            z-index: 999;
        }

        .bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            background-color: #212529;
            color: white;
            text-align: center;
            padding: 10px 0;
            z-index: 998;
        }

        .sidebar {
            position: fixed;
            top: 60px;
            bottom: 50px;
            left: 0;
            width: 250px;
            background-color: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease-in-out;
            overflow-y: auto;
            z-index: 997;
        }

        .sidebar.collapsed {
            width: 60px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ddd;
            padding: 10px 20px;
            text-decoration: none;
            transition: background 0.3s;
            white-space: nowrap;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #495057;
            color: white;
        }

        .sidebar h5 {
            padding: 15px;
            text-align: center;
        }

        .sidebar i {
            width: 20px;
            text-align: center;
        }

        .sidebar .submenu {
            padding-left: 35px;
        }

        .sidebar.collapsed a span,
        .sidebar.collapsed .submenu,
        .sidebar.collapsed .logout-button span,
        .sidebar.collapsed .chevron {
            display: none !important;
        }

        .sidebar.collapsed .submenu a {
            padding-left: 0 !important;
            justify-content: center !important;
        }

        .logout-button {
            padding: 15px 20px;
        }

        .content-wrapper {
            margin-top: 60px;
            margin-left: 250px;
            margin-bottom: 50px;
            padding: 20px;
            background-color: #f8f9fa;
            min-height: calc(100vh - 110px);
        }

        .sidebar.collapsed ~ .content-wrapper {
            margin-left: 60px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                transform: translateX(-100%);
                z-index: 998;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content-wrapper {
                margin-left: 0 !important;
            }
        }

        .btn-toggle {
            background-color: transparent;
            border: none;
            color: white;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <button id="toggleMenu" class="btn btn-toggle">
        <i class="fas fa-bars"></i>
    </button>
    <span>Você está logado como <strong>{{ auth()->user()->name }}</strong> — {{ now()->format('d/m/Y H:i') }}</span>
</div>

@if(auth()->check())
    <div class="sidebar" id="sidebar">
        <div>
            <h5 class="text-white">ERP</h5>

            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>

            <a href="#submenuCadastro" data-bs-toggle="collapse" class="d-flex justify-content-between align-items-center">
                <div><i class="fas fa-folder-plus"></i> <span>Cadastro</span></div>
                <i class="fas fa-chevron-down chevron"></i>
            </a>
            <div id="submenuCadastro" class="submenu collapse {{ request()->is('produtos*') || request()->is('clientes*') || request()->is('fornecedores*') ? 'show' : '' }}">
                <a href="{{ route('produtos.index') }}" class="{{ request()->is('produtos*') ? 'active' : '' }}">
                    <i class="fas fa-box-open"></i>
                    <span>Produtos</span>
                </a>
                <a href="{{ route('clientes.index') }}" class="{{ request()->is('clientes*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Clientes</span>
                </a>
                <a href="{{ route('fornecedores.index') }}" class="{{ request()->is('fornecedores*') ? 'active' : '' }}">
                    <i class="fas fa-truck"></i>
                    <span>Fornecedores</span>
                </a>
            </div>

            <a href="#submenuConfig" data-bs-toggle="collapse" class="d-flex justify-content-between align-items-center">
                <div><i class="fas fa-cog"></i> <span>Configurações</span></div>
                <i class="fas fa-chevron-down chevron"></i>
            </a>
            <div id="submenuConfig" class="submenu collapse {{ request()->is('configuracoes') || request()->is('configuracao*') ? 'show' : '' }}">
                <a href="{{ route('empresa.configuracoes') }}">
                    <i class="fas fa-building"></i>
                    <span>Empresa</span>
                </a>
                <a href="{{ route('config.usuario') }}">
                    <i class="fas fa-user"></i>
                    <span>Usuário</span>
                </a>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="logout-button">
            @csrf
            <button class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
                <i class="fas fa-sign-out-alt me-2"></i> <span>Sair</span>
            </button>
        </form>
    </div>

    <div class="content-wrapper" id="mainContent">
        @yield('content')
    </div>

    <footer class="bottom-bar">
        {{ date('Y') }} © Todos os direitos reservados — <a href="#" class="text-white text-decoration-underline">Ajuda</a>
    </footer>
@else
    <main class="p-4">
        @yield('content')
    </main>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const toggle = document.getElementById('toggleMenu');
    const sidebar = document.getElementById('sidebar');

    toggle.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
            sidebar.classList.toggle('show');
        } else {
            sidebar.classList.toggle('collapsed');
            document.getElementById('mainContent').classList.toggle('collapsed');
        }
    });
</script>
</body>
</html>
