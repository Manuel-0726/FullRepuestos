@extends('layouts.app')

@section('title', 'Detalles de Producto')

@section('content')
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
        <h3 class="text-white fw-bold mb-4">Detalles del producto: <span style="color: #f80320">{{ $lubricante->nombre }}</span></h3>

        <div class="row g-3">
            {{-- Tarjeta de Resumen Rápido (Columna 1) --}}
            <div class="col-md-4">
                <div class="card card-custom h-100 shadow-lg">
                    <div class="card-body text-center pb-3 d-flex flex-column">

                        @if ($lubricante->imagen)
                            <img src="{{ asset('storage/' . $lubricante->imagen) }}" alt="Imagen de {{ $lubricante->nombre }}" class="product-image">
                        @else
                            <div class="image-placeholder">
                                <i class="fas fa-image"></i> Sin Imagen
                            </div>
                        @endif

                        <h4 class="card-title mb-2 text-white">{{ $lubricante->nombre }}</h4>
                        <p class="text-muted-dark mb-3 text-wrap">{{ $lubricante->marca }}</p>

                        <div class="product-status {{ $lubricante->estado === 'Activo' ? 'status-activo' : 'status-inactivo' }} mb-4">
                            {{ $lubricante->estado }}
                        </div>

                        @php
                            $stockClass = '';
                            if ($lubricante->stock == 0) {
                                $stockClass = 'stock-cero';
                            } elseif ($lubricante->stock <= 5) {
                                $stockClass = 'stock-bajo';
                            }
                        @endphp

                        <p class="mb-1 detail-value text-wrap">
                            <strong><i class="fas fa-cubes me-2"></i> Cantidad Actual:</strong>
                            <span class="{{ $stockClass }}">{{ $lubricante->stock }}</span> uds.
                        </p>

                        <div class="d-flex justify-content-center gap-3 mt-auto pt-4">
                            <a href="{{ route('lubricantes.edit', $lubricante->id) }}" class="btn btn-custom-edit btn-sm rounded-pill shadow-sm px-4">
                                <i class="fas fa-edit me-2"></i> Editar
                            </a>
                            <a href="{{ route('lubricantes.index') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm px-4">
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
                                    <strong><i class="fas fa-barcode me-2"></i> Código:</strong> {{ $lubricante->codigo ?? 'N/A' }}
                                </p>
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-tag me-2"></i> Marca:</strong> {{ $lubricante->marca }}
                                </p>
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-cogs me-2"></i> Tipo:</strong> {{ $lubricante->tipo_producto }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-money-bill-wave me-2"></i> Precio de Venta:</strong>
                                    N/A
                                </p>
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-calendar-plus me-2"></i> Registrado:</strong> {{ $lubricante->created_at->format('d/m/Y H:i') }}
                                </p>
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-history me-2"></i> Última Actualización:</strong> {{ $lubricante->updated_at->diffForHumans() }}
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
                                <div class="description-content">{!! strip_tags(trim($lubricante->descripcion)) ?? 'No hay descripción detallada.' !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
