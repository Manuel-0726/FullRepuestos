@extends('layouts.app')

@section('content')
    <div class="container mt-4 text-white">
        <div class="card text-white bg-dark shadow">
            <div class="card-header">
                <h4 class="mb-0">Detalles de la promoción</h4>
            </div>
            <div class="card-body">

                {{-- Imagen de la promoción --}}
                @if($promocione->imagen)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $promocione->imagen) }}"
                             alt="Imagen de la promoción"
                             class="img-fluid rounded shadow"
                             style="max-height: 300px;">
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Nombre:</strong> {{ $promocione->nombre }}</p>
                        <p><strong>Descripción:</strong> {{ $promocione->descripcion }}</p>
                        <p><strong>Descuento:</strong> {{ $promocione->descuento }}%</p>
                        <p><strong>Fecha de Inicio:</strong> {{ $promocione->fecha_inicio }}</p>
                        <p><strong>Fecha de Fin:</strong> {{ $promocione->fecha_fin }}</p>
                    </div>
                </div>

                <hr>

                <h5>Productos Incluidos</h5>
                @if($promocione->productos->isEmpty())
                    <p>No hay productos asociados a esta promoción.</p>
                @else
                    <ul>
                        @foreach($promocione->productos as $producto)
                            <li>{{ $producto->nombre }}</li>
                        @endforeach
                    </ul>
                @endif

                <hr>



                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('promociones.index') }}" class="btn btn-danger">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection
