@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }
        /* Estilo para los campos de texto/select/textarea para que se vean oscuros */
        .form-control, .form-select, .form-file-input {
            background-color: #1e1e1e !important;
            color: #ffffff !important;
            border: 1px solid #333 !important;
        }
        /* Color del texto del placeholder en dark mode */
        .form-control::placeholder {
            color: #ccc;
        }
        /* Estilo del focus en dark mode - CAMBIO A AZUL */
        .form-control:focus, .form-select:focus, .form-file-input:focus {
            border-color: #007bff !important; /* Borde azul */
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25) !important; /* Sombra azul */
            background-color: #1e1e1e !important;
            color: #ffffff !important;
        }
        /* Estilo para labels de formulario */
        .form-label {
            color: #ffffff;
        }
        /* Estilo para el input[type="file"] en modo oscuro */
        .form-file-input {
            padding: 0.375rem 0.75rem;
        }
        /* Estilo para la imagen actual */
        .current-image-preview {
            max-width: 100px;
            height: auto;
            border-radius: 8px;
            margin-top: 5px;
            border: 1px solid #444;
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="mb-4 text-white">Editar Producto: <span style="color: #f80320">{{ $lubricante->nombre }}</span></h2>

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

                <form id="formLubricanteEdit" action="{{ route('lubricantes.update', $lubricante->id) }}" method="POST" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input
                                    type="text"
                                    name="nombre"
                                    id="nombre"
                                    class="form-control bg-dark text-white @error('nombre') is-invalid @enderror"
                                    value="{{ old('nombre', $lubricante->nombre) }}"
                                    required
                                    maxlength="50"
                                    autocomplete="off"
                            >
                            <div class="invalid-feedback" id="nombre-feedback">
                                @error('nombre') {{ $message }} @else El nombre es requerido. @enderror
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="codigo" class="form-label">Código:</label>
                            <input
                                    type="text"
                                    name="codigo"
                                    id="codigo"
                                    class="form-control bg-dark text-white @error('codigo') is-invalid @enderror"
                                    value="{{ old('codigo', $lubricante->codigo) }}"
                                    maxlength="20"
                                    required
                                    autocomplete="off"
                            >
                            <div class="invalid-feedback" id="codigo-feedback">
                                @error('codigo') {{ $message }} @else El código es requerido y debe ser único. @enderror
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="marca" class="form-label">Marca:</label>
                            <input
                                    type="text"
                                    name="marca"
                                    id="marca"
                                    class="form-control bg-dark text-white @error('marca') is-invalid @enderror"
                                    value="{{ old('marca', $lubricante->marca) }}"
                                    required
                                    maxlength="30"
                                    autocomplete="off"
                            >
                            <div class="invalid-feedback" id="marca-feedback">
                                @error('marca') {{ $message }} @else La marca es requerida. @enderror
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="tipo_producto" class="form-label">Tipo de producto:</label>
                            <select name="tipo_producto" id="tipo_producto"
                                    class="form-select bg-dark text-white @error('tipo_producto') is-invalid @enderror" required>
                                <option value="" class="text-white">Seleccione un producto...</option>
                                @php
                                    $tipos = ['Lubricantes', 'Fluidos y líquidos', 'Filtros', 'Productos de mantenimiento y limpieza', 'Accesorios complementarios'];
                                @endphp
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo }}" {{ old('tipo_producto', $lubricante->tipo_producto) == $tipo ? 'selected' : '' }}>
                                        {{ $tipo }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="tipo_producto-feedback">
                                @error('tipo_producto') {{ $message }} @else Por favor, seleccione una categoría de producto. @enderror
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea name="descripcion" id="descripcion" rows="4"
                                      class="form-control bg-dark text-white @error('descripcion') is-invalid @enderror"
                                      maxlength="300"
                                      required autocomplete="off">{{ old('descripcion', $lubricante->descripcion) }}</textarea>
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
                            >
                            <div class="form-text text-white mt-1">
                                Max 2MB. Dejar vacío para conservar la imagen actual.
                            </div>

                            @if ($lubricante->imagen)
                                <p class="text-white mt-2 mb-1 small">Imagen actual:</p>
                                <img src="{{ asset('storage/' . $lubricante->imagen) }}" alt="Imagen actual del producto" class="current-image-preview">
                            @endif

                            <div class="invalid-feedback" id="imagen-feedback">
                                @error('imagen') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger">Actualizar</button>
                    <button type="button" class="btn btn-danger" id="restablecerFormulario">Restablecer</button>
                    <a href="{{ route('lubricantes.index') }}" class="btn btn-danger">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('formLubricanteEdit');
            const nombreInput = document.getElementById('nombre');
            const codigoInput = document.getElementById('codigo');
            const marcaInput = document.getElementById('marca');
            const tipoProductoInput = document.getElementById('tipo_producto');
            const descripcionInput = document.getElementById('descripcion');
            const imagenInput = document.getElementById('imagen');

            const originalValues = {
                nombre: nombreInput.value,
                codigo: codigoInput.value,
                marca: marcaInput.value,
                tipo_producto: tipoProductoInput.value,
                descripcion: descripcionInput.value,
            };

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
                    document.getElementById('codigo-feedback').textContent = 'El código es requerido.';
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

                if (!formIsValid) {
                    event.preventDefault();
                }
            });

            document.getElementById('restablecerFormulario').addEventListener('click', function() {
                nombreInput.value = originalValues.nombre;
                codigoInput.value = originalValues.codigo;
                marcaInput.value = originalValues.marca;
                tipoProductoInput.value = originalValues.tipo_producto;
                descripcionInput.value = originalValues.descripcion;

                imagenInput.value = '';

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
                    }
                });
            });

            document.querySelectorAll('.form-control, .form-select, .form-file-input').forEach(input => {
                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid')) {
                        const feedbackElement = document.getElementById(this.id + '-feedback');
                        if (feedbackElement && !feedbackElement.hasAttribute('data-laravel-error')) {
                            this.classList.remove('is-invalid');
                            feedbackElement.style.display = 'none';
                        }
                    }
                });

                if (input.tagName === 'SELECT') {
                    input.addEventListener('change', function() {
                        if (this.value) {
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback');
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