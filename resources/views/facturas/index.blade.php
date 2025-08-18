@extends('layouts.app')

@section('title', 'Lista de Facturas')

@section('content')
    <div class="container py-5">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Lista facturas registradas</h2>
                <span class="text-white">Total: <strong>{{ $facturas->total() }}</strong></span>
            </div>

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



            <div class="d-flex gap-2 align-items-center mt-3 mb-4">
                <a href="{{ route('facturas.create') }}" class="btn btn-danger mb-3">+ Nueva factura</a>
                <a href="{{ route('welcome') }}" class="btn btn-danger mb-3">Inicio</a>

            </div>
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover text-center align-middle">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Código</th> {{-- Columna para el código de factura --}}
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Total</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($facturas as $factura)
                        <tr>
                            <td>{{ $loop->iteration + ($facturas->currentPage() - 1) * $facturas->perPage() }}</td>
                            <td>{{ $factura->codigo }}</td> {{-- Mostrar el código de la factura --}}
                            <td>{{ $factura->cliente ? $factura->cliente->nombre . ' ' . $factura->cliente->apellido : 'Sin cliente' }}</td>
                            <td>{{ $factura->fecha ? \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') : '' }}</td>
                            <td>L. {{ number_format($factura->total, 2) }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('facturas.show', $factura->id) }}" class="btn btn-info btn-sm" title="Ver Detalles">Ver</a>
                                    <a href="{{ route('facturas.edit', $factura->id) }}" class="btn btn-warning btn-sm" title="Editar Factura">Editar</a>
                                    <form action="{{ route('facturas.destroy', $factura->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta factura?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar Factura">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-white">No hay facturas registradas.</td> {{-- Colspan ajustado a 6 --}}
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4 mb-4">
                {{ $facturas->links('vendor.pagination.bootstrap-5') }}
            </div>


        </div>
    </div>
@endsection


