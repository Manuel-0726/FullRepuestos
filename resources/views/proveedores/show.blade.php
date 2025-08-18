@extends('layouts.app')

@section('title', 'Detalles del Proveedor')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Detalles del Proveedor</h2>
        <div>
            <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-danger">Editar</a>
            <a href="{{ route('proveedores.index') }}" class="btn btn-danger">Volver</a>
        </div>
    </div>

    <div class="card bg-dark text-white mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title mb-3">Información principal</h5>
                    <p><strong>Empresa:</strong> {{ $proveedor->nombre_empresa }}</p>
                    <p><strong>País de origen:</strong> {{ $proveedor->pais_origen }}</p>
                    <p><strong>Dirección:</strong> {{ $proveedor->direccion }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="card-title mb-3">Contacto principal</h5>
                    <p><strong>Persona de contacto:</strong> {{ $proveedor->persona_contacto }}</p>
                    <p><strong>Correo electrónico:</strong> {{ $proveedor->correo_electronico }}</p>
                    <p><strong>Teléfono:</strong> {{ $proveedor->telefono_contacto }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card bg-dark text-white mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title mb-3">Marcas que maneja</h5>
                    @if($proveedor->marcas && count($proveedor->marcas) > 0)
                        <div class="row row-cols-3 g-3">
                            @foreach($proveedor->marcas as $marca)
                                <div class="col text-center">
                                    <div class="marca-item">
                                        <div class="marca-logo-container mb-2">
                                            <img src="{{ asset('images/marcas/' . strtolower($marca) . '.png') }}"
                                                 alt="{{ $marca }}"
                                                 class="img-fluid marca-logo"
                                                 style="max-width: 100px; height: auto;"
                                                 onerror="this.src='{{ asset('images/marcas/default.png') }}'">
                                        </div>
                                        <p class="marca-nombre mb-0">{{ $marca }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No hay marcas registradas.</p>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <h5 class="card-title mb-3">Tipo de autopartes</h5>
                        @if($proveedor->tipo_autopartes && count($proveedor->tipo_autopartes) > 0)
                            <div class="row row-cols-2 g-2">
                                @foreach($proveedor->tipo_autopartes as $tipo)
                                    <div class="col">
                                        <div class="tipo-item">
                                            <i class="fas fa-cog me-2"></i>
                                            {{ $tipo }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">No hay tipos de autopartes registrados.</p>
                        @endif
                    </div>

                    <h5 class="card-title mb-3">Contacto secundario</h5>
                    @if($proveedor->persona_contacto_secundaria)
                        <p><strong>Persona de Contacto:</strong> {{ $proveedor->persona_contacto_secundaria }}</p>
                        <p><strong>Teléfono:</strong> {{ $proveedor->telefono_contacto_secundario }}</p>
                    @else
                        <p class="text-muted">No hay contacto secundario registrado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card bg-dark text-white">
        <div class="card-body">
            <h5 class="card-title mb-3">Información adicional</h5>
            <p><strong>Fecha de Registro:</strong> {{ $proveedor->created_at ? $proveedor->created_at->format('d/m/Y H:i') : 'No disponible' }}</p>
            <p><strong>Última Actualización:</strong> {{ $proveedor->updated_at ? $proveedor->updated_at->format('d/m/Y H:i') : 'No disponible' }}</p>
        </div>
    </div>
@endsection
