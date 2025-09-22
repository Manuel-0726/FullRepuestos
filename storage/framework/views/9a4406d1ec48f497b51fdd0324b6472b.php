
<div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="modalProductosLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProductosLabel">Seleccionar Producto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <table class="table table-dark table-hover table-bordered text-center align-middle">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Descuento (%)</th>
                        <th>IVA (%)</th>
                        <th>Cantidad</th>
                        <th>Agregar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="fila-producto-<?php echo e($producto->id); ?>">
                            <td><?php echo e($producto->nombre); ?></td>
                            <td><?php echo e($producto->marca); ?></td>
                            <td>
                                <input type="number" step="0.01" class="form-control form-control-sm text-center"
                                       id="precio_compra_<?php echo e($producto->id); ?>"
                                       value="<?php echo e($producto->precio_compra ?? 0); ?>">
                            </td>
                            <td>
                                <input type="number" step="0.01" class="form-control form-control-sm text-center"
                                       id="precio_venta_<?php echo e($producto->id); ?>"
                                       value="0">
                            </td>
                            <td>
                                <input type="number" step="0.01" class="form-control form-control-sm text-center"
                                       id="descuento_<?php echo e($producto->id); ?>"
                                       value="<?php echo e($producto->descuento ?? 0); ?>">
                            </td>
                            <td>
                                <input type="number" step="0.01" min="0" max="100" class="form-control form-control-sm text-center"
                                       id="impuesto_<?php echo e($producto->id); ?>"
                                       value="<?php echo e($producto->impuesto ?? 0); ?>">
                            </td>
                            <td>
                                <input type="number" min="1" class="form-control form-control-sm text-center"
                                       id="cantidad_<?php echo e($producto->id); ?>"
                                       value="1">
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm"
                                        onclick="agregarProductoDesdeModal(<?php echo e($producto->id); ?>)">
                                    Agregar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/facturaCompra/modal-factura-compra.blade.php ENDPATH**/ ?>