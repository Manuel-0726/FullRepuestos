

<?php $__env->startSection('content'); ?>
    <div class="container text-white-justify-center">

        <h2 class="mb-3">Registrar factura de compra</h2> <!-- margen inferior pequeño -->


    </div>


    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

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

    <form action="<?php echo e(route('facturas-compra.store')); ?>" method="POST" id="formFactura">
        <?php echo csrf_field(); ?>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="empleado_id" class="form-label">Empleado</label>
                <select name="empleado_id" id="empleado_id" class="form-select">
                    <option value="">Seleccione un empleado</option>
                    <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($empleado->id); ?>" <?php echo e(old('empleado_id') == $empleado->id ? 'selected' : ''); ?>>
                            <?php echo e($empleado->nombre); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="text-danger mt-1" id="empleado_id-error" style="display:none;">Seleccione un empleado.</div>
            </div>
            <div class="col-md-6">
                <label for="proveedor_id" class="form-label">Proveedor</label>
                <select name="proveedor_id" id="proveedor_id" class="form-select">
                    <option value="">Seleccione un proveedor</option>
                    <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($proveedor->id); ?>" <?php echo e(old('proveedor_id') == $proveedor->id ? 'selected' : ''); ?>>
                            <?php echo e($proveedor->nombre_empresa); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="text-danger mt-1" id="proveedor_id-error" style="display:none;">Seleccione un proveedor.</div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="codigo" class="form-label">Código de Factura</label>
                <input type="text" name="codigo" id="codigo" class="form-control" value="<?php echo e(old('codigo')); ?>" maxlength="12">
                <div class="text-danger mt-1" id="codigo-error" style="display:none;">El codigo de la factura es necesario.</div>
            </div>
            <div class="col-md-6">
                <label for="fecha" class="form-label">Fecha de Compra</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo e(old('fecha', date('Y-m-d'))); ?>">
                <div class="text-danger mt-1" id="fecha-error" style="display:none;">Este campo es necesario.</div>
            </div>
        </div>

        <div class="mb-3 text-end">
            <button type="button" class="btn btn-danger" id="agregar-productos-btn" data-bs-toggle="modal" data-bs-target="#modalProductos">
                Agregar Productos
            </button>
        </div>

        <div class="table-responsive table-container mb-4">
            <table class="table table-dark table-bordered align-middle text-center" id="tablaProductos">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                    <th>Descuento</th>
                    <th>IVA</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div class="text-danger mb-3" id="productos-error" style="display:none;">
            Debe agregar al menos un producto para guardar la factura.
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea name="observaciones" id="observaciones" class="form-control" rows="3" maxlength="250"><?php echo e(old('observaciones')); ?></textarea>
                <div class="text-danger mt-1" id="observaciones-error" style="display:none;">El campo no puede tener espacios al inicio y debe tener un máximo de 250 caracteres.</div>
            </div>
            <div class="col-md-8">
                <div class="row text-end">
                    <div class="col-6"><strong>Subtotal Factura:</strong></div>
                    <div class="col-6"><span id="subtotalFactura">0.00</span></div>
                    <div class="col-6"><strong>IVA Total Factura:</strong></div>
                    <div class="col-6"><span id="ivaTotalFactura">0.00</span></div>
                    <div class="col-6"><strong>Total Factura:</strong></div>
                    <div class="col-6"><span id="totalFactura">0.00</span></div>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-danger">Guardar factura</button>
            <button type="button" class="btn btn-danger" id="limpiarFormulario">Limpiar</button>
            <a href="<?php echo e(route('facturas-compra.index')); ?>" class="btn btn-danger">
                Cancelar
            </a>
        </div>
    </form>
    </div>

    
    <div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="modalProductosLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProductosLabel">Seleccionar y Agregar Productos</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" id="filtro-productos" class="form-control" placeholder="Buscar producto...">
                        <div id="filtro-mensaje" class="text-info mt-2" style="display:none;">No se encontraron productos.</div>
                    </div>
                    <div id="modal-mensaje" class="alert d-none" role="alert"></div>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle text-center" id="tablaModalProductos">
                            <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Descuento (%)</th>
                                <th>IVA (%)</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($producto->nombre); ?></td>
                                    <td>
                                        <input type="number" id="cantidad_<?php echo e($producto->id); ?>" class="form-control" value="1" min="1" required style="width: 80px;">
                                        <div class="text-danger mt-1" id="cantidad_<?php echo e($producto->id); ?>-error" style="display:none;"></div>
                                    </td>
                                    <td>
                                        <input type="number" id="precio_compra_<?php echo e($producto->id); ?>" class="form-control" value="<?php echo e($producto->precio_compra); ?>" min="0" step="0.01" required style="width: 100px;">
                                        <div class="text-danger mt-1" id="precio_compra_<?php echo e($producto->id); ?>-error" style="display:none;"></div>
                                    </td>
                                    <td>
                                        <input type="number" id="precio_venta_<?php echo e($producto->id); ?>" class="form-control" value="<?php echo e($producto->precio_venta); ?>" min="0" step="0.01" required style="width: 100px;">
                                        <div class="text-danger mt-1" id="precio_venta_<?php echo e($producto->id); ?>-error" style="display:none;"></div>
                                    </td>
                                    <td>
                                        <input type="number" id="descuento_<?php echo e($producto->id); ?>" class="form-control" value="0" min="0" step="0.01" required style="width: 80px;">
                                        <div class="text-danger mt-1" id="descuento_<?php echo e($producto->id); ?>-error" style="display:none;"></div>
                                    </td>
                                    <td>
                                        <input type="number" id="impuesto_<?php echo e($producto->id); ?>" class="form-control" value="0" min="0" step="0.01" required style="width: 80px;">
                                        <div class="text-danger mt-1" id="impuesto_<?php echo e($producto->id); ?>-error" style="display:none;"></div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" onclick="agregarProductoDesdeModal(<?php echo e($producto->id); ?>)">
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
        const productosDisponibles = <?php echo json_encode($productos, 15, 512) ?>;
        let productosSeleccionados = [];

        document.addEventListener('DOMContentLoaded', function () {
            const oldDetalles = <?php echo json_encode(old('detalles'), 15, 512) ?>;
            if (oldDetalles && oldDetalles.length > 0) {
                oldDetalles.forEach(oldDetalle => {
                    const productoOriginal = productosDisponibles.find(p => p.id == oldDetalle.producto_id);
                    if (productoOriginal) {
                        const productoRestaurado = { ...productoOriginal,
                            cantidad: parseInt(oldDetalle.cantidad),
                            precio_compra: parseFloat(oldDetalle.precio_unitario),
                            precio_venta: parseFloat(oldDetalle.precio_venta),
                            descuento: parseFloat(oldDetalle.descuento) || 0,
                            impuesto: parseFloat(oldDetalle.impuesto) || 0,
                        };
                        productosSeleccionados.push(productoRestaurado);
                    }
                });
                renderizarTabla();
                actualizarTotales();
            }

            const botonAbrirModal = document.getElementById('agregar-productos-btn');
            const modalProductos = document.getElementById('modalProductos');

            if (modalProductos) {
                modalProductos.addEventListener('hidden.bs.modal', function () {
                    // Limpiar el filtro y mostrar todos los productos al cerrar el modal
                    document.getElementById('filtro-productos').value = '';
                    const filas = document.querySelectorAll('#tablaModalProductos tbody tr');
                    filas.forEach(fila => fila.style.display = '');
                    document.getElementById('filtro-mensaje').style.display = 'none';

                    if (botonAbrirModal) {
                        botonAbrirModal.focus();
                    }
                });
            }

            // Lógica para el filtro de productos
            document.getElementById('filtro-productos').addEventListener('input', function(e) {
                const filtro = e.target.value.toLowerCase();
                const filas = document.querySelectorAll('#tablaModalProductos tbody tr');
                let productosVisibles = 0;
                filas.forEach(fila => {
                    const nombreProducto = fila.querySelector('td:first-child').textContent.toLowerCase();
                    if (nombreProducto.includes(filtro)) {
                        fila.style.display = '';
                        productosVisibles++;
                    } else {
                        fila.style.display = 'none';
                    }
                });

                if (productosVisibles === 0 && filtro.length > 0) {
                    document.getElementById('filtro-mensaje').style.display = 'block';
                } else {
                    document.getElementById('filtro-mensaje').style.display = 'none';
                }
            });
        });

        function agregarProductoDesdeModal(productoId) {
            const producto = productosDisponibles.find(p => p.id === productoId);
            const productosError = document.getElementById('productos-error');
            const modalTablaBody = document.querySelector('#tablaModalProductos tbody');
            const modalMensaje = document.getElementById('modal-mensaje');
            const modalProductos = document.getElementById('modalProductos');
            const modal = bootstrap.Modal.getInstance(modalProductos) || new bootstrap.Modal(modalProductos);

            // Limpiar los mensajes de error existentes en el modal
            modalTablaBody.querySelectorAll('.text-danger').forEach(el => {
                el.style.display = 'none';
            });
            modalTablaBody.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });

            if (!producto) {
                console.error('Error: Producto no encontrado.');
                return;
            }

            const cantidadInput = document.getElementById(`cantidad_${productoId}`);
            const precioCompraInput = document.getElementById(`precio_compra_${productoId}`);
            const precioVentaInput = document.getElementById(`precio_venta_${productoId}`);
            const descuentoInput = document.getElementById(`descuento_${productoId}`);
            const impuestoInput = document.getElementById(`impuesto_${productoId}`);

            const cantidadError = document.getElementById(`cantidad_${productoId}-error`);
            const precioCompraError = document.getElementById(`precio_compra_${productoId}-error`);
            const precioVentaError = document.getElementById(`precio_venta_${productoId}-error`);
            const descuentoError = document.getElementById(`descuento_${productoId}-error`);
            const impuestoError = document.getElementById(`impuesto_${productoId}-error`);

            let valid = true;

            const cantidad = parseInt(cantidadInput.value);
            const precioCompra = parseFloat(precioCompraInput.value);
            const precioVenta = parseFloat(precioVentaInput.value);
            const descuento = parseFloat(descuentoInput.value);
            const impuesto = parseFloat(impuestoInput.value);

            if (cantidad <= 0 || isNaN(cantidad)) {
                cantidadInput.classList.add('is-invalid');
                cantidadError.textContent = 'Debe ser un número mayor a cero.';
                cantidadError.style.display = 'block';
                valid = false;
            }

            if (precioCompra < 0 || isNaN(precioCompra)) {
                precioCompraInput.classList.add('is-invalid');
                precioCompraError.textContent = 'No puede ser un valor negativo.';
                precioCompraError.style.display = 'block';
                valid = false;
            }

            if (precioVenta < 0 || isNaN(precioVenta)) {
                precioVentaInput.classList.add('is-invalid');
                precioVentaError.textContent = 'No puede ser un valor negativo.';
                precioVentaError.style.display = 'block';
                valid = false;
            }

            if (descuento < 0 || isNaN(descuento)) {
                descuentoInput.classList.add('is-invalid');
                descuentoError.textContent = 'No puede ser un valor negativo.';
                descuentoError.style.display = 'block';
                valid = false;
            }

            if (impuesto < 0 || isNaN(impuesto)) {
                impuestoInput.classList.add('is-invalid');
                impuestoError.textContent = 'No puede ser un valor negativo.';
                impuestoError.style.display = 'block';
                valid = false;
            }

            if (productosSeleccionados.find(p => p.id === producto.id)) {
                modalMensaje.textContent = 'Este producto ya ha sido agregado.';
                modalMensaje.classList.remove('d-none', 'alert-success');
                modalMensaje.classList.add('alert-danger');
                setTimeout(() => {
                    modalMensaje.classList.add('d-none');
                }, 3000);
                valid = false;
            }

            if (!valid) {
                return;
            }

            // Limpiar errores si la validación es exitosa
            productosError.style.display = 'none';

            producto.cantidad = cantidad;
            producto.precio_compra = precioCompra;
            producto.precio_venta = precioVenta;
            producto.descuento = descuento;
            producto.impuesto = impuesto;

            productosSeleccionados.push(producto);
            renderizarTabla();
            actualizarTotales();

            modal.hide();
        }

        function actualizarTotales() {
            let subtotal = 0;
            let ivaTotal = 0;
            let totalFactura = 0;

            productosSeleccionados.forEach(p => {
                let cantidad = parseFloat(p.cantidad) || 0;
                let precio = parseFloat(p.precio_compra) || 0;
                let descuento = parseFloat(p.descuento || 0) || 0;
                let iva = parseFloat(p.impuesto || 0) || 0;

                let subtotalProducto = (cantidad * precio) - descuento;
                let ivaProducto = subtotalProducto * (iva / 100);

                subtotal += subtotalProducto;
                ivaTotal += ivaProducto;
            });

            totalFactura = subtotal + ivaTotal;

            document.getElementById('subtotalFactura').innerText = subtotal.toFixed(2);
            document.getElementById('ivaTotalFactura').innerText = ivaTotal.toFixed(2);
            document.getElementById('totalFactura').innerText = totalFactura.toFixed(2);
        }

        function renderizarTabla() {
            const tbody = document.querySelector('#tablaProductos tbody');
            tbody.innerHTML = '';

            if (productosSeleccionados.length === 0) {
                document.getElementById('productos-error').style.display = 'block';
            } else {
                document.getElementById('productos-error').style.display = 'none';
            }

            productosSeleccionados.forEach((producto, index) => {
                let row = document.createElement('tr');
                let subtotalProducto = ((producto.cantidad * producto.precio_compra) - producto.descuento);
                let ivaProducto = subtotalProducto * (producto.impuesto / 100);
                let totalProducto = subtotalProducto + ivaProducto;

                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>
                        ${producto.nombre}
                        <input type="hidden" name="detalles[${index}][producto_id]" value="${producto.id}">
                        <input type="hidden" name="detalles[${index}][cantidad]" value="${producto.cantidad}">
                        <input type="hidden" name="detalles[${index}][precio_unitario]" value="${producto.precio_compra}">
                        <input type="hidden" name="detalles[${index}][precio_venta]" value="${producto.precio_venta}">
                        <input type="hidden" name="detalles[${index}][descuento]" value="${producto.descuento}">
                        <input type="hidden" name="detalles[${index}][impuesto]" value="${producto.impuesto}">
                    </td>
                    <td>${producto.cantidad}</td>
                    <td>${(producto.precio_compra).toFixed(2)}</td>
                    <td>${(producto.precio_venta).toFixed(2)}</td>
                    <td>${(producto.descuento).toFixed(2)}</td>
                    <td>${producto.impuesto}%</td>
                    <td>${(totalProducto).toFixed(2)}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarProducto(${index})">Eliminar</button></td>
                `;
                tbody.appendChild(row);
            });
        }

        function eliminarProducto(index) {
            productosSeleccionados.splice(index, 1);
            renderizarTabla();
            actualizarTotales();
        }

        document.getElementById('formFactura').addEventListener('submit', function(e) {
            let isValid = true;

            // Campos de selección
            const camposSelect = ['empleado_id', 'proveedor_id'];
            camposSelect.forEach(campoId => {
                const campo = document.getElementById(campoId);
                const errorDiv = document.getElementById(`${campoId}-error`);

                if (campo.value.trim() === '') {
                    campo.classList.add('is-invalid');
                    errorDiv.style.display = 'block';
                    isValid = false;
                } else {
                    campo.classList.remove('is-invalid');
                    errorDiv.style.display = 'none';
                }
            });

            // Campo de fecha
            const fecha = document.getElementById('fecha');
            const fechaError = document.getElementById('fecha-error');
            if (fecha.value === '') {
                fecha.classList.add('is-invalid');
                fechaError.style.display = 'block';
                isValid = false;
            } else {
                fecha.classList.remove('is-invalid');
                fechaError.style.display = 'none';
            }

            // Campo de código
            const codigo = document.getElementById('codigo');
            const codigoError = document.getElementById('codigo-error');
            const codigoValue = codigo.value;
            if (codigoValue.trim() === '' || codigoValue.startsWith(' ') || codigoValue.length > 12) {
                codigo.classList.add('is-invalid');
                codigoError.style.display = 'block';
                isValid = false;
            } else {
                codigo.classList.remove('is-invalid');
                codigoError.style.display = 'none';
            }

            // Campo de observaciones
            const observaciones = document.getElementById('observaciones');
            const observacionesError = document.getElementById('observaciones-error');
            const observacionesValue = observaciones.value;
            if (observacionesValue.startsWith(' ') || observacionesValue.length > 250) {
                observaciones.classList.add('is-invalid');
                observacionesError.style.display = 'block';
                isValid = false;
            } else {
                observaciones.classList.remove('is-invalid');
                observacionesError.style.display = 'none';
            }

            // Validación de productos
            const productosError = document.getElementById('productos-error');
            if (productosSeleccionados.length === 0) {
                productosError.style.display = 'block';
                isValid = false;
            } else {
                productosError.style.display = 'none';
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        // Limpieza de campos al escribir
        document.getElementById('codigo').addEventListener('input', function() {
            this.value = this.value.trimStart();
        });

        document.getElementById('observaciones').addEventListener('input', function() {
            this.value = this.value.trimStart();
        });


        document.getElementById('limpiarFormulario').addEventListener('click', function() {
            // Limpiar los campos del formulario
            document.getElementById('formFactura').reset();

            // Limpiar la tabla de productos
            productosSeleccionados = [];
            renderizarTabla();

            // Limpiar los totales
            actualizarTotales();

            // Ocultar todos los mensajes de error
            document.querySelectorAll('.text-danger, .invalid-feedback, .alert-danger').forEach(el => {
                el.style.display = 'none';
            });

            // Remover las clases de validación
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/facturaCompra/create.blade.php ENDPATH**/ ?>