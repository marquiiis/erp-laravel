<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        body {
            margin: 0;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            transition: transform 0.3s ease;
        }

        .sidebar a {
            color: #ddd;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar .active {
            background-color: #495057;
            color: #fff;
        }

        .submenu {
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease-in-out;
        }

        .submenu.show {
            max-height: 500px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                top: 0;
                left: -250px;
                height: 100%;
                z-index: 1000;
            }

            .sidebar.show {
                left: 0;
            }

            .menu-toggle {
                display: inline-block;
                margin-bottom: 10px;
            }
        }

        @media (min-width: 769px) {
            .menu-toggle {
                display: none;
            }
        }
    </style>
</head>
<body>
    @if(auth()->check())
        <!-- Botão hamburguer para mobile -->
        <div class="d-md-none bg-light p-2">
            <button id="toggleSidebar" class="btn btn-outline-secondary">
                <i class="fas fa-bars"></i> Menu
            </button>
        </div>

        <div class="wrapper">
            <!-- Sidebar -->
            <nav class="sidebar" id="sidebar">
                <a href="{{ route('home') }}" class="{{ request()->is('home') ? 'active' : '' }}">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
                <a href="{{ route('produtos.index') }}" class="{{ request()->is('produtos*') ? 'active' : '' }}">
                    <i class="fas fa-box me-2"></i> Produtos
                </a>

                <!-- Configurações com submenu -->
                <a href="#" id="toggleSubmenu">
                    <i class="fas fa-cog me-2"></i> Configurações
                    <i class="fas fa-chevron-down float-end"></i>
                </a>
                <div class="submenu {{ request()->is('configuracao*') || request()->is('configuracoes') ? 'show' : '' }}" id="submenu">
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
            </nav>

            <!-- Conteúdo principal -->
            <main class="content">
                @yield('content')
            </main>
        </div>
    @else
        <main class="p-4">
            @yield('content')
        </main>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS para animação e toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleSidebar = document.getElementById('toggleSidebar');
            const sidebar = document.getElementById('sidebar');
            const toggleSubmenu = document.getElementById('toggleSubmenu');
            const submenu = document.getElementById('submenu');

            if (toggleSidebar) {
                toggleSidebar.addEventListener('click', () => {
                    sidebar.classList.toggle('show');
                });
            }

            if (toggleSubmenu) {
                toggleSubmenu.addEventListener('click', (e) => {
                    e.preventDefault();
                    submenu.classList.toggle('show');
                });
            }
        });
    </script>
</body>
</html>
