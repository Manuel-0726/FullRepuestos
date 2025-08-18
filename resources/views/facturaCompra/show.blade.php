@extends('layouts.app')

@section('title', 'Detalle de Factura de Compra')

@section('content')
    <div class="container py-5">
        <div class="table-container">
            <h2 class="mb-4">Factura de compra #{{ $factura->codigo }}</h2>

            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</p>

            <p><strong>Proveedor:</strong> {{ $factura->proveedor->nombre_empresa }}</p>
            <p><strong>Empleado:</strong> {{ $factura->empleado->nombre }}</p>
            <p><strong>Subtotal:</strong> L. {{ number_format($factura->subtotal, 2) }}</p>
            <p><strong>IVA:</strong> L. {{ number_format($factura->iva, 2) }}</p>
            <p><strong>Total:</strong> L. {{ number_format($factura->total, 2) }}</p>

            <hr>

            <h4>Productos</h4>
            <table class="table table-dark table-hover text-white mt-3">
                <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                    <th>Impuesto</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($factura->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>L. {{ number_format($detalle->precio_unitario, 2) }}</td>
                        <td>L. {{ number_format($detalle->producto->precio_venta ?? 0, 2) }}</td>
                        <td>{{ $detalle->producto->impuesto ?? 0 }}%</td>

                        <td>L. {{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="{{ route('facturas-compra.index') }}" class="btn btn-danger mt-3">Volver</a>
        </div>
    </div>
@endsection
