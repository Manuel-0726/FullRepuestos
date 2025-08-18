<!-- resources/views/facturas/modal-producto.blade.php -->

<div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="modalProductosLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header d-block">
                <h5 class="modal-title" id="modalProductosLabel">Seleccionar Productos</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <table class="table table-dark table-hover text-center align-middle">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Stock</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario (L.)</th>
                        <th>IVA (L.)</th>
                        <th>Subtotal (L.)</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody id="modalProductosTbody">
                    <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-id="<?php echo e($producto->id); ?>">
                            <td><?php echo e($producto->nombre); ?></td>
                            <td><?php echo e($producto->marca); ?></td>
                            <td><?php echo e($producto->modelo); ?></td>
                            <td><?php echo e($producto->anio); ?></td>
                            <td><?php echo e($producto->stock); ?></td>
                            <td>
                                <input type="number" min="1" value="1"
                                       class="form-control form-control-sm bg-dark text-white cantidad-venta-modal"
                                       data-id="<?php echo e($producto->id); ?>" data-stock="<?php echo e($producto->stock); ?>">
                            </td>
                            <td>
                                <input type="number" min="0" step="0.01" value="<?php echo e(number_format($producto->precio_unitario, 2)); ?>"
                                       class="form-control form-control-sm bg-dark text-white precio-unitario-modal"
                                       data-id="<?php echo e($producto->id); ?>">
                            </td>
                            <td>
                                <input type="number" min="0" step="0.01" value="<?php echo e(number_format($producto->iva, 2)); ?>"
                                       class="form-control form-control-sm bg-dark text-white iva-modal"
                                       data-id="<?php echo e($producto->id); ?>">
                            </td>
                            <td class="subtotal-modal">L. <?php echo e(number_format($producto->precio_unitario + $producto->iva, 2)); ?></td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm agregar-producto" data-id="<?php echo e($producto->id); ?>">
                                    Agregar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalProductos = document.getElementById('modalProductos');
        const modalBootstrap = bootstrap.Modal.getOrCreateInstance(modalProductos);
        const productosSeleccionadosEvent = new Event('productSelected', { bubbles: true, cancelable: true });

        modalProductos.querySelectorAll('.agregar-producto').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');

                // Obtener valores de inputs asociados
                const row = this.closest('tr');
                const nombre = row.querySelector('td:first-child').textContent.trim();
                const cantidadInput = row.querySelector('.cantidad-venta-modal[data-id="' + id + '"]');
                const precioInput = row.querySelector('.precio-unitario-modal[data-id="' + id + '"]');
                const ivaInput = row.querySelector('.iva-modal[data-id="' + id + '"]');

                const cantidad = parseInt(cantidadInput.value) || 1;
                const precio_unitario = parseFloat(precioInput.value) || 0;
                const iva = parseFloat(ivaInput.value) || 0;

                if (cantidad < 1) {
                    alert('La cantidad debe ser al menos 1.');
                    cantidadInput.focus();
                    return;
                }

                if (cantidad > parseInt(cantidadInput.getAttribute('data-stock'))) {
                    alert('La cantidad no puede ser mayor al stock disponible.');
                    cantidadInput.focus();
                    return;
                }

                // Crear objeto producto para enviar en evento
                const productoSeleccionado = {
                    id: parseInt(id),
                    nombre: nombre,
                    cantidad: cantidad,
                    precio_unitario: precio_unitario,
                    iva: iva
                };

                // Lanzar evento personalizado para que el formulario principal escuche
                const event = new CustomEvent('productSelected', { detail: productoSeleccionado, bubbles: true });
                document.dispatchEvent(event);

                // Mover foco al botón cerrar para evitar el warning de aria-hidden en elemento con foco
                const botonCerrar = modalProductos.querySelector('.btn-close');
                if (botonCerrar) {
                    botonCerrar.focus();
                }

                // Cerrar modal
                modalBootstrap.hide();
            });
        });
    });
</script>

<?php /**PATH C:\Users\manue\PhpstormProjects\FullRepuestos\resources\views/facturas/modal-producto.blade.php ENDPATH**/ ?>