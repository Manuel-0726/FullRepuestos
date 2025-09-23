@extends('layouts.app')

@section('title', 'Detalles del Producto')

@section('content')
    <div class="container py-5">
        <div class="card bg-dark text-white shadow-lg rounded-3">
            <div class="card-header bg-darker text-center py-3 rounded-top-3">
                <h3 class="mb-0"><i class="fas fa-box me-2"></i> Detalles del Producto</h3>
            </div>
            <div class="card-body p-4">
                {{-- Mensajes de sesión (éxito/error) --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif

                <div class="mb-3">
                    <p class="mb-1"><strong>Nombre:</strong> {{ $producto->nombre }}</p>
                    <p class="mb-1"><strong>Marca:</strong> {{ $producto->marca }}</p>
                    <p class="mb-1"><strong>Modelo:</strong> {{ $producto->modelo }}</p>
                    <p class="mb-1"><strong>Año:</strong> {{ $producto->anio }}</p>
                    <p class="mb-1"><strong>Categoría:</strong> {{ $producto->categoria }}</p>
                    <p class="mb-1"><strong>Descripción:</strong> {{ $producto->descripcion }}</p> {{-- Descripción --}}

                </div>

                <hr class="border-secondary mb-4">

                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-lg rounded-pill shadow-sm">
                        <i class="fas fa-edit me-2"></i> Editar Producto
                    </a>
                    <a href="{{ route('productos.index') }}" class="btn btn-outline-light btn-lg rounded-pill shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i> Volver a la lista
                    </a>
                </div>
            </div>
            <div class="card-footer bg-darker text-center py-3 rounded-bottom-3">
                <small class="text-muted">Última actualización: {{ $producto->updated_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>
@endsection


