
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Registrar empleado</title> 
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="form-container">
                <h2 class="mb-4">Registrar un empleado</h2> 

                
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form id="formEmpleado" action="<?php echo e(route('empleados.store')); ?>" method="POST" novalidate>
                    <?php echo csrf_field(); ?>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="nombre" name="nombre" value="<?php echo e(old('nombre')); ?>" required maxlength="30" />
                            <div class="invalid-feedback" id="nombre-feedback">
                                <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                <?php else: ?>
                                    El nombre es requerido.
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="apellido" name="apellido" value="<?php echo e(old('apellido')); ?>" required maxlength="30" />
                            <div class="invalid-feedback" id="apellido-feedback">
                                <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                <?php else: ?>
                                    El apellido es requerido.
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="correo" class="form-label">Correo:</label>
                            <input type="email" class="form-control <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="correo" name="correo" value="<?php echo e(old('correo')); ?>" required maxlength="30" />
                            <div class="invalid-feedback" id="correo-feedback">
                                <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                <?php else: ?>
                                    El correo es requerido.
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="telefono" name="telefono" value="<?php echo e(old('telefono')); ?>" maxlength="8" />
                            <div class="invalid-feedback" id="telefono-feedback">
                                <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                <?php else: ?>
                                    El teléfono es requerido.
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="identidad" class="form-label">Identidad</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text"><i class="bi bi-credit-card-2-front-fill"></i></span>
                                <input type="text" id="identidad" name="identidad" maxlength="15"
                                       value="<?php echo e(old('identidad')); ?>"
                                       class="form-control <?php $__errorArgs = ['identidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       oninput="formatearIdentidad(this)" />
                                <?php $__errorArgs = ['identidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div id="errorIdentidad" class="invalid-feedback"></div>
                            </div>
                        </div>



                        <div class="mb-3 col-md-6">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <textarea class="form-control <?php $__errorArgs = ['direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="direccion" name="direccion" required maxlength="100" rows="3"><?php echo e(old('direccion')); ?></textarea>
                            <div class="invalid-feedback" id="direccion-feedback">
                                <?php $__errorArgs = ['direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                <?php else: ?>
                                    La dirección es requerida.
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="sexo" class="form-label">Sexo:</label>
                            <select class="form-control <?php $__errorArgs = ['sexo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="sexo" name="sexo" required>
                                <option value="">Seleccione...</option>
                                <option value="Masculino" <?php echo e(old('sexo') == 'Masculino' ? 'selected' : ''); ?>>Masculino</option>
                                <option value="Femenino" <?php echo e(old('sexo') == 'Femenino' ? 'selected' : ''); ?>>Femenino</option>
                                <option value="Otro" <?php echo e(old('sexo') == 'Otro' ? 'selected' : ''); ?>>Otro</option>
                            </select>
                            <div class="invalid-feedback">
                                <?php $__errorArgs = ['sexo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                <?php else: ?>
                                    Por favor, seleccione una opción.
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="puesto" class="form-label">Puesto:</label>
                            <select class="form-control <?php $__errorArgs = ['puesto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="puesto" name="puesto" required>
                                <option value="">Seleccione...</option>
                                <option value="Vendedor" <?php echo e(old('puesto') == 'Vendedor' ? 'selected' : ''); ?>>Vendedor</option>
                                <option value="Cajero" <?php echo e(old('puesto') == 'Cajero' ? 'selected' : ''); ?>>Cajero</option>
                                <option value="Motorista" <?php echo e(old('puesto') == 'Motorista' ? 'selected' : ''); ?>>Motorista</option>
                                <option value="Gerente" <?php echo e(old('puesto') == 'Gerente' ? 'selected' : ''); ?>>Gerente</option>
                                <option value="Contador" <?php echo e(old('puesto') == 'Contador' ? 'selected' : ''); ?>>Contador</option>
                                <option value="Aseador" <?php echo e(old('puesto') == 'Aseador' ? 'selected' : ''); ?>>Aseador</option>
                            </select>
                            <div class="invalid-feedback">
                                <?php $__errorArgs = ['puesto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                <?php else: ?>
                                    Por favor, seleccione una opción.
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="salario" class="form-label">Salario:</label>
                            <input type="number" class="form-control <?php $__errorArgs = ['salario'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="salario" name="salario" value="<?php echo e(old('salario')); ?>" step="0.01" required min="0" />
                            <div class="invalid-feedback" id="salario-feedback">
                                <?php $__errorArgs = ['salario'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                <?php else: ?>
                                    El salario es requerido, debe ser un número positivo y con un máximo de 5 cifras enteras.
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="fecha_contratacion" class="form-label">Fecha de Contratación:</label>
                            <input type="date" class="form-control <?php $__errorArgs = ['fecha_contratacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="fecha_contratacion" name="fecha_contratacion" value="<?php echo e(old('fecha_contratacion')); ?>" required />
                            <div class="invalid-feedback" id="fecha_contratacion-feedback">
                                <?php $__errorArgs = ['fecha_contratacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                <?php else: ?>
                                    La fecha de contratación es requerida.
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger">Guardar</button>
                    <button type="button" class="btn btn-danger" id="limpiarFormulario">Limpiar</button>
                    <a href="<?php echo e(route('empleados.index')); ?>" class="btn btn-danger">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>




document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formEmpleado');
    const nombreInput = document.getElementById('nombre');
    const apellidoInput = document.getElementById('apellido');
    const salarioInput = document.getElementById('salario');
    const telefonoInput = document.getElementById('telefono');
    const correoInput = document.getElementById('correo');
    const fechaContratacionInput = document.getElementById('fecha_contratacion');
    const identidadInput = document.getElementById('identidad'); // Added for direct access
    const direccionInput = document.getElementById('direccion'); // Added for direct access

    function formatearIdentidad(input) {
        // Eliminar todo lo que no sea dígito
        let valor = input.value.replace(/\D/g, '');

        // Insertar guiones automáticamente en posiciones 4 y 8
        if (valor.length > 4) valor = valor.slice(0, 4) + '-' + valor.slice(4);
        if (valor.length > 9) valor = valor.slice(0, 9) + '-' + valor.slice(9);

        // Limitar a 15 caracteres con formato
        if (valor.length > 15) valor = valor.slice(0, 15);

        input.value = valor;

        // Validaciones
        const errorDiv = document.getElementById("errorIdentidad");
        errorDiv.innerText = "";

        // Si ya tiene los 15 caracteres, validar estructura
        if (valor.length === 15) {
            const partes = valor.split("-");
            const depto = parseInt(partes[0].substring(0, 2));
            const muni  = parseInt(partes[0].substring(2, 4));
            const anio  = parseInt(partes[1]);

            const anioActual = new Date().getFullYear();

            if (depto < 1 || depto > 18) {
                errorDiv.innerText = "Departamento inválido (01-18).";
            } else if (muni < 1 || muni > 28) {
                errorDiv.innerText = "Municipio inválido (01-28).";
            } else if (anio > anioActual) {
                errorDiv.innerText = "El año no puede ser mayor a " + anioActual + ".";
            }
        }
    }


    // --- Listeners de PREVENCIÓN de entrada en tiempo real ---

    // Nombre y Apellido: Solo letras, espacios, guiones y tildes/ñ
    const regexSoloLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/;

    function enforceLettersOnly(event) {
        let value = event.target.value;
        const originalSelectionStart = event.target.selectionStart;
        const originalSelectionEnd = event.target.selectionEnd;

        // Filtra los caracteres no permitidos
        const filteredValue = value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]/g, '');

        if (value !== filteredValue) {
            event.target.value = filteredValue;

            // Ajusta la posición del cursor si los caracteres fueron eliminados
            if (originalSelectionStart === originalSelectionEnd) {
                event.target.setSelectionRange(originalSelectionStart - (value.length - filteredValue.length), originalSelectionEnd - (value.length - filteredValue.length));
            } else {
                event.target.setSelectionRange(originalSelectionStart, originalSelectionEnd - (value.length - filteredValue.length));
            }
        }
    }

    nombreInput.addEventListener('input', enforceLettersOnly);
    apellidoInput.addEventListener('input', enforceLettersOnly);


    // Salario: Limita la entrada en tiempo real a 5 dígitos enteros
    salarioInput.addEventListener('input', function(e) {
        let value = e.target.value;
        const parts = value.split('.');
        let integerPart = parts[0];
        let decimalPart = parts[1];

        // Limitar la parte entera a 5 dígitos
        if (integerPart.length > 5) {
            integerPart = integerPart.substring(0, 5);
        }

        // Reconstruir el valor
        if (decimalPart !== undefined) {
            e.target.value = integerPart + '.' + decimalPart;
        } else {
            e.target.value = integerPart;
        }

        // Asegurarse de que no haya ceros iniciales si no es '0'
        if (e.target.value.length > 1 && e.target.value[0] === '0' && e.target.value[1] !== '.') {
            e.target.value = e.target.value.substring(1);
        }
    });

    // Teléfono: Limitar a 8 dígitos y solo números (ya estaba, mantenido)
    telefonoInput.addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/\D/g, '').substring(0, 8);
    });

    // Identidad: Formateo automático (ya estaba, mantenido)
    identidadInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Remover todo lo que no sea dígito
        let formattedValue = '';
        if (value.length > 0) {
            formattedValue += value.substring(0, Math.min(value.length, 4));
            if (value.length > 4) {
                formattedValue += '-' + value.substring(4, Math.min(value.length, 8));
            }
            if (value.length > 8) {
                formattedValue += '-' + value.substring(8, Math.min(value.length, 13));
            }
        }
        e.target.value = formattedValue;
    });


    // --- Listener para el SUBMIT del formulario (Validaciones al enviar) ---

    form.addEventListener('submit', function(event) {
        let formIsValid = true;

        // Limpiar mensajes de error previos del cliente
        document.querySelectorAll('.is-invalid').forEach(element => {
            element.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback').forEach(element => {
            // Solo ocultar si no es un mensaje de error de Laravel
            if (element.textContent.trim().length > 0 && !element.dataset.laravelError) {
                element.style.display = 'none';
            }
        });

        // Validaciones para Nombre
        const nombre = nombreInput.value.trim();
        if (nombre.length === 0) {
            nombreInput.classList.add('is-invalid');
            document.getElementById('nombre-feedback').textContent = 'El nombre es requerido.';
            document.getElementById('nombre-feedback').style.display = 'block';
            formIsValid = false;
        } else if (!regexSoloLetras.test(nombre)) { // Aunque se previene la entrada, esto es un fallback de seguridad
            nombreInput.classList.add('is-invalid');
            document.getElementById('nombre-feedback').textContent = 'No se permiten números ni caracteres especiales.';
            document.getElementById('nombre-feedback').style.display = 'block';
            formIsValid = false;
        }

        // Validaciones para Apellido
        const apellido = apellidoInput.value.trim();
        if (apellido.length === 0) {
            apellidoInput.classList.add('is-invalid');
            document.getElementById('apellido-feedback').textContent = 'El apellido es requerido.';
            document.getElementById('apellido-feedback').style.display = 'block';
            formIsValid = false;
        } else if (!regexSoloLetras.test(apellido)) { // Fallback de seguridad
            apellidoInput.classList.add('is-invalid');
            document.getElementById('apellido-feedback').textContent = 'No se permiten números ni caracteres especiales.';
            document.getElementById('apellido-feedback').style.display = 'block';
            formIsValid = false;
        }

        // Validaciones para Correo Electrónico
        const correo = correoInput.value.trim();
        const regexCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (correo.length === 0) {
            correoInput.classList.add('is-invalid');
            document.getElementById('correo-feedback').textContent = 'El correo es requerido.';
            document.getElementById('correo-feedback').style.display = 'block';
            formIsValid = false;
        } else if (!regexCorreo.test(correo) || correo.length > 30) {
            correoInput.classList.add('is-invalid');
            document.getElementById('correo-feedback').textContent = 'Ingrese un correo válido (ej. usuario@dominio.com).';
            document.getElementById('correo-feedback').style.display = 'block';
            formIsValid = false;
        }


        // Validaciones para Teléfono
        const telefono = telefonoInput.value.trim();
        const regexTelefonoInicio = /^[2389]\d{7}$/;

        if (telefono.length === 0) {
            telefonoInput.classList.add('is-invalid');
            document.getElementById('telefono-feedback').textContent = 'El teléfono es requerido.';
            document.getElementById('telefono-feedback').style.display = 'block';
            formIsValid = false;
        } else if (!regexTelefonoInicio.test(telefono)) {
            telefonoInput.classList.add('is-invalid');
            document.getElementById('telefono-feedback').textContent = 'El teléfono debe tener 8 dígitos y comenzar con 2, 3, 8 o 9.';
            document.getElementById('telefono-feedback').style.display = 'block';
            formIsValid = false;
        }

        // Validación de Identidad (####-####-##### y los dos primeros dígitos no mayores a 18)
        const identidad = identidadInput.value.trim();
        const identidadFeedback = document.getElementById('identidad-feedback');
        const regexIdentidad = /^\d{4}-\d{4}-\d{5}$/;

        if (identidad.length === 0) {
            identidadInput.classList.add('is-invalid');
            identidadFeedback.textContent = 'El número de identidad es requerido.';
            identidadFeedback.style.display = 'block';
            formIsValid = false;
        } else if (!regexIdentidad.test(identidad)) {
            identidadInput.classList.add('is-invalid');
            identidadFeedback.textContent = 'Debe ingresar 13 dígitos numéricos en formato ####-####-#####.';
            identidadFeedback.style.display = 'block';
            formIsValid = false;
        } else {
            // Extraer los primeros dos dígitos (ignorando guiones)
            const soloDigitosIdentidad = identidad.replace(/-/g, '');
            if (soloDigitosIdentidad.length >= 2) {
                const primerosDosNumeros = parseInt(soloDigitosIdentidad.substring(0, 2), 10);
                if (primerosDosNumeros > 18) {
                    identidadInput.classList.add('is-invalid');
                    identidadFeedback.textContent = 'Los dos primeros números de la identidad no pueden ser mayores que 18.';
                    identidadFeedback.style.display = 'block';
                    formIsValid = false;
                }
            }
        }

        // Validación de Dirección (textarea)
        const direccion = direccionInput.value.trim();

        if (direccion.length === 0) {
            direccionInput.classList.add('is-invalid');
            document.getElementById('direccion-feedback').textContent = 'La dirección es requerida.';
            document.getElementById('direccion-feedback').style.display = 'block';
            formIsValid = false;
        } else if (direccion.length > 100) {
            direccionInput.classList.add('is-invalid');
            document.getElementById('direccion-feedback').textContent = 'La dirección no puede exceder los 100 caracteres.';
            document.getElementById('direccion-feedback').style.display = 'block';
            formIsValid = false;
        }

        // Validaciones para select (Sexo y Puesto)
        const sexoInput = document.getElementById('sexo');
        if (!sexoInput.value) {
            sexoInput.classList.add('is-invalid');
            sexoInput.nextElementSibling.style.display = 'block'; // Mostrar el feedback por defecto de Bootstrap
            formIsValid = false;
        }

        const puestoInput = document.getElementById('puesto');
        if (!puestoInput.value) {
            puestoInput.classList.add('is-invalid');
            puestoInput.nextElementSibling.style.display = 'block'; // Mostrar el feedback por defecto de Bootstrap
            formIsValid = false;
        }

        // Validaciones para Salario
        const salarioValue = salarioInput.value.trim();
        const salarioFloat = parseFloat(salarioValue);
        const integerPartSalario = salarioValue.includes('.') ? salarioValue.split('.')[0] : salarioValue;

        if (salarioValue.length === 0) {
            salarioInput.classList.add('is-invalid');
            document.getElementById('salario-feedback').textContent = 'El salario es requerido.';
            document.getElementById('salario-feedback').style.display = 'block';
            formIsValid = false;
        } else if (isNaN(salarioFloat) || salarioFloat <= 0 || integerPartSalario.length > 5) {
            salarioInput.classList.add('is-invalid');
            document.getElementById('salario-feedback').textContent = 'El salario debe ser un número positivo con un máximo de 5 cifras enteras.';
            document.getElementById('salario-feedback').style.display = 'block';
            formIsValid = false;
        }

        // Validaciones para Fecha de Contratación
        const fechaSeleccionada = new Date(fechaContratacionInput.value + 'T00:00:00');
        const fechaLimiteInferior = new Date('2000-01-01T00:00:00');
        const fechaActual = new Date();
        fechaActual.setHours(0, 0, 0, 0); // Para comparar solo fechas, ignoramos la hora

        if (fechaContratacionInput.value.length === 0) {
            fechaContratacionInput.classList.add('is-invalid');
            document.getElementById('fecha_contratacion-feedback').textContent = 'La fecha de contratación es requerida.';
            document.getElementById('fecha_contratacion-feedback').style.display = 'block';
            formIsValid = false;
        } else if (fechaSeleccionada < fechaLimiteInferior) {
            fechaContratacionInput.classList.add('is-invalid');
            document.getElementById('fecha_contratacion-feedback').textContent = 'La fecha no puede ser anterior al 1 de enero de 2000.';
            document.getElementById('fecha_contratacion-feedback').style.display = 'block';
            formIsValid = false;
        } else if (fechaSeleccionada > fechaActual) {
            fechaContratacionInput.classList.add('is-invalid');
            document.getElementById('fecha_contratacion-feedback').textContent = 'La fecha no puede ser una fecha futura.';
            document.getElementById('fecha_contratacion-feedback').style.display = 'block';
            formIsValid = false;
        }

        if (!formIsValid) {
            event.preventDefault(); // Evita que el formulario se envíe si hay errores
            // No es necesario stopPropagation() si ya se previene el default.
        } else {
            // Si todas las validaciones JS pasan, el formulario se enviará al backend (Laravel).
            // La validación de unicidad se realizará en el backend.
            // Si deseas un mensaje de éxito con JavaScript antes del envío real, puedes agregarlo aquí.
            // Por ejemplo: alert('Formulario enviado correctamente!');
            // Luego, el formulario se enviará de forma natural.
        }
    });

    // --- Funcionalidad del botón Limpiar ---
    document.getElementById('limpiarFormulario').addEventListener('click', function() {
        form.reset(); // Restablece todos los campos del formulario a sus valores iniciales
        // Limpiar estilos de validación y restablecer mensajes de feedback
        document.querySelectorAll('.is-invalid').forEach(element => {
            element.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback').forEach(element => {
            element.style.display = 'none';
            element.removeAttribute('data-laravel-error'); // Quita el marcador de error de Laravel

            // Restablecer el texto de feedback a su estado inicial
            if (element.id === 'nombre-feedback') {
                element.textContent = 'El nombre es requerido.';
            } else if (element.id === 'apellido-feedback') {
                element.textContent = 'El apellido es requerido.';
            } else if (element.id === 'correo-feedback') {
                element.textContent = 'El correo es requerido.';
            } else if (element.id === 'telefono-feedback') {
                element.textContent = 'El teléfono es requerido.';
            } else if (element.id === 'identidad-feedback') {
                element.textContent = 'El número de identidad es requerido.';
            } else if (element.id === 'salario-feedback') {
                element.textContent = 'El salario es requerido, debe ser un número positivo y con un máximo de 5 cifras enteras.';
            } else if (element.id === 'fecha_contratacion-feedback') {
                element.textContent = 'La fecha de contratación es requerida.';
            } else if (element.id === 'direccion-feedback') {
                element.textContent = 'La dirección es requerida.';
            } else if (element.previousElementSibling && element.previousElementSibling.tagName === 'SELECT') {
                // Para los selects, restablecer el mensaje genérico
                element.textContent = 'Por favor, seleccione una opción.';
            }
        });
    });

    // --- Listener general para limpiar validación cuando el usuario corrige o el campo ya no está vacío ---
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('input', function() {
            // Solo limpiar la clase si el campo ya no está vacío (o si se ha corregido el formato)
            if (this.classList.contains('is-invalid')) {
                // Para inputs de texto, email, number, etc.
                if (this.value.trim().length > 0) {
                    // Lógica específica para identidad si se borran los guiones y se vuelve a escribir correctamente
                    if (this.id === 'identidad') {
                        const identidadVal = this.value.trim();
                        const soloDigitos = identidadVal.replace(/-/g, '');
                        // No limpiar si sigue siendo inválido según la regla de los primeros dos dígitos
                        if (soloDigitos.length === 13 && parseInt(soloDigitos.substring(0, 2), 10) <= 18) {
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback');
                            if (feedbackElement) {
                                feedbackElement.style.display = 'none';
                                feedbackElement.removeAttribute('data-laravel-error');
                            }
                        } else if (soloDigitos.length !== 13 || parseInt(soloDigitos.substring(0, 2), 10) > 18) {
                             // Si todavía es inválido por longitud o los primeros 2 dígitos, no limpiar
                             return;
                        }
                    } else if (this.id === 'telefono') {
                        // Limpiar si el teléfono es válido según la regex JS
                        const regexTelefonoInicio = /^[2389]\d{7}$/;
                        if (regexTelefonoInicio.test(this.value.trim())) {
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback');
                            if (feedbackElement) {
                                feedbackElement.style.display = 'none';
                                feedbackElement.removeAttribute('data-laravel-error');
                            }
                        } else {
                            // Si el formato es incorrecto, no limpiar y mantener el mensaje de error de JS
                            return;
                        }
                    } else if (this.id === 'correo') {
                        // Limpiar si el correo es válido según la regex JS
                        const regexCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                        if (regexCorreo.test(this.value.trim()) && this.value.trim().length <= 30) {
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback');
                            if (feedbackElement) {
                                feedbackElement.style.display = 'none';
                                feedbackElement.removeAttribute('data-laravel-error');
                            }
                        } else {
                            return;
                        }
                    }
                    else if (this.id === 'salario') {
                        const salarioVal = this.value.trim();
                        const salarioFloat = parseFloat(salarioVal);
                        const integerPart = salarioVal.includes('.') ? salarioVal.split('.')[0] : salarioVal;
                        if (!isNaN(salarioFloat) && salarioFloat > 0 && integerPart.length <= 5) {
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback');
                            if (feedbackElement) {
                                feedbackElement.style.display = 'none';
                                feedbackElement.removeAttribute('data-laravel-error');
                            }
                        } else {
                            return;
                        }
                    }
                    else if (this.id === 'fecha_contratacion') {
                        const fechaSel = new Date(this.value + 'T00:00:00');
                        const fechaLimInf = new Date('2000-01-01T00:00:00');
                        const fechaAct = new Date();
                        fechaAct.setHours(0,0,0,0);
                        if (this.value.length > 0 && fechaSel >= fechaLimInf && fechaSel <= fechaAct) {
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback');
                            if (feedbackElement) {
                                feedbackElement.style.display = 'none';
                                feedbackElement.removeAttribute('data-laravel-error');
                            }
                        } else {
                            return;
                        }
                    }
                    else { // Para los campos de texto simples
                        this.classList.remove('is-invalid');
                        const feedbackElement = document.getElementById(this.id + '-feedback');
                        if (feedbackElement) {
                            feedbackElement.style.display = 'none';
                            feedbackElement.removeAttribute('data-laravel-error');
                        }
                    }
                }
            }
        });
        // Para selects, es 'change' en lugar de 'input'
        if (input.tagName === 'SELECT') {
            input.addEventListener('change', function() {
                if (this.classList.contains('is-invalid') && this.value !== '') {
                    this.classList.remove('is-invalid');
                    this.nextElementSibling.style.display = 'none'; // Ocultar el feedback por defecto de Bootstrap
                    this.nextElementSibling.removeAttribute('data-laravel-error');
                }
            });
        }
    });

    // --- Cargar mensajes de error de Laravel al cargar la página ---
    // Esta función se ejecuta solo una vez al cargar el DOM.
    // Itera sobre todos los elementos con la clase 'is-invalid' que Laravel pudo haber añadido
    // y asegura que sus mensajes de feedback se muestren.
    document.querySelectorAll('.form-control.is-invalid, select.is-invalid, textarea.is-invalid').forEach(function(element) {
        let feedbackElement;
        // Para inputs y textareas con ID de feedback específico
        if (element.id && document.getElementById(element.id + '-feedback')) {
            feedbackElement = document.getElementById(element.id + '-feedback');
        } else {
            // Para selects que usan el nextElementSibling como feedback
            feedbackElement = element.nextElementSibling;
        }

        if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
            feedbackElement.style.display = 'block';
            feedbackElement.setAttribute('data-laravel-error', 'true'); // Marca que es un error de Laravel
        }
    });
});
</script>

</body>
</html>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/empleados/create.blade.php ENDPATH**/ ?>