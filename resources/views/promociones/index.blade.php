@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-white">Lista de promociones</h1>

        @if(session('success'))
            <div id="alertSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <div class="d-flex justify-content-start mt-4 gap-2">
            <a href="{{ route('promociones.create') }}" class="btn btn-danger">Registrar nueva promoción</a>
            <a href="{{ url('/') }}" class="btn btn-danger">Inicio</a>
        </div>

        <div class="table-container table-responsive">
            <table class="table table-dark table-hover table-bordered align-middle">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descuento (%)</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Productos</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($promociones as $index => $promo)
                    <tr>
                        <td>{{ $index + 1 }}</td> {{-- Solo el número 1, 2, 3 ... --}}
                        <td>{{ $promo->nombre }}</td>
                        <td>{{ $promo->descuento }}</td>
                        <td>{{ $promo->fecha_inicio }}</td>
                        <td>{{ $promo->fecha_fin }}</td>
                        <td>
                            @foreach($promo->productos as $producto)
                                <span class="badge bg-primary">{{ $producto->nombre }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('promociones.show', $promo) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('promociones.edit', $promo) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('promociones.destroy', $promo) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar esta promoción?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $promociones->links() }}

    </div>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const alert = document.getElementById('alertSuccess');
            if(alert){
                setTimeout(() => {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    bsAlert.close(); // Cierra la alerta automáticamente después de 5 segundos
                }, 5000);
            }
        });
    </script>
@endsection
