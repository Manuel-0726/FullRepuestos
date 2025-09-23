@extends('layouts.app')

@section('content')
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-color: #121212;
        }
        .card-custom {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }
        .detail-item strong {
            color: #f80320;
            font-weight: 600;
        }
        .detail-value {
            color: #ffffff;
            font-size: 1rem;
        }
        .text-muted-dark {
            color: #ccc !important;
        }
        .avatar-container {

            padding: 15px;
            display: inline-block;
        }
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

        .address-box {
            white-space: normal;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <h3 class="text-white fw-bold mb-4">Detalles del Cliente</h3>

    <div class="row g-3">

        <div class="col-md-4">
            <div class="card card-custom h-100 shadow-lg">
                <div class="card-body text-center pb-3 d-flex flex-column">

                    <div class="avatar-container mb-4">
                        <i class="fas {{ $cliente->sexo === 'Masculino' ? 'fa-male' : 'fa-female' }} fa-4x" style="color: {{ $cliente->sexo === 'Masculino' ? '#007bff' : '#f80320' }};"></i>
                    </div>

                    <h4 class="card-title mb-2 text-white">{{ $cliente->nombre }} {{ $cliente->apellido }}</h4>
                    <p class="text-muted-dark mb-4">Cliente Registrado</p>

                    <div class="d-flex justify-content-center gap-3 mt-auto pt-2">
                        <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-custom-edit btn-sm rounded-pill shadow-sm px-4">
                            <i class="fas fa-edit me-2"></i> Editar
                        </a>
                        <a href="{{ route('cliente.index') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm px-4">
                            <i class="fas fa-arrow-left me-2"></i> Volver a la lista
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-custom h-100 shadow-lg">
                <div class="card-body pb-3">
                    <h5 class="card-title mb-4 border-bottom border-secondary text-light pb-2"><i class="fas fa-clipboard-list me-2"></i> Información Completa</h5>

                    <div class="row gx-3 gy-3">

                        <div class="col-md-6">
                            <p class="mb-2 detail-value text-wrap">
                                <strong><i class="fas fa-id-card me-2"></i> Identidad:</strong> {{ $cliente->identidad }}
                            </p>
                            <p class="mb-2 detail-value text-wrap">
                                <strong><i class="fas fa-envelope me-2"></i> Correo:</strong> {{ $cliente->correo }}
                            </p>
                            <p class="mb-2 detail-value text-wrap">
                                <strong><i class="fas fa-phone me-2"></i> Teléfono:</strong> {{ $cliente->telefono }}
                            </p>
                            <p class="mb-2 detail-value text-wrap">
                                <strong><i class="fas fa-venus-mars me-2"></i> Sexo:</strong> {{ $cliente->sexo }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <p class="mb-2 detail-value text-wrap">
                                <strong><i class="fas fa-map-marker-alt me-2"></i> Dirección:</strong>
                                <span class="address-box">{{ $cliente->direccion }}</span>
                            </p>
                            <p class="mb-2 detail-value text-wrap">
                                <strong><i class="fas fa-calendar-plus me-2"></i> Registrado:</strong> {{ $cliente->created_at->format('d/m/Y H:i') }}
                            </p>
                            <p class="mb-2 detail-value text-wrap">
                                <strong><i class="fas fa-history me-2"></i> Última Actualización:</strong> {{ $cliente->updated_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection