

<?php $__env->startSection('title', 'Lista de Facturas'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Lista facturas registradas</h2>
                <span class="text-white">Total: <strong><?php echo e($facturas->total()); ?></strong></span>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
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



            <div class="d-flex gap-2 align-items-center mt-3 mb-4">
                <a href="<?php echo e(route('facturas.create')); ?>" class="btn btn-danger mb-3">+ Nueva factura</a>
                <a href="<?php echo e(route('welcome')); ?>" class="btn btn-danger mb-3">Inicio</a>

            </div>
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover text-center align-middle">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Código</th> 
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Total</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $facturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $factura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration + ($facturas->currentPage() - 1) * $facturas->perPage()); ?></td>
                            <td><?php echo e($factura->codigo); ?></td> 
                            <td><?php echo e($factura->cliente ? $factura->cliente->nombre . ' ' . $factura->cliente->apellido : 'Sin cliente'); ?></td>
                            <td><?php echo e($factura->fecha ? \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') : ''); ?></td>
                            <td>L. <?php echo e(number_format($factura->total, 2)); ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?php echo e(route('facturas.show', $factura->id)); ?>" class="btn btn-info btn-sm" title="Ver Detalles">Ver</a>
                                    <a href="<?php echo e(route('facturas.edit', $factura->id)); ?>" class="btn btn-warning btn-sm" title="Editar Factura">Editar</a>
                                    <form action="<?php echo e(route('facturas.destroy', $factura->id)); ?>" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta factura?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar Factura">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-white">No hay facturas registradas.</td> 
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4 mb-4">
                <?php echo e($facturas->links('vendor.pagination.bootstrap-5')); ?>

            </div>


        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\FullRepuestos\resources\views/facturas/index.blade.php ENDPATH**/ ?>