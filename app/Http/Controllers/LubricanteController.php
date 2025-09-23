<?php

namespace App\Http\Controllers;

use App\Models\Lubricante;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class LubricanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $lubricantes = Lubricante::query()
            ->when($search, function ($query, $search) {
                $query->where('nombre', 'LIKE', "%{$search}%")
                    ->orWhere('codigo', 'LIKE', "%{$search}%")
                    ->orWhere('marca', 'LIKE', "%{$search}%");
            })
            ->orderBy('nombre', 'desc')
            ->paginate(10);

        return view('lubricantes.index', compact('lubricantes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lubricantes.create');
    }

    // -------------------------------------------------------------------

    /**
     * Store a newly created resource in storage.
     * * MODIFICADO: Se elimina la restricción 'mimes' para permitir cualquier formato de imagen.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:lubricantes,nombre',
            'codigo' => 'required|string|max:20|unique:lubricantes,codigo',
            'marca' => 'required|string|max:30',
            'tipo_producto' => 'required|string|max:50',
            'descripcion' => 'required|string|max:500',
            'imagen' => 'required|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('images/lubricantes', 'public');
            $data['imagen'] = $imagePath;
        }

        Lubricante::create($data);

        return redirect()->route('lubricantes.index')
            ->with('success', 'Producto registrado exitosamente.');
    }

    // -------------------------------------------------------------------

    /**
     * Display the specified resource.
     */
    public function show(Lubricante $lubricante)
    {
        return view('lubricantes.show', compact('lubricante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lubricante $lubricante)
    {
        return view('lubricantes.edit', compact('lubricante'));
    }

    // -------------------------------------------------------------------

    /**
     * Update the specified resource in storage.
     * * MODIFICADO: Se elimina la restricción 'mimes' para permitir cualquier formato de imagen.
     */
    public function update(Request $request, Lubricante $lubricante)
    {
        $rules = [
            'nombre' => [
                'required', 'string', 'max:50', Rule::unique('lubricantes')->ignore($lubricante->id),
            ],
            'codigo' => [
                'required', 'string', 'max:20', Rule::unique('lubricantes')->ignore($lubricante->id),
            ],
            'marca' => 'required|string|max:50',
            'tipo_producto' => 'required|string|max:50',
            'descripcion' => 'required|string|max:500',

            'imagen' => 'nullable|image|max:2048',
        ];

        $request->validate($rules);

        $data = $request->all();

        // Lógica para actualizar la imagen
        if ($request->hasFile('imagen')) {
            // 1. Eliminar la imagen anterior si existe
            if ($lubricante->imagen && Storage::disk('public')->exists($lubricante->imagen)) {
                Storage::disk('public')->delete($lubricante->imagen);
            }

            // 2. Subir la nueva imagen
            $imagePath = $request->file('imagen')->store('images/lubricantes', 'public');
            $data['imagen'] = $imagePath;
        } else {
            // Si no se envía una nueva imagen, conservamos la antigua
            unset($data['imagen']);
        }

        $lubricante->update($data);

        return redirect()->route('lubricantes.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    // -------------------------------------------------------------------

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lubricante $lubricante)
    {
        // 1. Eliminar el archivo físico del storage si existe
        if ($lubricante->imagen && Storage::disk('public')->exists($lubricante->imagen)) {
            Storage::disk('public')->delete($lubricante->imagen);
        }

        // 2. Eliminar el registro de la DB
        $lubricante->delete();

        return redirect()->route('lubricantes.index')
            ->with('success', 'Producto eliminado.');
    }
}