<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::query();

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

        $productosFiltrados = $query->count();
        $totalProductos = Producto::count();

        $productos = $query->orderBy('id', 'desc')->paginate(5);

        return view('productos.index', compact('productos', 'productosFiltrados', 'totalProductos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:60', 'regex:/^[^\s].*/'],
            'modelo' => ['required', 'string', 'max:60', 'regex:/^[^\s][A-Za-z0-9\s-]*$/'],
            'marca' => ['required', 'string', 'regex:/^[^\s].*/'],
            'anio' => ['required', 'digits:4', 'integer', 'min:1990', 'max:' . date('Y')],
            'categoria' => ['required', 'string', 'regex:/^[^\s].*/'],
            'descripcion' => ['nullable', 'string', 'max:250', 'regex:/^[^\s].*/'],

            'precio_compra' => 'nullable|numeric|min:0',

        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede superar 60 caracteres.',
            'nombre.regex' => 'El nombre no puede iniciar con un espacio.',
            'modelo.required' => 'El modelo es obligatorio.',
            'modelo.max' => 'El modelo no puede superar 60 caracteres.',
            'modelo.regex' => 'El modelo solo puede contener letras, números, guiones y espacios, sin espacios al inicio.',
            'marca.required' => 'La marca es obligatoria.',
            'marca.regex' => 'La marca no puede iniciar con un espacio.',
            'anio.required' => 'El año es obligatorio.',
            'anio.digits' => 'El año debe tener 4 dígitos.',
            'anio.min' => 'El año no puede ser menor a 1990.',
            'anio.max' => 'El año no puede ser mayor al actual.',
            'categoria.required' => 'La categoría es obligatoria.',
            'categoria.regex' => 'La categoría no puede iniciar con un espacio.',
            'descripcion.max' => 'La descripción no puede superar 250 caracteres.',
            'descripcion.regex' => 'La descripción no puede iniciar con un espacio.',

            'precio_compra.min' => 'El precio de compra no puede ser negativo.',

        ]);

        $existe = Producto::where('nombre', $validated['nombre'])
            ->where('marca', $validated['marca'])
            ->where('modelo', $validated['modelo'])
            ->where('anio', $validated['anio'])
            ->where('categoria', $validated['categoria'])
            ->exists();

        if ($existe) {
            return back()
                ->withErrors(['duplicado' => 'Ya existe un producto con esa combinación de nombre, marca, modelo, año y categoría.'])
                ->withInput();
        }

        Producto::create($validated);

        return redirect()->route('productos.index')->with('success', 'Producto registrado correctamente.');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:60', 'regex:/^[^\s].*/'],
            'modelo' => ['required', 'string', 'max:60', 'regex:/^[^\s][A-Za-z0-9\s-]*$/'],
            'marca' => ['required', 'string', 'regex:/^[^\s].*/'],
            'anio' => ['required', 'digits:4', 'integer', 'min:1990', 'max:' . date('Y')],
            'categoria' => ['required', 'string', 'regex:/^[^\s].*/'],
            'descripcion' => ['nullable', 'string', 'max:250', 'regex:/^[^\s].*/'],

            'precio_compra' => 'nullable|numeric|min:0',

        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede superar 60 caracteres.',
            'nombre.regex' => 'El nombre no puede iniciar con un espacio.',
            'modelo.required' => 'El modelo es obligatorio.',
            'modelo.max' => 'El modelo no puede superar 60 caracteres.',
            'modelo.regex' => 'El modelo solo puede contener letras, números, guiones y espacios, sin espacios al inicio.',
            'marca.required' => 'La marca es obligatoria.',
            'marca.regex' => 'La marca no puede iniciar con un espacio.',
            'anio.required' => 'El año es obligatorio.',
            'anio.digits' => 'El año debe tener 4 dígitos.',
            'anio.min' => 'El año no puede ser menor a 1990.',
            'anio.max' => 'El año no puede ser mayor al actual.',
            'categoria.required' => 'La categoría es obligatoria.',
            'categoria.regex' => 'La categoría no puede iniciar con un espacio.',
            'descripcion.max' => 'La descripción no puede superar 250 caracteres.',
            'descripcion.regex' => 'La descripción no puede iniciar con un espacio.',
            'precio_compra.min' => 'El precio de compra no puede ser negativo.',

        ]);

        $producto->update($validated);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }

    // Nuevo método para la búsqueda
    public function search(Request $request)
    {
        $query = $request->input('query');

        $productos = Producto::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('descripcion', 'LIKE', "%{$query}%")
            ->get();

        return view('search_results', compact('productos', 'query'));
    }
}
