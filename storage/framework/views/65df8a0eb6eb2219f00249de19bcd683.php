

<?php $__env->startSection('title', 'Listado de Facturas de Compra'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">

        <h1 class="mb-4">Listado de facturas de compra</h1>

        <div class="d-flex justify-content-start gap-2 mb-4">
            <a href="<?php echo e(route('facturas-compra.create')); ?>" class="btn btn-danger">Registrar nueva factura</a>
            <a href="<?php echo e(route('welcome')); ?>" class="btn btn-danger">Inicio</a>
        </div>

        <table class="table table-dark table-hover align-middle">
            <thead>
            <tr>
                <th>#</th> <!-- Columna para el número -->
                <th>Código</th>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Empleado</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $facturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $factura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(($facturas->currentPage() - 1) * $facturas->perPage() + $loop->iteration); ?></td>
                    <td><?php echo e($factura->codigo); ?></td>
                    <td><?php echo e($factura->fecha->format('d/m/Y')); ?></td>
                    <td><?php echo e($factura->proveedor->nombre_empresa ?? 'N/A'); ?></td>
                    <td><?php echo e($factura->empleado->nombre ?? 'N/A'); ?></td>
                    <td>L. <?php echo e(number_format($factura->total, 2)); ?></td>
                    <td>
                        <a href="<?php echo e(route('facturas-compra.show', $factura)); ?>" class="btn btn-sm btn-info">Ver</a>
                        <a href="<?php echo e(route('facturas-compra.edit', $factura)); ?>" class="btn btn-sm btn-warning">Editar</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4 mb-4">
            <?php echo e($facturas->withQueryString()->links('vendor.pagination.bootstrap-5')); ?>

        </div>



    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\FullRepuestos\resources\views/facturaCompra/index.blade.php ENDPATH**/ ?>