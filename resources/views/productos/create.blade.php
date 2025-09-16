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
                        <!-- Nombre -->
                        <div class="mb-3 col-md-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input
                                    type="text"
                                    class="form-control @error('nombre') is-invalid @enderror"
                                    id="nombre"
                                    name="nombre"
                                    value="{{ old('nombre') }}"
                                    required
                                    maxlength="60"
                                    onkeydown="return evitarEspaciosInicio(this, event)"
                            />
                            @error('nombre')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Modelo -->
                        <div class="mb-3 col-md-6">
                            <label for="modelo" class="form-label">Modelo:</label>
                            <input
                                    type="text"
                                    class="form-control @error('modelo') is-invalid @enderror"
                                    id="modelo"
                                    name="modelo"
                                    value="{{ old('modelo') }}"
                                    required
                                    maxlength="60"
                                    pattern="^[A-Za-z0-9\-]+$"
                                    onkeydown="return evitarEspaciosInicio(this, event)"
                            />
                            @error('modelo')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Marca -->
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

                        <!-- Año -->
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
                                    oninput="validarAnio(this)"
                            />
                            @error('anio')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Categoría -->
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

                        <!-- Descripción -->
                        <div class="mb-3 col-12">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea
                                    class="form-control @error('descripcion') is-invalid @enderror"
                                    id="descripcion"
                                    name="descripcion"
                                    required
                                    maxlength="250"
                                    rows="3"
                                    onkeydown="return evitarEspaciosInicio(this, event)"
                            >{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-danger">Registrar</button>
                        <a href="{{ route('productos.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JS validaciones extra -->
<script>
    // Evitar espacios al inicio
    function evitarEspaciosInicio(input, event) {
        if (event.key === " " && input.selectionStart === 0) {
            event.preventDefault();
            return false;
        }
        return true;
    }

    // Validar campo año: solo 4 dígitos
    function validarAnio(input) {
        let valor = input.value.replace(/\D/g, ""); // solo números
        if (valor.length > 4) {
            valor = valor.slice(0, 4);
        }
        input.value = valor;
    }
</script>
</body>
</html>
