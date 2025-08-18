<?php

namespace App\Http\Controllers;

use App\Models\FacturaCompra;
use App\Models\DetalleFacturaCompra;
use App\Models\Producto;
use App\Models\Empleado;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Exception;

class FacturaCompraController extends Controller
{
    /**
     * Muestra una lista de todas las facturas de compra.
     */
    public function index()
    {
        // Carga relaciones con with
        $facturas = FacturaCompra::with(['empleado', 'proveedor'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Opcional: formatear la fecha antes de pasar (mejor hacerlo en la vista)
        return view('facturaCompra.index', compact('facturas'));
    }

    /**
     * Muestra el formulario para crear una nueva factura de compra.
     */
    public function create()
    {
        $empleados = Empleado::orderBy('nombre')->get();
        $proveedores = Proveedor::orderBy('nombre_empresa')->get();

        $productos = Producto::select('id', 'nombre', 'descripcion', 'marca', 'precio_compra', 'precio_venta', 'stock', 'impuesto', 'modelo', 'anio', 'descuento')->get();

        return view('facturaCompra.create', compact('empleados', 'proveedores', 'productos'));
    }

    /**
     * Almacena una nueva factura de compra y sus detalles en la base de datos.
     */
    public function store(Request $request)
    {
        // === PASO DE DEPURACIÓN CRÍTICO: REVISA LOS DATOS DEL FORMULARIO ===
        // Esto detendrá el script y te mostrará el array de detalles del formulario.
        // Asegúrate de que cada elemento tiene una clave 'producto_id'.
        // dd($request->detalles);

        $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:255',
                'unique:factura_compras,codigo',
                function ($attribute, $value, $fail) {
                    if (trim($value) !== $value) {
                        $fail('El ' . $attribute . ' no debe contener espacios al inicio o al final.');
                    }
                },
            ],
            'fecha' => 'required|date',
            'empleado_id' => 'required|exists:empleados,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'observaciones' => 'nullable|string',
            'detalles' => 'required|array|min:1',
            'detalles.*.producto_id' => 'required|exists:productos,id',
            'detalles.*.cantidad' => 'required|integer|min:1',
            'detalles.*.precio_unitario' => 'required|numeric|min:0',
            'detalles.*.precio_venta' => 'required|numeric|min:0',
            'detalles.*.descuento' => 'nullable|numeric|min:0',
            'detalles.*.impuesto' => 'nullable|numeric|min:0|max:100',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $subtotalFactura = 0;
                $ivaTotalFactura = 0;
                $descuentoTotalFactura = 0;

                do {
                    $codigoFactura = 'COMP-' . date('Ymd') . '-' . Str::random(6);
                } while (FacturaCompra::where('codigo', $codigoFactura)->exists());

                $facturaCompra = FacturaCompra::create([
                    'codigo' => $codigoFactura,
                    'fecha' => $request->fecha,
                    'empleado_id' => $request->empleado_id,
                    'proveedor_id' => $request->proveedor_id,
                    'subtotal' => 0,
                    'iva' => 0,
                    'total' => 0,
                    'observaciones' => $request->observaciones ? trim($request->observaciones) : null,
                ]);

                foreach ($request->detalles as $detalleData) {
                    // Verificación robusta: saltar si el producto_id no está presente
                    if (!isset($detalleData['producto_id'])) {
                        continue;
                    }

                    $productoId = data_get($detalleData, 'producto_id');
                    $producto = Producto::find($productoId);

                    if (!$producto) {
                        throw new Exception("Producto con ID {$productoId} no encontrado.");
                    }

                    $cantidad = data_get($detalleData, 'cantidad');
                    $precioUnitarioCompra = data_get($detalleData, 'precio_unitario');
                    $precioVenta = data_get($detalleData, 'precio_venta');
                    $descuento = data_get($detalleData, 'descuento', 0);
                    $impuesto = data_get($detalleData, 'impuesto', 0);

                    DetalleFacturaCompra::create([
                        'factura_compra_id' => $facturaCompra->id,
                        'producto_id' => $producto->id,
                        'cantidad' => $cantidad,
                        'precio_unitario' => $precioUnitarioCompra,
                        'descuento' => $descuento,
                        'impuesto' => $impuesto,
                    ]);

                    $producto->stock += $cantidad;
                    $producto->precio_compra = $precioUnitarioCompra;
                    $producto->precio_venta = $precioVenta;
                    $producto->impuesto = $impuesto;
                    $producto->save();

                    $subtotalDetalle = $cantidad * $precioUnitarioCompra;
                    $ivaDetalle = (($subtotalDetalle - $descuento) * $impuesto) / 100;

                    $subtotalFactura += $subtotalDetalle;
                    $ivaTotalFactura += $ivaDetalle;
                    $descuentoTotalFactura += $descuento;
                }

                $totalFactura = ($subtotalFactura - $descuentoTotalFactura) + $ivaTotalFactura;

                $facturaCompra->update([
                    'subtotal' => $subtotalFactura,
                    'iva' => $ivaTotalFactura,
                    'total' => $totalFactura,
                    'descuento' => $descuentoTotalFactura,
                ]);
            });

            return redirect()->route('facturas-compra.index')->with('success', 'Factura de compra creada exitosamente.');

        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al crear la factura de compra: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $factura = FacturaCompra::with(['proveedor', 'empleado', 'detalles.producto'])->findOrFail($id);
        return view('facturaCompra.show', compact('factura'));
    }
    public function edit(FacturaCompra $facturas_compra)
    {
        $facturas_compra->load('detalles.producto');
        $empleados = Empleado::orderBy('nombre')->get();
        $proveedores = Proveedor::orderBy('nombre_empresa')->get();
        $productos = Producto::all();

        return view('facturaCompra.edit', compact('facturas_compra', 'empleados', 'proveedores', 'productos'));
    }

    public function update(Request $request, FacturaCompra $facturas_compra)
    {
        // Validar campos según tu necesidad
        $request->validate([
            'fecha' => 'required|date',
            'proveedor_id' => 'required|exists:proveedores,id',
            'empleado_id' => 'required|exists:empleados,id',
            // agrega más validaciones según campos
        ]);

        $facturas_compra->update($request->only('fecha', 'proveedor_id', 'empleado_id', 'subtotal', 'iva', 'total', 'descuento', 'observaciones'));

        // Aquí podrías actualizar detalles si lo tienes implementado

        return redirect()->route('facturas-compra.show', $facturas_compra)->with('success', 'Factura actualizada correctamente.');
    }

    public function destroy(FacturaCompra $facturas_Compra)
    {
        try {
            DB::transaction(function () use ($facturas_Compra) {
                foreach ($facturas_Compra->detalles as $detalle) {
                    $producto = Producto::find($detalle->producto_id);
                    if ($producto) {
                        $producto->decrement('stock', $detalle->cantidad);
                    }
                }
                $facturas_Compra->delete();
            });

            return redirect()->route('facturas-compra.index')->with('success', 'Factura de compra eliminada exitosamente.');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la factura de compra: ' . $e->getMessage());
        }
    }
}
