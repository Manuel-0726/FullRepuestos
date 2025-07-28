@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4 text-center">Lista de Proveedores</h1>


    @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped w-100">
            <thead class="table-dark">
            <tr>
                <th>Nombre Completo</th>
                <th>Empresa</th>
                <th>Teléfono</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach($proveedores as $proveedor)
                <tr>
                    <td>
                        <a href="{{ route('proveedores.show', $proveedor->id) }}">
                            {{ $proveedor->nombre }} {{ $proveedor->apellido }}
                        </a>
                    </td>
                    <td>{{ $proveedor->nombre_empresa }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>{{ $proveedor->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div>
            {{ $proveedores->links() }}
        </div>

        <div class="d-flex justify-content-between mt-3">
            @if ($proveedores->onFirstPage())
                <span class="btn btn-primary disabled">Atrás</span>
            @else
                <a href="{{ $proveedores->previousPageUrl() }}" class="btn btn-primary">Atrás</a>
            @endif

            @if ($proveedores->hasMorePages())
                <a href="{{ $proveedores->nextPageUrl() }}" class="btn btn-primary">Siguiente</a>
            @else
                <span class="btn btn-primary disabled">Siguiente</span>
            @endif
        </div>
    </div>
@endsection
