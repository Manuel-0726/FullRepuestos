@extends('layouts.app')

@section('title', 'Registrar empleado')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        #identidad:-webkit-autofill,
        #identidad:-webkit-autofill:hover,
        #identidad:-webkit-autofill:focus,
        #identidad:-webkit-autofill:active {
            background-color: transparent !important;
            -webkit-box-shadow: 0 0 0 1000px #f8f9fa inset !important;
            box-shadow: 0 0 0 1000px #f8f9fa inset !important;
            -webkit-text-fill-color: #212529 !important;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-container">
                    <h2 class="mb-4">Registrar un empleado</h2>

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

                    <form id="formEmpleado" action="{{ route('empleados.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required maxlength="30" />
                                <div class="invalid-feedback" id="nombre-feedback">
                                    @error('nombre')
                                    {{ $message }}
                                    @else
                                        El nombre es obligatorio.
                                        @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="apellido" class="form-label">Apellido:</label>
                                <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" value="{{ old('apellido') }}" required maxlength="30" />
                                <div class="invalid-feedback" id="apellido-feedback">
                                    @error('apellido')
                                    {{ $message }}
                                    @else
                                        El apellido es obligatorio.
                                        @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="correo" class="form-label">Correo:</label>
                                <input type="email" class="form-control @error('correo') is-invalid @enderror" id="correo" name="correo" value="{{ old('correo') }}" required maxlength="30" />
                                <div class="invalid-feedback" id="correo-feedback">
                                    @error('correo')
                                    {{ $message }}
                                    @else
                                        El correo es obligatorio.
                                        @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}" maxlength="8" />
                                <div class="invalid-feedback" id="telefono-feedback">
                                    @error('telefono')
                                    {{ $message }}
                                    @else
                                        El teléfono es obligatorio.
                                        @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="identidad" class="form-label">Identidad</label>
                                <input type="text" id="identidad" name="identidad" maxlength="15"
                                       value="{{ old('identidad') }}"
                                       class="form-control @error('identidad') is-invalid @enderror"
                                       oninput="formatearIdentidad(this)" />
                                @error('identidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="errorIdentidad" class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="direccion" class="form-label">Dirección:</label>
                                <textarea class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" required maxlength="100" rows="3">{{ old('direccion') }}</textarea>
                                <div class="invalid-feedback" id="direccion-feedback">
                                    @error('direccion')
                                    {{ $message }}
                                    @else
                                        La dirección es obligatoria.
                                        @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sexo" class="form-label">Sexo:</label>
                                <select class="form-control @error('sexo') is-invalid @enderror" id="sexo" name="sexo" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="Otro" {{ old('sexo') == 'Otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('sexo')
                                    {{ $message }}
                                    @else
                                        Por favor, seleccione una opción.
                                        @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="puesto" class="form-label">Puesto:</label>
                                <select class="form-control @error('puesto') is-invalid @enderror" id="puesto" name="puesto" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Vendedor" {{ old('puesto') == 'Vendedor' ? 'selected' : '' }}>Vendedor</option>
                                    <option value="Cajero" {{ old('puesto') == 'Cajero' ? 'selected' : '' }}>Cajero</option>
                                    <option value="Motorista" {{ old('puesto') == 'Motorista' ? 'selected' : '' }}>Motorista</option>
                                    <option value="Gerente" {{ old('puesto') == 'Gerente' ? 'selected' : '' }}>Gerente</option>
                                    <option value="Contador" {{ old('puesto') == 'Contador' ? 'selected' : '' }}>Contador</option>
                                    <option value="Aseador" {{ old('puesto') == 'Aseador' ? 'selected' : '' }}>Aseador</option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('puesto')
                                    {{ $message }}
                                    @else
                                        Por favor, seleccione una opción.
                                        @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="salario" class="form-label">Salario (Lempiras):</label>
                                <input type="number" class="form-control @error('salario') is-invalid @enderror" id="salario" name="salario" value="{{ old('salario') }}" required min="1" max="99999"/>
                                <div class="invalid-feedback" id="salario-feedback">
                                    @error('salario')
                                    {{ $message }}
                                    @else
                                        El salario es obligatorio, debe ser un número entero positivo y con un máximo de 5 cifras.
                                        @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="fecha_contratacion" class="form-label">Fecha de Contratación:</label>
                                <input type="date" class="form-control @error('fecha_contratacion') is-invalid @enderror" id="fecha_contratacion" name="fecha_contratacion" value="{{ old('fecha_contratacion') }}" required />
                                <div class="invalid-feedback" id="fecha_contratacion-feedback">
                                    @error('fecha_contratacion')
                                    {{ $message }}
                                    @else
                                        La fecha de contratación es obligatoria.
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger">Guardar</button>
                        <a href="{{ route('empleados.create') }}" class="btn btn-danger">Limpiar</a>
                        <a href="{{ route('empleados.index') }}" class="btn btn-danger">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function formatearIdentidad(input) {
            const originalStart = input.selectionStart;
            let valorSinGuiones = input.value.replace(/\D/g, '');
            let nuevoValor = '';
            let guionesPrevios = (input.value.slice(0, originalStart).match(/-/g) || []).length;
            let cursorOffset = 0;
            let nuevaPosicion = originalStart - guionesPrevios;

            for (let i = 0; i < valorSinGuiones.length; i++) {
                const char = valorSinGuiones[i];
                if (i > 0 && (i === 4 || i === 8)) {
                    nuevoValor += '-';
                    if (i <= nuevaPosicion) {
                        cursorOffset++;
                    }
                }
                nuevoValor += char;
            }

            if (nuevoValor.length > 15) {
                nuevoValor = nuevoValor.slice(0, 15);
            }

            input.value = nuevoValor;
            let posicionFinalCursor = nuevaPosicion + cursorOffset;
            if (posicionFinalCursor > nuevoValor.length) {
                posicionFinalCursor = nuevoValor.length;
            }
            if (nuevoValor.charAt(posicionFinalCursor) === '-' && posicionFinalCursor === 4) {
                posicionFinalCursor++;
            } else if (nuevoValor.charAt(posicionFinalCursor) === '-' && posicionFinalCursor === 9) {
                posicionFinalCursor++;
            }
            input.setSelectionRange(posicionFinalCursor, posicionFinalCursor);

            const valorValidacion = input.value;
            const errorDiv = document.getElementById("errorIdentidad");
            errorDiv.innerText = "";
            errorDiv.style.display = 'none';

            if (valorValidacion.length === 15) {
                const soloDigitos = valorValidacion.replace(/-/g, '');
                const departamento = parseInt(soloDigitos.substring(0, 2), 10);
                const anio = parseInt(soloDigitos.substring(4, 8), 10);
                const anioActual = new Date().getFullYear();
                const anioLimite = anioActual - 18;

                if (departamento < 1 || departamento > 18) {
                    errorDiv.innerText = "Departamento inválido (01-18).";
                    errorDiv.style.display = 'block';
                } else if (anio > anioLimite) {
                    errorDiv.innerText = "El empleado debe ser mayor de 18 años.";
                    errorDiv.style.display = 'block';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('formEmpleado');
            const nombreInput = document.getElementById('nombre');
            const apellidoInput = document.getElementById('apellido');
            const salarioInput = document.getElementById('salario');
            const telefonoInput = document.getElementById('telefono');
            const correoInput = document.getElementById('correo');
            const fechaContratacionInput = document.getElementById('fecha_contratacion');
            const identidadInput = document.getElementById('identidad');
            const direccionInput = document.getElementById('direccion');

            function cleanStartSpace(event) {
                let value = event.target.value;
                if (value.startsWith(' ')) {
                    event.target.value = value.trimStart();
                }
            }
            function enforceLettersOnly(event) {
                cleanStartSpace(event);
                let value = event.target.value;
                const filteredValue = value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]/g, '');
                if (value !== filteredValue) {
                    event.target.value = filteredValue;
                }
            }
            nombreInput.addEventListener('input', enforceLettersOnly);
            apellidoInput.addEventListener('input', enforceLettersOnly);
            correoInput.addEventListener('input', cleanStartSpace);
            direccionInput.addEventListener('input', cleanStartSpace);
            telefonoInput.addEventListener('input', function (e) {
                cleanStartSpace(e);
                e.target.value = e.target.value.replace(/\D/g, '').substring(0, 8);
            });
            salarioInput.addEventListener('input', function(e) {
                cleanStartSpace(e);
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 5) {
                    value = value.substring(0, 5);
                }
                if (value.length > 1 && value[0] === '0') {
                    value = value.substring(1);
                }
                e.target.value = value;
            });

            form.addEventListener('submit', function(event) {
                let formIsValid = true;

                document.querySelectorAll('.is-invalid').forEach(element => {
                    element.classList.remove('is-invalid');
                });
                document.querySelectorAll('.invalid-feedback').forEach(element => {
                    if (!element.dataset.laravelError) {
                        element.style.display = 'none';
                    }
                });

                const nombre = nombreInput.value.trim();
                if (nombre.length === 0) {
                    nombreInput.classList.add('is-invalid');
                    document.getElementById('nombre-feedback').textContent = 'El nombre es obligatorio.';
                    document.getElementById('nombre-feedback').style.display = 'block';
                    formIsValid = false;
                }

                const apellido = apellidoInput.value.trim();
                if (apellido.length === 0) {
                    apellidoInput.classList.add('is-invalid');
                    document.getElementById('apellido-feedback').textContent = 'El apellido es obligatorio.';
                    document.getElementById('apellido-feedback').style.display = 'block';
                    formIsValid = false;
                }

                const correo = correoInput.value.trim();
                const regexCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (correo.length === 0) {
                    correoInput.classList.add('is-invalid');
                    document.getElementById('correo-feedback').textContent = 'El correo es obligatorio.';
                    document.getElementById('correo-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (!regexCorreo.test(correo) || correo.length > 30) {
                    correoInput.classList.add('is-invalid');
                    document.getElementById('correo-feedback').textContent = 'Ingrese un correo electrónico válido (ej. usuario@dominio.com).';
                    document.getElementById('correo-feedback').style.display = 'block';
                    formIsValid = false;
                }

                const telefono = telefonoInput.value.trim();
                const regexTelefonoInicio = /^[2389]\d{7}$/;
                if (telefono.length === 0) {
                    telefonoInput.classList.add('is-invalid');
                    document.getElementById('telefono-feedback').textContent = 'El teléfono es obligatorio.';
                    document.getElementById('telefono-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (!regexTelefonoInicio.test(telefono)) {
                    telefonoInput.classList.add('is-invalid');
                    document.getElementById('telefono-feedback').textContent = 'El teléfono debe tener 8 dígitos y comenzar con 2, 3, 8 o 9.';
                    document.getElementById('telefono-feedback').style.display = 'block';
                    formIsValid = false;
                }

                const identidad = identidadInput.value.trim();
                const identidadFeedback = document.getElementById('errorIdentidad');
                const regexIdentidad = /^\d{4}-\d{4}-\d{5}$/;
                let anioNacimientoIdentidad = null;

                if (identidad.length === 15 && regexIdentidad.test(identidad)) {
                    const soloDigitosIdentidad = identidad.replace(/-/g, '');
                    anioNacimientoIdentidad = parseInt(soloDigitosIdentidad.substring(4, 8), 10);
                    const primerosDosNumeros = parseInt(soloDigitosIdentidad.substring(0, 2), 10);
                    const anioActual = new Date().getFullYear();
                    const anioLimite = anioActual - 18;

                    if (primerosDosNumeros > 18) {
                        identidadInput.classList.add('is-invalid');
                        identidadFeedback.textContent = 'Los dos primeros números de la identidad (Departamento) no pueden ser mayores que 18.';
                        identidadFeedback.style.display = 'block';
                        formIsValid = false;
                    } else if (anioNacimientoIdentidad > anioLimite) {
                        identidadInput.classList.add('is-invalid');
                        identidadFeedback.textContent = 'El empleado debe ser mayor de 18 años.';
                        identidadFeedback.style.display = 'block';
                        formIsValid = false;
                    }
                } else if (identidad.length === 0) {
                    identidadInput.classList.add('is-invalid');
                    identidadFeedback.textContent = 'El número de identidad es obligatorio.';
                    identidadFeedback.style.display = 'block';
                    formIsValid = false;
                } else if (!regexIdentidad.test(identidad)) {
                    identidadInput.classList.add('is-invalid');
                    identidadFeedback.textContent = 'Debe ingresar 13 dígitos numéricos en formato ####-####-#####.';
                    identidadFeedback.style.display = 'block';
                    formIsValid = false;
                }

                const direccion = direccionInput.value.trim();
                if (direccion.length === 0) {
                    direccionInput.classList.add('is-invalid');
                    document.getElementById('direccion-feedback').textContent = 'La dirección es obligatoria.';
                    document.getElementById('direccion-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (direccion.length > 100) {
                    direccionInput.classList.add('is-invalid');
                    document.getElementById('direccion-feedback').textContent = 'La dirección no puede exceder los 100 caracteres.';
                    document.getElementById('direccion-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (!/[a-zA-Z]/.test(direccion)) {
                    direccionInput.classList.add('is-invalid');
                    document.getElementById('direccion-feedback').textContent = 'La dirección debe contener al menos una letra.';
                    document.getElementById('direccion-feedback').style.display = 'block';
                    formIsValid = false;
                }

                const sexoInput = document.getElementById('sexo');
                if (!sexoInput.value) {
                    sexoInput.classList.add('is-invalid');
                    sexoInput.nextElementSibling.textContent = 'Por favor, seleccione una opción de sexo.';
                    sexoInput.nextElementSibling.style.display = 'block';
                    formIsValid = false;
                }

                const puestoInput = document.getElementById('puesto');
                if (!puestoInput.value) {
                    puestoInput.classList.add('is-invalid');
                    puestoInput.nextElementSibling.textContent = 'Por favor, seleccione un puesto.';
                    puestoInput.nextElementSibling.style.display = 'block';
                    formIsValid = false;
                }

                const salarioValue = salarioInput.value.trim();
                const salarioInt = parseInt(salarioValue, 10);
                if (salarioValue.length === 0) {
                    salarioInput.classList.add('is-invalid');
                    document.getElementById('salario-feedback').textContent = 'El salario es obligatorio.';
                    document.getElementById('salario-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (isNaN(salarioInt) || salarioInt < 1 || salarioInt > 99999 || salarioValue.includes('.') || salarioValue.includes(',')) {
                    salarioInput.classList.add('is-invalid');
                    document.getElementById('salario-feedback').textContent = 'El salario debe ser un número entero positivo (máx. 5 cifras).';
                    document.getElementById('salario-feedback').style.display = 'block';
                    formIsValid = false;
                }

                const fechaContratacionValue = fechaContratacionInput.value;
                const fechaSeleccionada = new Date(fechaContratacionValue + 'T00:00:00');
                const fechaLimiteInferior = new Date('2000-01-01T00:00:00');
                const fechaActual = new Date();
                fechaActual.setHours(0, 0, 0, 0);

                if (fechaContratacionValue.length === 0) {
                    fechaContratacionInput.classList.add('is-invalid');
                    document.getElementById('fecha_contratacion-feedback').textContent = 'La fecha de contratación es obligatoria.';
                    document.getElementById('fecha_contratacion-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (fechaSeleccionada < fechaLimiteInferior) {
                    fechaContratacionInput.classList.add('is-invalid');
                    document.getElementById('fecha_contratacion-feedback').textContent = 'La fecha no puede ser anterior al 1 de enero de 2000.';
                    document.getElementById('fecha_contratacion-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (fechaSeleccionada > fechaActual) {
                    fechaContratacionInput.classList.add('is-invalid');
                    document.getElementById('fecha_contratacion-feedback').textContent = 'La fecha no puede ser futura.';
                    document.getElementById('fecha_contratacion-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (anioNacimientoIdentidad !== null) {
                    const anioContratacionMinima = anioNacimientoIdentidad + 18;
                    const fechaMinimaContratacion = new Date(anioContratacionMinima, 0, 1, 0, 0, 0);
                    if (fechaSeleccionada < fechaMinimaContratacion) {
                        fechaContratacionInput.classList.add('is-invalid');
                        document.getElementById('fecha_contratacion-feedback').textContent = `El empleado debe tener al menos 18 años al contratar. Fecha mínima: 01/01/${anioContratacionMinima}.`;
                        document.getElementById('fecha_contratacion-feedback').style.display = 'block';
                        formIsValid = false;
                    }
                }

                if (!formIsValid) {
                    event.preventDefault();
                }
            });

            document.querySelectorAll('.form-control').forEach(input => {
                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid') && this.value.trim().length > 0) {
                        this.classList.remove('is-invalid');
                        let feedbackElement = this.id === 'identidad' ? document.getElementById('errorIdentidad') : document.getElementById(this.id + '-feedback');
                        if (feedbackElement && !feedbackElement.dataset.laravelError) {
                            feedbackElement.style.display = 'none';
                        }
                    }
                });

                if (input.tagName === 'SELECT') {
                    input.addEventListener('change', function() {
                        if (this.value !== '') {
                            this.classList.remove('is-invalid');
                            let feedbackElement = this.nextElementSibling;
                            if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                                feedbackElement.style.display = 'none';
                                feedbackElement.removeAttribute('data-laravel-error');
                            }
                        }
                    });
                }
            });
            document.querySelectorAll('.form-control.is-invalid, select.is-invalid, textarea.is-invalid').forEach(function(element) {
                let feedbackElement;
                if (element.id === 'identidad') {
                    feedbackElement = document.getElementById('errorIdentidad');
                } else if (element.id && document.getElementById(element.id + '-feedback')) {
                    feedbackElement = document.getElementById(element.id + '-feedback');
                } else {
                    feedbackElement = element.nextElementSibling;
                }
                if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                    feedbackElement.style.display = 'block';
                    feedbackElement.setAttribute('data-laravel-error', 'true');
                }
            });
        });
    </script>
@endsection