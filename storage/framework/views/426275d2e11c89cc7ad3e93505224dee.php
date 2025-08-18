

<?php $__env->startSection('title', 'Editar Factura de Compra'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="table-container">
            <h2 class="mb-4">Editar factura de compra: <?php echo e($facturas_compra->codigo); ?></h2>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('facturas-compra.update', $facturas_compra)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo e(old('fecha', $facturas_compra->fecha->format('Y-m-d'))); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="proveedor_id" class="form-label">Proveedor</label>
                    <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                        <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($proveedor->id); ?>" <?php echo e(old('proveedor_id', $facturas_compra->proveedor_id) == $proveedor->id ? 'selected' : ''); ?>>
                                <?php echo e($proveedor->nombre_empresa); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="empleado_id" class="form-label">Empleado</label>
                    <select name="empleado_id" id="empleado_id" class="form-control" required>
                        <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($empleado->id); ?>" <?php echo e(old('empleado_id', $facturas_compra->empleado_id) == $empleado->id ? 'selected' : ''); ?>>
                                <?php echo e($empleado->nombre); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                

                <button type="submit" class="btn btn-danger">Guardar Cambios</button>
                <button type="reset" class="btn btn-danger">Restablecer</button>
                <a href="<?php echo e(route('facturas-compra.show', $facturas_compra)); ?>" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\FullRepuestos\resources\views/facturaCompra/edit.blade.php ENDPATH**/ ?>