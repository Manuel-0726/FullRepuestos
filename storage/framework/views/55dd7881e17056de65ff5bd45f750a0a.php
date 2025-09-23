

<?php $__env->startSection('title', 'Registrar nuevo producto de moto'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-container">
                    <h2 class="mb-4">Registrar nuevo producto de moto</h2>

                    <form id="formProductoMoto" action="<?php echo e(route('productos_moto.store')); ?>" method="POST" enctype="multipart/form-data" novalidate>
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <!-- Nombre -->
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
                                        value="<?php echo e(old('nombre')); ?>"
                                        required
                                        maxlength="60"
                                        oninput="this.value = this.value.trimStart()"
                                />
                                <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Modelo -->
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
                                        value="<?php echo e(old('modelo')); ?>"
                                        maxlength="60"
                                        pattern="^[A-Za-z0-9\-]+$"
                                        oninput="this.value = this.value.trimStart()"
                                />
                                <?php $__errorArgs = ['modelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Marca -->
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
                                        $marcasMoto = ['Honda', 'Yamaha', 'Suzuki', 'Kawasaki', 'Ducati', 'BMW', 'Harley-Davidson'];
                                    ?>
                                    <?php $__currentLoopData = $marcasMoto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($marca); ?>" <?php echo e(old('marca') == $marca ? 'selected' : ''); ?>><?php echo e($marca); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['marca'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Año -->
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
                                        value="<?php echo e(old('anio')); ?>"
                                        min="1990"
                                        max="<?php echo e(date('Y')); ?>"
                                        onkeydown="return (this.value.length < 4) || event.key === 'Backspace' || event.key === 'Delete' || event.key === 'Tab' || event.key === 'ArrowLeft' || event.key === 'ArrowRight';"
                                />
                                <?php $__errorArgs = ['anio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Categoría -->
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
                                        $categoriasMoto = ['Motor', 'Frenos', 'Suspensión', 'Eléctrico', 'Accesorios'];
                                    ?>
                                    <?php $__currentLoopData = $categoriasMoto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($categoria); ?>" <?php echo e(old('categoria') == $categoria ? 'selected' : ''); ?>><?php echo e($categoria); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['categoria'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Descripción -->
                            <div class="mb-3 col-12">
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
                                        maxlength="250"
                                        rows="3"
                                        oninput="this.value = this.value.trimStart()"
                                ><?php echo e(old('descripcion')); ?></textarea>
                                <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Imagen -->
                            <div class="mb-3 col-md-6">
                                <label for="imagen" class="form-label">Imagen:</label>
                                <input type="file" class="form-control <?php $__errorArgs = ['imagen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="imagen" name="imagen" accept="image/*">
                                <?php $__errorArgs = ['imagen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mt-3">
                            <button type="submit" class="btn btn-danger">Registrar</button>
                            <a href="<?php echo e(route('productos_moto.index')); ?>" class="btn btn-secondary">Volver</a>
                            <a href="<?php echo e(route('welcome')); ?>" class="btn btn-primary">Inicio</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script para mostrar el tamaño del archivo y el mensaje de error de 2MB
        document.addEventListener('DOMContentLoaded', function () {
            const imagenInput = document.getElementById('imagen');
            imagenInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const maxSize = 2 * 1024 * 1024; // 2 MB en bytes
                    if (file.size > maxSize) {
                        // Cambiamos el mensaje para que sea más claro
                        const errorMessage = document.createElement('div');
                        errorMessage.classList.add('text-danger', 'mt-1');
                        errorMessage.textContent = 'La imagen no puede ser mayor a 2 MB.';
                        this.parentNode.appendChild(errorMessage);
                        this.classList.add('is-invalid');
                    } else {
                        // Si el archivo es válido, eliminamos el error anterior
                        const prevError = this.parentNode.querySelector('.text-danger');
                        if (prevError) {
                            prevError.remove();
                        }
                        this.classList.remove('is-invalid');
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\FullRepuestos\resources\views/productosMoto/create.blade.php ENDPATH**/ ?>