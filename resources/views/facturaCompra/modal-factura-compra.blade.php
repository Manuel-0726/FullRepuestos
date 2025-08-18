@extends('layouts.app')
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
                    @foreach($productos as $producto)
                        <tr id="fila-producto-{{ $producto->id }}">
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->marca }}</td>
                            <td>
                                <input type="number" step="0.01" class="form-control form-control-sm text-center"
                                       id="precio_compra_{{ $producto->id }}"
                                       value="{{ $producto->precio_compra ?? 0 }}">
                            </td>
                            <td>
                                <input type="number" step="0.01" class="form-control form-control-sm text-center"
                                       id="precio_venta_{{ $producto->id }}"
                                       value="0">
                            </td>
                            <td>
                                <input type="number" step="0.01" class="form-control form-control-sm text-center"
                                       id="descuento_{{ $producto->id }}"
                                       value="{{ $producto->descuento ?? 0 }}">
                            </td>
                            <td>
                                <input type="number" step="0.01" min="0" max="100" class="form-control form-control-sm text-center"
                                       id="impuesto_{{ $producto->id }}"
                                       value="{{ $producto->impuesto ?? 0 }}">
                            </td>
                            <td>
                                <input type="number" min="1" class="form-control form-control-sm text-center"
                                       id="cantidad_{{ $producto->id }}"
                                       value="1">
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm"
                                        onclick="agregarProductoDesdeModal({{ $producto->id }})">
                                    Agregar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

