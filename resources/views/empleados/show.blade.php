@extends('layouts.app')

@section('title', 'Detalles del Empleado')

@section('content')
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Empleado</title>
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

        .card-body p {
            color: #ffffff;
            font-size: 1rem;
        }
        .card-body p strong {
            color: #ffffff;
            font-weight: 600;
        }

        .card-title h5 {
            color: #f80320 !important;
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
        .empleado-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            font-size: 0.9rem;
        }
        .status-activo {
            background-color: #007bff;
            color: #fff;
        }
        .status-inactivo {
            background-color: #6c757d;
            color: #fff;
        }

        .card-body h4, .card-body p.text-muted-dark {
            border-bottom: none !important;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <h3 class="text-white fw-bold mb-4">Detalles del Empleado</h3>

    <div class="row g-3">

        <div class="col-md-4">
            <div class="card card-custom h-100 shadow-lg">
                <div class="card-body text-center pb-3 d-flex flex-column">

                    {{-- Lógica de Avatar Actualizada para manejar 'Otro' --}}
                    <div class="avatar-container mb-4">
                        @php
                            $iconClass = 'fa-male';
                            $iconColor = 'text-primary';

                            if ($empleado->sexo === 'Femenino') {
                                $iconClass = 'fa-female';
                                $iconColor = 'text-danger';
                            } elseif ($empleado->sexo === 'Otro') {
                                // Ícono neutro/formal (cambiado de fa-female)
                                $iconClass = 'fa-user-tie'; // Ícono de persona con corbata (neutro)
                                $iconColor = 'text-secondary'; // Color gris neutro
                            }
                        @endphp
                        <i class="fas {{ $iconClass }} fa-4x {{ $iconColor }}"></i>
                    </div>
                    {{-- Fin Lógica de Avatar --}}

                    <h4 class="card-title mb-2 text-white">{{ $empleado->nombre }} {{ $empleado->apellido }}</h4>
                    <p class="text-muted-dark mb-3 text-wrap">{{ $empleado->puesto }}</p>

                    <div class="empleado-status {{ $empleado->estado === 'Activo' ? 'status-activo' : 'status-inactivo' }} mb-4">
                        {{ $empleado->estado }}
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-auto pt-2">
                        <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-custom-edit btn-sm rounded-pill shadow-sm px-4">
                            <i class="fas fa-edit me-2"></i> Editar
                        </a>
                        <a href="{{ route('empleados.index') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm px-4">
                            <i class="fas fa-arrow-left me-2"></i> Volver a la lista
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-custom h-100 shadow-lg">
                <div class="card-body pb-3">

                    <h5 class="card-title mb-4 border-bottom border-secondary text-light pb-2"><i class="fas fa-user-alt me-2"></i> Información Personal</h5>
                    <div class="row gx-3 gy-3">
                        <div class="col-md-6">
                            <p class="mb-2 text-wrap"><i class="fas fa-id-card me-2"></i><strong>Identidad:</strong> {{ $empleado->identidad }}</p>
                            <p class="mb-2 text-wrap"><i class="fas fa-venus-mars me-2"></i><strong>Sexo:</strong> {{ $empleado->sexo }}</p>
                            <p class="mb-2 text-wrap"><i class="fas fa-envelope me-2"></i><strong>Correo:</strong> {{ $empleado->correo }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2 text-wrap"><i class="fas fa-phone me-2"></i><strong>Teléfono:</strong> {{ $empleado->telefono }}</p>
                            <p class="mb-2 text-wrap">
                                <i class="fas fa-map-marker-alt me-2"></i><strong>Dirección:</strong>
                                <span class="address-box">{{ $empleado->direccion }}</span>
                            </p>
                        </div>
                    </div>

                    <h5 class="card-title mt-4 mb-4 border-bottom border-secondary text-light pb-2"><i class="fas fa-briefcase me-2"></i> Información Laboral y Fechas</h5>
                    <div class="row gx-3 gy-3">
                        <div class="col-md-6">
                            <p class="mb-2 text-wrap"><i class="fas fa-briefcase me-2"></i><strong>Puesto:</strong> {{ $empleado->puesto }}</p>
                            <p class="mb-2 text-wrap"><i class="fas fa-money-bill-wave me-2"></i><strong>Salario:</strong> L. {{ number_format($empleado->salario, 2, '.', ',') }}</p>
                            <p class="mb-2 text-wrap"><i class="fas fa-calendar-alt me-2"></i><strong>Fecha contratación:</strong> {{ $empleado->fecha_contratacion }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2 text-wrap"><i class="fas fa-calendar-plus me-2"></i><strong>Registro:</strong> {{ $empleado->created_at ? $empleado->created_at->format('d/m/Y H:i') : 'No disponible' }}</p>
                            <p class="mb-2 text-wrap"><i class="fas fa-calendar-check me-2"></i><strong>Última actualización:</strong> {{ $empleado->updated_at ? $empleado->updated_at->format('d/m/Y H:i') : 'No disponible' }}</p>
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