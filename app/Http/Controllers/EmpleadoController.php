<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $empleados = Empleado::query();

        if ($search) {
            $empleados->where(function ($query) use ($search) {
                $query->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellido', 'like', "%{$search}%")
                    ->orWhere('correo', 'like', "%{$search}%")
                    ->orWhere('telefono', 'like', "%{$search}%")
                    ->orWhere('sexo', 'like', "%{$search}%")
                    ->orWhere('identidad', 'like', "%{$search}%")
                    ->orWhere('puesto', 'like', "%{$search}%");
            });
        }

        $empleados = $empleados->orderBy('id', 'desc')->paginate(10);

        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => ['required', 'string', 'max:30', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/'],
            'apellido' => ['required', 'string', 'max:30', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/'],
            'correo' => ['required', 'email', 'max:30', 'unique:empleados,correo'],
            'telefono' => ['required', 'max:8', 'regex:/^[2389]\d{7}$/', 'unique:empleados,telefono'],
            'sexo' => ['required', 'in:Masculino,Femenino,Otro'],
            'puesto' => ['required', 'string', 'max:255'],
            'salario' => ['required', 'numeric', 'min:0', 'max:99999.99'],
            'fecha_contratacion' => ['required', 'date', 'after_or_equal:2000-01-01', 'before_or_equal:today'],
            'direccion' => ['required', 'string', 'max:100'],
            'identidad' => [
                'required',
                'regex:/^\d{4}-\d{4}-\d{5}$/',
                'unique:empleados,identidad',
                function ($attribute, $value, $fail) {
                    $partes = explode('-', $value);
                    [$lugar, $anio, $correlativo] = $partes;

                    $departamento = (int)substr($lugar, 0, 2);
                    $municipio = (int)substr($lugar, 2, 2);

                    if ($departamento < 1 || $departamento > 18) {
                        return $fail('El código de departamento es inválido.');
                    }

                    if ($municipio < 1 || $municipio > 28) {
                        return $fail('El código de municipio es inválido.');
                    }

                    $anioActual = date('Y');
                    if ((int)$anio > (int)$anioActual) {
                        return $fail('El año de nacimiento no puede ser mayor al actual.');
                    }
                    if ((int)$anio < 1900) {
                        return $fail('El año de nacimiento no puede ser menor a 1900.');
                    }
                },
            ],
        ];

        $messages = [
            'identidad.required' => 'El número de identidad es obligatorio.',
            'identidad.regex' => 'El formato del número de identidad es inválido: debe ser ####-####-#####.',
            'identidad.unique' => 'Este número de identidad ya está registrado.',
        ];

        $request->validate($rules, $messages);

        try {
            Empleado::create($request->all());

            return redirect()->route('empleados.index')
                ->with('success', 'Empleado registrado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al registrar empleado: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Error al registrar el empleado. Por favor, inténtelo de nuevo.');
        }
    }

    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados.editar', compact('empleado'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $rules = [
            'nombre' => ['required', 'string', 'max:30', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/u'],
            'apellido' => ['required', 'string', 'max:30', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/u'],
            'correo' => [
                'required',
                'email',
                'max:30',
                Rule::unique('empleados')->ignore($empleado->id),
            ],
            'telefono' => [
                'required',
                'string',
                'max:8',
                'regex:/^[2389]\d{7}$/',
                Rule::unique('empleados')->ignore($empleado->id),
            ],
            'sexo' => ['required', 'in:Masculino,Femenino,Otro'],
            'identidad' => [
                'required',
                'regex:/^\d{4}-\d{4}-\d{5}$/',
                Rule::unique('empleados')->ignore($empleado->id),
                function ($attribute, $value, $fail) {
                    $partes = explode('-', $value);
                    [$lugar, $anio, $correlativo] = $partes;

                    $departamento = (int)substr($lugar, 0, 2);
                    $municipio = (int)substr($lugar, 2, 2);

                    if ($departamento < 1 || $departamento > 18) {
                        return $fail('El código de departamento es inválido.');
                    }

                    if ($municipio < 1 || $municipio > 28) {
                        return $fail('El código de municipio es inválido.');
                    }

                    $anioActual = date('Y');
                    if ((int)$anio > (int)$anioActual) {
                        return $fail('El año de nacimiento no puede ser mayor al actual.');
                    }
                    if ((int)$anio < 1900) {
                        return $fail('El año de nacimiento no puede ser menor a 1900.');
                    }
                },
            ],
            'puesto' => ['required', 'string', 'max:255'],
            'salario' => ['required', 'numeric', 'min:0', 'max:99999.99'],
            'fecha_contratacion' => ['required', 'date', 'after_or_equal:2000-01-01', 'before_or_equal:today'],
            'direccion' => ['required', 'string', 'max:100'],
            'estado' => ['required', 'in:Activo,Inactivo'],
        ];

        $messages = [
            'identidad.required' => 'El número de identidad es obligatorio.',
            'identidad.regex' => 'El formato del número de identidad es inválido: debe ser ####-####-#####.',
            'identidad.unique' => 'Este número de identidad ya está registrado.',
        ];

        $request->validate($rules, $messages);

        try {
            $empleado->update($request->all());

            return redirect()->route('empleados.index')
                ->with('success', 'Empleado actualizado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar empleado: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error al actualizar el empleado. Por favor, inténtelo de nuevo.');
        }
    }

    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados.show', compact('empleado'));
    }

    public function autocomplete(Request $request)
    {
        $query = $request->input('query');
        $suggestions = [];

        if ($query) {
            $empleados = Empleado::where('nombre', 'like', "%{$query}%")
                ->orWhere('apellido', 'like', "%{$query}%")
                ->orWhere('identidad', 'like', "%{$query}%")
                ->limit(10)
                ->get();

            foreach ($empleados as $empleado) {
                $suggestions[] = $empleado->nombre . ' ' . $empleado->apellido;
                $suggestions[] = $empleado->identidad;
            }

            $suggestions = array_values(array_unique($suggestions));
        }

        Log::info('Autocomplete suggestions:', ['query' => $query, 'suggestions' => $suggestions]);

        return response()->json($suggestions);
    }
}
