@extends('layouts.app')

@section('title', 'Detalles del Empleado')

@section('content')
<div class="row g-3"> {{-- Usar g-3 para un gap entre columnas en Bootstrap 5 --}}
    {{-- Columna Izquierda: Resumen del Empleado y Botones --}}
    <div class="col-md-4">
        <div class="card bg-dark text-white h-100 shadow-lg"> {{-- Añadir sombra para mejor estética --}}
            <div class="card-body text-center pb-3 d-flex flex-column"> {{-- Añadir flex-column para empujar el contenido hacia abajo --}}
                <div class="avatar-container mb-3"> {{-- Margen inferior adecuado --}}
                    {{-- Usar Font Awesome para iconos de género --}}
                    <i class="fas {{ $empleado->sexo === 'Masculino' ? 'fa-male' : 'fa-female' }} fa-4x {{ $empleado->sexo === 'Masculino' ? 'text-primary' : 'text-danger' }}"></i>
                </div>
                <h4 class="card-title mb-2">{{ $empleado->nombre }} {{ $empleado->apellido }}</h4>
                <p class="text-muted mb-3 text-wrap">{{ $empleado->puesto }}</p> {{-- Asegurar text-wrap también aquí --}}
                <div class="empleado-status {{ $empleado->estado === 'Activo' ? 'status-activo' : 'status-inactivo' }} mb-4">
                    {{ $empleado->estado }}
                </div>
                <div class="d-flex justify-content-center gap-2 mt-auto pt-2"> {{-- mt-auto y pt-2 para empujar los botones abajo --}}
                    <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('empleados.index') }}" class="btn btn-outline-light btn-sm">Volver a la lista</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Columna Derecha: Información Personal y Laboral/Adicional --}}
    <div class="col-md-8">
        <div class="card bg-dark text-white h-100 shadow-lg"> {{-- Añadir sombra --}}
            <div class="card-body pb-3"> {{-- Ajuste de padding inferior --}}
                <h5 class="card-title mb-3 border-bottom border-secondary pb-2">Información personal</h5>
                <div class="row gx-3 gy-2"> {{-- g-x y g-y para gap entre filas y columnas --}}
                    <div class="col-md-6">
                        <p class="mb-2 text-wrap"><i class="fas fa-id-card me-2"></i><strong>Identidad:</strong> {{ $empleado->identidad }}</p>
                        <p class="mb-2 text-wrap"><i class="fas fa-venus-mars me-2"></i><strong>Sexo:</strong> {{ $empleado->sexo }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2 text-wrap"><i class="fas fa-envelope me-2"></i><strong>Correo:</strong> {{ $empleado->correo }}</p>
                        <p class="mb-2 text-wrap"><i class="fas fa-phone me-2"></i><strong>Teléfono:</strong> {{ $empleado->telefono }}</p>
                        <p class="mb-2 text-wrap"><i class="fas fa-map-marker-alt me-2"></i><strong>Dirección:</strong> {{ $empleado->direccion }}</p>
                    </div>
                </div>

                <h5 class="card-title mt-4 mb-3 border-bottom border-secondary pb-2">Información laboral y adicional</h5>
                <div class="row gx-3 gy-2">
                    <div class="col-md-6">
                        <p class="mb-2 text-wrap"><i class="fas fa-briefcase me-2"></i><strong>Puesto:</strong> {{ $empleado->puesto }}</p>
                        <p class="mb-2 text-wrap"><i class="fas fa-calendar-alt me-2"></i><strong>Fecha contratación:</strong> {{ $empleado->fecha_contratacion }}</p>
                        {{-- **FOCUS DE LA CORRECCIÓN:** Aplicar clase para tamaño de fuente más pequeño --}}
                        <p class="mb-2 text-wrap info-fecha"><i class="fas fa-calendar-plus me-2"></i><strong>Registro:</strong> {{ $empleado->created_at ? $empleado->created_at->format('d/m/Y H:i') : 'No disponible' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2 text-wrap"><i class="fas fa-money-bill-wave me-2"></i><strong>Salario:</strong> L. {{ number_format($empleado->salario, 2, '.', ',') }}</p>
                        {{-- **FOCUS DE LA CORRECCIÓN:** Aplicar clase para tamaño de fuente más pequeño --}}
                        <p class="mb-2 text-wrap info-fecha"><i class="fas fa-calendar-check me-2"></i><strong>Última actualización:</strong> {{ $empleado->updated_at ? $empleado->updated_at->format('d/m/Y H:i') : 'No disponible' }}</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
