@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Informacion del Proveedor</h1>

        <div class="card">
            <div class="card-header">
                {{ $proveedor->nombre }} {{ $proveedor->apellido }}
            </div>
            <div class="card-body">
                <p><strong>País:</strong> {{ $proveedor->pais ?? 'No especificado' }}</p>
                <p><strong>Categoría:</strong> {{ $proveedor->categoria ?? 'No especificada' }}</p>
                <p><strong>Fecha de registro:</strong> {{ $proveedor->fecha_registro ? $proveedor->fecha_registro->format('d/m/Y H:i') : 'No especificada' }}</p>
            </div>
        </div>

        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
    </div>
@endsection
