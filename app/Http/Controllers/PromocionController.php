<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class PromocionController extends Controller
{
    public function index()
    {
        $promociones = Promocion::with('productos')->paginate(10);
        return view('promociones.index', compact('promociones'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('promociones.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $hoy = Carbon::today()->format('Y-m-d');

        $request->validate([
            'nombre' => ['required', 'string', 'max:60', 'regex:/^(?!\s).+$/'],
            'descripcion' => ['nullable', 'string', 'max:250', 'regex:/^(?!\s).+$/'],
            'descuento' => 'required|numeric|min:0|max:100',
            'fecha_inicio' => ['required', 'date', 'after_or_equal:'.$hoy],
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'productos' => 'required|array',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ], [
            'nombre.required' => 'El campo nombre es necesario.',
            'nombre.max' => 'El nombre no puede superar 60 caracteres.',
            'nombre.regex' => 'El nombre no puede comenzar con espacio.',
            'descripcion.max' => 'La descripción no puede superar 250 caracteres.',
            'descripcion.regex' => 'La descripción no puede comenzar con espacio.',
            'descuento.required' => 'El campo descuento es necesario.',
            'descuento.numeric' => 'El descuento debe ser un número.',
            'descuento.min' => 'El descuento no puede ser negativo.',
            'descuento.max' => 'El descuento no puede superar 100%.',
            'fecha_inicio.required' => 'La fecha de inicio es necesaria.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio no puede ser anterior a hoy.',
            'fecha_fin.required' => 'La fecha de fin es necesaria.',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'productos.required' => 'Debe seleccionar al menos un producto.',
        ]);

        try {
            $promocion = Promocion::create($request->only(['nombre','descripcion','descuento','fecha_inicio','fecha_fin']));

            if($request->hasFile('imagen')){
                $path = $request->file('imagen')->store('promociones', 'public');
                $promocion->imagen = $path;
                $promocion->save();
            }

            $promocion->productos()->sync($request->productos);

            return redirect()->route('promociones.index')->with('success','Promoción creada correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == 23000){
                return back()->with('error','No se permiten campos duplicados. El nombre de la promoción ya existe.')->withInput();
            }
            throw $e;
        }
    }

    public function show(Promocion $promocione)
    {
        $promocione->load('productos');
        return view('promociones.show', compact('promocione'));
    }

    public function edit(Promocion $promocione)


    {
        $productos = Producto::all();
        return view('promociones.edit', compact('promocione','productos'));
    }

    public function update(Request $request, Promocion $promocione)
    {
        $hoy = Carbon::today()->format('Y-m-d');

        $request->validate([
            'nombre' => ['required', 'string', 'max:60', 'regex:/^(?!\s).+$/'],
            'descripcion' => ['nullable', 'string', 'max:250', 'regex:/^(?!\s).+$/'],
            'descuento' => 'required|numeric|min:0|max:100',
            'fecha_inicio' => ['required', 'date', 'after_or_equal:'.$hoy],
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'productos' => 'required|array',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ], [
            'nombre.required' => 'El campo nombre es necesario.',
            'nombre.max' => 'El nombre no puede superar 60 caracteres.',
            'nombre.regex' => 'El nombre no puede comenzar con espacio.',
            'descripcion.max' => 'La descripción no puede superar 250 caracteres.',
            'descripcion.regex' => 'La descripción no puede comenzar con espacio.',
            'descuento.required' => 'El campo descuento es necesario.',
            'descuento.numeric' => 'El descuento debe ser un número.',
            'descuento.min' => 'El descuento no puede ser negativo.',
            'descuento.max' => 'El descuento no puede superar 100%.',
            'fecha_inicio.required' => 'La fecha de inicio es necesaria.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio no puede ser anterior a hoy.',
            'fecha_fin.required' => 'La fecha de fin es necesaria.',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'productos.required' => 'Debe seleccionar al menos un producto.',
        ]);

        $promocione->update($request->only(['nombre','descripcion','descuento','fecha_inicio','fecha_fin']));

        if($request->hasFile('imagen')){
            $path = $request->file('imagen')->store('promociones', 'public');
            $promocione->imagen = $path;
            $promocione->save();
        }

        $promocione->productos()->sync($request->productos);

        return redirect()->route('promociones.index')->with('success','Promoción actualizada correctamente.');
    }

    public function destroy(Promocion $promocione)
    {
        $promocione->productos()->detach();
        $promocione->delete();

        return redirect()->route('promociones.index')->with('success','Promoción eliminada correctamente.');
    }
}
