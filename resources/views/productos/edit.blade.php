@extends('layouts.app')
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="form-container">
                <h2 class="mb-4">Editar producto</h2>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="formProducto" action="{{ route('productos.update', $producto->id) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Nombre --}}
                        <div class="mb-3 col-md-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input
                                    type="text"
                                    class="form-control @error('nombre') is-invalid @enderror"
                                    id="nombre"
                                    name="nombre"
                                    value="{{ old('nombre', $producto->nombre) }}"
                                    required
                                    maxlength="60"
                                    autocomplete="off"
                                    onkeydown="return evitarEspaciosInicio(this, event)"
                            />
                            @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Modelo --}}
                        <div class="mb-3 col-md-6">
                            <label for="modelo" class="form-label">Modelo:</label>
                            <input
                                    type="text"
                                    class="form-control @error('modelo') is-invalid @enderror"
                                    id="modelo"
                                    name="modelo"
                                    value="{{ old('modelo', $producto->modelo) }}"
                                    required
                                    maxlength="60"
                                    autocomplete="off"
                                    pattern="^[A-Za-z0-9\-]+$"
                                    onkeydown="return evitarEspaciosInicio(this, event)"
                            />
                            @error('modelo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Marca --}}
                        <div class="mb-3 col-md-6">
                            <label for="marca" class="form-label">Marca:</label>
                            <select class="form-control @error('marca') is-invalid @enderror" id="marca" name="marca" required>
                                <option value="">Seleccione una marca...</option>
                                @php
                                    $marcas = ['Toyota', 'Honda', 'Ford', 'Chevrolet', 'Nissan', 'Volkswagen', 'Hyundai', 'Mazda', 'Kia'];
                                @endphp
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca }}" {{ old('marca', $producto->marca) == $marca ? 'selected' : '' }}>{{ $marca }}</option>
                                @endforeach
                            </select>
                            @error('marca')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Año --}}
                        <div class="mb-3 col-md-6">
                            <label for="anio" class="form-label">Año:</label>
                            <input
                                    type="number"
                                    class="form-control @error('anio') is-invalid @enderror"
                                    id="anio"
                                    name="anio"
                                    value="{{ old('anio', $producto->anio) }}"
                                    required
                                    min="1990"
                                    max="{{ date('Y') }}"
                                    oninput="validarAnio(this)"
                            />
                            @error('anio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Categoría --}}
                        <div class="mb-3 col-md-6">
                            <label for="categoria" class="form-label">Categoría:</label>
                            <select class="form-control @error('categoria') is-invalid @enderror" id="categoria" name="categoria" required>
                                <option value="">Seleccione...</option>
                                @php
                                    $categorias = ['Motor', 'Frenos', 'Suspensión', 'Eléctrico', 'Accesorios'];
                                @endphp
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria }}" {{ old('categoria', $producto->categoria) == $categoria ? 'selected' : '' }}>
                                        {{ $categoria }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoria')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div class="mb-3 col-md-6">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea
                                    class="form-control @error('descripcion') is-invalid @enderror"
                                    id="descripcion"
                                    name="descripcion"
                                    required
                                    maxlength="250"
                                    rows="3"
                                    autocomplete="off"
                                    onkeydown="return evitarEspaciosInicio(this, event)"
                            >{{ old('descripcion', $producto->descripcion) }}</textarea>
                            @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-danger">Actualizar</button>
                        <button type="reset" class="btn btn-danger">Restablecer</button>
                        <a href="{{ route('productos.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JS validaciones -->
<script>
    // Evitar que el primer caracter sea un espacio
    function evitarEspaciosInicio(input, event) {
        if (event.key === " " && input.selectionStart === 0) {
            event.preventDefault();
            return false;
        }
        return true;
    }

    // Validar que el año solo tenga 4 dígitos válidos
    function validarAnio(input) {
        let valor = input.value.replace(/\D/g, ""); // elimina letras
        if (valor.length > 4) {
            valor = valor.slice(0, 4); // solo deja 4 dígitos
        }
        input.value = valor;
    }
</script>
</body>
</html>
