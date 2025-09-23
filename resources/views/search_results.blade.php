@extends('layouts.app')

@section('title', 'Resultados de Búsqueda')

@section('content')
    <div class="container py-5">
        <!-- Botón para volver al inicio -->
        <a href="{{ url('/') }}" class="btn btn-danger mb-4"><i class="fas fa-arrow-left me-2"></i> Volver al inicio</a>

        <h1 class="text-white mb-4">Resultados de búsqueda para: "{{ $query }}"</h1>

        @if($productos->isEmpty())
            <div class="alert alert-warning">
                No se encontraron productos que coincidan con tu búsqueda.
            </div>
        @else
            <div class="row">
                @foreach ($productos as $producto)
                    <div class="col-md-4 mb-4">
                        <div class="card bg-dark text-white h-100">
                            @if ($producto->imagen)
                                <!-- Cambio aquí: la ruta apunta a la carpeta de almacenamiento pública -->
                                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                            @else
                                <img src="https://placehold.co/600x400/2c2c2c/ffffff?text=Sin+Imagen" class="card-img-top" alt="Imagen no disponible">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto->nombre }}</h5>
                                <p class="card-text">{{ $producto->descripcion ?? '' }}</p>
                                <p class="card-text"><strong>Precio:</strong> L. {{ number_format($producto->precio, 2) }}</p>
                                <a href="#" class="btn btn-danger w-100">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const input = document.querySelector('input[name="query"]');
            if (input) {
                // Mueve el cursor al final del texto si hay un valor
                const end = input.value.length;
                input.setSelectionRange(end, end);
                input.focus();
            }
        });
    </script>
@endsection
