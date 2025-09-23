<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>@yield('title', 'Sistema')</title><meta name="viewport" content="width=device-width, initial-scale=1"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* --- Estilos Globales para el Body y el Fondo --- */
        body {
            background-image: url('{{ asset('logo.png/fondo.png') }}');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-color: #121212;
            color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- Estilos para el Contenedor Principal de Contenido (Transparente) --- */
        .content-wrapper {
            padding: 2rem;
            border-radius: 1rem;
            max-width: 1200px;
            margin: 20px auto;
            flex-grow: 1;
        }

        /* --- Estilos para Tarjetas (Cards) - Semi-Transparentes --- */
        .card {
            background-color: rgba(30, 30, 30, 0.8);
            border-width: 3px !important;
            min-height: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .card-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: #f8f9fa;
        }
        .card-text {
            font-size: 1rem;
            color: #ffffff;
        }

        /* --- Estilos para Contenedores de Tablas/Formularios (Semi-Transparentes) --- */
        .table-container {
            background-color: rgba(30, 30, 30, 0.8);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.05);
        }

        /* --- Estilos para Tablas Oscuras (Table-Dark) - Semi-Transparentes --- */
        .table-dark th, .table-dark td {
            vertical-align: middle;
            border-color: #454d55;
        }
        .table-dark {
            --bs-table-bg: rgba(0, 0, 0, 0.5);
            --bs-table-striped-bg: rgba(0, 0, 0, 0.3);
            --bs-table-hover-bg: rgba(0, 0, 0, 0.7);
            color: #f8f9fa;
        }

        /* --- Estilos para Formularios y Selectores --- */
        .form-control, .form-select {
            background-color: #2c2c2c;
            color: #ffffff;
            border: 1px solid #444;
        }
        .form-control::placeholder {
            color: #aaa;
        }
        .form-control:focus, .form-select:focus {
            background-color: #2c2c2c;
            color: #ffffff;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        /* --- Estilos para Botones --- */
        .btn {
            border-radius: 0.5rem;
            font-weight: 600;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #ffffff;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #ffffff;
        }
        .btn-secondary:hover {
            background-color: #5c636a;
            border-color: #565e64;
        }

        .btn-info {
            background-color: #0dcaf0;
            border-color: #0dcaf0;
            color: #ffffff;
        }
        .btn-info:hover {
            background-color: #31d2f2;
            border-color: #25cff2;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #ffffff;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #ffffff;
        }
        .btn-danger:hover {
            background-color: #bb2d3b;
            border-color: #b02a37;
        }

        .btn-outline-light {
            color: #f8f9fa;
            border-color: #f8f9fa;
        }
        .btn-outline-light:hover {
            color: #212529;
            background-color: #f8f9fa;
        }

        /* --- Estilos para Alertas --- */
        .alert {
            border-radius: 0.5rem;
        }

        /* --- Estilos para Paginación --- */
        .pagination .page-link {
            background-color: #2c2c2c;
            color: #fff;
            border: 1px solid #444;
        }
        .pagination .page-link:hover {
            background-color: #3a3a3a;
            color: #fff;
            border-color: #555;
        }
        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
        }

        /* --- Estilos para Enlaces Generales --- */
        a {
            color: #0d6efd;
        }
        a:hover {
            color: #0b5ed7;
        }

        /* --- Estilos específicos de la vista Welcome -- */
        .text-center .display-4, .text-center .lead {
            color: #f8f9fa !important;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }
        .offcanvas-header {
            border-bottom: 1px solid #dc3545;
        }
        .offcanvas-body .text-white:hover {
            background-color: #333;
        }
        /* Estilos para los iconos de la barra de navegación */
        .nav-icon {
            font-size: 1.5rem;
            color: #fff;
            margin-right: 0.5rem;
        }
    </style>
</head><body>
{{-- NAVBAR SUPERIOR (de esquina a esquina) --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm w-100"><div class="container-fluid">{{-- Logo --}}<a class="navbar-brand d-flex align-items-center fw-bold" href="/"><img src="{{ asset('logo.png/log.png') }}" alt="Logo" style="height:40px;" class="me-2">Full Repuestos</a>    {{-- Barra de búsqueda (centrada) --}}
        <form class="d-flex mx-auto w-50" role="search" action="{{ route('search.results') }}" method="GET">
            <input class="form-control me-2" type="search" name="query" placeholder="Buscar tu producto por nombre..." aria-label="Buscar" value="{{ request()->query('query') }}">
            <button class="btn btn-dark" type="submit">Buscar</button>
        </form>
        <div class="d-flex align-items-center">
            {{-- Icono y lógica para Login/Usuario --}}
            @guest
                <a class="nav-link text-white d-flex align-items-center me-2" href="#">
                    <i class="fa-solid fa-user me-1 nav-icon"></i>
                    <span>Login</span>
                </a>
            @else
                <div class="dropdown me-2">
                    <a class="nav-link text-white d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-circle me-1 nav-icon"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Historial de compras</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest

            {{-- Botón menú hamburguesa (derecha) --}}
            <button class="btn btn-outline-light d-flex flex-column justify-content-center align-items-center ms-2"
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral" aria-controls="menuLateral"
                    aria-label="Abrir menú" style="width:45px; height:40px;">
                <span style="display:block;width:22px;height:3px;background:#fff;margin:2px 0;border-radius:2px;"></span>
                <span style="display:block;width:22px;height:3px;background:#fff;margin:2px 0;border-radius:2px;"></span>
                <span style="display:block;width:22px;height:3px;background:#fff;margin:2px 0;border-radius:2px;"></span>
            </button>
        </div>
    </div>
</nav>{{-- MENU LATERAL OFFCANVAS --}}
        <div class="offcanvas offcanvas-end bg-dark text-white" tabindex="-1" id="menuLateral" aria-labelledby="menuLateralLabel"><div class="offcanvas-header bg-danger text-white"><h5 class="offcanvas-title" id="menuLateralLabel">Menú</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button></div><div class="offcanvas-body p-0"><ul class="list-unstyled mb-0"><li><a href="/" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none bg-dark"><i class="bi bi-house-door-fill me-2"></i>Inicio</a></li><li><a href="{{ route('about') }}" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-journal-text me-2"></i>Nuestra historia</a></li><li><a href="{{ route('productos.index') }}" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-car-front-fill me-2"></i>Repuestos de carro</a></li><li><a href="{{ route('productos_moto.index') }}" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-bicycle me-2"></i>Repuestos de moto</a></li><li><a href="{{ route('lubricantes.index') }}" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-droplet-fill me-2"></i>Lubricantes y otros productos</a></li><li><a href="{{ route('promociones.index') }}" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-tags-fill me-2"></i>Promociones</a></li><li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-cart-fill me-2"></i>Carrito de compras</a></li>        <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-geo-alt-fill me-2"></i>Nuestros almacenes</a></li>
            <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-chat-dots-fill me-2"></i>Chat en linea</a></li>
            <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-telephone-fill me-2"></i>Contacto</a></li>

            <li class="border-top border-secondary mt-2 pt-2"><a href="{{ route('empleados.index') }}" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi-people-fill me-2"></i>Empleados</a></li>
            <li><a href="{{ route('cliente.index') }}" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi-person-lines-fill me-2"></i>Clientes</a></li>
            <li><a href="{{ route('proveedores.index') }}" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi-truck me-2"></i>Proveedores</a></li>
            <li><a href="{{ route('facturas-compra.index') }}" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi-receipt me-2"></i>Factura de compra</a></li>
            <li><a href="{{ route('facturas.index') }}" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi-cash-stack me-2"></i>Factura de venta</a></li>


            <li class="border-top border-secondary mt-2 pt-2"><a href="#" class="d-block py-2 ps-3 pe-4 text-danger text-decoration-none"><i class="bi bi-question-circle-fill me-2"></i>Guía de compras</a></li>
            <li><a href="#" class="d-block py-2 ps-3 pe-4 text-danger text-decoration-none"><i class="bi bi-patch-question-fill me-2"></i>Preguntas frecuentes</a></li>
            <li><a href="#" class="d-block py-2 ps-3 pe-4 text-danger text-decoration-none"><i class="bi bi-patch-question-fill me-2"></i>Soporte</a></li>

        </ul>
    </div>
</div><div class="container-fluid content-wrapper">@yield('content')</div><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script></body></html>
