

<?php $__env->startSection('content'); ?>
    <div class="container mt-4 text-white">
        <h2>Editar promoción: <?php echo e($promocione->nombre); ?></h2>

        <form id="formPromocion" action="<?php echo e(url('/promociones/' . $promocione->id)); ?>" method="POST" enctype="multipart/form-data" class="bg-dark p-4 rounded" novalidate>
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Nombre, Descripción, Descuento, Fechas e Imagen -->
            <div class="mb-3">
                <label class="form-label text-white">Nombre</label>
                <input type="text" name="nombre" maxlength="60" pattern="^[^\s].*$"
                       title="El nombre no puede iniciar con un espacio"
                       class="form-control <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nombre', $promocione->nombre)); ?>" required>
                <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">El campo nombre es necesario.</div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Descripción</label>
                <textarea name="descripcion" maxlength="250" pattern="^[^\s].*$"
                          title="La descripción no puede iniciar con un espacio"
                          class="form-control <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required><?php echo e(old('descripcion', $promocione->descripcion)); ?></textarea>
                <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">El campo descripción es necesario.</div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control <?php $__errorArgs = ['fecha_inicio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       value="<?php echo e(old('fecha_inicio', $promocione->fecha_inicio)); ?>" min="<?php echo e(\Carbon\Carbon::today()->format('Y-m-d')); ?>" required>
                <?php $__errorArgs = ['fecha_inicio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">La fecha de inicio no puede ser anterior a hoy.</div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Fecha Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control <?php $__errorArgs = ['fecha_fin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       value="<?php echo e(old('fecha_fin', $promocione->fecha_fin)); ?>" min="<?php echo e(\Carbon\Carbon::today()->format('Y-m-d')); ?>" required>
                <?php $__errorArgs = ['fecha_fin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">La fecha fin no puede ser anterior a la fecha de inicio ni a hoy.</div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Descuento (%)</label>
                <input type="number" step="0.01" name="descuento" class="form-control <?php $__errorArgs = ['descuento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('descuento', $promocione->descuento)); ?>" required>
                <?php $__errorArgs = ['descuento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Imagen</label>
                <input type="file" name="imagen" class="form-control <?php $__errorArgs = ['imagen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*" id="imagenInput">
                <?php $__errorArgs = ['imagen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <img id="previewImagen" src="<?php echo e($promocione->imagen ? asset('storage/'.$promocione->imagen) : ''); ?>" class="mt-2 img-fluid" style="max-height:150px; <?php echo e($promocione->imagen ? '' : 'display:none;'); ?>">
            </div>

            <!-- Selección de productos -->
            <div class="mb-3">
                <label class="form-label text-white">Productos</label>
                <select id="selectProducto" class="form-control mb-2">
                    <option value="" disabled selected>Seleccionar producto...</option>
                    <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($producto->id); ?>"><?php echo e($producto->nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <table class="table table-dark table-striped">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody id="productosSeleccionados">
                    <?php $__currentLoopData = $promocione->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-id="<?php echo e($producto->id); ?>">
                            <td><?php echo e($producto->nombre); ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger btn-eliminar">Eliminar</button>
                            </td>
                            <input type="hidden" name="productos[]" value="<?php echo e($producto->id); ?>">
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php $__errorArgs = ['productos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="d-flex justify-content-end mt-4 gap-2">
                <a href="<?php echo e(route('promociones.index')); ?>" class="btn btn-danger">Volver</a>
                <button type="reset" class="btn btn-danger">Restablecer</button>
                <button type="submit" class="btn btn-danger">Actualizar Promoción</button>
            </div>
        </form>
    </div>

    <script>
        (function () {
            'use strict';
            const form = document.getElementById('formPromocion');

            // Validación de formulario
            form.addEventListener('submit', function (event) {
                // Antes de enviar, agregar hidden inputs con productos seleccionados que no estén ya en la tabla
                const tbody = document.getElementById('productosSeleccionados');
                tbody.querySelectorAll('tr').forEach(row => {
                    const productId = row.dataset.id;
                    if (!form.querySelector('input[name="productos[]"][value="'+productId+'"]')) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'productos[]';
                        input.value = productId;
                        form.appendChild(input);
                    }
                });

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);

            // Evitar espacio al inicio en nombre y descripción
            const noSpaceStart = form.querySelectorAll('input[name="nombre"], textarea[name="descripcion"]');
            noSpaceStart.forEach(el => {
                el.addEventListener('keydown', function(e) {
                    if (e.key === " " && this.value.length === 0) e.preventDefault();
                });
            });

            // Previsualizar imagen
            const imagenInput = document.getElementById('imagenInput');
            const previewImagen = document.getElementById('previewImagen');
            if(imagenInput && previewImagen){
                imagenInput.addEventListener('change', function(e){
                    const file = e.target.files[0];
                    if(file){
                        const reader = new FileReader();
                        reader.onload = function(event){
                            previewImagen.src = event.target.result;
                            previewImagen.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Manejo de productos seleccionados
            const selectProducto = document.getElementById('selectProducto');
            const tbody = document.getElementById('productosSeleccionados');

            selectProducto.addEventListener('change', function() {
                const selectedId = this.value;
                const selectedText = this.options[this.selectedIndex].text;

                // Evitar duplicados
                if (tbody.querySelector('tr[data-id="'+selectedId+'"]')) return;

                const row = document.createElement('tr');
                row.dataset.id = selectedId;
                row.innerHTML = `
            <td>${selectedText}</td>
            <td><button type="button" class="btn btn-sm btn-danger btn-eliminar">Eliminar</button></td>
        `;
                tbody.appendChild(row);

                // Eliminar producto
                row.querySelector('.btn-eliminar').addEventListener('click', function() {
                    row.remove();
                });
            });

            // Agregar funcionalidad de eliminar a los productos ya cargados
            tbody.querySelectorAll('.btn-eliminar').forEach(btn => {
                btn.addEventListener('click', function() {
                    btn.closest('tr').remove();
                });
            });

        })();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\FullRepuestos\resources\views/promociones/edit.blade.php ENDPATH**/ ?>