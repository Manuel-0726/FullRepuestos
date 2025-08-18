@extends('layouts.app')

@section('title', 'Editar Factura de Compra')

@section('content')
    <div class="container py-5">
        <div class="table-container">
            <h2 class="mb-4">Editar factura de compra: {{ $facturas_compra->codigo }}</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('facturas-compra.update', $facturas_compra) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $facturas_compra->fecha->format('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label for="proveedor_id" class="form-label">Proveedor</label>
                    <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}" {{ old('proveedor_id', $facturas_compra->proveedor_id) == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->nombre_empresa }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="empleado_id" class="form-label">Empleado</label>
                    <select name="empleado_id" id="empleado_id" class="form-control" required>
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->id }}" {{ old('empleado_id', $facturas_compra->empleado_id) == $empleado->id ? 'selected' : '' }}>
                                {{ $empleado->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Puedes agregar aquí más campos según tu tabla --}}

                <button type="submit" class="btn btn-danger">Guardar Cambios</button>
                <button type="reset" class="btn btn-danger">Restablecer</button>
                <a href="{{ route('facturas-compra.show', $facturas_compra) }}" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
