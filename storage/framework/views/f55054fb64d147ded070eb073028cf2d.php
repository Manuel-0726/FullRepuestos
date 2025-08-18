

<?php $__env->startSection('title', 'Editar Factura de Venta'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="table-container">
            <h2 class="mb-4">Editar factura de venta #<?php echo e($factura->codigo); ?></h2>

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

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('facturas.update', $factura->id)); ?>" id="formFactura" novalidate>
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                
                <div class="mb-3">
                    <label for="cliente" class="form-label">Cliente</label>
                    <select name="cliente_id" id="cliente" class="form-select bg-dark text-white <?php $__errorArgs = ['cliente_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="">-- Seleccione un cliente --</option>
                        <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cliente->id); ?>" <?php echo e(old('cliente_id', $factura->cliente_id) == $cliente->id ? 'selected' : ''); ?>>
                                <?php echo e($cliente->nombre); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['cliente_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha"
                           value="<?php echo e(old('fecha', $factura->fecha ? $factura->fecha->format('Y-m-d') : '')); ?>"
                           class="form-control bg-dark text-white <?php $__errorArgs = ['fecha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           required>
                    <?php $__errorArgs = ['fecha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-3">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalProductos">
                        + Agregar/Modificar Producto
                    </button>
                </div>

                
                <div class="table-responsive mb-3">
                    <table class="table table-dark table-striped table-hover text-center align-middle" id="tablaProductos">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario (L.)</th>
                            <th>IVA (L.)</th>
                            <th>Subtotal (L.)</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                        <tr>
                            <th colspan="5" class="text-end">Total:</th>
                            <th id="totalFactura">L. 0.00</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <button type="submit" class="btn btn-danger">Actualizar Factura</button>

                <button type="reset" class="btn btn-danger">Restablecer</button>
                <a href="<?php echo e(route('facturas.index')); ?>" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>

    
    <div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="modalProductosLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProductosLabel">Seleccione Productos</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="buscarProducto" class="form-control mb-3" placeholder="Buscar producto...">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle" id="tablaModalProductos">
                            <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Año</th>
                                <th>Stock</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario (L.)</th>
                                <th>IVA (%)</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr data-id="<?php echo e($producto->id); ?>">
                                    <td><?php echo e($producto->nombre); ?></td>
                                    <td><?php echo e($producto->marca); ?></td>
                                    <td><?php echo e($producto->modelo); ?></td>
                                    <td><?php echo e($producto->anio); ?></td>
                                    <td><?php echo e($producto->stock); ?></td>
                                    <td><input type="number" min="1" max="<?php echo e($producto->stock); ?>" value="1" class="form-control cantidad-input" style="width: 80px;"></td>
                                    <td><?php echo e(number_format($producto->precio_venta,2)); ?></td>
                                    <td><?php echo e($producto->impuesto); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm btn-agregar-producto"
                                                data-id="<?php echo e($producto->id); ?>"
                                                data-nombre="<?php echo e($producto->nombre); ?>"
                                                data-marca="<?php echo e($producto->marca); ?>"
                                                data-modelo="<?php echo e($producto->modelo); ?>"
                                                data-anio="<?php echo e($producto->anio); ?>"
                                                data-stock="<?php echo e($producto->stock); ?>"
                                                data-precio="<?php echo e($producto->precio_venta); ?>"
                                                data-iva="<?php echo e($producto->impuesto); ?>">
                                            Agregar
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('formFactura');
            const tbody = document.querySelector('#tablaProductos tbody');
            const totalFacturaEl = document.getElementById('totalFactura');
            const tablaModal = document.querySelector('#tablaModalProductos tbody');

            let productosSeleccionados = <?php echo json_encode($factura->detalles->map(function($detalle){
        return [
            'id' => $detalle->producto_id,
            'nombre' => $detalle->producto?->nombre ?? 'Producto Desconocido',
            'marca' => $detalle->producto?->marca ?? '',
            'modelo' => $detalle->producto?->modelo ?? '',
            'anio' => $detalle->producto?->anio ?? '',
            'cantidad' => $detalle->cantidad,
            'precio_unitario' => floatval($detalle->precio_unitario),
            'iva' => floatval($detalle->iva)
        ];
    })); ?>;

            function calcularSubtotal(precio, cantidad, ivaPorcentaje) {
                const subtotal = parseFloat(precio) * parseInt(cantidad);
                const iva = subtotal * (parseFloat(ivaPorcentaje) / 100);
                return subtotal + iva;
            }

            function calcularIva(precio, cantidad, ivaPorcentaje) {
                const subtotal = parseFloat(precio) * parseInt(cantidad);
                return subtotal * (parseFloat(ivaPorcentaje) / 100);
            }

            function actualizarTotal() {
                let total = productosSeleccionados.reduce((acc, p) => acc + calcularSubtotal(p.precio_unitario, p.cantidad, p.iva), 0);
                totalFacturaEl.textContent = 'L. ' + total.toFixed(2);
            }

            function renderizarTabla() {
                tbody.innerHTML = '';
                if(productosSeleccionados.length === 0){
                    tbody.innerHTML = `<tr><td colspan="7">No hay productos seleccionados.</td></tr>`;
                    actualizarTotal();
                    return;
                }

                productosSeleccionados.forEach((p, index) => {
                    const ivaEnLempiras = calcularIva(p.precio_unitario, p.cantidad, p.iva);
                    const total = calcularSubtotal(p.precio_unitario, p.cantidad, p.iva);

                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                <td>${index + 1}</td>
                <td>${p.nombre}<input type="hidden" name="detalles[${index}][producto_id]" value="${p.id}"></td>
                <td>${p.cantidad}<input type="hidden" name="detalles[${index}][cantidad]" value="${p.cantidad}"></td>
                <td>L. ${parseFloat(p.precio_unitario).toFixed(2)}<input type="hidden" name="detalles[${index}][precio_unitario]" value="${p.precio_unitario}"></td>
                <td>L. ${ivaEnLempiras.toFixed(2)}<input type="hidden" name="detalles[${index}][iva]" value="${p.iva}"></td>
                <td>L. ${total.toFixed(2)}</td>
                <td><button type="button" class="btn btn-danger btn-sm eliminar" data-index="${index}">Eliminar</button></td>
            `;
                    tbody.appendChild(tr);
                });

                actualizarTotal();
            }

            // Eliminar producto
            tbody.addEventListener('click', function(e){
                if(e.target.classList.contains('eliminar')){
                    const index = parseInt(e.target.dataset.index);
                    productosSeleccionados.splice(index,1);
                    renderizarTabla();
                }
            });

            // Agregar producto desde modal (solo un listener)
            tablaModal.addEventListener('click', function(e){
                if(e.target.classList.contains('btn-agregar-producto')){
                    const btn = e.target;
                    const id = parseInt(btn.dataset.id);
                    const cantidadInput = btn.closest('tr').querySelector('.cantidad-input');
                    const cantidad = parseInt(cantidadInput.value);
                    const stock = parseInt(btn.dataset.stock);

                    if(cantidad < 1 || cantidad > stock){
                        alert('Cantidad inválida');
                        return;
                    }

                    const existente = productosSeleccionados.find(p => p.id === id);
                    if(existente){
                        existente.cantidad = cantidad;
                    } else {
                        productosSeleccionados.push({
                            id: id,
                            nombre: btn.dataset.nombre,
                            marca: btn.dataset.marca,
                            modelo: btn.dataset.modelo,
                            anio: btn.dataset.anio,
                            cantidad: cantidad,
                            precio_unitario: parseFloat(btn.dataset.precio),
                            iva: parseFloat(btn.dataset.iva)
                        });
                    }

                    renderizarTabla();
                }
            });

            // Validación al enviar formulario
            form.addEventListener('submit', function(e){
                if(productosSeleccionados.length === 0){
                    e.preventDefault();
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-danger alert-dismissible fade show mt-3';
                    alertDiv.innerHTML = `Debe agregar al menos un producto.<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
                    form.prepend(alertDiv);
                    setTimeout(()=> alertDiv.remove(),3000);
                }
            });

            renderizarTabla();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\FullRepuestos\resources\views/facturas/edit.blade.php ENDPATH**/ ?>