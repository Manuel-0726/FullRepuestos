@extends('layouts.app')

@section('title', 'Detalles del Producto')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWixpZLYP/3bKq42S+R2t3xN6h+wD+q4+W1f5eW+g+s2t/t" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Estilos generales del fondo (Asumiendo que layouts.app no lo maneja) */
        body {
            background-color: #121212;
            color: #ffffff; /* Color de texto base para el cuerpo */
        }
        /* Estilos de la tarjeta (Fondo oscuro y borde) */
        .card-custom {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }
        /* Color de las etiquetas/íconos (Similar al rojo de tu vista de cliente) */
        .detail-item strong {
            color: #f80320; /* Rojo principal */
            font-weight: 600;
        }
        /* Estilo para los valores de los detalles */
        .detail-value {
            color: #ffffff;
            font-size: 1rem;
        }
        /* Color de texto menos prominente */
        .text-muted-dark {
            color: #ccc !important;
        }
        .product-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            font-size: 0.9rem;
        }
        /* Colores de estado Activo/Inactivo */
        .status-activo {
            background-color: #28a745; /* Verde */
            color: #fff;
        }
        .status-inactivo {
            background-color: #6c757d; /* Gris */
            color: #fff;
        }
        /* Botón de Editar Personalizado (Amarillo/Cambiado a Warning de Bootstrap para simplicidad) */
        .btn-custom-edit {
            background-color: #FFC300;
            border-color: #FFC300;
            color: #121212;
            font-weight: 600;
        }
        .btn-custom-edit:hover {
            background-color: #e0b400;
            border-color: #e0b400;
        }
        /* Estilo para stock bajo */
        .stock-bajo {
            color: #dc3545; /* Rojo */
            font-weight: bold;
        }
        /* Estilo para stock en cero */
        .stock-cero {
            color: #ffc107; /* Amarillo/Advertencia */
            font-weight: bold;
        }
        /* Estilo ajustado para la descripción: Mantiene el texto en una línea simple */
        .description-content {
            white-space: pre-wrap;
            text-align: left;
            font-size: 0.95rem;
            color: #ffffff;
            /* Elimina el margen superior para pegarse a la etiqueta "Descripción" */
            margin-top: 0.25rem;
        }
        /* NUEVOS ESTILOS PARA LA IMAGEN DEL PRODUCTO */
        .product-image {
            max-width: 100%; /* Asegura que la imagen no se desborde */
            height: auto;
            max-height: 200px; /* Limita la altura de la imagen */
            object-fit: contain; /* Asegura que la imagen se ajuste sin recortarse */
            border-radius: 8px; /* Bordes ligeramente redondeados */
            margin-bottom: 1rem; /* Espacio debajo de la imagen */
            border: 1px solid #444; /* Borde sutil */
        }
        .image-placeholder {
            width: 100%;
            height: 200px;
            background-color: #333;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            border: 1px dashed #555;
        }
        .image-placeholder i {
            margin-right: 0.5rem;
        }
        /* FIN NUEVOS ESTILOS */
    </style>

    <div class="container py-5">
        <h3 class="text-white fw-bold mb-4">Detalles del producto: {{ $productos_moto->nombre }}</h3>

        <div class="row g-3">
            {{-- Tarjeta de Resumen Rápido (Columna 1) --}}
            <div class="col-md-4">
                <div class="card card-custom h-100 shadow-lg">
                    <div class="card-body text-center pb-3 d-flex flex-column">

                        {{-- MOSTRAR IMAGEN O PLACEHOLDER --}}
                        @if ($productos_moto->imagen)
                            <img src="{{ asset('storage/' . $productos_moto->imagen) }}" alt="Imagen de {{ $productos_moto->nombre }}" class="product-image">
                        @else
                            <div class="image-placeholder">
                                <i class="fas fa-image"></i> Sin Imagen
                            </div>
                        @endif

                        <h4 class="card-title mb-2 text-white">{{ $productos_moto->nombre }}</h4>
                        <p class="text-muted-dark mb-3 text-wrap">{{ $productos_moto->marca }}</p>

                        {{-- Nota: El modelo ProductoMoto no tiene un campo 'estado' --}}
                        {{-- Esto es un placeholder para mostrar cómo se vería --}}
                        @php
                            $estado = 'Activo';
                        @endphp
                        <div class="product-status {{ $estado === 'Activo' ? 'status-activo' : 'status-inactivo' }} mb-4">
                            {{ $estado }}
                        </div>

                        {{-- Indicador de STOCK --}}
                        {{-- Nota: El modelo ProductoMoto no tiene un campo 'stock' --}}
                        {{-- Esto es un placeholder para mostrar cómo se vería --}}
                        @php
                            $stock = 15; // Ejemplo: Puedes usar un número fijo
                            $stockClass = '';
                            if ($stock == 0) {
                                $stockClass = 'stock-cero';
                            } elseif ($stock <= 5) {
                                $stockClass = 'stock-bajo';
                            }
                        @endphp
                        <p class="mb-1 detail-value text-wrap">
                            <strong><i class="fas fa-cubes me-2"></i> Cantidad Actual:</strong>
                            <span class="{{ $stockClass }}">{{ $stock }}</span> uds.
                        </p>

                        <div class="d-flex justify-content-center gap-3 mt-auto pt-4">
                            <a href="{{ route('productos_moto.edit', $productos_moto) }}" class="btn btn-custom-edit btn-sm rounded-pill shadow-sm px-4">
                                <i class="fas fa-edit me-2"></i> Editar
                            </a>
                            <a href="{{ route('productos_moto.index') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm px-4">
                                <i class="fas fa-arrow-left me-2"></i> Volver a la lista
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tarjeta de Detalles Completos (Columna 2) --}}
            <div class="col-md-8">
                <div class="card card-custom h-100 shadow-lg">
                    <div class="card-body pb-3">
                        <h5 class="card-title mb-4 border-bottom border-secondary text-light pb-2">
                            <i class="fas fa-info-circle me-2"></i> Información del Producto
                        </h5>
                        <div class="row gx-3 gy-3">
                            <div class="col-md-6">
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-tag me-2"></i> Marca:</strong> {{ $productos_moto->marca }}
                                </p>
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-motorcycle me-2"></i> Modelo:</strong> {{ $productos_moto->modelo }}
                                </p>
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-calendar-alt me-2"></i> Año:</strong> {{ $productos_moto->anio }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-cogs me-2"></i> Categoría:</strong> {{ $productos_moto->categoria }}
                                </p>
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-calendar-plus me-2"></i> Registrado:</strong> {{ $productos_moto->created_at->format('d/m/Y H:i') }}
                                </p>
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-history me-2"></i> Última Actualización:</strong> {{ $productos_moto->updated_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        <h5 class="card-title mt-4 mb-3 border-bottom border-secondary text-light pb-2">
                            <i class="fas fa-clipboard-list me-2"></i> Especificaciones
                        </h5>
                        <div class="row gx-3 gy-3">
                            <div class="col-12">
                                <p class="mb-2 detail-value text-wrap">
                                    <strong class="detail-item">Descripción:</strong>
                                </p>
                                <div class="description-content">{{ strip_tags(trim($productos_moto->descripcion)) ?? 'No hay descripción detallada.' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
