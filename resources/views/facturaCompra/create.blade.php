@extends('layouts.app')

@section('content')
    <div class="container text-white-justify-center">
        <h2 class="mb-3">Registrar factura de compra</h2>
    </div>

    {{-- Mostrar errores de la sesión --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Mostrar errores de validación de Laravel --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('facturas-compra.store') }}" method="POST" id="formFactura">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="empleado_id" class="form-label">Empleado</label>
                <select name="empleado_id" id="empleado_id" class="form-select @error('empleado_id') is-invalid @enderror">
                    <option value="">Seleccione un empleado</option>
                    @foreach($empleados as $empleado)
                        <option value="{{ $empleado->id }}" {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                            {{ $empleado->nombre }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback" id="empleado_id-error">Seleccione un empleado.</div>
            </div>
            <div class="col-md-6">
                <label for="proveedor_id" class="form-label">Proveedor</label>
                <select name="proveedor_id" id="proveedor_id" class="form-select @error('proveedor_id') is-invalid @enderror">
                    <option value="">Seleccione un proveedor</option>
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                            {{ $proveedor->nombre_empresa }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback" id="proveedor_id-error">Seleccione un proveedor.</div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="codigo" class="form-label">Código de Factura</label>
                <input type="text" name="codigo" id="codigo" class="form-control @error('codigo') is-invalid @enderror" value="{{ old('codigo') }}" maxlength="12">
                <div class="invalid-feedback" id="codigo-error">El código de la factura es necesario y no puede tener espacios iniciales.</div>
            </div>
            <div class="col-md-6">
                <label for="fecha" class="form-label">Fecha de Compra</label>
                <input type="date" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', date('Y-m-d')) }}">
                <div class="invalid-feedback" id="fecha-error">Este campo es necesario.</div>
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
                <tbody>
                <tr>
                    <td colspan="9" id="no-products-message">
                        No se han agregado productos.
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="text-danger mb-3" id="productos-error" style="display:none;">
            Debe agregar al menos un producto para guardar la factura.
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea name="observaciones" id="observaciones" class="form-control @error('observaciones') is-invalid @enderror" rows="3" maxlength="250">{{ old('observaciones') }}</textarea>
                <div class="invalid-feedback" id="observaciones-error">El campo no puede tener espacios al inicio y debe tener un máximo de 250 caracteres.</div>
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
            <a href="{{ route('facturas-compra.index') }}" class="btn btn-danger">
                Cancelar
            </a>
        </div>
    </form>

    {{-- Modal para agregar productos --}}
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
                            @foreach($productos as $producto)
                                <tr>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>
                                        <input type="number" id="cantidad_{{ $producto->id }}" class="form-control" value="1" min="1" required style="width: 80px;">
                                        <div class="invalid-feedback" id="cantidad_{{ $producto->id }}-error"></div>
                                    </td>
                                    <td>
                                        <input type="number" id="precio_compra_{{ $producto->id }}" class="form-control" value="{{ $producto->precio_compra }}" min="0" step="0.01" required style="width: 100px;">
                                        <div class="invalid-feedback" id="precio_compra_{{ $producto->id }}-error"></div>
                                    </td>
                                    <td>
                                        <input type="number" id="precio_venta_{{ $producto->id }}" class="form-control" value="{{ $producto->precio_venta }}" min="0" step="0.01" required style="width: 100px;">
                                        <div class="invalid-feedback" id="precio_venta_{{ $producto->id }}-error"></div>
                                    </td>
                                    <td>
                                        <input type="number" id="descuento_{{ $producto->id }}" class="form-control" value="0" min="0" step="0.01" required style="width: 80px;">
                                        <div class="invalid-feedback" id="descuento_{{ $producto->id }}-error"></div>
                                    </td>
                                    <td>
                                        <input type="number" id="impuesto_{{ $producto->id }}" class="form-control" value="0" min="0" step="0.01" required style="width: 80px;">
                                        <div class="invalid-feedback" id="impuesto_{{ $producto->id }}-error"></div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" onclick="agregarProductoDesdeModal({{ $producto->id }})">
                                            Agregar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
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
        const productosDisponibles = @json($productos);
        let productosSeleccionados = [];

        document.addEventListener('DOMContentLoaded', function () {
            const oldDetalles = @json(old('detalles'));
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
            }
            renderizarTabla();
            actualizarTotales();

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

        /**
         * Valida un campo de entrada y muestra un mensaje de error si es inválido.
         * @param {HTMLElement} inputElement - El elemento input a validar.
         * @param {function} validationFn - La función de validación que retorna true si es válido.
         * @param {string} errorMessage - El mensaje de error a mostrar.
         * @returns {boolean} - True si el campo es válido, false en caso contrario.
         */
        function validateField(inputElement, validationFn, errorMessage) {
            const errorElement = inputElement.nextElementSibling;
            if (errorElement) {
                if (!validationFn(inputElement.value)) {
                    inputElement.classList.add('is-invalid');
                    errorElement.textContent = errorMessage;
                    return false;
                } else {
                    inputElement.classList.remove('is-invalid');
                    return true;
                }
            }
            return true;
        }

        /**
         * Valida los campos de la fila de un producto en el modal.
         * @param {string} productoId - El ID del producto.
         * @returns {boolean} - True si todos los campos son válidos, false en caso contrario.
         */
        function validateModalInputs(productoId) {
            let isValid = true;

            const cantidadInput = document.getElementById(`cantidad_${productoId}`);
            const precioCompraInput = document.getElementById(`precio_compra_${productoId}`);
            const precioVentaInput = document.getElementById(`precio_venta_${productoId}`);
            const descuentoInput = document.getElementById(`descuento_${productoId}`);
            const impuestoInput = document.getElementById(`impuesto_${productoId}`);

            // Validación de cantidad
            if (!validateField(cantidadInput, v => !isNaN(parseInt(v)) && parseInt(v) > 0, 'Debe ser un número mayor a cero.')) {
                isValid = false;
            }

            // Validación de precio de compra
            if (!validateField(precioCompraInput, v => !isNaN(parseFloat(v)) && parseFloat(v) >= 0, 'No puede ser un valor negativo.')) {
                isValid = false;
            }

            // Validación de precio de venta
            if (!validateField(precioVentaInput, v => !isNaN(parseFloat(v)) && parseFloat(v) >= 0, 'No puede ser un valor negativo.')) {
                isValid = false;
            }

            // Validación de descuento
            if (!validateField(descuentoInput, v => !isNaN(parseFloat(v)) && parseFloat(v) >= 0, 'No puede ser un valor negativo.')) {
                isValid = false;
            }

            // Validación de impuesto
            if (!validateField(impuestoInput, v => !isNaN(parseFloat(v)) && parseFloat(v) >= 0, 'No puede ser un valor negativo.')) {
                isValid = false;
            }

            return isValid;
        }

        function agregarProductoDesdeModal(productoId) {
            const producto = productosDisponibles.find(p => p.id === productoId);
            const modalMensaje = document.getElementById('modal-mensaje');
            const modalProductos = document.getElementById('modalProductos');
            const modal = bootstrap.Modal.getInstance(modalProductos) || new bootstrap.Modal(modalProductos);

            if (!producto) {
                console.error('Error: Producto no encontrado.');
                return;
            }

            if (!validateModalInputs(productoId)) {
                return;
            }

            if (productosSeleccionados.find(p => p.id === producto.id)) {
                modalMensaje.textContent = 'Este producto ya ha sido agregado.';
                modalMensaje.classList.remove('d-none', 'alert-success');
                modalMensaje.classList.add('alert-danger');
                setTimeout(() => {
                    modalMensaje.classList.add('d-none');
                }, 3000);
                return;
            }

            // Limpiar errores si la validación es exitosa
            document.getElementById('productos-error').style.display = 'none';

            const cantidad = parseInt(document.getElementById(`cantidad_${productoId}`).value);
            const precioCompra = parseFloat(document.getElementById(`precio_compra_${productoId}`).value);
            const precioVenta = parseFloat(document.getElementById(`precio_venta_${productoId}`).value);
            const descuento = parseFloat(document.getElementById(`descuento_${productoId}`).value);
            const impuesto = parseFloat(document.getElementById(`impuesto_${productoId}`).value);

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
                const row = document.createElement('tr');
                row.innerHTML = `<td colspan="9" id="no-products-message">No se han agregado productos.</td>`;
                tbody.appendChild(row);
                document.getElementById('productos-error').style.display = 'block';
            } else {
                document.getElementById('productos-error').style.display = 'none';
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
        }

        function eliminarProducto(index) {
            productosSeleccionados.splice(index, 1);
            renderizarTabla();
            actualizarTotales();
        }

        document.getElementById('formFactura').addEventListener('submit', function(e) {
            let isValid = true;

            // Validación de los campos principales
            const empleadoValid = validateField(
                document.getElementById('empleado_id'),
                v => v.trim() !== '',
                'Seleccione un empleado.'
            );
            const proveedorValid = validateField(
                document.getElementById('proveedor_id'),
                v => v.trim() !== '',
                'Seleccione un proveedor.'
            );
            const codigoValid = validateField(
                document.getElementById('codigo'),
                v => v.trim() !== '' && !v.startsWith(' ') && v.length <= 12,
                'El código es necesario, no puede tener espacios iniciales y debe tener un máximo de 12 caracteres.'
            );
            const fechaValid = validateField(
                document.getElementById('fecha'),
                v => v.trim() !== '',
                'Este campo es necesario.'
            );
            const observacionesValid = validateField(
                document.getElementById('observaciones'),
                v => !v.startsWith(' ') && v.length <= 250,
                'No puede tener espacios al inicio y debe tener un máximo de 250 caracteres.'
            );

            // Validación de productos
            const productosError = document.getElementById('productos-error');
            if (productosSeleccionados.length === 0) {
                productosError.style.display = 'block';
                isValid = false;
            } else {
                productosError.style.display = 'none';
            }

            isValid = empleadoValid && proveedorValid && codigoValid && fechaValid && observacionesValid && isValid;

            if (!isValid) {
                e.preventDefault();
            }
        });

        // Limpieza de campos al escribir para evitar espacios iniciales
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

            // Ocultar todos los mensajes de error y remover clases de validación
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            document.querySelectorAll('.alert, .text-danger').forEach(el => {
                el.style.display = 'none';
            });
        });

    </script>
@endsection
