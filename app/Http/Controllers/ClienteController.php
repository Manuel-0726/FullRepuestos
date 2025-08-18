<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Importar la clase Rule para validaciones más avanzadas

class ClienteController extends Controller
{
    /**
     * Muestra una lista de clientes.
     */
    public function index(Request $request)
    {
        $query = Cliente::query();

        // Lógica de búsqueda
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', '%' . $search . '%')
                    ->orWhere('apellido', 'like', '%' . $search . '%')
                    ->orWhere('identidad', 'like', '%' . $search . '%');
            });
        }

        $clientes = $query->paginate(10); // Pagina los resultados, 10 por página
        return view('cliente.index', compact('clientes'));
    }

    /**
     * Muestra el formulario para crear un nuevo cliente.
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Almacena un nuevo cliente en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:30|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/',
            'apellido' => 'required|string|max:30|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/',
            'correo' => 'required|email|max:30|unique:clientes,correo',
            'telefono' => 'required|string|digits_between:7,11|regex:/^[2389]\d*$/',
            'identidad' => [
                'required',
                'string',
                'max:15',
                'regex:/^\d{4}-\d{4}-\d{5}$/',
                Rule::unique('clientes', 'identidad')->ignore($request->id),
                function ($attribute, $value, $fail) {
                    $digits = str_replace('-', '', $value);

                    if (strlen($digits) !== 13) {
                        return $fail('El número de identidad debe tener 13 dígitos.');
                    }

                    $departamento = (int) substr($digits, 0, 2);
                    $municipio    = (int) substr($digits, 2, 2);
                    $anio         = (int) substr($digits, 4, 4);
                    $anioActual   = (int) date('Y');

                    if ($departamento < 1 || $departamento > 18) {
                        return $fail('El código de departamento no es válido.');
                    }

                    if ($municipio < 1 || $municipio > 28) {
                        return $fail('El código de municipio no es válido.');
                    }

                    if ($anio > $anioActual) {
                        return $fail('El año de nacimiento no puede ser mayor al año actual.');
                    }
                },
            ],
            'direccion' => 'required|string|max:100',
            'sexo' => 'required|in:Masculino,Femenino,Otro',
        ]);

        try {
            Cliente::create($request->all());
            return redirect()->route('cliente.index')->with('success', 'Cliente registrado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al registrar el cliente: ' . $e->getMessage());
        }
    }

    /**
     * Muestra los detalles de un cliente específico.
     */
    public function show(Cliente $cliente)
    {
        return view('cliente.show', compact('cliente'));
    }

    /**
     * Muestra el formulario para editar un cliente existente.
     */
    public function edit(Cliente $cliente)
    {
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Actualiza un cliente existente en la base de datos.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|string|max:30|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/',
            'apellido' => 'required|string|max:30|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/',
            'correo' => 'required|email|max:30|unique:clientes,correo,' . $cliente->id,
            'telefono' => 'required|string|digits_between:7,11|regex:/^[2389]\d*$/',
            'identidad' => [
                'required',
                'string',
                'max:15',
                'regex:/^\d{4}-\d{4}-\d{5}$/',
                Rule::unique('clientes', 'identidad')->ignore($cliente->id),
                function ($attribute, $value, $fail) {
                    $digits = str_replace('-', '', $value);

                    if (strlen($digits) !== 13) {
                        return $fail('El número de identidad debe tener 13 dígitos.');
                    }

                    $departamento = (int) substr($digits, 0, 2);
                    $municipio    = (int) substr($digits, 2, 2);
                    $anio         = (int) substr($digits, 4, 4);
                    $anioActual   = (int) date('Y');

                    if ($departamento < 1 || $departamento > 18) {
                        return $fail('El código de departamento no es válido.');
                    }

                    if ($municipio < 1 || $municipio > 28) {
                        return $fail('El código de municipio no es válido.');
                    }

                    if ($anio > $anioActual) {
                        return $fail('El año de nacimiento no puede ser mayor al año actual.');
                    }
                },
            ],
            'direccion' => 'required|string|max:100',
            'sexo' => 'required|in:Masculino,Femenino,Otro',
        ]);

        try {
            $cliente->update($request->all());
            return redirect()->route('cliente.index')->with('success', 'Cliente actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el cliente: ' . $e->getMessage());
        }
    }

    /**
     * Elimina un cliente de la base de datos.
     */
    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();
            return redirect()->route('cliente.index')->with('success', 'Cliente eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el cliente: ' . $e->getMessage());
        }
    }

    /**
     * Proporciona sugerencias para el autocompletado de clientes.
     */
    public function autocomplete(Request $request)
    {
        $query = $request->input('query');
        $clientes = Cliente::where('nombre', 'like', '%' . $query . '%')
            ->orWhere('apellido', 'like', '%' . $query . '%')
            ->orWhere('identidad', 'like', '%' . $query . '%')
            ->pluck('nombre')
            ->take(10);

        return response()->json($clientes);
    }
}
