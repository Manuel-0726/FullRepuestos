

<?php $__env->startSection('content'); ?>
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Registrar Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="form-container">
                <h2 class="mb-4 text-white">Registrar un Cliente</h2>

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

                
                <form id="formCliente" action="<?php echo e(route('cliente.store')); ?>" method="POST" novalidate>
                    <?php echo csrf_field(); ?>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="nombre" class="form-label text-white">Nombre:</label>
                            <input type="text" class=" form-control bg-dark text-white <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="nombre" name="nombre" value="<?php echo e(old('nombre')); ?>" required maxlength="30" autocomplete="off" />
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
                            <label for="apellido" class="form-label text-white">Apellido:</label>
                            <input type="text" class="form-control bg-dark text-white <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="apellido" name="apellido" value="<?php echo e(old('apellido')); ?>" required maxlength="30" autocomplete="off" />
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
                            <label for="correo" class="form-label text-white">Correo:</label>
                            <input type="email" class="form-control bg-dark text-white <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="correo" name="correo" value="<?php echo e(old('correo')); ?>" required maxlength="30" autocomplete="off" />
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
                            <label for="telefono" class="form-label text-white">Teléfono:</label>
                            <input type="text" class="form-control bg-dark text-white <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="telefono" name="telefono" value="<?php echo e(old('telefono')); ?>" maxlength="8" autocomplete="off" />
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

                        <div class="mb-3 col-md-6">
                            <label for="identidad" class="form-label text-white">Número de Identidad:</label>
                            <input type="text" class="form-control bg-dark text-white <?php $__errorArgs = ['identidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="identidad" name="identidad" value="<?php echo e(old('identidad')); ?>" maxlength="15" required autocomplete="off"
                                   title="Debe ingresar 13 dígitos numéricos en formato ####-####-#####" />
                            <div class="invalid-feedback" id="identidad-feedback">
                                <?php $__errorArgs = ['identidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <?php echo e($message); ?>

                                <?php else: ?>
                                    El número de identidad es requerido.
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="direccion" class="form-label text-white">Dirección:</label>
                            <textarea class="form-control bg-dark text-white <?php $__errorArgs = ['direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="direccion" name="direccion" required maxlength="100" rows="3" autocomplete="off"><?php echo e(old('direccion')); ?></textarea>
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
                            <label for="sexo" class="form-label text-white">Sexo:</label>
                            <select class="form-control bg-dark text-white <?php $__errorArgs = ['sexo'];
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
                    </div>

                    <button type="submit" class="btn btn-danger">Guardar</button>
                    <button type="button" class="btn btn-danger" id="limpiarFormulario">Limpiar</button>
                    
                    <a href="<?php echo e(route('cliente.index')); ?>" class="btn btn-danger">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() { // Abre DOMContentLoaded
        const form = document.getElementById('formCliente');
        const nombreInput = document.getElementById('nombre');
        const apellidoInput = document.getElementById('apellido');
        const telefonoInput = document.getElementById('telefono');
        const correoInput = document.getElementById('correo');
        const identidadInput = document.getElementById('identidad');
        const direccionInput = document.getElementById('direccion');
        const sexoInput = document.getElementById('sexo');

        // --- Listeners de PREVENCIÓN de entrada en tiempo real ---

        // Nombre y Apellido: Solo letras, espacios, guiones y tildes/ñ
        const regexSoloLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/;

        function enforceLettersOnly(event) {
            let value = event.target.value;
            const originalSelectionStart = event.target.selectionStart;
            const originalSelectionEnd = event.target.selectionEnd;

            const filteredValue = value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]/g, '');

            if (value !== filteredValue) {
                event.target.value = filteredValue;
                if (originalSelectionStart === originalSelectionEnd) {
                    event.target.setSelectionRange(originalSelectionStart - (value.length - filteredValue.length), originalSelectionEnd - (value.length - filteredValue.length));
                } else {
                    event.target.setSelectionRange(originalSelectionStart, originalSelectionEnd - (value.length - filteredValue.length));
                }
            }
        }

        nombreInput.addEventListener('input', enforceLettersOnly);
        apellidoInput.addEventListener('input', enforceLettersOnly);

        // Teléfono: Limitar a 8 dígitos y solo números
        telefonoInput.addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 8);
        });

        // Identidad: Formateo automático
        identidadInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
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

        form.addEventListener('submit', function(event) { // Abre submit listener
            let formIsValid = true;

            // Limpiar mensajes de error previos del cliente
            document.querySelectorAll('.is-invalid').forEach(element => {
                element.classList.remove('is-invalid');
            });
            document.querySelectorAll('.invalid-feedback').forEach(element => {
                if (element.textContent.trim().length > 0 && !element.dataset.laravelError) {
                    element.style.display = 'none';
                }
            });

            // Trim leading spaces from all text-based inputs before validation
            nombreInput.value = nombreInput.value.trimStart();
            apellidoInput.value = apellidoInput.value.trimStart();
            correoInput.value = correoInput.value.trimStart();
            telefonoInput.value = telefonoInput.value.trimStart();
            identidadInput.value = identidadInput.value.trimStart();
            direccionInput.value = direccionInput.value.trimStart();

            // Validaciones para Nombre
            const nombre = nombreInput.value.trim();
            if (nombre.length === 0) {
                nombreInput.classList.add('is-invalid');
                document.getElementById('nombre-feedback').textContent = 'El nombre es requerido.';
                document.getElementById('nombre-feedback').style.display = 'block';
                formIsValid = false;
            } else if (!regexSoloLetras.test(nombre)) {
                nombreInput.classList.add('is-invalid');
                document.getElementById('nombre-feedback').textContent = 'El nombre solo puede contener letras, espacios y guiones.';
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
            } else if (!regexSoloLetras.test(apellido)) {
                apellidoInput.classList.add('is-invalid');
                document.getElementById('apellido-feedback').textContent = 'El apellido solo puede contener letras, espacios y guiones.';
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
                const soloDigitosIdentidad = identidad.replace(/-/g, '');
                if (soloDigitosIdentidad.length === 13) {
                    const primerosDosNumeros = parseInt(soloDigitosIdentidad.substring(0, 2), 10);
                    if (primerosDosNumeros > 18) {
                        identidadInput.classList.add('is-invalid');
                        identidadFeedback.textContent = 'Los dos primeros números de la identidad no pueden ser mayores que 18.';
                        identidadFeedback.style.display = 'block';
                        formIsValid = false;
                    }
                } else { // Si después de quitar guiones no tiene 13 dígitos
                    identidadInput.classList.add('is-invalid');
                    identidadFeedback.textContent = 'El número de identidad debe tener 13 dígitos.';
                    identidadFeedback.style.display = 'block';
                    formIsValid = false;
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

            // Validaciones para select (Sexo)
            if (!sexoInput.value) {
                sexoInput.classList.add('is-invalid');
                sexoInput.nextElementSibling.style.display = 'block';
                formIsValid = false;
            }

            if (!formIsValid) {
                event.preventDefault(); // Evita que el formulario se envíe si hay errores
            }
        }); // Cierra submit listener

        // --- Funcionalidad del botón Limpiar ---
        document.getElementById('limpiarFormulario').addEventListener('click', function() { // Abre limpiarFormulario listener
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
                } else if (element.id === 'direccion-feedback') {
                    element.textContent = 'La dirección es requerida.';
                } else if (element.previousElementSibling && element.previousElementSibling.tagName === 'SELECT') {
                    // Para los selects, restablecer el mensaje genérico
                    element.textContent = 'Por favor, seleccione una opción.';
                }
            });
        }); // Cierra limpiarFormulario listener

        // --- Listener general para limpiar validación cuando el usuario corrige o el campo ya no está vacío ---
        document.querySelectorAll('.form-control').forEach(input => { // Abre forEach input
            input.addEventListener('input', function() { // Abre input listener
                // Trim leading spaces for all text inputs
                this.value = this.value.trimStart();

                // Solo limpiar la clase si el campo ya no está vacío (o si se ha corregido el formato)
                if (this.classList.contains('is-invalid')) {
                    // Lógica específica para identidad si se borran los guiones y se vuelve a escribir correctamente
                    if (this.id === 'identidad') {
                        const identidadVal = this.value.trim();
                        const soloDigitos = identidadVal.replace(/-/g, '');
                        const regexIdentidad = /^\d{4}-\d{4}-\d{5}$/; // Regex para el formato con guiones

                        // Si el formato es correcto, tiene 13 dígitos y los primeros dos son <= 18
                        if (regexIdentidad.test(identidadVal) && soloDigitos.length === 13 && parseInt(soloDigitos.substring(0, 2), 10) <= 18) {
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback');
                            if (feedbackElement) {
                                feedbackElement.style.display = 'none';
                                feedbackElement.removeAttribute('data-laravel-error');
                            }
                        } else if (identidadVal.length === 0) { // Si el campo está vacío, limpiar también
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback');
                            if (feedbackElement) {
                                feedbackElement.style.display = 'none';
                                feedbackElement.removeAttribute('data-laravel-error');
                            }
                        }
                        // Si no cumple las condiciones de arriba, no limpiar la validación
                    } else if (this.id === 'telefono') {
                        const regexTelefonoInicio = /^[2389]\d{7}$/;
                        if (regexTelefonoInicio.test(this.value.trim()) || this.value.trim().length === 0) {
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback');
                            if (feedbackElement) {
                                feedbackElement.style.display = 'none';
                                feedbackElement.removeAttribute('data-laravel-error');
                            }
                        }
                    } else if (this.id === 'correo') {
                        const regexCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                        if ((regexCorreo.test(this.value.trim()) && this.value.trim().length <= 30) || this.value.trim().length === 0) {
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback');
                            if (feedbackElement) {
                                feedbackElement.style.display = 'none';
                                feedbackElement.removeAttribute('data-laravel-error');
                            }
                        }
                    } else {
                        // Para otros campos de texto/número, simplemente limpiar si no está vacío
                        if (this.value.trim().length > 0) {
                            this.classList.remove('is-invalid');
                            const feedbackElement = document.getElementById(this.id + '-feedback');
                            if (feedbackElement) {
                                feedbackElement.style.display = 'none';
                                feedbackElement.removeAttribute('data-laravel-error');
                            }
                        }
                    }
                }
            }); // Cierra input listener
        }); // Cierra forEach input
    }); // Cierre del DOMContentLoaded
</script>
</body>
</html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/cliente/create.blade.php ENDPATH**/ ?>