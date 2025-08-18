

<?php $__env->startSection('content'); ?>
    <div class="container mt-4 text-white">
        <div class="card text-white bg-dark shadow">
            <div class="card-header">
                <h4 class="mb-0">Detalles de la promoción</h4>
            </div>
            <div class="card-body">

                
                <?php if($promocione->imagen): ?>
                    <div class="text-center mb-4">
                        <img src="<?php echo e(asset('storage/' . $promocione->imagen)); ?>"
                             alt="Imagen de la promoción"
                             class="img-fluid rounded shadow"
                             style="max-height: 300px;">
                    </div>
                <?php endif; ?>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Nombre:</strong> <?php echo e($promocione->nombre); ?></p>
                        <p><strong>Descripción:</strong> <?php echo e($promocione->descripcion); ?></p>
                        <p><strong>Descuento:</strong> <?php echo e($promocione->descuento); ?>%</p>
                        <p><strong>Fecha de Inicio:</strong> <?php echo e($promocione->fecha_inicio); ?></p>
                        <p><strong>Fecha de Fin:</strong> <?php echo e($promocione->fecha_fin); ?></p>
                    </div>
                </div>

                <hr>

                <h5>Productos Incluidos</h5>
                <?php if($promocione->productos->isEmpty()): ?>
                    <p>No hay productos asociados a esta promoción.</p>
                <?php else: ?>
                    <ul>
                        <?php $__currentLoopData = $promocione->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($producto->nombre); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>

                <hr>



                <div class="d-flex justify-content-start mt-4">
                    <a href="<?php echo e(route('promociones.index')); ?>" class="btn btn-danger">Volver</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\FullRepuestos\resources\views/promociones/show.blade.php ENDPATH**/ ?>