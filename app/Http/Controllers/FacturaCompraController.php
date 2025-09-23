<?php

namespace App\Http\Controllers;

use App\Models\FacturaCompra;
use App\Models\FacturaCompraDetalle;
use App\Models\Producto;
use App\Models\ProductoMoto;
use App\Models\Proveedor;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FacturaCompraController extends Controller
{
    /**
     * Muestra una lista de las facturas de compra.
     */
    public function index()
    {
        $facturas = FacturaCompra::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('facturaCompra.index', compact('facturas'));
    }

    /**
     * Muestra el formulario para crear una nueva factura de compra.
     */
    public function create()
    {
        $empleados = Empleado::orderBy('nombre')->get();
        $proveedores = Proveedor::orderBy('nombre_empresa')->get();

        // Se obtienen todos los productos de carro
        $productosCarro = Producto::orderBy('nombre')->get();

        // Se obtienen todos los productos de moto
        $productosMoto = ProductoMoto::orderBy('nombre')->get();

        // Combinamos ambos listados para la vista
        $productos = $productosCarro->map(function ($item) {
            $item->tipo = 'carro';
            return $item;
        })->merge($productosMoto->map(function ($item) {
            $item->tipo = 'moto';
            return $item;
        }));

        return view('facturaCompra.create', compact('empleados', 'proveedores', 'productos'));
    }

    /**
     * Almacena una nueva factura de compra y sus detalles en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validar la solicitud
        $request->validate([
            'codigo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'proveedor_id' => 'required|exists:proveedores,id',
            'empleado_id' => 'required|exists:empleados,id',
            'productos' => 'required|array',
            'productos.*' => 'required|integer', // El ID del producto
            'cantidades' => 'required|array',
            'cantidades.*' => 'required|integer|min:1',
            'precios' => 'required|array',
            'precios.*' => 'required|numeric|min:0',
            'tipos_producto' => 'required|array',
            'tipos_producto.*' => 'required|in:carro,moto',
        ]);

        // 2. Asegurar que las listas tienen el mismo tamaño
        if (count($request->productos) != count($request->cantidades) ||
            count($request->productos) != count($request->precios) ||
            count($request->productos) != count($request->tipos_producto)) {
            return back()->with('error', 'Los datos del formulario no son consistentes. Intente de nuevo.')->withInput();
        }

        // 3. Iniciar una transacción de base de datos
        DB::beginTransaction();

        try {
            // 4. Calcular los totales de la factura
            $subtotal = 0;
            for ($i = 0; $i < count($request->productos); $i++) {
                $subtotal += $request->cantidades[$i] * $request->precios[$i];
            }
            $iva = $subtotal * 0.13;
            $total = $subtotal + $iva;

            // 5. Guardar el registro principal de la Factura de Compra
            $factura = FacturaCompra::create([
                'codigo' => $request->codigo,
                'fecha' => $request->fecha,
                'subtotal' => $subtotal,
                'iva' => $iva,
                'total' => $total,
                'proveedor_id' => $request->proveedor_id,
                'empleado_id' => $request->empleado_id,
            ]);

            // 6. Guardar cada detalle de producto y actualizar el stock
            foreach ($request->productos as $index => $productoId) {
                $cantidad = $request->cantidades[$index];
                $precioUnitario = $request->precios[$index];
                $tipoProducto = $request->tipos_producto[$index];

                // Guardar el detalle de la factura
                FacturaCompraDetalle::create([
                    'factura_compra_id' => $factura->id,
                    'producto_id' => $productoId,
                    'producto_tipo' => $tipoProducto,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precioUnitario,
                ]);

                // Actualizar el stock del producto
                if ($tipoProducto === 'carro') {
                    $producto = Producto::find($productoId);
                    if ($producto) {
                        $producto->stock += $cantidad;
                        $producto->save();
                    }
                } elseif ($tipoProducto === 'moto') {
                    $producto = ProductoMoto::find($productoId);
                    if ($producto) {
                        $producto->stock += $cantidad;
                        $producto->save();
                    }
                }
            }

            // 7. Si todo es exitoso, confirmar la transacción
            DB::commit();

            return redirect()->route('facturas_compra.index')->with('success', 'Factura de compra creada exitosamente.');

        } catch (\Exception $e) {
            // 8. En caso de error, deshacer todos los cambios
            DB::rollBack();
            Log::error('Error al guardar la factura de compra: ' . $e->getMessage());
            return back()->with('error', 'Error al guardar la factura de compra. Por favor, inténtelo de nuevo.')->withInput();
        }
    }
}
