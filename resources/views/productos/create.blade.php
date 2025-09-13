@extends('layouts.app')
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Registrar nuevo producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="form-container">
                <h2 class="mb-4">Registrar nuevo producto</h2>

                <form id="formProducto" action="{{ route('productos.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input
                                    type="text"
                                    class="form-control @error('nombre') is-invalid @enderror"
                                    id="nombre"
                                    name="nombre"
                                    value="{{ old('nombre') }}"
                                    required
                            />
                            @error('nombre')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="stock" class="form-label">Cantidad en stock</label>
                            <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" min="0" required value="{{ old('stock', $producto->stock ?? 0) }}">
                            @error('stock')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="precio_venta" class="form-label">Precio de Venta</label>
                            <input type="number" id="precio_venta" name="precio_venta" value="{{ old('precio_venta') }}"
                                   class="form-control @error('precio_venta') is-invalid @enderror" step="0.01" min="0" required>
                            @error('precio_venta')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="modelo" class="form-label">Modelo:</label>
                            <input
                                    type="text"
                                    class="form-control @error('modelo') is-invalid @enderror"
                                    id="modelo"
                                    name="modelo"
                                    value="{{ old('modelo') }}"
                                    required
                            />
                            @error('modelo')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="marca" class="form-label">Marca:</label>
                            <select class="form-control @error('marca') is-invalid @enderror" id="marca" name="marca" required>
                                <option value="">Seleccione una marca...</option>
                                @php
                                    $marcas = ['Toyota', 'Honda', 'Ford', 'Chevrolet', 'Nissan', 'Volkswagen', 'Hyundai', 'Mazda', 'Kia'];
                                @endphp
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca }}" {{ old('marca') == $marca ? 'selected' : '' }}>{{ $marca }}</option>
                                @endforeach
                            </select>
                            @error('marca')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="anio" class="form-label">Año:</label>
                            <input
                                    type="number"
                                    class="form-control @error('anio') is-invalid @enderror"
                                    id="anio"
                                    name="anio"
                                    value="{{ old('anio') }}"
                                    required
                                    min="1990"
                                    max="{{ date('Y') }}"
                            />
                            @error('anio')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="categoria" class="form-label">Categoría:</label>
                            <select class="form-control @error('categoria') is-invalid @enderror" id="categoria" name="categoria" required>
                                <option value="">Seleccione...</option>
                                @php
                                    $categorias = ['Motor', 'Frenos', 'Suspensión', 'Eléctrico', 'Accesorios'];
                                @endphp
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria }}" {{ old('categoria') == $categoria ? 'selected' : '' }}>
                                        {{ $categoria }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoria')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-12">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea
                                    class="form-control @error('descripcion') is-invalid @enderror"
                                    id="descripcion"
                                    name="descripcion"
                                    required
                                    maxlength="100"
                                    rows="3"
                            >{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-danger">Registrar</button>
                        <button type="button" class="btn btn-danger" id="limpiarFormulario">Limpiar</button>
                        <a href="{{ route('productos.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get references to the form elements
        const form = document.getElementById('formProducto');
        const clearButton = document.getElementById('limpiarFormulario');
        const nombreInput = document.getElementById('nombre');
        const descripcionInput = document.getElementById('descripcion');

        // Add functionality to the "Limpiar" button
        clearButton.addEventListener('click', function () {
            // Reset the form fields
            form.reset();

            // Clear validation messages (divs with class 'text-danger')
            const errorMessages = document.querySelectorAll('.text-danger');
            errorMessages.forEach(msg => {
                msg.remove();
            });

            // Clear 'is-invalid' class from input fields to remove the red border
            const invalidInputs = document.querySelectorAll('.is-invalid');
            invalidInputs.forEach(input => {
                input.classList.remove('is-invalid');
            });
        });

        // Prevent leading spaces in 'nombre' input
        nombreInput.addEventListener('input', function() {
            this.value = this.value.trimStart();
        });

        // Prevent leading spaces in 'descripcion' textarea
        descripcionInput.addEventListener('input', function() {
            this.value = this.value.trimStart();
        });
    });
</script>

</body>
</html>
