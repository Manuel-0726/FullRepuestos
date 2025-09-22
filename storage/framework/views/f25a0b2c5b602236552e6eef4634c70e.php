
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Empleado</title> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="form-container">
        <h2 class="mb-4">Editar Empleado</h2> 

        
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

        <form id="empleadoForm" action="<?php echo e(route('empleados.update', $empleado->id)); ?>" method="POST" novalidate>
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nombre', $empleado->nombre)); ?>" required maxlength="30">
                    <div class="invalid-feedback" id="nombre-feedback">
                        <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                        <?php else: ?>
                            El nombre es requerido y solo puede contener letras, espacios y guiones.
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" class="form-control <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('apellido', $empleado->apellido)); ?>" required maxlength="30">
                    <div class="invalid-feedback" id="apellido-feedback">
                        <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                        <?php else: ?>
                            El apellido es requerido y solo puede contener letras, espacios y guiones.
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="correo">Correo:</label>
                    <input type="email" name="correo" id="correo" class="form-control <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('correo', $empleado->correo)); ?>" required maxlength="30">
                    <div class="invalid-feedback" id="correo-feedback">
                        <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                        <?php else: ?>
                            Ingrese un correo válido (ej. usuario@dominio.com) con máximo 30 caracteres.
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" class="form-control <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('telefono', $empleado->telefono)); ?>" maxlength="8">
                    <div class="invalid-feedback" id="telefono-feedback">
                        <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                        <?php else: ?>
                            El teléfono debe tener 8 dígitos y empezar con 2, 3, 8 o 9.
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <textarea class="form-control <?php $__errorArgs = ['direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="direccion" name="direccion" required maxlength="100" rows="3"><?php echo e(old('direccion', $empleado->direccion)); ?></textarea>
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

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="identidad">Identidad:</label>
                    <input type="text" name="identidad" id="identidad" class="form-control <?php $__errorArgs = ['identidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('identidad', $empleado->identidad)); ?>" required maxlength="15" title="Debe ingresar 13 dígitos numéricos en formato ####-####-#####">
                    <div class="invalid-feedback" id="identidad-feedback">
                        <?php $__errorArgs = ['identidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                        <?php else: ?>
                            Número de identidad inválido (debe ser ####-####-#####).
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-md-6">
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
                        <?php $__currentLoopData = ['Vendedor', 'Cajero', 'Motorista', 'Gerente', 'Contador', 'Aseador']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $puesto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($puesto); ?>" <?php echo e(old('puesto', $empleado->puesto) == $puesto ? 'selected' : ''); ?>><?php echo e($puesto); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
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
                        <?php $__currentLoopData = ['Masculino', 'Femenino', 'Otro']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sexo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sexo); ?>" <?php echo e(old('sexo', $empleado->sexo) == $sexo ? 'selected' : ''); ?>><?php echo e($sexo); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <div class="col-md-6">
                    <label class="form-label" for="salario">Salario:</label>
                    <input type="number" step="0.01" name="salario" id="salario" class="form-control <?php $__errorArgs = ['salario'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('salario', $empleado->salario)); ?>" required min="0">
                    <div class="invalid-feedback" id="salario-feedback">
                        <?php $__errorArgs = ['salario'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                        <?php else: ?>
                            El salario debe ser un número positivo con un máximo de 5 cifras enteras.
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="fecha_contratacion">Fecha de Contratación:</label>
                <input type="date" name="fecha_contratacion" id="fecha_contratacion" class="form-control <?php $__errorArgs = ['fecha_contratacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('fecha_contratacion', $empleado->fecha_contratacion)); ?>" required>
                <div class="invalid-feedback" id="fecha_contratacion-feedback">
                    <?php $__errorArgs = ['fecha_contratacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <?php echo e($message); ?>

                    <?php else: ?>
                        La fecha de contratación es requerida y no puede ser anterior al 1 de enero de 2000 ni una fecha futura.
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            
            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select class="form-control <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="estado" name="estado" required>
                    <option value="Activo" <?php echo e(old('estado', $empleado->estado) == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                    <option value="Inactivo" <?php echo e(old('estado', $empleado->estado) == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                </select>
                <div class="invalid-feedback">
                    <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <?php echo e($message); ?>

                    <?php else: ?>
                        Por favor, seleccione el estado.
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="d-flex justify-content-start gap-2"> 
                <button type="submit" class="btn btn-danger">Actualizar</button>
                <button type="reset" class="btn btn-danger">Restablecer</button>
                <a href="<?php echo e(route('empleados.index')); ?>" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('empleadoForm');
            const nombreInput = document.getElementById('nombre');
            const apellidoInput = document.getElementById('apellido');
            const salarioInput = document.getElementById('salario');
            const telefonoInput = document.getElementById('telefono');
            const correoInput = document.getElementById('correo');
            const fechaContratacionInput = document.getElementById('fecha_contratacion');
            const identidadInput = document.getElementById('identidad'); // Added for direct access
            const direccionInput = document.getElementById('direccion'); // Added for direct access
            const sexoInput = document.getElementById('sexo');
            const puestoInput = document.getElementById('puesto');
            const estadoInput = document.getElementById('estado');

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
                    document.getElementById('correo-feedback').textContent = '';
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
                if (!sexoInput.value) {
                    sexoInput.classList.add('is-invalid');
                    sexoInput.nextElementSibling.style.display = 'block'; // Mostrar el feedback por defecto de Bootstrap
                    formIsValid = false;
                }

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

                // Validación para Estado
                if (!estadoInput.value) {
                    estadoInput.classList.add('is-invalid');
                    estadoInput.nextElementSibling.style.display = 'block'; // Mostrar el mensaje de feedback predeterminado
                    formIsValid = false;
                }

                if (!formIsValid) {
                    event.preventDefault(); // Evitar que el formulario se envíe si hay errores
                    // No es necesario stopPropagation() si ya se previene el default.
                }
            });

            // --- Listener general para limpiar validación cuando el usuario corrige la entrada ---
            document.querySelectorAll('.form-control').forEach(input => {
                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid')) {
                        // Lógica específica para identidad, teléfono, correo, salario, fecha de contratación
                        if (this.id === 'identidad') {
                            const identidadVal = this.value.trim();
                            const soloDigitos = identidadVal.replace(/-/g, '');
                            // Limpiar solo si el formato es correcto Y la regla de los dos primeros dígitos se cumple
                            if (soloDigitos.length === 13 && parseInt(soloDigitos.substring(0, 2), 10) <= 18) {
                                this.classList.remove('is-invalid');
                                const feedbackElement = document.getElementById(this.id + '-feedback');
                                if (feedbackElement) {
                                    feedbackElement.style.display = 'none';
                                    feedbackElement.removeAttribute('data-laravel-error');
                                }
                            } else { return; } // Mantener error si el formato o la regla de los 2 dígitos es incorrecta
                        } else if (this.id === 'telefono') {
                            const regexTelefonoInicio = /^[2389]\d{7}$/;
                            if (regexTelefonoInicio.test(this.value.trim())) {
                                this.classList.remove('is-invalid');
                                const feedbackElement = document.getElementById(this.id + '-feedback');
                                if (feedbackElement) {
                                    feedbackElement.style.display = 'none';
                                    feedbackElement.removeAttribute('data-laravel-error');
                                }
                            } else { return; } // Mantener error si el formato es incorrecto
                        } else if (this.id === 'correo') {
                            const regexCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                            if (regexCorreo.test(this.value.trim()) && this.value.trim().length <= 30) {
                                this.classList.remove('is-invalid');
                                const feedbackElement = document.getElementById(this.id + '-feedback');
                                if (feedbackElement) {
                                    feedbackElement.style.display = 'none';
                                    feedbackElement.removeAttribute('data-laravel-error');
                                }
                            } else { return; } // Mantener error si el formato es incorrecto
                        } else if (this.id === 'salario') {
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
                            } else { return; }
                        } else if (this.id === 'fecha_contratacion') {
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
                            } else { return; }
                        }
                        else if (this.value.trim().length > 0) { // Para campos de texto/área de texto genéricos
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback');
                            if (feedbackElement) {
                                feedbackElement.style.display = 'none';
                                feedbackElement.removeAttribute('data-laravel-error');
                            }
                        }
                    }
                });
                // Para los selects, usar el evento 'change'
                if (input.tagName === 'SELECT') {
                    input.addEventListener('change', function() {
                        if (this.classList.contains('is-invalid') && this.value !== '') {
                            this.classList.remove('is-invalid');
                            const feedbackElement = this.nextElementSibling; // Obtener el siguiente hermano (invalid-feedback)
                            if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                                feedbackElement.style.display = 'none';
                                feedbackElement.removeAttribute('data-laravel-error');
                            }
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/empleados/editar.blade.php ENDPATH**/ ?>