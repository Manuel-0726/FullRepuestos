<?php

namespace App\Http\Controllers;

use App\Models\ProductoMoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductoMotoController extends Controller
{
    /**
     * Muestra una lista de productos de moto.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = ProductoMoto::query();

        // Aplicar filtros de búsqueda
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('modelo')) {
            $query->where('modelo', 'like', '%' . $request->modelo . '%');
        }

        if ($request->filled('anio')) {
            $query->where('anio', $request->anio);
        }

        if ($request->filled('marca')) {
            $query->where('marca', $request->marca);
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        $productos = $query->paginate(10);
        return view('productosMoto.index', compact('productos'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('productosMoto.create');
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Reglas de validación
        $rules = [
            'nombre' => 'required|string|max:60',
            'marca' => 'required|string|max:255',
            'modelo' => 'nullable|string|max:60',
            'anio' => 'nullable|digits:4|integer|min:1990|max:' . date('Y'),
            'descripcion' => 'nullable|string|max:250',
            'categoria' => 'required|string|max:255',
            'imagen' => 'nullable|image|max:2048', // Límite de 2MB
        ];

        // Mensajes personalizados
        $messages = [
            'nombre.required' => 'El nombre es necesario.',
            'marca.required' => 'La marca es necesaria.',
            'categoria.required' => 'La categoria es necesaria.',
            'anio.digits' => 'El año debe tener exactamente 4 dígitos.',
            'anio.integer' => 'El año debe ser un número entero.',
            'anio.min' => 'El año debe ser mayor o igual a 1990.',
            'anio.max' => 'El año no puede ser superior al año actual.',
            'imagen.max' => 'La imagen no debe ser mayor de 2MB.',
        ];

        $request->validate($rules, $messages);

        $data = $request->except('imagen');

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('productos_moto', 'public');
            $data['imagen'] = $path;
        }

        ProductoMoto::create($data);

        return redirect()->route('productos_moto.index')->with('success', 'Producto de moto creado.');
    }

    /**
     * Muestra el formulario para editar un producto existente.
     *
     * @param ProductoMoto $productos_moto
     * @return \Illuminate\View\View
     */
    public function edit(ProductoMoto $productos_moto)
    {
        return view('productosMoto.edit', compact('productos_moto'));
    }

    /**
     * Actualiza un producto existente en la base de datos.
     *
     * @param Request $request
     * @param ProductoMoto $productos_moto
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ProductoMoto $productos_moto)
    {
        // Reglas de validación
        $rules = [
            'nombre' => 'required|string|max:60',
            'marca' => 'required|string|max:255',
            'modelo' => 'nullable|string|max:60',
            'anio' => 'nullable|digits:4|integer|min:1990|max:' . date('Y'),
            'descripcion' => 'nullable|string|max:250',
            'categoria' => 'required|string|max:255',
            'imagen' => 'nullable|image|max:2048', // Límite de 2MB
        ];

        // Mensajes personalizados
        $messages = [
            'nombre.required' => 'Este campo es necesario.',
            'marca.required' => 'Este campo es necesario.',
            'categoria.required' => 'Este campo es necesario.',
            'anio.digits' => 'El año debe tener exactamente 4 dígitos.',
            'anio.integer' => 'El año debe ser un número entero.',
            'anio.min' => 'El año debe ser mayor o igual a 1990.',
            'anio.max' => 'El año no puede ser superior al año actual.',
            'imagen.max' => 'La imagen no debe ser mayor de 2MB.',
        ];

        $request->validate($rules, $messages);

        $productos_moto->nombre = $request->nombre;
        $productos_moto->marca = $request->marca;
        $productos_moto->modelo = $request->modelo;
        $productos_moto->anio = $request->anio;
        $productos_moto->categoria = $request->categoria;
        $productos_moto->descripcion = $request->descripcion;

        if ($request->hasFile('imagen')) {
            if ($productos_moto->imagen) {
                Storage::disk('public')->delete($productos_moto->imagen);
            }
            $productos_moto->imagen = $request->file('imagen')->store('productos_moto', 'public');
        }

        $productos_moto->save();

        return redirect()->route('productos_moto.index')->with('success', 'Producto de moto actualizado.');
    }

    /**
     * Muestra los detalles de un producto específico.
     *
     * @param ProductoMoto $productos_moto
     * @return \Illuminate\View\View
     */
    public function show(ProductoMoto $productos_moto)
    {
        return view('productosMoto.show', compact('productos_moto'));
    }

    /**
     * Elimina un producto de la base de datos.
     *
     * @param ProductoMoto $productos_moto
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ProductoMoto $productos_moto)
    {
        // Elimina la imagen asociada antes del registro
        if ($productos_moto->imagen) {
            Storage::disk('public')->delete($productos_moto->imagen);
        }

        $productos_moto->delete();
        return redirect()->route('productos_moto.index')->with('success', 'Producto de moto eliminado.');
    }
}
