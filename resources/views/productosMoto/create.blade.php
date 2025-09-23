@extends('layouts.app')

@section('title', 'Registrar nuevo producto de moto')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-container">
                    <h2 class="mb-4">Registrar nuevo producto de moto</h2>

                    <form id="formProductoMoto" action="{{ route('productos_moto.store') }}" method="POST" enctype="multipart/form-data" novalidate>
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
                                        oninput="this.value = this.value.trimStart()"
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
                                        maxlength="60"
                                        pattern="^[A-Za-z0-9\-]+$"
                                        oninput="this.value = this.value.trimStart()"
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
                                        $marcasMoto = ['Honda', 'Yamaha', 'Suzuki', 'Kawasaki', 'Ducati', 'BMW', 'Harley-Davidson'];
                                    @endphp
                                    @foreach($marcasMoto as $marca)
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
                                        min="1990"
                                        max="{{ date('Y') }}"
                                        onkeydown="return (this.value.length < 4) || event.key === 'Backspace' || event.key === 'Delete' || event.key === 'Tab' || event.key === 'ArrowLeft' || event.key === 'ArrowRight';"
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
                                        $categoriasMoto = ['Motor', 'Frenos', 'Suspensión', 'Eléctrico', 'Accesorios'];
                                    @endphp
                                    @foreach($categoriasMoto as $categoria)
                                        <option value="{{ $categoria }}" {{ old('categoria') == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
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
                                        maxlength="250"
                                        rows="3"
                                        oninput="this.value = this.value.trimStart()"
                                >{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Imagen -->
                            <div class="mb-3 col-md-6">
                                <label for="imagen" class="form-label">Imagen:</label>
                                <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" accept="image/*">
                                @error('imagen')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-3 mt-3">
                            <button type="submit" class="btn btn-danger">Registrar</button>
                            <a href="{{ route('productos_moto.index') }}" class="btn btn-secondary">Volver</a>
                            <a href="{{ route('welcome') }}" class="btn btn-primary">Inicio</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script para mostrar el tamaño del archivo y el mensaje de error de 2MB
        document.addEventListener('DOMContentLoaded', function () {
            const imagenInput = document.getElementById('imagen');
            imagenInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const maxSize = 2 * 1024 * 1024; // 2 MB en bytes
                    if (file.size > maxSize) {
                        // Cambiamos el mensaje para que sea más claro
                        const errorMessage = document.createElement('div');
                        errorMessage.classList.add('text-danger', 'mt-1');
                        errorMessage.textContent = 'La imagen no puede ser mayor a 2 MB.';
                        this.parentNode.appendChild(errorMessage);
                        this.classList.add('is-invalid');
                    } else {
                        // Si el archivo es válido, eliminamos el error anterior
                        const prevError = this.parentNode.querySelector('.text-danger');
                        if (prevError) {
                            prevError.remove();
                        }
                        this.classList.remove('is-invalid');
                    }
                }
            });
        });
    </script>
@endsection
