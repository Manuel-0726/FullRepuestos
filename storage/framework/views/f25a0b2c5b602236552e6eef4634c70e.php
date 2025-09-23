

<?php $__env->startSection('title', 'Editar Empleado'); ?>

<?php $__env->startSection('content'); ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
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

                        <div class="row">
                            
                            <div class="mb-3 col-md-6">
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

                            
                            <div class="mb-3 col-md-6">
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

                            
                            <div class="mb-3 col-md-6">
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

                            
                            <div class="mb-3 col-md-6">
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

                            
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="identidad">Identidad:</label>
                                <input type="text" name="identidad" id="identidad" class="form-control <?php $__errorArgs = ['identidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('identidad', $empleado->identidad)); ?>" required maxlength="15" oninput="formatearIdentidad(this)" title="Debe ingresar 13 dígitos numéricos en formato ####-####-#####">
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
                                <div id="errorIdentidadExtra" class="invalid-feedback" style="display: none;"></div>
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

                            
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="salario">Salario (Lempiras):</label>
                                <input type="number" name="salario" id="salario" class="form-control <?php $__errorArgs = ['salario'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('salario', (int)$empleado->salario)); ?>" required min="0">
                                <div class="invalid-feedback" id="salario-feedback">
                                    <?php $__errorArgs = ['salario'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                    <?php else: ?>
                                        El salario debe ser un número entero positivo con un máximo de 5 cifras.
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            
                            <div class="mb-3 col-md-6">
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
                                        La fecha de contratación es requerida y debe cumplir con la edad mínima (18 años) según la identidad.
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            
                            <div class="mb-3 col-md-6">
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
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-danger">Actualizar</button>
                            <button type="button" id="restablecerFormulario" class="btn btn-danger">Restablecer</button>
                            <a href="<?php echo e(route('empleados.index')); ?>" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        /**
         * Almacena el estado original del formulario al cargar la página para la función "Restablecer".
         */
        const originalFormData = {};

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('empleadoForm');
            const nombreInput = document.getElementById('nombre');
            const apellidoInput = document.getElementById('apellido');
            const salarioInput = document.getElementById('salario');
            const telefonoInput = document.getElementById('telefono');
            const correoInput = document.getElementById('correo');
            const fechaContratacionInput = document.getElementById('fecha_contratacion');
            const identidadInput = document.getElementById('identidad');
            const direccionInput = document.getElementById('direccion');
            const sexoInput = document.getElementById('sexo');
            const puestoInput = document.getElementById('puesto');
            const estadoInput = document.getElementById('estado');

            // Inicializa el estado original para el botón de Restablecer
            document.querySelectorAll('.form-control, .form-select').forEach(element => {
                originalFormData[element.id] = element.value;
            });

            // Función de Restablecer (Reemplaza el type="reset" nativo)
            document.getElementById('restablecerFormulario').addEventListener('click', function() {
                // Restaura los valores del DOM a los valores originales
                Object.keys(originalFormData).forEach(id => {
                    const element = document.getElementById(id);
                    if (element) {
                        element.value = originalFormData[id];
                        // Limpia las clases de validación de Bootstrap
                        element.classList.remove('is-invalid');
                        element.classList.remove('is-valid');
                    }
                });

                // Oculta todos los mensajes de error
                document.querySelectorAll('.invalid-feedback').forEach(element => {
                    element.style.display = 'none';
                    element.removeAttribute('data-laravel-error');
                });
            });

            // ----------------------------------------------------
            // Funciones de utilidad y listeners de PREVENCIÓN
            // ----------------------------------------------------

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

            // 🚨 Función para el formateo de identidad en tiempo real
            window.formatearIdentidad = function(input) {
                // 1. Guardar la posición actual del cursor.
                const originalStart = input.selectionStart;

                // 2. Obtener el valor sin guiones para trabajar con él.
                let valorSinGuiones = input.value.replace(/\D/g, '');
                let nuevoValor = '';
                let guionesPrevios = (input.value.slice(0, originalStart).match(/-/g) || []).length;
                let cursorOffset = 0;
                let nuevaPosicion = originalStart - guionesPrevios;

                // 3. Reconstruir el valor con el formato ####-####-#####.
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

                // 4. Limitar a 15 caracteres.
                if (nuevoValor.length > 15) {
                    nuevoValor = nuevoValor.slice(0, 15);
                }

                // 5. Aplicar el nuevo valor y restaurar el cursor.
                input.value = nuevoValor;
                let posicionFinalCursor = nuevaPosicion + cursorOffset;
                if (posicionFinalCursor > nuevoValor.length) {
                    posicionFinalCursor = nuevoValor.length;
                }
                if (nuevoValor.charAt(posicionFinalCursor) === '-' && (posicionFinalCursor === 4 || posicionFinalCursor === 9)) {
                    posicionFinalCursor++;
                }
                input.setSelectionRange(posicionFinalCursor, posicionFinalCursor);
            }

            nombreInput.addEventListener('input', enforceLettersOnly);
            apellidoInput.addEventListener('input', enforceLettersOnly);
            correoInput.addEventListener('input', cleanStartSpace);
            direccionInput.addEventListener('input', cleanStartSpace);

            telefonoInput.addEventListener('input', function (e) {
                cleanStartSpace(e);
                e.target.value = e.target.value.replace(/\D/g, '').substring(0, 8);
            });

            /**
             * Lógica para el Salario: solo enteros, máximo 5 cifras.
             */
            salarioInput.addEventListener('input', function(e) {
                cleanStartSpace(e);
                // Permite solo números, eliminando cualquier caracter que no sea un dígito
                let value = e.target.value.replace(/\D/g, '');

                // Limitar a 5 cifras enteras
                if (value.length > 5) {
                    value = value.substring(0, 5);
                }

                // Evitar que el primer dígito sea 0 si hay más dígitos (ej: 01 -> 1)
                if (value.length > 1 && value[0] === '0') {
                    value = value.substring(1);
                }

                e.target.value = value;
            });


            // ----------------------------------------------------
            // LISTENER PARA EL SUBMIT DEL FORMULARIO (Validaciones JS)
            // ----------------------------------------------------

            form.addEventListener('submit', function(event) {
                let formIsValid = true;
                let anioNacimientoIdentidad = null;

                // 1. Limpiar mensajes de error previos del cliente
                document.querySelectorAll('.is-invalid').forEach(element => {
                    element.classList.remove('is-invalid');
                });
                document.querySelectorAll('.invalid-feedback').forEach(element => {
                    if (!element.dataset.laravelError) {
                        element.style.display = 'none';
                    }
                });
                document.getElementById('errorIdentidadExtra').style.display = 'none';

                // 2. Validaciones de Inputs

                // Nombre
                if (nombreInput.value.trim().length === 0) {
                    nombreInput.classList.add('is-invalid');
                    document.getElementById('nombre-feedback').textContent = 'El nombre es requerido.';
                    document.getElementById('nombre-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Apellido
                if (apellidoInput.value.trim().length === 0) {
                    apellidoInput.classList.add('is-invalid');
                    document.getElementById('apellido-feedback').textContent = 'El apellido es requerido.';
                    document.getElementById('apellido-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Correo
                const correo = correoInput.value.trim();
                const regexCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (correo.length === 0 || !regexCorreo.test(correo) || correo.length > 30) {
                    correoInput.classList.add('is-invalid');
                    document.getElementById('correo-feedback').textContent = (correo.length === 0) ? 'El correo es requerido.' : 'Ingrese un correo válido (ej. usuario@dominio.com) con máximo 30 caracteres.';
                    document.getElementById('correo-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Teléfono
                const telefono = telefonoInput.value.trim();
                const regexTelefonoInicio = /^[2389]\d{7}$/;
                if (telefono.length === 0 || !regexTelefonoInicio.test(telefono)) {
                    telefonoInput.classList.add('is-invalid');
                    document.getElementById('telefono-feedback').textContent = (telefono.length === 0) ? 'El teléfono es requerido.' : 'El teléfono debe tener 8 dígitos y comenzar con 2, 3, 8 o 9.';
                    document.getElementById('telefono-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Dirección
                const direccion = direccionInput.value.trim();
                if (direccion.length === 0 || direccion.length > 100) {
                    direccionInput.classList.add('is-invalid');
                    document.getElementById('direccion-feedback').textContent = (direccion.length === 0) ? 'La dirección es requerida.' : 'La dirección no puede exceder los 100 caracteres.';
                    document.getElementById('direccion-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Identidad (Formato, Depto <= 18, Edad actual >= 18)
                const identidad = identidadInput.value.trim();
                const identidadFeedback = document.getElementById('identidad-feedback');
                const identidadFeedbackExtra = document.getElementById('errorIdentidadExtra');
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
                    const primerosDosNumeros = parseInt(soloDigitosIdentidad.substring(0, 2), 10);
                    anioNacimientoIdentidad = parseInt(soloDigitosIdentidad.substring(4, 8), 10);

                    const anioActual = new Date().getFullYear();
                    const anioLimite = anioActual - 18;

                    if (primerosDosNumeros > 18) {
                        identidadInput.classList.add('is-invalid');
                        identidadFeedbackExtra.textContent = 'Los dos primeros números de la identidad (Departamento) no pueden ser mayores que 18.';
                        identidadFeedbackExtra.style.display = 'block';
                        formIsValid = false;
                    } else if (anioNacimientoIdentidad > anioLimite) {
                        identidadInput.classList.add('is-invalid');
                        identidadFeedbackExtra.textContent = 'El empleado debe ser mayor de 18 años a la fecha actual.';
                        identidadFeedbackExtra.style.display = 'block';
                        formIsValid = false;
                    }
                }

                // Salario (Validación solo enteros)
                const salarioValue = salarioInput.value.trim();
                const salarioInt = parseInt(salarioValue, 10);

                // Se verifica si está vacío, no es un número, es menor o igual a cero, o si tiene más de 5 cifras
                if (salarioValue.length === 0 || isNaN(salarioInt) || salarioInt <= 0 || salarioValue.length > 5) {
                    salarioInput.classList.add('is-invalid');
                    document.getElementById('salario-feedback').textContent = 'El salario debe ser un número entero positivo con un máximo de 5 cifras.';
                    document.getElementById('salario-feedback').style.display = 'block';
                    formIsValid = false;
                }

                // Selects
                if (!sexoInput.value) {
                    sexoInput.classList.add('is-invalid');
                    sexoInput.nextElementSibling.textContent = 'Por favor, seleccione una opción.';
                    sexoInput.nextElementSibling.style.display = 'block';
                    formIsValid = false;
                }
                if (!puestoInput.value) {
                    puestoInput.classList.add('is-invalid');
                    puestoInput.nextElementSibling.textContent = 'Por favor, seleccione una opción.';
                    puestoInput.nextElementSibling.style.display = 'block';
                    formIsValid = false;
                }
                if (!estadoInput.value) {
                    estadoInput.classList.add('is-invalid');
                    estadoInput.nextElementSibling.textContent = 'Por favor, seleccione el estado.';
                    estadoInput.nextElementSibling.style.display = 'block';
                    formIsValid = false;
                }

                // 3. Validaciones para Fecha de Contratación (y edad mínima)
                const fechaContratacionValue = fechaContratacionInput.value;
                const fechaSeleccionada = new Date(fechaContratacionValue + 'T00:00:00');
                const fechaLimiteInferior = new Date('2000-01-01T00:00:00');
                const fechaActual = new Date();
                fechaActual.setHours(0, 0, 0, 0);
                const feedbackContratacion = document.getElementById('fecha_contratacion-feedback');

                if (fechaContratacionValue.length === 0) {
                    fechaContratacionInput.classList.add('is-invalid');
                    feedbackContratacion.textContent = 'La fecha de contratación es requerida.';
                    feedbackContratacion.style.display = 'block';
                    formIsValid = false;
                } else if (fechaSeleccionada < fechaLimiteInferior) {
                    fechaContratacionInput.classList.add('is-invalid');
                    feedbackContratacion.textContent = 'La fecha no puede ser anterior al 1 de enero de 2000.';
                    feedbackContratacion.style.display = 'block';
                    formIsValid = false;
                } else if (fechaSeleccionada > fechaActual) {
                    fechaContratacionInput.classList.add('is-invalid');
                    feedbackContratacion.textContent = 'La fecha no puede ser futura.';
                    feedbackContratacion.style.display = 'block';
                    formIsValid = false;
                }

                // 🚨 Validación CRÍTICA de Edad (18 años)
                if (anioNacimientoIdentidad !== null) {
                    const anioContratacionMinima = anioNacimientoIdentidad + 18;
                    const fechaMinimaContratacion = new Date(anioContratacionMinima, 0, 1, 0, 0, 0);

                    if (fechaSeleccionada < fechaMinimaContratacion) {
                        fechaContratacionInput.classList.add('is-invalid');
                        feedbackContratacion.textContent = `El empleado debe tener al menos 18 años al contratar. Fecha mínima: 01/01/${anioContratacionMinima}.`;
                        feedbackContratacion.style.display = 'block';
                        formIsValid = false;
                    }
                }

                if (!formIsValid) {
                    event.preventDefault();
                }
            });

            // ----------------------------------------------------
            // Listeners para limpiar la validación en tiempo real (al corregir)
            // ----------------------------------------------------
            document.querySelectorAll('.form-control, .form-select').forEach(element => {
                // Función general para inputs (input event)
                if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
                    element.addEventListener('input', function() {
                        // Si el campo tiene un error y ya no está vacío
                        if (this.classList.contains('is-invalid') && this.value.trim().length > 0) {

                            // Lógica para Identidad
                            if (this.id === 'identidad') {
                                const soloDigitos = this.value.replace(/-/g, '');
                                // Limpiar si se corrige a 15 caracteres (formato completo)
                                if (soloDigitos.length === 13) {
                                    this.classList.remove('is-invalid');
                                    document.getElementById('identidad-feedback').style.display = 'none';
                                    document.getElementById('errorIdentidadExtra').style.display = 'none';
                                }
                            }
                            // Lógica para Salario
                            else if (this.id === 'salario') {
                                // Limpiar si es un número válido y dentro del límite (5 cifras)
                                const value = this.value.trim();
                                if (value.length > 0 && !isNaN(parseInt(value)) && parseInt(value) > 0 && value.length <= 5) {
                                    this.classList.remove('is-invalid');
                                    document.getElementById('salario-feedback').style.display = 'none';
                                }
                            }
                            // Lógica general para otros campos (Nombre, Apellido, etc.)
                            else {
                                this.classList.remove('is-invalid');
                                const feedbackElement = document.getElementById(this.id + '-feedback');
                                if (feedbackElement) {
                                    feedbackElement.style.display = 'none';
                                    feedbackElement.removeAttribute('data-laravel-error');
                                }
                            }
                        }
                    });
                }

                // Lógica específica para selects (change event)
                if (element.tagName === 'SELECT') {
                    element.addEventListener('change', function() {
                        if (this.classList.contains('is-invalid') && this.value !== '') {
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

            // --- Cargar mensajes de error de Laravel al cargar la página ---
            document.querySelectorAll('.form-control.is-invalid, select.is-invalid, textarea.is-invalid').forEach(function(element) {
                let feedbackElement = element.nextElementSibling;

                if (element.id === 'identidad' && document.getElementById('identidad-feedback')) {
                    feedbackElement = document.getElementById('identidad-feedback');
                } else if (element.id && document.getElementById(element.id + '-feedback')) {
                    feedbackElement = document.getElementById(element.id + '-feedback');
                }

                if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                    feedbackElement.style.display = 'block';
                    feedbackElement.setAttribute('data-laravel-error', 'true');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/empleados/editar.blade.php ENDPATH**/ ?>