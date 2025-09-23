<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Dark Theme -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* --- Estilos Globales para el Body y el Fondo --- */
        body {
            background-image: url('{{ asset('logo.png/fondo.png') }}'); /* ¡Asegúrate de que esta ruta sea correcta! */
            background-size: cover; /* La imagen cubre todo el fondo */
            background-position: center center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            background-attachment: fixed; /* La imagen se mantiene fija al hacer scroll */
            background-color: #121212; /* Color de respaldo si la imagen no carga */
            color: #f8f9fa; /* Color de texto general para todo el body (claro) */
            min-height: 100vh; /* Asegura que el body ocupe al menos el 100% del alto del viewport */
            display: flex; /* Usa flexbox para organizar el contenido */
            flex-direction: column; /* Contenido en columna */
        }

        /* --- Estilos para el Contenedor Principal de Contenido (Transparente) --- */
        .content-wrapper {
            padding: 2rem;
            border-radius: 1rem;
            max-width: 1200px; /* Limita el ancho máximo del contenedor */
            margin: 20px auto; /* Centra el contenedor horizontalmente y añade margen vertical */
            flex-grow: 1; /* Permite que el contenedor crezca y ocupe el espacio disponible */
        }

        /* --- Estilos para Tarjetas (Cards) - Semi-Transparentes --- */
        .card {
            background-color: rgba(30, 30, 30, 0.8); /* Fondo oscuro con 80% de opacidad */
            border-width: 3px !important;
            min-height: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra sutil */
        }
        .card-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: #f8f9fa; /* Asegura que el título de la tarjeta sea claro */
        }
        .card-text {
            font-size: 1rem;
            color: #ffffff; /* ¡Texto blanco para el contenido de la tarjeta! */
        }

        /* --- Estilos para Contenedores de Tablas/Formularios (Semi-Transparentes) --- */
        .table-container {
            background-color: rgba(30, 30, 30, 0.8); /* Fondo oscuro con 80% de opacidad */
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.05);
        }

        /* --- Estilos para Tablas Oscuras (Table-Dark) - Semi-Transparentes --- */
        .table-dark th, .table-dark td {
            vertical-align: middle;
            border-color: #454d55; /* Bordes de tabla más claros */
        }
        .table-dark {
            --bs-table-bg: rgba(0, 0, 0, 0.5); /* Fondo de tabla semi-transparente */
            --bs-table-striped-bg: rgba(0, 0, 0, 0.3); /* Rayas de tabla semi-transparentes */
            --bs-table-hover-bg: rgba(0, 0, 0, 0.7); /* Hover de tabla semi-transparente */
            color: #f8f9fa; /* Asegura que el texto de la tabla sea claro */
        }

        /* --- Estilos para Formularios y Selectores --- */
        .form-control, .form-select {
            background-color: #2c2c2c; /* Fondo oscuro para campos de entrada */
            color: #ffffff; /* Texto claro en campos de entrada */
            border: 1px solid #444; /* Borde oscuro */
        }
        .form-control::placeholder {
            color: #aaa; /* Color de placeholder */
        }
        .form-control:focus, .form-select:focus {
            background-color: #2c2c2c; /* Mantener el fondo oscuro al enfocar */
            color: #ffffff;
            border-color: #0d6efd; /* Borde azul al enfocar */
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        /* --- Estilos para Botones --- */
        .btn {
            border-radius: 0.5rem;
            font-weight: 600; /* Un poco más de peso para el texto del botón */
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
            color: #ffffff; /* Texto blanco para botón info */
        }
        .btn-info:hover {
            background-color: #31d2f2;
            border-color: #25cff2;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #ffffff; /* Texto blanco para botón warning */
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
            /* Puedes ajustar los colores de fondo de las alertas si quieres que sean semi-transparentes */
            /* Ejemplo para alert-success: */
            /* background-color: rgba(25, 135, 84, 0.8); */
            /* border-color: rgba(25, 135, 84, 0.8); */
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
            color: #0d6efd; /* Color azul para enlaces */
        }
        a:hover {
            color: #0b5ed7; /* Azul más oscuro al pasar el ratón */
        }

        /* --- Estilos específicos para el logo en welcome.blade.php --- */
        /* Aseguramos que el logo y los títulos principales sean visibles */
        .text-center .display-4, .text-center .lead {
            color: #f8f9fa !important; /* Fuerza el color blanco para los títulos principales */
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7); /* Sombra para mejorar la legibilidad sobre el fondo */
        }
    </style>
</head>
<body>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                </li>
                <!-- Aquí puedes añadir más enlaces de navegación si los necesitas en todas las páginas -->
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid content-wrapper">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
