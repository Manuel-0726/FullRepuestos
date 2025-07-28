<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <h1 class="my-4 text-center">Lista de Proveedores</h1>


    <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <table class="table table-bordered table-striped w-100">
            <thead class="table-dark">
            <tr>
                <th>Nombre Completo</th>
                <th>Empresa</th>
                <th>Teléfono</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <a href="<?php echo e(route('proveedores.show', $proveedor->id)); ?>">
                            <?php echo e($proveedor->nombre); ?> <?php echo e($proveedor->apellido); ?>

                        </a>
                    </td>
                    <td><?php echo e($proveedor->nombre_empresa); ?></td>
                    <td><?php echo e($proveedor->telefono); ?></td>
                    <td><?php echo e($proveedor->email); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div>
            <?php echo e($proveedores->links()); ?>

        </div>

        <div class="d-flex justify-content-between mt-3">
            <?php if($proveedores->onFirstPage()): ?>
                <span class="btn btn-primary disabled">Atrás</span>
            <?php else: ?>
                <a href="<?php echo e($proveedores->previousPageUrl()); ?>" class="btn btn-primary">Atrás</a>
            <?php endif; ?>

            <?php if($proveedores->hasMorePages()): ?>
                <a href="<?php echo e($proveedores->nextPageUrl()); ?>" class="btn btn-primary">Siguiente</a>
            <?php else: ?>
                <span class="btn btn-primary disabled">Siguiente</span>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\Herd\racing_part\resources\views/proveedores/index.blade.php ENDPATH**/ ?>