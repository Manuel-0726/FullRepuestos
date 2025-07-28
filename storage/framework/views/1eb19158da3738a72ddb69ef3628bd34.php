<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Informacion del Proveedor</h1>

        <div class="card">
            <div class="card-header">
                <?php echo e($proveedor->nombre); ?> <?php echo e($proveedor->apellido); ?>

            </div>
            <div class="card-body">
                <p><strong>País:</strong> <?php echo e($proveedor->pais ?? 'No especificado'); ?></p>
                <p><strong>Categoría:</strong> <?php echo e($proveedor->categoria ?? 'No especificada'); ?></p>
                <p><strong>Fecha de registro:</strong> <?php echo e($proveedor->fecha_registro ? $proveedor->fecha_registro->format('d/m/Y H:i') : 'No especificada'); ?></p>
            </div>
        </div>

        <a href="<?php echo e(route('proveedores.index')); ?>" class="btn btn-secondary mt-3">Volver a la lista</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\Herd\racing_part\resources\views/proveedores/show.blade.php ENDPATH**/ ?>