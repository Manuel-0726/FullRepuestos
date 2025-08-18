

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <h1 class="text-white">Registrar nueva promoción</h1>

        
        <?php if(session('success')): ?>
            <div id="alertSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <form id="formPromocion" action="<?php echo e(route('promociones.store')); ?>" method="POST" enctype="multipart/form-data" class="bg-dark p-4 rounded" novalidate>
            <?php echo csrf_field(); ?>

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
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nombre')); ?>" required>
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
unset($__errorArgs, $__bag); ?>" required><?php echo e(old('descripcion')); ?></textarea>
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
                       value="<?php echo e(old('fecha_inicio')); ?>" min="<?php echo e(\Carbon\Carbon::today()->format('Y-m-d')); ?>" required>
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
                       value="<?php echo e(old('fecha_fin')); ?>" min="<?php echo e(\Carbon\Carbon::today()->format('Y-m-d')); ?>" required>
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
                <input type="number" name="descuento" step="0.01" class="form-control <?php $__errorArgs = ['descuento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('descuento')); ?>" required>
                <?php $__errorArgs = ['descuento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">El campo descuento es necesario.</div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="mb-3">
                <label class="form-label text-white">Imagen de la promoción</label>
                <input type="file" name="imagen" accept="image/*" class="form-control" id="imagenInput">
                <div class="mt-2">
                    <img id="previewImagen" src="#" alt="Previsualización" style="max-width: 200px; display:none;" class="rounded shadow">
                </div>
            </div>

            
            <div class="mb-3">
                <label class="form-label text-white">Seleccione los productos para la promocion:</label>
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

            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="submit" class="btn btn-danger">Guardar</button>
                <button type="button" id="btnLimpiar" class="btn btn-danger">Limpiar</button>
                <a href="<?php echo e(route('promociones.index')); ?>" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const alert = document.getElementById('alertSuccess');
            if(alert){
                setTimeout(() => {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    bsAlert.close(); // Cierra la alerta automáticamente
                }, 5000); // 5000 ms = 5 segundos
            }
        });

        (function () {
            'use strict';
            const form = document.getElementById('formPromocion');

            // Validación de formulario
            form.addEventListener('submit', function (event) {
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

            // Botón Limpiar
            const btnLimpiar = document.getElementById('btnLimpiar');
            if(btnLimpiar){
                btnLimpiar.addEventListener('click', function() {
                    form.querySelectorAll('input, textarea').forEach(el => el.value = '');
                    form.querySelectorAll('input[type="hidden"]').forEach(el => el.remove());
                    const tbody = document.getElementById('productosSeleccionados');
                    tbody.innerHTML = '';
                    const preview = document.getElementById('previewImagen');
                    if(preview) preview.style.display = 'none';
                    form.classList.remove('was-validated');
                });
            }

            // Evitar espacio al inicio en nombre y descripción
            const noSpaceStart = form.querySelectorAll('input[name="nombre"], textarea[name="descripcion"]');
            noSpaceStart.forEach(el => {
                el.addEventListener('keydown', function(e) {
                    if (e.key === " " && this.value.length === 0) {
                        e.preventDefault();
                    }
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
                if (tbody.querySelector('tr[data-id="'+selectedId+'"]')) return;

                const row = document.createElement('tr');
                row.dataset.id = selectedId;
                row.innerHTML = `
                    <td>${selectedText}</td>
                    <td><button type="button" class="btn btn-sm btn-danger btn-eliminar">Eliminar</button></td>
                `;
                tbody.appendChild(row);

                row.querySelector('.btn-eliminar').addEventListener('click', function() {
                    row.remove();
                });
            });

        })();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\FullRepuestos\resources\views/promociones/create.blade.php ENDPATH**/ ?>