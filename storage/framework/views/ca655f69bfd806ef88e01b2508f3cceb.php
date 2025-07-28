<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #121212;
            color: #f1f1f1;
        }

        .form-container {
            background-color: #1e1e1e;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.6);
        }

        .form-label {
            color: #ccc;
        }

        .form-control {
            background-color: #2c2c2c;
            border: none;
            color: #fff;
        }

        .form-control:focus {
            background-color: #2c2c2c;
            color: #fff;
            border-color: #4caf50;
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
        }

        .btn-primary {
            background-color: #4caf50;
            border: none;
        }

        .btn-primary:hover {
            background-color: #43a047;
        }

        h2 {
            color: #e0e0e0;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="form-container">
                <h2 class="mb-4">Editar producto</h2>

                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form id="formProducto" action="<?php echo e(route('productos.update', $producto->id)); ?>" method="POST" novalidate>
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="row">
                        
                        <div class="mb-3 col-md-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input
                                type="text"
                                class="form-control <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="nombre"
                                name="nombre"
                                value="<?php echo e(old('nombre', $producto->nombre)); ?>"
                                required
                                maxlength="50"
                                autocomplete="off"
                            />
                            <div class="invalid-feedback" id="nombre-feedback">
                                El nombre solo puede contener letras y espacios.
                            </div>
                            <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-3 col-md-6">
                            <label for="modelo" class="form-label">Modelo:</label>
                            <input
                                type="text"
                                class="form-control <?php $__errorArgs = ['modelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="modelo"
                                name="modelo"
                                value="<?php echo e(old('modelo', $producto->modelo)); ?>"
                                required
                                maxlength="50"
                                autocomplete="off"
                            />
                            <div class="invalid-feedback" id="modelo-feedback">
                                El modelo puede contener letras, números, espacios y guiones.
                            </div>
                            <?php $__errorArgs = ['modelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-3 col-md-6">
                            <label for="marca" class="form-label">Marca:</label>
                            <select class="form-control <?php $__errorArgs = ['marca'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="marca" name="marca" required>
                                <option value="">Seleccione una marca...</option>
                                <?php
                                    $marcas = ['Toyota', 'Honda', 'Ford', 'Chevrolet', 'Nissan', 'Volkswagen', 'Hyundai', 'Mazda', 'Kia'];
                                ?>
                                <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($marca); ?>" <?php echo e(old('marca', $producto->marca) == $marca ? 'selected' : ''); ?>><?php echo e($marca); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="invalid-feedback" id="marca-feedback">Por favor, seleccione una marca.</div>
                            <?php $__errorArgs = ['marca'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-3 col-md-6">
                            <label for="anio" class="form-label">Año:</label>
                            <input
                                type="number"
                                class="form-control <?php $__errorArgs = ['anio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="anio"
                                name="anio"
                                value="<?php echo e(old('anio', $producto->anio)); ?>"
                                required
                                min="1990"
                                max="<?php echo e(date('Y')); ?>"
                                maxlength="4"
                                autocomplete="off"
                            />
                            <div class="invalid-feedback" id="anio-feedback">
                                El año debe ser igual o mayor a 1990, no mayor al año actual.
                            </div>
                            <?php $__errorArgs = ['anio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-3 col-md-6">
                            <label for="categoria" class="form-label">Categoría:</label>
                            <select class="form-control <?php $__errorArgs = ['categoria'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="categoria" name="categoria" required>
                                <option value="">Seleccione...</option>
                                <?php
                                    $categorias = ['Motor', 'Frenos', 'Suspensión', 'Eléctrico', 'Accesorios'];
                                ?>
                                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($categoria); ?>" <?php echo e(old('categoria', $producto->categoria) == $categoria ? 'selected' : ''); ?>>
                                        <?php echo e($categoria); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="invalid-feedback" id="categoria-feedback">Por favor, seleccione una categoría.</div>
                            <?php $__errorArgs = ['categoria'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-3 col-md-6">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea
                                class="form-control <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="descripcion"
                                name="descripcion"
                                required
                                maxlength="100"
                                rows="3"
                                autocomplete="off"
                            ><?php echo e(old('descripcion', $producto->descripcion)); ?></textarea>
                            <div class="invalid-feedback" id="descripcion-feedback">
                                La descripción no puede empezar con espacio o número.
                            </div>
                            <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="<?php echo e(route('productos.index')); ?>" class="btn btn-outline-light">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('formProducto');

        form.addEventListener('submit', function(event) {
            let formIsValid = true;

            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.querySelectorAll('.invalid-feedback').forEach(el => el.style.display = 'none');

            const nombreInput = document.getElementById('nombre');
            const nombre = nombreInput.value.trim();
            const regexNombre = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ][a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s]{0,49}$/;
            if (nombre === '') {
                nombreInput.classList.add('is-invalid');
                nombreInput.nextElementSibling.style.display = 'block';
                formIsValid = false;
            } else if (!regexNombre.test(nombre)) {
                nombreInput.classList.add('is-invalid');
                nombreInput.nextElementSibling.style.display = 'block';
                formIsValid = false;
            }

            const modeloInput = document.getElementById('modelo');
            const modelo = modeloInput.value.trim();
            const regexModelo = /^[a-zA-Z][a-zA-Z0-9\s\-]{0,49}$/;
            if (modelo === '') {
                modeloInput.classList.add('is-invalid');
                document.getElementById('modelo-feedback').style.display = 'block';
                formIsValid = false;
            } else if (!regexModelo.test(modelo)) {
                modeloInput.classList.add('is-invalid');
                document.getElementById('modelo-feedback').style.display = 'block';
                formIsValid = false;
            }

            const marcaInput = document.getElementById('marca');
            if (!marcaInput.value) {
                marcaInput.classList.add('is-invalid');
                document.getElementById('marca-feedback').style.display = 'block';
                formIsValid = false;
            }

            const anioInput = document.getElementById('anio');
            const anio = anioInput.value.trim();
            const anioNum = parseInt(anio, 10);
            const anioActual = new Date().getFullYear();
            const regexAnio = /^[1-9]\d{3}$/;
            if (anio === '') {
                anioInput.classList.add('is-invalid');
                document.getElementById('anio-feedback').style.display = 'block';
                formIsValid = false;
            } else if (!regexAnio.test(anio) || isNaN(anioNum) || anioNum < 1990 || anioNum > anioActual) {
                anioInput.classList.add('is-invalid');
                document.getElementById('anio-feedback').style.display = 'block';
                formIsValid = false;
            }

            const categoriaInput = document.getElementById('categoria');
            if (!categoriaInput.value) {
                categoriaInput.classList.add('is-invalid');
                document.getElementById('categoria-feedback').style.display = 'block';
                formIsValid = false;
            }

            const descripcionInput = document.getElementById('descripcion');
            const descripcion = descripcionInput.value.trim();
            const regexDescripcion = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ][a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s]{0,99}$/;
            if (descripcion === '') {
                descripcionInput.classList.add('is-invalid');
                document.getElementById('descripcion-feedback').style.display = 'block';
                formIsValid = false;
            } else if (!regexDescripcion.test(descripcion)) {
                descripcionInput.classList.add('is-invalid');
                document.getElementById('descripcion-feedback').style.display = 'block';
                formIsValid = false;
            }

            if (!formIsValid) {
                event.preventDefault();
                event.stopPropagation();
            }
        });

        ['nombre', 'descripcion', 'marca', 'modelo', 'anio', 'categoria'].forEach(id => {
            const el = document.getElementById(id);
            el.addEventListener('input', () => {
                if(el.classList.contains('is-invalid')) {
                    el.classList.remove('is-invalid');
                    const feedback = document.getElementById(id + '-feedback');
                    if(feedback) feedback.style.display = 'none';
                }
            });
            if(el.tagName === 'SELECT') {
                el.addEventListener('change', () => {
                    if(el.classList.contains('is-invalid')) {
                        el.classList.remove('is-invalid');
                        const feedback = document.getElementById(el.id + '-feedback');
                        if(feedback) feedback.style.display = 'none';
                    }
                });
            }
        });

        document.getElementById('anio').addEventListener('input', e => {
            let val = e.target.value.replace(/\D/g, '');
            if(val.length > 4) val = val.slice(0, 4);
            while(val.startsWith('0')) val = val.slice(1);
            e.target.value = val;
        });

        ['nombre', 'descripcion', 'modelo'].forEach(id => {
            const el = document.getElementById(id);
            el.addEventListener('input', () => {
                let val = el.value;
                if(val.length > 0 && (/^[\s0-9]/.test(val.charAt(0)))) {
                    el.value = val.substring(1);
                }
            });
        });
    });
</script>

</body>
</html>
<?php /**PATH C:\Users\manue\PhpstormProjects\RacingParts2.0\resources\views/productos/edit.blade.php ENDPATH**/ ?>