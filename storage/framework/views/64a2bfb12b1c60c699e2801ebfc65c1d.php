
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
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
                                    maxlength="60"
                                    autocomplete="off"
                                    onkeydown="return evitarEspaciosInicio(this, event)"
                            />
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
                                    maxlength="60"
                                    autocomplete="off"
                                    pattern="^[A-Za-z0-9\-]+$"
                                    onkeydown="return evitarEspaciosInicio(this, event)"
                            />
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
                                    oninput="validarAnio(this)"
                            />
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
                                    maxlength="250"
                                    rows="3"
                                    autocomplete="off"
                                    onkeydown="return evitarEspaciosInicio(this, event)"
                            ><?php echo e(old('descripcion', $producto->descripcion)); ?></textarea>
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
                        <button type="submit" class="btn btn-danger">Actualizar</button>
                        <button type="reset" class="btn btn-danger">Restablecer</button>
                        <a href="<?php echo e(route('productos.index')); ?>" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JS validaciones -->
<script>
    // Evitar que el primer caracter sea un espacio
    function evitarEspaciosInicio(input, event) {
        if (event.key === " " && input.selectionStart === 0) {
            event.preventDefault();
            return false;
        }
        return true;
    }

    // Validar que el año solo tenga 4 dígitos válidos
    function validarAnio(input) {
        let valor = input.value.replace(/\D/g, ""); // elimina letras
        if (valor.length > 4) {
            valor = valor.slice(0, 4); // solo deja 4 dígitos
        }
        input.value = valor;
    }
</script>
</body>
</html>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\FullRepuestos\resources\views/productos/edit.blade.php ENDPATH**/ ?>