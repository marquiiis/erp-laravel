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
            padding-top: 60px;
            padding-bottom: 50px;
            overflow-x: hidden;
        }

        .top-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
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
            width: 100%;
            background-color: #212529;
            color: white;
            text-align: center;
            padding: 10px 0;
            z-index: 998;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        .content-wrapper {
            display: flex;
            flex: 1;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            transition: all 0.3s ease-in-out;
        }

        .sidebar.collapsed {
            width: 60px;
        }

        .sidebar h5 {
            padding: 15px;
            text-align: center;
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

        .content {
            flex: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .btn-toggle {
            background-color: transparent;
            border: none;
            color: white;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                height: 100%;
                transform: translateX(-100%);
                z-index: 998;
            }

            .sidebar.show {
                transform: translateX(0);
            }
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
    <div class="wrapper">
        <div class="content-wrapper">
            <div id="sidebar" class="sidebar">
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

                <form action="{{ route('logout') }}" method="POST" class="mt-3 px-3 logout-button">
                    @csrf
                    <button class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
                        <i class="fas fa-sign-out-alt me-2"></i> <span>Sair</span>
                    </button>
                </form>
            </div>

            <main class="content" id="mainContent">
                @yield('content')
            </main>
        </div>

        <footer class="bottom-bar">
            {{ date('Y') }} © Todos os direitos reservados — <a href="#" class="text-white text-decoration-underline">Ajuda</a>
        </footer>
    </div>
@else
    <main class="p-4">
        @yield('content')
    </main>
@endif

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const toggle = document.getElementById('toggleMenu');
    const sidebar = document.getElementById('sidebar');

    toggle.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
            sidebar.classList.toggle('show');
        } else {
            sidebar.classList.toggle('collapsed');
        }
    });
</script>
</body>
</html>
