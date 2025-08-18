@extends('layouts.app')

@section('title', 'Detalle de Factura de Venta')

@section('content')
    <div class="container py-5">
        <div class="card bg-dark text-white shadow-lg rounded-3">
            <div class="card-header bg-darker text-center py-3 rounded-top-3">
                <h3 class="mb-0">
                    <i class="fas fa-file-invoice me-2"></i> Factura de Venta
                </h3>
                <small class="text-muted">Creado el: {{ $factura->created_at->format('d/m/Y H:i') }}</small>
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

                <div class="row mb-4">
                    <div class="col-md-6 border-end border-secondary pe-4">
                        {{-- Detalles de tu empresa (ajusta según tu información) --}}
                        <h5 class="text-warning mb-3">FULLREPUESTOS</h5>
                        <p class="mb-1"><strong>Dirección:</strong> Danli, El Paraiso</p>
                        <p class="mb-1"><strong>Teléfono:</strong> +504 2763-3585</p>
                        <p class="mb-1"><strong>Email:</strong> fullrepuestos@gmail.com</p>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('logo.png/log.png') }}" alt="Logo de la Empresa" class="me-3 rounded" style="width: 60px; height: 60px;">
                            <span class="text-white fw-bold">FullRepuestos S.A.</span>
                        </div>
                    </div>
                    <div class="col-md-6 ps-4">
                        {{-- Detalles del cliente y factura --}}
                        <h5 class="text-warning mb-3">DETALLES DE LA FACTURA</h5>
                        <p class="mb-1"><strong>Codigo de factura:</strong> {{ $factura->codigo }}</p>
                        <p class="mb-1"><strong>Factura de venta no.:</strong> {{ $factura->id }}</p>
                        <p class="mb-1"><strong>Fecha emitida:</strong> {{ $factura->fecha->format('d/m/Y') }}</p>
                        <p class="mb-1">
                            <strong>Cliente:</strong>
                            {{ $factura->cliente ? $factura->cliente->nombre . ' ' . $factura->cliente->apellido : 'Sin cliente' }}
                        </p>
                    </div>
                </div>

                <hr class="border-secondary mb-4">

                {{-- Tabla de Productos/Servicios --}}
                <div class="table-responsive mb-4">
                    <table class="table table-dark table-hover text-center align-middle">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Productos</th>
                            <th>Categoría</th>
                            <th>Precio Unitario (Lps)</th>
                            <th>Cantidad</th>
                            <th>IVA (Lps)</th>
                            <th>Subtotal (Lps)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($factura->detalles as $index => $detalle)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $detalle->producto->nombre ?? 'Producto Eliminado' }}</td>
                                <td>{{ $detalle->producto->categoria ?? 'N/A' }}</td>
                                <td>L. {{ number_format($detalle->precio_unitario, 2) }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>L. {{ number_format($detalle->iva, 2) }}</td>
                                <td>L. {{ number_format($detalle->subtotal, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No hay detalles para esta factura.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="row justify-content-end">
                    <div class="col-md-6 col-lg-4">
                        <div class="card bg-secondary text-white p-3 rounded-3">
                            <p class="d-flex justify-content-between mb-1">
                                <span>Importe Grabado (Lps):</span>
                                <span>L. {{ number_format($factura->subtotal, 2) }}</span>
                            </p>
                            <p class="d-flex justify-content-between fw-bold mb-1">
                                <span>Subtotal (Lps):</span>
                                <span>L. {{ number_format($factura->subtotal, 2) }}</span>
                            </p>
                            <p class="d-flex justify-content-between mb-1">
                                <span>IVA (Lps):</span>
                                <span>L. {{ number_format($factura->iva, 2) }}</span>
                            </p>
                            <hr class="border-dark my-2">
                            <h5 class="d-flex justify-content-between text-warning mb-0">
                                <span>Total Final (Lps):</span>
                                <span>L. {{ number_format($factura->total, 2) }}</span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-darker text-center py-3 rounded-bottom-3">
                <small class="text-muted">Última actualización: {{ $factura->updated_at->diffForHumans() }}</small>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('facturas.index') }}" class="btn btn-warning btn-lg rounded-pill shadow-sm">
                <i class="btn btn- mb-3"></i> Volver a la lista
            </a>
        </div>
    </div>

    {{-- Script para iconos de Font Awesome --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" crossorigin="anonymous"></script>


@endsection
