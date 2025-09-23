@extends('layouts.app')

@section('title', 'Editar Proveedor')

@section('head')
    {{-- Select2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .is-invalid-select2 .select2-selection {
            border-color: #dc3545 !important;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-container">
                    <h2 class="mb-4">Editar Proveedor</h2>

                    {{-- Mensajes de éxito y error de sesión --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="formProveedor" action="{{ route('proveedores.update', $proveedor->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT') {{-- Importante para las actualizaciones en Laravel --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre_empresa" class="form-label">Nombre de la empresa *</label>
                                <input type="text" class="form-control @error('nombre_empresa') is-invalid @enderror"
                                       id="nombre_empresa" name="nombre_empresa" value="{{ old('nombre_empresa', $proveedor->nombre_empresa) }}" required maxlength="30">
                                <div class="invalid-feedback" id="nombre_empresa-feedback">
                                    @error('nombre_empresa')
                                    {{ $message }}
                                    @else
                                        Este campo es obligatorio.
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="pais_origen" class="form-label">País de origen *</label>
                                <select class="form-select @error('pais_origen') is-invalid @enderror"
                                        id="pais_origen" name="pais_origen" required>
                                    <option value="">Seleccione un país...</option>
                                    @foreach($countries ?? [] as $country)
                                        <option value="{{ $country['name'] }}" data-phone-code="{{ $country['phone_code'] }}"
                                                {{ (old('pais_origen', $proveedor->pais_origen) == $country['name']) ? 'selected' : '' }}>
                                            {{ $country['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="pais_origen-feedback">
                                    @error('pais_origen')
                                    {{ $message }}
                                    @else
                                        Por favor, seleccione el país de origen.
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="persona_contacto" class="form-label">Persona de contacto *</label>
                                <input type="text" class="form-control @error('persona_contacto') is-invalid @enderror"
                                       id="persona_contacto" name="persona_contacto"
                                       value="{{ old('persona_contacto', $proveedor->persona_contacto) }}"
                                       title="Solo se permiten letras y espacios" required maxlength="32">
                                <div class="invalid-feedback" id="persona_contacto-feedback">
                                    @error('persona_contacto')
                                    {{ $message }}
                                    @else
                                        Este campo es obligatorio y solo puede contener letras.
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="correo_electronico" class="form-label">Correo electrónico *</label>
                                <input type="email" class="form-control @error('correo_electronico') is-invalid @enderror"
                                       id="correo_electronico" name="correo_electronico" value="{{ old('correo_electronico', $proveedor->correo_electronico) }}" required maxlength="30">
                                <div class="invalid-feedback" id="correo_electronico-feedback">
                                    @error('correo_electronico')
                                    {{ $message }}
                                    @else
                                        Este campo es obligatorio y debe ser un correo válido.
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telefono_contacto" class="form-label">Teléfono de contacto *</label>
                                <input type="text" class="form-control @error('telefono_contacto') is-invalid @enderror"
                                       id="telefono_contacto" name="telefono_contacto" value="{{ old('telefono_contacto', $proveedor->telefono_contacto) }}"
                                       maxlength="12" required placeholder="Ej: +504XXXXXXXX">
                                <div class="invalid-feedback" id="telefono_contacto-feedback">
                                    @error('telefono_contacto')
                                    {{ $message }}
                                    @else
                                        Este campo es obligatorio y debe incluir el código de país (ej. +504) y tener entre 8 y 12 caracteres (incluyendo el +).
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="direccion" class="form-label">Dirección *</label>
                                <textarea class="form-control @error('direccion') is-invalid @enderror"
                                          id="direccion" name="direccion" required maxlength="150" rows="3">{{ old('direccion', $proveedor->direccion) }}</textarea>
                                <div class="invalid-feedback" id="direccion-feedback">
                                    @error('direccion')
                                    {{ $message }}
                                    @else
                                        Este campo es obligatorio.
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="marcas" class="form-label">Marcas que maneja *</label>
                                <select class="form-select @error('marcas') is-invalid @enderror"
                                        id="marcas" name="marcas[]" multiple required>
                                    <option value="">Seleccione marcas...</option>
                                    @php
                                        $allMarcas = [
                                            'Toyota', 'Honda', 'Nissan', 'Mazda', 'Mitsubishi',
                                            'Suzuki', 'Hyundai', 'Kia', 'Ford', 'Chevrolet'
                                        ];
                                        $selectedMarcas = old('marcas', $proveedor->marcas ?? []);
                                        if (is_string($selectedMarcas)) {
                                            $selectedMarcas = json_decode($selectedMarcas, true) ?? [];
                                        }
                                    @endphp
                                    @foreach($allMarcas as $marca)
                                        <option value="{{ $marca }}"
                                                {{ in_array($marca, $selectedMarcas) ? 'selected' : '' }}>
                                            {{ $marca }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="marcas-feedback">
                                    @error('marcas')
                                    {{ $message }}
                                    @else
                                        Por favor, seleccione al menos una marca.
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tipo_autopartes" class="form-label">Tipo de Autopartes *</label>
                                <select class="form-select @error('tipo_autopartes') is-invalid @enderror"
                                        id="tipo_autopartes" name="tipo_autopartes[]" multiple required>
                                    <option value="">Seleccione tipos de autopartes...</option>
                                    @php
                                        $allTiposAutopartes = [
                                            'Motor', 'Transmisión', 'Suspensión', 'Frenos',
                                            'Eléctrico', 'Carrocería', 'Interior', 'Accesorios'
                                        ];
                                        $selectedTiposAutopartes = old('tipo_autopartes', $proveedor->tipo_autopartes ?? []);
                                        if (is_string($selectedTiposAutopartes)) {
                                            $selectedTiposAutopartes = json_decode($selectedTiposAutopartes, true) ?? [];
                                        }
                                    @endphp
                                    @foreach($allTiposAutopartes as $tipo)
                                        <option value="{{ $tipo }}"
                                                {{ in_array($tipo, $selectedTiposAutopartes) ? 'selected' : '' }}>
                                            {{ $tipo }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="tipo_autopartes-feedback">
                                    @error('tipo_autopartes')
                                    {{ $message }}
                                    @else
                                        Por favor, seleccione al menos un tipo de autoparte.
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="persona_contacto_secundaria" class="form-label">Persona de Contacto Secundaria</label>
                                <input type="text" class="form-control @error('persona_contacto_secundaria') is-invalid @enderror"
                                       id="persona_contacto_secundaria" name="persona_contacto_secundaria"
                                       value="{{ old('persona_contacto_secundaria', $proveedor->persona_contacto_secundaria) }}" maxlength="32">
                                <div class="invalid-feedback" id="persona_contacto_secundaria-feedback">
                                    @error('persona_contacto_secundaria')
                                    {{ $message }}
                                    @else
                                        Solo se permiten letras y espacios, máximo 32 caracteres.
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telefono_contacto_secundario" class="form-label">Teléfono de Contacto Secundario</label>
                                <input type="text" class="form-control @error('telefono_contacto_secundario') is-invalid @enderror"
                                       id="telefono_contacto_secundario" name="telefono_contacto_secundario"
                                       value="{{ old('telefono_contacto_secundario', $proveedor->telefono_contacto_secundario) }}" maxlength="12" placeholder="Ej: +504XXXXXXXX">
                                <div class="invalid-feedback" id="telefono_contacto_secundario-feedback">
                                    @error('telefono_contacto_secundario')
                                    {{ $message }}
                                    @else
                                        El teléfono debe incluir el código de país (ej. +504) y tener entre 8 y 12 caracteres (incluyendo el +).
                                        @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start gap-2 mt-4">
                            <button type="submit" class="btn btn-danger">Actualizar Proveedor</button>
                            <button type="reset" class="btn btn-danger">Restablecer</button>
                            <a href="{{ route('proveedores.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- CDN de Bootstrap JS (para funcionalidades interactivas de Bootstrap) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- jQuery (necesario para Select2) --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- Select2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('formProveedor');
            const nombreEmpresaInput = document.getElementById('nombre_empresa');
            const personaContactoInput = document.getElementById('persona_contacto');
            const telefonoContactoInput = document.getElementById('telefono_contacto');
            const correoInput = document.getElementById('correo_electronico');
            const direccionTextarea = document.getElementById('direccion');
            const paisOrigenSelect = document.getElementById('pais_origen');
            const marcasSelect = document.getElementById('marcas');
            const tipoAutopartesSelect = document.getElementById('tipo_autopartes');
            const personaContactoSecundariaInput = document.getElementById('persona_contacto_secundaria');
            const telefonoContactoSecundarioInput = document.getElementById('telefono_contacto_secundario');

            // Inicialización de Select2 para campos multi-select
            $('#marcas, #tipo_autopartes').select2({
                theme: 'default',
                width: '100%',
                placeholder: 'Seleccione las opciones',
                allowClear: true
            });

            // Función para poblar el select de países (si no está ya poblado por Blade)
            function populateCountries() {
                const countries = [
                    { "name": "Afganistán", "phone_code": "+93" },
                    //... y así para el resto de países, como en tu código original
                ];
                // Lógica de llenado, no es necesaria si ya lo hace Blade, pero se mantiene por si acaso
                const options = paisOrigenSelect.options;
                if (options.length <= 1) {
                    countries.forEach(country => {
                        const option = document.createElement('option');
                        option.value = country.name;
                        option.textContent = country.name;
                        option.setAttribute('data-phone-code', country.phone_code);
                        paisOrigenSelect.appendChild(option);
                    });
                }
            }
            //populateCountries();

            // Restablecer el select de país para que se dispare el evento
            const initialCountry = "{{ old('pais_origen', $proveedor->pais_origen) }}";
            if (initialCountry) {
                const selectedOption = paisOrigenSelect.querySelector(`option[value="${initialCountry}"]`);
                if (selectedOption) {
                    selectedOption.selected = true;
                }
            }

            // Disparar el cambio de país al cargar para inicializar el prefijo de teléfono
            if (paisOrigenSelect.value) {
                paisOrigenSelect.dispatchEvent(new Event('change'));
            }

            // Evento change para el selector de país para actualizar el código telefónico
            paisOrigenSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const phoneCode = selectedOption ? selectedOption.getAttribute('data-phone-code') : '';

                const updatePhoneNumberField = (inputElement, code) => {
                    let currentValue = inputElement.value.trim();
                    // Si el valor actual es solo un signo '+' o vacío, o no empieza con el nuevo código, se actualiza
                    if (!currentValue || currentValue === '+' || !currentValue.startsWith(code)) {
                        inputElement.value = code;
                    }
                    // Asegurarse de que el cursor esté al final del código
                    if (inputElement.value) {
                        inputElement.setSelectionRange(inputElement.value.length, inputElement.value.length);
                    }
                };

                updatePhoneNumberField(telefonoContactoInput, phoneCode);
                updatePhoneNumberField(telefonoContactoSecundarioInput, phoneCode);
                // Disparar evento input para que la validación en tiempo real de formato de teléfono se actualice
                telefonoContactoInput.dispatchEvent(new Event('input'));
                telefonoContactoSecundarioInput.dispatchEvent(new Event('input'));
            });

            // --- PREVENCIÓN DE ENTRADA EN TIEMPO REAL ---

            // Función para eliminar espacios en blanco al inicio
            function trimWhitespace(inputElement) {
                if (inputElement.value.startsWith(' ')) {
                    inputElement.value = inputElement.value.trimStart();
                }
            }
            // Aplicar la función a los campos deseados
            nombreEmpresaInput.addEventListener('input', () => trimWhitespace(nombreEmpresaInput));
            personaContactoInput.addEventListener('input', () => trimWhitespace(personaContactoInput));
            correoInput.addEventListener('input', () => trimWhitespace(correoInput));
            direccionTextarea.addEventListener('input', () => trimWhitespace(direccionTextarea));
            personaContactoSecundariaInput.addEventListener('input', () => trimWhitespace(personaContactoSecundariaInput));

            // Nombre de Empresa: Limitar a 30 caracteres.
            nombreEmpresaInput.addEventListener('input', function() {
                if (this.value.length > 30) {
                    this.value = this.value.substring(0, 30);
                }
            });

            // Persona de Contacto: Solo letras, espacios, y tildes/ñ, hasta 32 caracteres.
            const regexSoloLetrasEspacios = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/;
            function restrictToLettersAndSpaces(inputElement, maxLength) {
                inputElement.addEventListener('input', function() {
                    let value = this.value;
                    const originalSelectionStart = this.selectionStart;
                    const originalSelectionEnd = this.selectionEnd;

                    let filteredValue = value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                    if (filteredValue.length > maxLength) {
                        filteredValue = filteredValue.substring(0, maxLength);
                    }

                    if (this.value !== filteredValue) {
                        this.value = filteredValue;
                        this.setSelectionRange(originalSelectionStart - (value.length - filteredValue.length), originalSelectionEnd - (value.length - filteredValue.length));
                    }
                });
            }
            restrictToLettersAndSpaces(personaContactoInput, 32);
            restrictToLettersAndSpaces(personaContactoSecundariaInput, 32);


            // Teléfono: Solo números y un '+' inicial. Máx 12 caracteres.
            const restrictPhoneInput = (inputElement) => {
                inputElement.addEventListener('input', function (e) {
                    let value = e.target.value;
                    let startWithPlus = value.startsWith('+');

                    value = value.replace(/[^\d+]/g, '');
                    if (startWithPlus && value[0] !== '+') {
                        value = '+' + value;
                    } else if (!startWithPlus && value.startsWith('+')) {
                        value = value.substring(1);
                    }

                    if (value.length > 12) {
                        value = value.substring(0, 12);
                    }
                    e.target.value = value;
                });
            };
            restrictPhoneInput(telefonoContactoInput);
            restrictPhoneInput(telefonoContactoSecundarioInput);


            // Correo: Limitar a 30 caracteres.
            correoInput.addEventListener('input', function() {
                if (this.value.length > 30) {
                    this.value = this.value.substring(0, 30);
                }
            });

            // Dirección: Limitar a 150 caracteres.
            direccionTextarea.addEventListener('input', function() {
                if (this.value.length > 150) {
                    this.value = this.value.substring(0, 150);
                }
            });


            // --- VALIDACIÓN EN EL ENVÍO DEL FORMULARIO ---

            form.addEventListener('submit', function(event) {
                let formIsValid = true;

                // Limpiar mensajes de error previos
                document.querySelectorAll('.is-invalid').forEach(element => {
                    element.classList.remove('is-invalid');
                });
                document.querySelectorAll('.invalid-feedback').forEach(element => {
                    if (!element.dataset.laravelError) {
                        element.style.display = 'none';
                        element.textContent = '';
                    }
                });
                $('.is-invalid-select2').removeClass('is-invalid-select2');


                // Validar Nombre de Empresa
                if (nombreEmpresaInput.value.trim() === '') {
                    nombreEmpresaInput.classList.add('is-invalid');
                    document.getElementById('nombre_empresa-feedback').textContent = 'Este campo es obligatorio.';
                    document.getElementById('nombre_empresa-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Validar País de Origen
                if (paisOrigenSelect.value === "") {
                    paisOrigenSelect.classList.add('is-invalid');
                    document.getElementById('pais_origen-feedback').textContent = 'Por favor, seleccione el país de origen.';
                    document.getElementById('pais_origen-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Validar Persona de Contacto
                const personaContacto = personaContactoInput.value.trim();
                if (personaContacto === '') {
                    personaContactoInput.classList.add('is-invalid');
                    document.getElementById('persona_contacto-feedback').textContent = 'Este campo es obligatorio.';
                    document.getElementById('persona_contacto-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (!regexSoloLetrasEspacios.test(personaContacto)) {
                    personaContactoInput.classList.add('is-invalid');
                    document.getElementById('persona_contacto-feedback').textContent = 'Solo se permiten letras y espacios.';
                    document.getElementById('persona_contacto-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Validar Correo
                const correo = correoInput.value.trim();
                const regexCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (correo === '') {
                    correoInput.classList.add('is-invalid');
                    document.getElementById('correo_electronico-feedback').textContent = 'Este campo es obligatorio.';
                    document.getElementById('correo_electronico-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (!regexCorreo.test(correo)) {
                    correoInput.classList.add('is-invalid');
                    document.getElementById('correo_electronico-feedback').textContent = 'Ingrese un correo electrónico válido.';
                    document.getElementById('correo_electronico-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (correo.length > 30) {
                    correoInput.classList.add('is-invalid');
                    document.getElementById('correo_electronico-feedback').textContent = 'El correo no debe exceder los 30 caracteres.';
                    document.getElementById('correo_electronico-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Validar Teléfono de Contacto Principal
                const telefonoContacto = telefonoContactoInput.value.trim();
                const regexTelefonoFull = /^\+\d{7,11}$/;
                if (telefonoContacto === '') {
                    telefonoContactoInput.classList.add('is-invalid');
                    document.getElementById('telefono_contacto-feedback').textContent = 'Este campo es obligatorio.';
                    document.getElementById('telefono_contacto-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (!regexTelefonoFull.test(telefonoContacto)) {
                    telefonoContactoInput.classList.add('is-invalid');
                    document.getElementById('telefono_contacto-feedback').textContent = 'El teléfono debe incluir el código de país (ej. +504) y tener entre 8 y 12 caracteres (incluyendo el +).';
                    document.getElementById('telefono_contacto-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Validar Dirección
                if (direccionTextarea.value.trim() === '') {
                    direccionTextarea.classList.add('is-invalid');
                    document.getElementById('direccion-feedback').textContent = 'Este campo es obligatorio.';
                    document.getElementById('direccion-feedback').style.display = 'block';
                    formIsValid = false;
                } else if (direccionTextarea.value.length > 150) {
                    direccionTextarea.classList.add('is-invalid');
                    document.getElementById('direccion-feedback').textContent = 'La dirección no debe exceder los 150 caracteres.';
                    document.getElementById('direccion-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Validar Marcas que maneja (Select2)
                const selectedMarcas = $(marcasSelect).val();
                if (!selectedMarcas || selectedMarcas.length === 0) {
                    $(marcasSelect).next('.select2-container').find('.select2-selection').addClass('is-invalid-select2');
                    document.getElementById('marcas-feedback').textContent = 'Por favor, seleccione al menos una marca.';
                    document.getElementById('marcas-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Validar Tipo de Autopartes (Select2)
                const selectedTipoAutopartes = $(tipoAutopartesSelect).val();
                if (!selectedTipoAutopartes || selectedTipoAutopartes.length === 0) {
                    $(tipoAutopartesSelect).next('.select2-container').find('.select2-selection').addClass('is-invalid-select2');
                    document.getElementById('tipo_autopartes-feedback').textContent = 'Por favor, seleccione al menos un tipo de autoparte.';
                    document.getElementById('tipo_autopartes-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Validar Persona de Contacto Secundaria (Opcional, pero si se llena, validar formato y longitud)
                const personaContactoSecundaria = personaContactoSecundariaInput.value.trim();
                if (personaContactoSecundaria.length > 0 && (!regexSoloLetrasEspacios.test(personaContactoSecundaria) || personaContactoSecundaria.length > 32)) {
                    personaContactoSecundariaInput.classList.add('is-invalid');
                    document.getElementById('persona_contacto_secundaria-feedback').textContent = 'Solo se permiten letras y espacios, máximo 32 caracteres.';
                    document.getElementById('persona_contacto_secundaria-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Validar Teléfono de Contacto Secundario (Opcional, pero si se llena, validar formato y longitud)
                const telefonoContactoSecundario = telefonoContactoSecundarioInput.value.trim();
                if (telefonoContactoSecundario.length > 0 && (!regexTelefonoFull.test(telefonoContactoSecundario) || telefonoContactoSecundario.length < 8 || telefonoContactoSecundario.length > 12)) {
                    telefonoContactoSecundarioInput.classList.add('is-invalid');
                    document.getElementById('telefono_contacto_secundario-feedback').textContent = 'El teléfono debe incluir el código de país (ej. +504) y tener entre 8 y 12 caracteres (incluyendo el +).';
                    document.getElementById('telefono_contacto_secundario-feedback').style.display = 'block';
                    formIsValid = false;
                }

                if (!formIsValid) {
                    event.preventDefault(); // Detener el envío si hay errores de JS
                }
            });

            // --- MANEJO DE ERRORES DE LARAVEL AL CARGAR LA PÁGINA ---
            document.querySelectorAll('.form-control.is-invalid, textarea.is-invalid, .form-select.is-invalid').forEach(function(element) {
                let feedbackElement;
                if (element.id && document.getElementById(element.id + '-feedback')) {
                    feedbackElement = document.getElementById(element.id + '-feedback');
                } else if (element.tagName === 'SELECT') {
                    $(element).next('.select2-container').find('.select2-selection').addClass('is-invalid-select2');
                    feedbackElement = document.getElementById(element.id + '-feedback');
                } else {
                    feedbackElement = element.nextElementSibling;
                }

                if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                    feedbackElement.style.display = 'block';
                    feedbackElement.setAttribute('data-laravel-error', 'true');
                }
            });

            // --- LISTENER GENERAL PARA LIMPIAR VALIDACIÓN CUANDO EL USUARIO CORRIGE ---
            document.querySelectorAll('.form-control, textarea').forEach(input => {
                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid')) {
                        let shouldClear = true;
                        if (this.hasAttribute('required') && this.value.trim().length === 0) {
                            shouldClear = false;
                        } else if (this.id === 'nombre_empresa' && this.value.length > 30) {
                            shouldClear = false;
                        } else if (this.id === 'persona_contacto' || this.id === 'persona_contacto_secundaria') {
                            if (!regexSoloLetrasEspacios.test(this.value) || this.value.length > 32) shouldClear = false;
                        } else if (this.id === 'telefono_contacto' || this.id === 'telefono_contacto_secundario') {
                            const regexTelefonoFullCheck = /^\+\d{7,11}$/;
                            if (this.value.trim().length > 0 && (!regexTelefonoFullCheck.test(this.value.trim()) || this.value.length < 8 || this.value.length > 12)) shouldClear = false;
                        } else if (this.id === 'correo_electronico') {
                            const regexCorreoCheck = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                            if (!regexCorreoCheck.test(this.value.trim()) || this.value.length > 30) shouldClear = false;
                        } else if (this.id === 'direccion') {
                            if (this.value.length > 150) shouldClear = false;
                        }

                        if (shouldClear) {
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback');
                            if (feedbackElement) {
                                feedbackElement.style.display = 'none';
                                feedbackElement.removeAttribute('data-laravel-error');
                            }
                        }
                    }
                });
            });

            // Listener para select/Select2 para limpiar validación
            $('#pais_origen, #marcas, #tipo_autopartes').on('change', function() {
                if (this.classList.contains('is-invalid')) {
                    this.classList.remove('is-invalid');
                    const feedbackElement = document.getElementById(this.id + '-feedback');
                    if (feedbackElement) {
                        feedbackElement.style.display = 'none';
                        feedbackElement.removeAttribute('data-laravel-error');
                    }
                }
                const select2Container = $(this).data('select2') ? $(this).next('.select2-container').find('.select2-selection') : null;
                if (select2Container && select2Container.hasClass('is-invalid-select2')) {
                    select2Container.removeClass('is-invalid-select2');
                    const feedbackElement = document.getElementById(this.id + '-feedback');
                    if (feedbackElement) {
                        feedbackElement.style.display = 'none';
                        feedbackElement.removeAttribute('data-laravel-error');
                    }
                }
            });
        });
    </script>
@endsection