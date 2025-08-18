@extends('layouts.app')

@section('title', 'Listado de Facturas de Compra')

@section('content')
    <div class="container py-5">

        <h1 class="mb-4">Listado de facturas de compra</h1>

        <div class="d-flex justify-content-start gap-2 mb-4">
            <a href="{{ route('facturas-compra.create') }}" class="btn btn-danger">Registrar nueva factura</a>
            <a href="{{ route('welcome') }}" class="btn btn-danger">Inicio</a>
        </div>

        <table class="table table-dark table-hover align-middle">
            <thead>
            <tr>
                <th>#</th> <!-- Columna para el número -->
                <th>Código</th>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Empleado</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($facturas as $factura)
                <tr>
                    <td>{{ ($facturas->currentPage() - 1) * $facturas->perPage() + $loop->iteration }}</td>
                    <td>{{ $factura->codigo }}</td>
                    <td>{{ $factura->fecha->format('d/m/Y') }}</td>
                    <td>{{ $factura->proveedor->nombre_empresa ?? 'N/A' }}</td>
                    <td>{{ $factura->empleado->nombre ?? 'N/A' }}</td>
                    <td>L. {{ number_format($factura->total, 2) }}</td>
                    <td>
                        <a href="{{ route('facturas-compra.show', $factura) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('facturas-compra.edit', $factura) }}" class="btn btn-sm btn-warning">Editar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4 mb-4">
            {{ $facturas->withQueryString()->links('vendor.pagination.bootstrap-5') }}
        </div>



    </div>



@endsection
