@extends('layouts.app')

@section('title', 'Registrar lubricante y otros productos')

@section('content')
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }
        .form-control, .form-select, .form-file-input {
            background-color: #1e1e1e !important;
            color: #ffffff !important;
            border: 1px solid #333 !important;
        }
        .form-control::placeholder {
            color: #ccc;
        }
        .form-control:focus, .form-select:focus, .form-file-input:focus {
            border-color: #f80320 !important;
            box-shadow: 0 0 0 0.25rem rgba(248, 3, 32, 0.25) !important;
            background-color: #1e1e1e !important;
            color: #ffffff !important;
        }
        .form-label {
            color: #ffffff;
        }
        .form-file-input {
            padding: 0.375rem 0.75rem;
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-container">
                    <h2 class="mb-4 text-white">Registrar lubricantes y otros productos</h2>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="formLubricante" action="{{ route('lubricantes.store') }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="nombre" class="form-label text-white">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control bg-dark text-white @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required maxlength="50" autocomplete="off">
                                <div class="invalid-feedback" id="nombre-feedback">
                                    @error('nombre') {{ $message }} @else El nombre es requerido. @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="codigo" class="form-label text-white">Código:</label>
                                <input type="text" name="codigo" id="codigo" class="form-control bg-dark text-white @error('codigo') is-invalid @enderror" value="{{ old('codigo') }}" maxlength="20" required autocomplete="off">
                                <div class="invalid-feedback" id="codigo-feedback">
                                    @error('codigo') {{ $message }} @else El código es requerido y debe ser único. @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="marca" class="form-label text-white">Marca:</label>
                                <input type="text" name="marca" id="marca" class="form-control bg-dark text-white @error('marca') is-invalid @enderror" value="{{ old('marca') }}" required maxlength="30" autocomplete="off">
                                <div class="invalid-feedback" id="marca-feedback">
                                    @error('marca') {{ $message }} @else La marca es requerida. @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="tipo_producto" class="form-label text-white">Tipo de producto:</label>
                                <select name="tipo_producto" id="tipo_producto" class="form-select bg-dark text-white @error('tipo_producto') is-invalid @enderror" required>
                                    <option value="" class="text-white">Seleccione un producto...</option>
                                    @php
                                        $tipos = ['Lubricantes', 'Fluidos y líquidos', 'Filtros', 'Productos de mantenimiento y limpieza', 'Accesorios complementarios'];
                                    @endphp
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo }}" {{ old('tipo_producto') == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="tipo_producto-feedback">
                                    @error('tipo_producto') {{ $message }} @else Por favor, seleccione una categoría de producto. @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="descripcion" class="form-label text-white">Descripción:</label>
                                <textarea name="descripcion" id="descripcion" rows="4" class="form-control bg-dark text-white @error('descripcion') is-invalid @enderror" maxlength="300" required autocomplete="off">{{ old('descripcion') }}</textarea>
                                <div class="invalid-feedback" id="descripcion-feedback">
                                    @error('descripcion') {{ $message }} @else La descripción es requerida. @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="imagen" class="form-label text-white">Imagen del producto:</label>
                                <input
                                        type="file"
                                        name="imagen"
                                        id="imagen"
                                        class="form-control form-file-input @error('imagen') is-invalid @enderror"
                                        required
                                >
                                {{-- AÑADIDO: Mensaje de tamaño de archivo en blanco --}}
                                <div class="form-text text-white mt-1">
                                    Max 2MB.
                                </div>

                                <div class="invalid-feedback" id="imagen-feedback">
                                    @error('imagen') {{ $message }} @else La imagen del producto es requerida. @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger">Guardar</button>
                        <button type="button" class="btn btn-danger" id="limpiarFormulario">Limpiar</button>
                        <a href="{{ route('lubricantes.index') }}" class="btn btn-danger">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('formLubricante');
            const nombreInput = document.getElementById('nombre');
            const codigoInput = document.getElementById('codigo');
            const marcaInput = document.getElementById('marca');
            const tipoProductoInput = document.getElementById('tipo_producto');
            const descripcionInput = document.getElementById('descripcion');
            const imagenInput = document.getElementById('imagen');

            const regexNombreMarca = /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\-\/.,()]+$/;

            function enforceValidChars(event) {
                let value = event.target.value;
                const originalSelectionStart = event.target.selectionStart;
                const originalSelectionEnd = event.target.selectionEnd;

                const filteredValue = value.replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\-\/.,()]/g, '');

                if (value !== filteredValue) {
                    event.target.value = filteredValue;
                    if (originalSelectionStart === originalSelectionEnd) {
                        event.target.setSelectionRange(originalSelectionStart - (value.length - filteredValue.length), originalSelectionEnd - (value.length - filteredValue.length));
                    } else {
                        event.target.setSelectionRange(originalSelectionStart, originalSelectionEnd - (value.length - filteredValue.length));
                    }
                }
            }

            nombreInput.addEventListener('input', enforceValidChars);
            marcaInput.addEventListener('input', enforceValidChars);

            codigoInput.addEventListener('input', function (e) {
                e.target.value = e.target.value.replace(/[^a-zA-Z0-9\-]/g, '');
            });

            form.addEventListener('submit', function(event) {
                let formIsValid = true;

                document.querySelectorAll('.is-invalid').forEach(element => {
                    element.classList.remove('is-invalid');
                });
                document.querySelectorAll('.invalid-feedback').forEach(element => {
                    if (!element.hasAttribute('data-laravel-error')) {
                        element.style.display = 'none';
                    }
                });

                nombreInput.value = nombreInput.value.trimStart();
                codigoInput.value = codigoInput.value.trimStart();
                marcaInput.value = marcaInput.value.trimStart();
                descripcionInput.value = descripcionInput.value.trimStart();


                const nombre = nombreInput.value.trim();
                if (nombre.length === 0) {
                    nombreInput.classList.add('is-invalid');
                    document.getElementById('nombre-feedback').textContent = 'El nombre es requerido.';
                    document.getElementById('nombre-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (nombre.length > 50) {
                    nombreInput.classList.add('is-invalid');
                    document.getElementById('nombre-feedback').textContent = 'El nombre no puede exceder los 50 caracteres.';
                    document.getElementById('nombre-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (!regexNombreMarca.test(nombre)) {
                    nombreInput.classList.add('is-invalid');
                    document.getElementById('nombre-feedback').textContent = 'Solo se permiten caracteres alfanuméricos, espacios y símbolos comunes (-, /, ., (, )).';
                    document.getElementById('nombre-feedback').style.display = 'block';
                    formIsValid = false;
                }

                const codigo = codigoInput.value.trim();
                if (codigo.length === 0) {
                    codigoInput.classList.add('is-invalid');
                    document.getElementById('codigo-feedback').textContent = 'El código es requerido y debe ser único.';
                    document.getElementById('codigo-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (codigo.length > 20) {
                    codigoInput.classList.add('is-invalid');
                    document.getElementById('codigo-feedback').textContent = 'El código no puede exceder los 20 caracteres.';
                    document.getElementById('codigo-feedback').style.display = 'block';
                    formIsValid = false;
                }

                const marca = marcaInput.value.trim();
                if (marca.length === 0) {
                    marcaInput.classList.add('is-invalid');
                    document.getElementById('marca-feedback').textContent = 'La marca es requerida.';
                    document.getElementById('marca-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (marca.length > 30) {
                    marcaInput.classList.add('is-invalid');
                    document.getElementById('marca-feedback').textContent = 'La marca no puede exceder los 30 caracteres.';
                    document.getElementById('marca-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (!regexNombreMarca.test(marca)) {
                    marcaInput.classList.add('is-invalid');
                    document.getElementById('marca-feedback').textContent = 'Solo se permiten caracteres alfanuméricos, espacios y símbolos comunes (-, /, ., (, )).';
                    document.getElementById('marca-feedback').style.display = 'block';
                    formIsValid = false;
                }

                if (!tipoProductoInput.value) {
                    tipoProductoInput.classList.add('is-invalid');
                    document.getElementById('tipo_producto-feedback').style.display = 'block';
                    formIsValid = false;
                }

                const descripcion = descripcionInput.value.trim();
                if (descripcion.length === 0) {
                    descripcionInput.classList.add('is-invalid');
                    document.getElementById('descripcion-feedback').textContent = 'La descripción es requerida.';
                    document.getElementById('descripcion-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (descripcion.length > 300) {
                    descripcionInput.classList.add('is-invalid');
                    document.getElementById('descripcion-feedback').textContent = 'La descripción no puede exceder los 300 caracteres.';
                    document.getElementById('descripcion-feedback').style.display = 'block';
                    formIsValid = false;
                }

                if (imagenInput.files.length === 0) {
                    imagenInput.classList.add('is-invalid');
                    document.getElementById('imagen-feedback').textContent = 'Debe seleccionar una imagen para el producto.';
                    document.getElementById('imagen-feedback').style.display = 'block';
                    formIsValid = false;
                }

                if (!formIsValid) {
                    event.preventDefault();
                }
            });

            document.getElementById('limpiarFormulario').addEventListener('click', function() {
                form.reset();

                document.querySelectorAll('.is-invalid').forEach(element => {
                    element.classList.remove('is-invalid');
                });
                document.querySelectorAll('.invalid-feedback').forEach(element => {
                    element.style.display = 'none';
                    element.removeAttribute('data-laravel-error');

                    if (element.id === 'nombre-feedback') {
                        element.textContent = 'El nombre es requerido.';
                    } else if (element.id === 'codigo-feedback') {
                        element.textContent = 'El código es requerido y debe ser único.';
                    } else if (element.id === 'marca-feedback') {
                        element.textContent = 'La marca es requerida.';
                    } else if (element.id === 'tipo_producto-feedback') {
                        element.textContent = 'Por favor, seleccione una categoría de producto.';
                    } else if (element.id === 'descripcion-feedback') {
                        element.textContent = 'La descripción es requerida.';
                    } else if (element.id === 'imagen-feedback') {
                        element.textContent = 'La imagen del producto es requerida.';
                    }
                });
            });

            document.querySelectorAll('.form-control, .form-select').forEach(input => {
                input.addEventListener('input', function() {
                    if (this.type !== 'select-one') {
                        this.value = this.value.trimStart();
                    }

                    if (this.classList.contains('is-invalid')) {
                        if (this.value.trim().length > 0 || this.type === 'select-one') {
                            const feedbackElement = document.getElementById(this.id + '-feedback') || this.nextElementSibling;

                            if (feedbackElement && !feedbackElement.hasAttribute('data-laravel-error')) {
                                this.classList.remove('is-invalid');
                                feedbackElement.style.display = 'none';
                            }
                        }
                    }
                });

                if (input.tagName === 'SELECT') {
                    input.addEventListener('change', function() {
                        if (this.value) {
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback') || this.nextElementSibling;
                            if (feedbackElement) {
                                feedbackElement.style.display = 'none';
                            }
                        }
                    });
                }

                if (input.type === 'file') {
                    input.addEventListener('change', function() {
                        if (this.files.length > 0) {
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback');
                            if (feedbackElement) {
                                feedbackElement.style.display = 'none';
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection