

<?php $__env->startSection('content'); ?>
    <div class="container table-container">
        <h1 class="text-white mb-4">Registrar Factura de Venta</h1>

        
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        
        <div id="js-alert-message" style="display: none;" class="mb-3"></div>

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


            <div class="text-end">
                <button type="submit" class="btn btn-danger">Guardar factura</button>
                <button type="button" class="btn btn-danger" id="limpiarFormulario">Limpiar</button>

                <a href="<?php echo e(route('facturas.index')); ?>" class="btn btn-danger">Cancelar</a>
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
                                        <div class="duplicate-product-message text-danger mt-1" style="display:none;"></div>
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
            const clearButton = document.getElementById('limpiarFormulario');
            const jsAlertMessage = document.getElementById('js-alert-message');

            const tablaProductosBody = document.querySelector('#tablaProductos tbody');
            const productosSeleccionadosBody = document.querySelector('#productosSeleccionados tbody');

            // Array to hold the selected products
            let productosSeleccionadosArray = [];

            // Function to show JS error messages on the main form
            function showJsMessage(message, type = 'danger') {
                jsAlertMessage.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
                jsAlertMessage.style.display = 'block';
            }

            // Function to clear JS error messages from the main form
            function clearJsMessage() {
                jsAlertMessage.innerHTML = '';
                jsAlertMessage.style.display = 'none';
            }

            // Handles form submission validation
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);

            // Filters products in the modal table
            const buscarProductoInput = document.getElementById('buscarProducto');
            buscarProductoInput.addEventListener('input', function () {
                const filtro = this.value.toLowerCase();
                Array.from(tablaProductosBody.rows).forEach(row => {
                    const textoFila = row.innerText.toLowerCase();
                    row.style.display = textoFila.includes(filtro) ? '' : 'none';
                });
            });

            // Handles adding a product from the modal
            tablaProductosBody.addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-agregar-producto')) {
                    const btn = e.target;
                    const id = btn.dataset.id;
                    const row = btn.closest('tr');
                    const cantidadInput = row.querySelector('.cantidad-input');
                    const cantidad = parseInt(cantidadInput.value);
                    const messageDiv = row.querySelector('.duplicate-product-message');

                    // Clear any previous messages on this row
                    if (messageDiv) {
                        messageDiv.style.display = 'none';
                    }

                    // Check for invalid quantity
                    const stock = parseInt(btn.dataset.stock);
                    if (cantidad < 1 || cantidad > stock || isNaN(cantidad)) {
                        messageDiv.textContent = 'Cantidad inválida.';
                        messageDiv.style.display = 'block';
                        cantidadInput.classList.add('is-invalid');
                        // Make the message disappear after 3 seconds
                        setTimeout(() => {
                            messageDiv.style.display = 'none';
                        }, 3000);
                        return;
                    } else {
                        cantidadInput.classList.remove('is-invalid');
                    }

                    // Check if product is already added
                    if (productosSeleccionadosArray.some(p => p.id == id)) {
                        if (messageDiv) {
                            messageDiv.textContent = 'Este producto ya está agregado.';
                            messageDiv.style.display = 'block';
                            // Make the message disappear after 3 seconds
                            setTimeout(() => {
                                messageDiv.style.display = 'none';
                            }, 3000);
                        }
                        return;
                    }

                    // Create product object and add to array
                    const newProduct = {
                        id: id,
                        nombre: btn.dataset.nombre,
                        marca: btn.dataset.marca,
                        modelo: btn.dataset.modelo,
                        anio: btn.dataset.anio || '',
                        stock: stock,
                        cantidad: cantidad,
                        precio_unitario: parseFloat(btn.dataset.precio),
                        impuesto: parseFloat(btn.dataset.iva)
                    };
                    productosSeleccionadosArray.push(newProduct);

                    // Re-render table and update totals
                    renderSelectedProductsTable();
                    actualizarTotales();

                    // Close the modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('modalProductos'));
                    modal.hide();
                }
            });

            // Handles removing a product from the selected products table
            productosSeleccionadosBody.addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-eliminar-producto')) {
                    const row = e.target.closest('tr');
                    const productId = row.dataset.id;
                    const productIndex = productosSeleccionadosArray.findIndex(p => p.id == productId);

                    if (productIndex > -1) {
                        productosSeleccionadosArray.splice(productIndex, 1);
                        renderSelectedProductsTable();
                        actualizarTotales();
                    }
                }
            });

            // Handles updating quantity in the selected products table
            productosSeleccionadosBody.addEventListener('input', function (e) {
                if (e.target.classList.contains('cantidad-seleccionada')) {
                    const row = e.target.closest('tr');
                    const productId = row.dataset.id;
                    const newQuantity = parseInt(e.target.value);
                    const productToUpdate = productosSeleccionadosArray.find(p => p.id == productId);

                    clearJsMessage();

                    if (!productToUpdate) {
                        return;
                    }

                    if (newQuantity < 1 || newQuantity > productToUpdate.stock || isNaN(newQuantity)) {
                        showJsMessage('Cantidad inválida. Máximo disponible: ' + productToUpdate.stock);
                        e.target.value = productToUpdate.cantidad; // Revert to last valid value
                        return;
                    }

                    productToUpdate.cantidad = newQuantity;
                    renderSelectedProductsTable();
                    actualizarTotales();
                }
            });

            // Renders the selected products table from the array
            function renderSelectedProductsTable() {
                productosSeleccionadosBody.innerHTML = '';
                productosSeleccionadosArray.forEach((product, index) => {
                    const ivaLempiras = (product.precio_unitario * product.impuesto / 100) * product.cantidad;
                    const subtotal = (product.precio_unitario * product.cantidad) + ivaLempiras;

                    const fila = document.createElement('tr');
                    fila.dataset.id = product.id;
                    fila.innerHTML = `
                        <td>${index + 1}</td>
                        <td>
                            ${product.nombre}
                            <input type="hidden" name="detalles[${index}][producto_id]" value="${product.id}">
                        </td>
                        <td>${product.marca}</td>
                        <td>${product.modelo}</td>
                        <td>${product.anio}</td>
                        <td>
                            <input type="number" name="detalles[${index}][cantidad]" value="${product.cantidad}"
                                min="1" max="${product.stock}" class="form-control cantidad-seleccionada"
                                style="width: 80px;" required>
                        </td>
                        <td>
                            ${product.precio_unitario.toFixed(2)}
                            <input type="hidden" name="detalles[${index}][precio_unitario]" value="${product.precio_unitario.toFixed(2)}">
                        </td>
                        <td>
                            ${ivaLempiras.toFixed(2)}
                            <input type="hidden" name="detalles[${index}][iva]" value="${ivaLempiras.toFixed(2)}">
                        </td>
                        <td class="subtotal">${subtotal.toFixed(2)}</td>
                        <td><button type="button" class="btn btn-danger btn-sm btn-eliminar-producto">Eliminar</button></td>
                    `;
                    productosSeleccionadosBody.appendChild(fila);
                });
            }

            // Updates the totals on the form
            function actualizarTotales() {
                let subtotalTotal = 0;
                let ivaTotal = 0;

                productosSeleccionadosArray.forEach(p => {
                    const subtotalProducto = p.precio_unitario * p.cantidad;
                    const ivaProducto = subtotalProducto * (p.impuesto / 100);
                    subtotalTotal += subtotalProducto;
                    ivaTotal += ivaProducto;
                });

                document.getElementById('subtotal').textContent = subtotalTotal.toFixed(2);
                document.getElementById('totalIva').textContent = ivaTotal.toFixed(2);
                document.getElementById('total').textContent = (subtotalTotal + ivaTotal).toFixed(2);
            }

            // Handles cleaning the form
            clearButton.addEventListener('click', function () {
                form.reset();
                productosSeleccionadosArray = [];
                renderSelectedProductsTable();
                actualizarTotales();
                clearJsMessage();
                form.classList.remove('was-validated');
                document.querySelectorAll('#facturaForm .is-invalid, #facturaForm .text-danger, #facturaForm .invalid-feedback').forEach(el => el.style.display = 'none');
                document.querySelector('#facturaForm .alert-danger')?.remove();
            });

            // Resets the search filter and modal message when the modal is closed
            const modalProductosEl = document.getElementById('modalProductos');
            if (modalProductosEl) {
                modalProductosEl.addEventListener('hidden.bs.modal', function () {
                    buscarProductoInput.value = '';
                    Array.from(tablaProductosBody.rows).forEach(row => {
                        row.style.display = '';
                    });
                    document.querySelectorAll('.duplicate-product-message').forEach(el => el.style.display = 'none');
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/facturas/create.blade.php ENDPATH**/ ?>