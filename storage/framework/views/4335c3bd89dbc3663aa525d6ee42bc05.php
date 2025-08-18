

<?php $__env->startSection('content'); ?>
    <div class="container table-container">
        <h1 class="text-white mb-4">Registrar Factura de Venta</h1>

        
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <form action="<?php echo e(route('facturas.store')); ?>" method="POST" id="facturaForm" class="needs-validation" novalidate>
            <?php echo csrf_field(); ?>

            
            <div class="mb-3">
                <label for="cliente_id" class="form-label text-white">Cliente</label>
                <select name="cliente_id" id="cliente_id"
                        class="form-select <?php $__errorArgs = ['cliente_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value=""> Seleccione un cliente </option>
                    <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cliente->id); ?>" <?php echo e(old('cliente_id') == $cliente->id ? 'selected' : ''); ?>>
                            <?php echo e($cliente->nombre); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['cliente_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">Debe seleccionar un cliente.</div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="mb-3">
                <label for="fecha" class="form-label text-white">Fecha</label>
                <input type="date" id="fecha" name="fecha"
                       class="form-control <?php $__errorArgs = ['fecha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       value="<?php echo e(old('fecha', date('Y-m-d'))); ?>" required>
                <?php $__errorArgs = ['fecha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">Debe ingresar una fecha válida.</div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#modalProductos">
                Seleccionar productos
            </button>
            <?php $__errorArgs = ['detalles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="alert alert-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            
            <div class="table-responsive mb-4">
                <table class="table table-dark table-hover align-middle" id="productosSeleccionados">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario (L.)</th>
                        <th>IVA (L.)</th>
                        <th>Subtotal (L.)</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
            </div>

            
            <div class="text-end text-white mb-4">
                <p>Subtotal: L. <span id="subtotal">0.00</span></p>
                <p>IVA: L. <span id="totalIva">0.00</span></p>
                <h4>Total: L. <span id="total">0.00</span></h4>
            </div>


            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-danger">Guardar factura</button>
                <a href="<?php echo e(route('facturas.index')); ?>" class="btn btn-danger">Volver</a>
            </div>
        </form>
    </div>

    
    <div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="modalProductosLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProductosLabel">Seleccione Productos</h5>
                    <button type="button" class="btn-danger" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="buscarProducto" class="form-control mb-3" placeholder="Buscar producto...">

                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle" id="tablaProductos">
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
                                <tr>
                                    <td><?php echo e($producto->nombre); ?></td>
                                    <td><?php echo e($producto->marca); ?></td>
                                    <td><?php echo e($producto->modelo); ?></td>
                                    <td><?php echo e($producto->anio); ?></td>
                                    <td><?php echo e($producto->stock); ?></td>
                                    <td>
                                        <input type="number" min="1" max="<?php echo e($producto->stock); ?>" value="1"
                                               class="form-control cantidad-input <?php $__errorArgs = ['detalles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               style="width: 80px;" required>
                                        <div class="invalid-feedback">Ingrese una cantidad válida.</div>
                                    </td>
                                    <td><?php echo e(number_format($producto->precio_venta, 2)); ?></td>
                                    <td><?php echo e($producto->impuesto); ?></td>
                                    <td>
                                        <button type="button"
                                                class="btn btn-success btn-sm btn-agregar-producto"
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
            const form = document.getElementById('facturaForm');
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);

            const buscarProductoInput = document.getElementById('buscarProducto');
            const tablaProductosBody = document.querySelector('#tablaProductos tbody');
            const productosSeleccionadosBody = document.querySelector('#productosSeleccionados tbody');

            let indiceDetalle = 0;

            buscarProductoInput.addEventListener('input', function () {
                const filtro = this.value.toLowerCase();
                Array.from(tablaProductosBody.rows).forEach(row => {
                    const textoFila = row.innerText.toLowerCase();
                    row.style.display = textoFila.includes(filtro) ? '' : 'none';
                });
            });

            tablaProductosBody.addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-agregar-producto')) {
                    const btn = e.target;
                    const id = btn.dataset.id;
                    const nombre = btn.dataset.nombre;
                    const marca = btn.dataset.marca;
                    const modelo = btn.dataset.modelo;
                    const anio = btn.dataset.anio || '';
                    const stock = parseInt(btn.dataset.stock);
                    const precio = parseFloat(btn.dataset.precio);
                    const impuesto = parseFloat(btn.dataset.iva);
                    const cantidadInput = btn.closest('tr').querySelector('.cantidad-input');
                    const cantidad = parseInt(cantidadInput.value);

                    if (cantidad < 1 || cantidad > stock) {
                        cantidadInput.classList.add('is-invalid');
                        return;
                    } else {
                        cantidadInput.classList.remove('is-invalid');
                    }

                    if (productosSeleccionadosBody.querySelector(`tr[data-id="${id}"]`)) {
                        alert('Este producto ya está agregado.');
                        return;
                    }

                    const ivaLempiras = (precio * impuesto / 100) * cantidad;
                    const subtotal = precio * cantidad;

                    const fila = document.createElement('tr');
                    fila.dataset.id = id;
                    fila.innerHTML = `
                        <td>${nombre}<input type="hidden" name="detalles[${indiceDetalle}][producto_id]" value="${id}"></td>
                        <td>${marca}</td>
                        <td>${modelo}</td>
                        <td>${anio}</td>
                        <td><input type="number" name="detalles[${indiceDetalle}][cantidad]" value="${cantidad}" min="1" max="${stock}" class="form-control cantidad-seleccionada" style="width: 80px;" required></td>
                        <td>${precio.toFixed(2)}<input type="hidden" name="detalles[${indiceDetalle}][precio_unitario]" value="${precio.toFixed(2)}"></td>
                        <td>${ivaLempiras.toFixed(2)}<input type="hidden" name="detalles[${indiceDetalle}][iva]" value="${ivaLempiras.toFixed(2)}"></td>
                        <td class="subtotal">${(subtotal + ivaLempiras).toFixed(2)}</td>
                        <td><button type="button" class="btn btn-danger btn-sm btn-eliminar-producto">Eliminar</button></td>
                    `;
                    productosSeleccionadosBody.appendChild(fila);

                    indiceDetalle++;
                    actualizarTotales();
                }
            });

            productosSeleccionadosBody.addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-eliminar-producto')) {
                    e.target.closest('tr').remove();
                    actualizarTotales();
                }
            });

            productosSeleccionadosBody.addEventListener('input', function (e) {
                if (e.target.classList.contains('cantidad-seleccionada')) {
                    const fila = e.target.closest('tr');
                    const cantidad = parseInt(e.target.value);
                    const max = parseInt(e.target.max);

                    if (cantidad < 1 || cantidad > max || isNaN(cantidad)) {
                        alert('Cantidad inválida.');
                        e.target.value = 1;
                        return;
                    }

                    const precio = parseFloat(fila.querySelector('input[name$="[precio_unitario]"]').value);
                    const ivaPorUnidad = parseFloat(fila.querySelector('input[name$="[iva]"]').value) / parseInt(fila.querySelector('input[name$="[cantidad]"]').value);

                    const ivaTotal = ivaPorUnidad * cantidad;
                    const subtotal = precio * cantidad;

                    fila.querySelector('input[name$="[iva]"]').value = ivaTotal.toFixed(2);
                    fila.querySelector('td.subtotal').textContent = (subtotal + ivaTotal).toFixed(2);

                    actualizarTotales();
                }
            });

            function actualizarTotales() {
                let subtotalTotal = 0;
                let ivaTotal = 0;

                productosSeleccionadosBody.querySelectorAll('tr').forEach(fila => {
                    const cantidad = parseInt(fila.querySelector('input[name$="[cantidad]"]').value);
                    const precio = parseFloat(fila.querySelector('input[name$="[precio_unitario]"]').value);
                    const iva = parseFloat(fila.querySelector('input[name$="[iva]"]').value);

                    subtotalTotal += precio * cantidad;
                    ivaTotal += iva;
                });

                document.getElementById('subtotal').textContent = subtotalTotal.toFixed(2);
                document.getElementById('totalIva').textContent = ivaTotal.toFixed(2);
                document.getElementById('total').textContent = (subtotalTotal + ivaTotal).toFixed(2);
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\FullRepuestos\resources\views/facturas/create.blade.php ENDPATH**/ ?>