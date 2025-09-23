@extends('layouts.app')

@section('title', 'Full Repuestos')

@section('content')

    {{-- NAVBAR SUPERIOR (de esquina a esquina) --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm w-100">
        <div class="container-fluid">
            {{-- Logo --}}
            <a class="navbar-brand d-flex align-items-center fw-bold" href="#">
                <img src="{{ asset('logo.png/log.png') }}" alt="Logo" style="height:40px;" class="me-2">
                Full Repuestos
            </a>

            {{-- Barra de búsqueda (centrada) --}}
            <form class="d-flex mx-auto w-50" role="search">
                <input class="form-control me-2" type="search" placeholder="Buscar producto..." aria-label="Buscar">
                <button class="btn btn-dark" type="submit">Buscar</button>
            </form>

            {{-- Botón menú hamburguesa (derecha) --}}
            <button class="btn btn-outline-light d-flex flex-column justify-content-center align-items-center ms-2"
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral" aria-controls="menuLateral"
                    aria-label="Abrir menú"
                    style="width:45px; height:40px;">
                <span style="display:block;width:22px;height:3px;background:#fff;margin:2px 0;border-radius:2px;"></span>
                <span style="display:block;width:22px;height:3px;background:#fff;margin:2px 0;border-radius:2px;"></span>
                <span style="display:block;width:22px;height:3px;background:#fff;margin:2px 0;border-radius:2px;"></span>
            </button>
        </div>
    </nav>

    {{-- SUBNAV DE CATEGORÍAS --}}
    <div class="bg-light shadow-sm">
        <div class="container">
            <ul class="nav nav-pills justify-content-center py-2">
                <li class="nav-item"><a href="#" class="nav-link text-dark">Repuestos</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-dark">Grasas y Lubricantes</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-dark">Aditivos y Químicos</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-dark">Herram/Equipo Taller</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-dark">Varios</a></li>
            </ul>
        </div>
    </div>

    {{-- MENU LATERAL OFFCANVAS --}}
    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="menuLateral" aria-labelledby="menuLateralLabel">
        <div class="offcanvas-header bg-danger text-white">
            <h5 class="offcanvas-title" id="menuLateralLabel">Menú</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
        </div>
        <div class="offcanvas-body p-0">
            <ul class="list-unstyled mb-0">
                <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none bg-dark"><i class="bi bi-house-door-fill me-2"></i>Inicio</a></li>
                <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-grid-fill me-2"></i>Categorías</a></li>
                <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-geo-alt-fill me-2"></i>Nuestros almacenes</a></li>
                <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-tags-fill me-2"></i>Promociones</a></li>
                <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-journal-text me-2"></i>Nuestra historia</a></li>
                <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-hand-thumbs-up-fill me-2"></i>Compromiso social</a></li>
                <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-people-fill me-2"></i>Únete al equipo</a></li>
                <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-newspaper me-2"></i>Noticias y eventos</a></li>
                <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-chat-dots-fill me-2"></i>Blog</a></li>
                <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-award-fill me-2"></i>Academia Super</a></li>
                <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-book-fill me-2"></i>Publicaciones</a></li>
                <li><a href="#" class="d-block py-2 ps-3 pe-4 text-white text-decoration-none"><i class="bi bi-telephone-fill me-2"></i>Contacto</a></li>
                <li class="border-top border-secondary mt-2 pt-2"><a href="#" class="d-block py-2 ps-3 pe-4 text-danger text-decoration-none"><i class="bi bi-question-circle-fill me-2"></i>Guía de compras</a></li>
                <li><a href="#" class="d-block py-2 ps-3 pe-4 text-danger text-decoration-none"><i class="bi bi-patch-question-fill me-2"></i>Preguntas frecuentes</a></li>
            </ul>
        </div>
    </div>

    {{-- CONTENIDO PRINCIPAL (TUS CARDS) --}}
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-dark">Full Repuestos</h1>
            <p class="lead text-secondary">Seleccione el sistema que desea gestionar</p>
        </div>

        <div class="row justify-content-center g-4">
            @php
                $sections = [
                    [
                        'route' => route('empleados.index'),
                        'title' => 'Sistema de Empleados',
                        'desc'  => 'Gestione empleados y su información.',
                        'img'   => asset('images/empleado.jpeg'),
                        'bg'    => 'rgba(220,20,60,0.6)'
                    ],
                    [
                        'route' => route('proveedores.index'),
                        'title' => 'Sistema de Proveedores',
                        'desc'  => 'Administre proveedores y marcas.',
                        'img'   => asset('images/proveedores.jpeg'),
                        'bg'    => 'rgba(220,20,60,0.6)'
                    ],
                    [
                         'route' => route('promociones.index'),
                        'title' => 'Sistema de promociones',
                        'desc'  => 'Administre las promociones.',
                        'img'   => asset(''),
                        'bg'    => 'rgba(220,20,60,0.6)'
                    ],
                    [

                         'route' => route('cliente.index'),
                        'title' => 'Sistema de clientes',
                        'desc'  => 'Administre los clientes.',
                        'img'   => asset(''),
                        'bg'    => 'rgba(220,20,60,0.6)'
                    ],
                    [

                         'route' => route('facturas.index'),
                        'title' => 'Sistema de factura de ventas',
                        'desc'  => 'Administre las facturas de ventas.',
                        'img'   => asset(''),
                        'bg'    => 'rgba(220,20,60,0.6)'
                    ],
                    [

                         'route' => route('facturas-compra.index'),
                        'title' => 'Sistema de facturas de compra',
                        'desc'  => 'Administre las facturas de compras.',
                        'img'   => asset(''),
                        'bg'    => 'rgba(220,20,60,0.6)'
                    ],
                    [
                        'route' => route('productos.index'),
                        'title' => 'Repuestos de Carro',
                        'desc'  => 'Gestione inventario de carro.',
                        'img'   => asset('images/repuestosC.jpg'),
                        'bg'    => 'rgba(220,20,60,0.6)'
                    ],
                    [
                        'route' => route('productos_moto.index'),
                        'title' => 'Repuestos de Moto',
                        'desc'  => 'Gestione inventario de moto.',
                        'img'   => asset('images/moto.jpg'),
                        'bg'    => 'rgba(220,20,60,0.6)'
                    ],
                ];
            @endphp

            @foreach ($sections as $section)
                <div class="col-md-4">
                    <a href="{{ $section['route'] }}" class="text-decoration-none">
                        <div class="card section-card h-100 shadow-lg rounded-4 overflow-hidden">
                            <div class="card-img-top position-relative"
                                 style="height: 200px; background: url('{{ $section['img'] }}') center center / cover no-repeat;">
                                <div class="overlay position-absolute top-0 start-0 w-100 h-100"
                                     style="background: {{ $section['bg'] }};"></div>
                                <div class="position-absolute bottom-0 start-0 p-3 text-white">
                                    <h3 class="fw-semibold">{{ $section['title'] }}</h3>
                                </div>
                            </div>
                            <div class="card-body text-center p-4">
                                <p class="card-text text-muted mb-4">{{ $section['desc'] }}</p>
                                <button class="btn btn-danger btn-lg rounded-pill w-100">Acceder</button>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ESTILOS --}}
    <style>
        /* Mantener header de esquina a esquina */
        nav.navbar {
            padding-left: 0;
            padding-right: 0;
        }

        .offcanvas-header {
            border-bottom: 1px solid #dc3545; /* línea separadora */
        }
        .offcanvas-body .text-white:hover {
            background-color: #333;
        }
        .section-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .section-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }
        .overlay {
            transition: background 0.3s ease;
        }
        .section-card:hover .overlay {
            background: rgba(220,20,60,0.5);
        }

        /* Ajuste para que el offcanvas no cubra TODO en pantallas grandes si quieres
           (coméntalo si prefieres que cubra completamente) */
        @media (min-width: 992px) {
            .offcanvas.show {
                width: 320px;
            }
        }
    </style>

@endsection
