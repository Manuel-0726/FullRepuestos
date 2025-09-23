<?php

namespace App\Http\Controllers;

use App\Models\FacturaVenta;
use App\Models\DetalleFacturaVenta;
use App\Models\Producto;
use App\Models\ProductoMoto; // Importamos el modelo para productos de moto
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FacturaController extends Controller
{
    /**
     * Muestra una lista de todas las facturas de venta.
     */
    public function index()
    {
        $facturas = FacturaVenta::with(['cliente', 'detalles.producto'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('facturas.index', compact('facturas'));
    }

    /**
     * Muestra el formulario para crear una nueva factura de venta.
     */
    public function create()
    {
        // Los clientes se ordenan por 'nombre'
        $clientes = Cliente::orderBy('nombre')->get();

        // Obtener productos de carro y de moto en colecciones separadas
        $productosCarro = Producto::select('id', 'nombre', 'marca', 'modelo', 'anio', 'categoria', 'precio_venta', 'impuesto', 'stock')->orderBy('nombre')->get();
        $productosMoto = ProductoMoto::select('id', 'nombre', 'marca', 'modelo', 'anio', 'categoria')->orderBy('nombre')->get();

        $marcas = $productosCarro->pluck('marca')->merge($productosMoto->pluck('marca'))->unique()->sort()->values();
        $categorias = $productosCarro->pluck('categoria')->merge($productosMoto->pluck('categoria'))->unique()->sort()->values();

        // Ahora la vista recibirá las colecciones de productos por separado
        return view('facturas.create', compact('clientes', 'productosCarro', 'productosMoto', 'marcas', 'categorias'));
    }

    /**
     * Almacena una nueva factura de venta en la base de datos.
     * Maneja la creación de la factura principal y sus detalles.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => [
                'required',
                'exists:clientes,id',
                function ($attribute, $value, $fail) {
                    if (!is_numeric($value) || trim($value) !== (string)$value) {
                        $fail('El ' . $attribute . ' contiene caracteres inválidos o espacios.');
                    }
                },
            ],
            'fecha' => 'required|date',
            'detalles' => 'required|array|min:1',
            'detalles.*.producto_id' => [
                'required',
                // Validamos que el producto exista en cualquiera de las dos tablas
                function ($attribute, $value, $fail) {
                    $productoCarro = Producto::find($value);
                    $productoMoto = ProductoMoto::find($value);
                    if (!$productoCarro && !$productoMoto) {
                        $fail('El producto con el ID ' . $value . ' no existe.');
                    }
                },
            ],
            'detalles.*.cantidad' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request) {
                    $index = explode('.', $attribute)[1];
                    $productoId = $request->input('detalles.' . $index . '.producto_id');

                    // Buscamos el producto en ambas tablas
                    $producto = Producto::find($productoId) ?? ProductoMoto::find($productoId);

                    if ($producto && $producto->stock < $value) {
                        $fail('No hay suficiente stock para el producto "' . $producto->nombre . '". Stock disponible: ' . $producto->stock . ', Cantidad solicitada: ' . $value);
                    } elseif (!$producto) {
                        $fail('Producto no encontrado para el detalle ' . ($index + 1) . '.');
                    }
                },
            ],
        ],
            // Mensajes de validación personalizados
            [
                'cliente_id.required' => 'El campo cliente es necesario.',
                'fecha.required' => 'El campo fecha es necesario.',
                'detalles.required' => 'Debe seleccionar al menos un producto.',
                'detalles.min' => 'Debe seleccionar al menos un producto.',
                'detalles.*.producto_id.required' => 'El campo producto es necesario.',
                'detalles.*.cantidad.required' => 'La cantidad del producto es necesaria.',
                'detalles.*.cantidad.min' => 'La cantidad debe ser al menos 1.',
            ]);

        try {
            DB::transaction(function () use ($request) {
                $subtotalFactura = 0;
                $ivaTotalFactura = 0;

                do {
                    $codigoFactura = 'FAC-' . date('Ymd') . '-' . Str::random(6);
                } while (FacturaVenta::where('codigo', $codigoFactura)->exists());

                $factura = FacturaVenta::create([
                    'codigo' => $codigoFactura,
                    'fecha' => now(),
                    'cliente_id' => $request->cliente_id,
                    'subtotal' => 0,
                    'iva' => 0,
                    'total' => 0,
                ]);

                foreach ($request->detalles as $detalleData) {
                    // Buscamos el producto en ambas tablas (carro y moto)
                    $producto = Producto::find($detalleData['producto_id']) ?? ProductoMoto::find($detalleData['producto_id']);

                    if ($producto && $producto->stock >= $detalleData['cantidad']) {
                        $cantidad = $detalleData['cantidad'];
                        $precioUnitarioVenta = $producto->precio_venta;
                        $impuestoAplicado = $producto->impuesto;

                        $subtotalDetalle = $cantidad * $precioUnitarioVenta;
                        $ivaDetalle = ($subtotalDetalle * $impuestoAplicado) / 100;

                        $factura->detalles()->create([
                            'producto_id' => $producto->id,
                            'cantidad' => $cantidad,
                            'precio_unitario' => $precioUnitarioVenta,
                            'iva' => $ivaDetalle,
                            'subtotal' => $subtotalDetalle,
                        ]);

                        $producto->decrement('stock', $cantidad);

                        $subtotalFactura += $subtotalDetalle;
                        $ivaTotalFactura += $ivaDetalle;
                    }
                }

                $factura->subtotal = $subtotalFactura;
                $factura->iva = $ivaTotalFactura;
                $factura->total = $subtotalFactura + $ivaTotalFactura;
                $factura->save();
            });

            return redirect()->route('facturas.index')->with('success', 'Factura creada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al crear la factura: ' . $e->getMessage());
        }
    }

    /**
     * Muestra una factura de venta específica.
     */
    public function show(FacturaVenta $factura)
    {
        $factura->load('cliente', 'detalles.producto');
        return view('facturas.show', compact('factura'));
    }

    /**
     * Muestra el formulario para editar una factura de venta existente.
     */
    public function edit(FacturaVenta $factura)
    {
        $factura->load('detalles.producto');

        // Los clientes se ordenan por 'nombre'
        $clientes = Cliente::orderBy('nombre')->get();

        // Obtener productos de carro y de moto y combinarlos
        $productosCarro = Producto::select('id', 'nombre', 'marca', 'modelo', 'anio', 'categoria', 'precio_venta', 'impuesto', 'stock')->orderBy('nombre')->get();
        $productosMoto = ProductoMoto::select('id', 'nombre', 'marca', 'modelo', 'anio', 'categoria', 'precio_venta', 'impuesto', 'stock')->orderBy('nombre')->get();
        $productos = $productosCarro->merge($productosMoto)->sortBy('nombre');

        $marcas = $productos->pluck('marca')->unique()->sort()->values();
        $categorias = $productos->pluck('categoria')->unique()->sort()->values();

        return view('facturas.edit', compact('factura', 'clientes', 'productos', 'marcas', 'categorias'));
    }

    /**
     * Actualiza una factura de venta existente en la base de datos.
     * Maneja la actualización de la factura principal y sus detalles.
     */
    public function update(Request $request, FacturaVenta $factura)
    {
        $request->validate([
            'cliente_id' => [
                'required',
                'exists:clientes,id',
                function ($attribute, $value, $fail) {
                    if (!is_numeric($value) || trim($value) !== (string)$value) {
                        $fail('El ' . $attribute . ' contiene caracteres inválidos o espacios.');
                    }
                },
            ],
            'fecha' => 'required|date',
            'detalles' => 'required|array|min:1',
            'detalles.*.producto_id' => [
                'required',
                // Validamos que el producto exista en cualquiera de las dos tablas
                function ($attribute, $value, $fail) {
                    $productoCarro = Producto::find($value);
                    $productoMoto = ProductoMoto::find($value);
                    if (!$productoCarro && !$productoMoto) {
                        $fail('El producto con el ID ' . $value . ' no existe.');
                    }
                },
            ],
            'detalles.*.cantidad' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request, $factura) {
                    $index = explode('.', $attribute)[1];
                    $productoId = $request->input('detalles.' . $index . '.producto_id');
                    $nuevaCantidad = $value;

                    // Buscamos el producto en ambas tablas
                    $producto = Producto::find($productoId) ?? ProductoMoto::find($productoId);
                    if (!$producto) {
                        $fail('Producto con ID ' . $productoId . ' no encontrado.');
                        return;
                    }

                    $cantidadVendidaAnteriormente = $factura->detalles()
                        ->where('producto_id', $productoId)
                        ->sum('cantidad');

                    $stockDisponible = $producto->stock + $cantidadVendidaAnteriormente;

                    if ($stockDisponible < $nuevaCantidad) {
                        $fail('No hay suficiente stock para el producto "' . $producto->nombre . '". Stock disponible para esta transacción: ' . $stockDisponible . ', Cantidad solicitada: ' . $nuevaCantidad);
                    }
                },
            ],
        ],
            // Mensajes de validación personalizados
            [
                'cliente_id.required' => 'El campo cliente es necesario.',
                'fecha.required' => 'El campo fecha es necesario.',
                'detalles.required' => 'Debe seleccionar al menos un producto.',
                'detalles.min' => 'Debe seleccionar al menos un producto.',
                'detalles.*.producto_id.required' => 'El campo producto es necesario.',
                'detalles.*.cantidad.required' => 'La cantidad del producto es necesaria.',
                'detalles.*.cantidad.min' => 'La cantidad debe ser al menos 1.',
            ]);

        try {
            DB::transaction(function () use ($request, $factura) {
                foreach ($factura->detalles as $detalleAnterior) {
                    // Determinamos si es un producto de carro o de moto para restaurar el stock
                    $producto = Producto::find($detalleAnterior->producto_id) ?? ProductoMoto::find($detalleAnterior->producto_id);
                    if ($producto) {
                        $producto->increment('stock', $detalleAnterior->cantidad);
                    }
                }

                $factura->detalles()->delete();

                $subtotalFactura = 0;
                $ivaTotalFactura = 0;

                foreach ($request->detalles as $detalleData) {
                    // Buscamos el producto en ambas tablas
                    $producto = Producto::find($detalleData['producto_id']) ?? ProductoMoto::find($detalleData['producto_id']);

                    if ($producto && $producto->stock >= $detalleData['cantidad']) {
                        $cantidad = $detalleData['cantidad'];
                        $precioUnitarioVenta = $producto->precio_venta;
                        $impuestoAplicado = $producto->impuesto;

                        $subtotalDetalle = $cantidad * $precioUnitarioVenta;
                        $ivaDetalle = ($subtotalDetalle * $impuestoAplicado) / 100;

                        $factura->detalles()->create([
                            'producto_id' => $producto->id,
                            'cantidad' => $cantidad,
                            'precio_unitario' => $precioUnitarioVenta,
                            'iva' => $ivaDetalle,
                            'subtotal' => $subtotalDetalle,
                        ]);

                        $producto->decrement('stock', $cantidad);
                        $subtotalFactura += $subtotalDetalle;
                        $ivaTotalFactura += $ivaDetalle;
                    } else {
                        throw new \Exception("Error de stock inesperado para el producto: " . ($producto->nombre ?? $detalleData['producto_id']));
                    }
                }

                $factura->update([
                    'fecha' => $request->fecha,
                    'cliente_id' => $request->cliente_id,
                    'subtotal' => $subtotalFactura,
                    'iva' => $ivaTotalFactura,
                    'total' => $subtotalFactura + $ivaTotalFactura,
                ]);
            });

            return redirect()->route('facturas.index')->with('success', 'Factura actualizada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al actualizar la factura: ' . $e->getMessage());
        }
    }

    /**
     * Elimina una factura de venta específica de la base de datos.
     * Asegúrate de restaurar el stock de los productos vendidos en esta factura.
     */
    public function destroy(FacturaVenta $factura)
    {
        try {
            DB::transaction(function () use ($factura) {
                foreach ($factura->detalles as $detalle) {
                    // Buscamos el producto en ambas tablas para restaurar el stock
                    $producto = Producto::find($detalle->producto_id) ?? ProductoMoto::find($detalle->producto_id);
                    if ($producto) {
                        $producto->increment('stock', $detalle->cantidad);
                    }
                }
                $factura->delete();
            });

            return redirect()->route('facturas.index')->with('success', 'Factura eliminada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la factura: ' . $e->getMessage());
        }
    }
}
