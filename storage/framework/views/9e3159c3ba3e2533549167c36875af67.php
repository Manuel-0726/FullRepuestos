

<?php $__env->startSection('title', 'Detalle de Factura de Compra'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="table-container">
            <h2 class="mb-4">Factura de compra #<?php echo e($factura->codigo); ?></h2>

            <p><strong>Fecha:</strong> <?php echo e(\Carbon\Carbon::parse($factura->fecha)->format('d/m/Y')); ?></p>

            <p><strong>Proveedor:</strong> <?php echo e($factura->proveedor->nombre_empresa); ?></p>
            <p><strong>Empleado:</strong> <?php echo e($factura->empleado->nombre); ?></p>
            <p><strong>Subtotal:</strong> L. <?php echo e(number_format($factura->subtotal, 2)); ?></p>
            <p><strong>IVA:</strong> L. <?php echo e(number_format($factura->iva, 2)); ?></p>
            <p><strong>Total:</strong> L. <?php echo e(number_format($factura->total, 2)); ?></p>

            <hr>

            <h4>Productos</h4>
            <table class="table table-dark table-hover text-white mt-3">
                <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                    <th>Impuesto</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $factura->detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($detalle->producto->nombre); ?></td>
                        <td><?php echo e($detalle->cantidad); ?></td>
                        <td>L. <?php echo e(number_format($detalle->precio_unitario, 2)); ?></td>
                        <td>L. <?php echo e(number_format($detalle->producto->precio_venta ?? 0, 2)); ?></td>
                        <td><?php echo e($detalle->producto->impuesto ?? 0); ?>%</td>

                        <td>L. <?php echo e(number_format($detalle->cantidad * $detalle->precio_unitario, 2)); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <a href="<?php echo e(route('facturas-compra.index')); ?>" class="btn btn-danger mt-3">Volver</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\FullRepuestos\resources\views/facturaCompra/show.blade.php ENDPATH**/ ?>