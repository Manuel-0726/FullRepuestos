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
        $query = Empleado::query();

        if ($request->has('search')) {

            $search = trim($request->input('search'));

            $search = substr($search, 0, 30);

            if ($search != '' && preg_match('/^[a-zA-Z0-9\s]+$/', $search)) {

                $searchLower = strtolower($search);

                $keywords = preg_split('/\s+/', $searchLower, -1, PREG_SPLIT_NO_EMPTY);

                $query->where(function($q) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $q->where(function($qq) use ($keyword) {
                            $qq->whereRaw('LCASE(nombre) LIKE ?', ['%' . $keyword . '%'])
                                ->orWhereRaw('LCASE(apellido) LIKE ?', ['%' . $keyword . '%'])
                                ->orWhereRaw('LCASE(correo) LIKE ?', ['%' . $keyword . '%'])
                                ->orWhereRaw('LCASE(telefono) LIKE ?', ['%' . $keyword . '%'])
                                ->orWhereRaw('LCASE(sexo) LIKE ?', ['%' . $keyword . '%'])
                                ->orWhereRaw('LCASE(identidad) LIKE ?', ['%' . $keyword . '%'])
                                ->orWhereRaw('LCASE(puesto) LIKE ?', ['%' . $keyword . '%']);
                        });
                    }
                });
            }

            $request->merge(['search' => $search]);
        }

        $empleados = $query->orderBy('id', 'asc')->paginate(10);
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['nombre'] = trim($input['nombre'] ?? '');
        $input['apellido'] = trim($input['apellido'] ?? '');
        $input['correo'] = trim($input['correo'] ?? '');
        $input['direccion'] = trim($input['direccion'] ?? '');
        $request->replace($input);

        $rules = [
            'nombre' => ['required', 'string', 'max:30', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/'],
            'apellido' => ['required', 'string', 'max:30', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/'],
            'correo' => ['required', 'email', 'max:30', 'unique:empleados,correo'],
            'telefono' => ['required', 'max:8', 'regex:/^[2389]\d{7}$/', 'unique:empleados,telefono'],
            'sexo' => ['required', 'in:Masculino,Femenino,Otro'],
            'puesto' => ['required', 'string', 'max:255'],
            'salario' => ['required', 'integer', 'min:1', 'max:99999'],
            'fecha_contratacion' => ['required', 'date', 'after_or_equal:2000-01-01', 'before_or_equal:today'],
            'direccion' => ['required', 'string', 'max:100', 'regex:/[a-zA-Z]/'],
            'identidad' => [
                'required',
                'regex:/^\d{4}-\d{4}-\d{5}$/',
                'unique:empleados,identidad',
                function ($attribute, $value, $fail) {
                    $partes = explode('-', $value);
                    // CAMBIO APLICADO: Asegurarse de que el formato de la identidad es correcto
                    if (count($partes) !== 3) {
                        return $fail('El formato del número de identidad es inválido: debe ser ####-####-#####.');
                    }
                    [$lugar, $anio, $correlativo] = $partes;

                    $departamento = (int)substr($lugar, 0, 2);
                    $municipio = (int)substr($lugar, 2, 2);

                    $anioActual = date('Y');
                    $edad = $anioActual - (int)$anio;
                    $limiteAnio = $anioActual - 18;

                    if ($departamento < 1 || $departamento > 18) {
                        return $fail('El código de departamento es inválido (debe ser entre 01 y 18).');
                    }
                    if ($municipio < 1 || $municipio > 28) {
                    }

                    if ((int)$anio > (int)$limiteAnio) {
                        return $fail('El empleado debe ser mayor de 18 años.');
                    }
                    if ((int)$anio > (int)$anioActual) {
                        return $fail('El año de nacimiento no puede ser futuro.');
                    }
                    if ((int)$anio < 1900) {
                        return $fail('El año de nacimiento no puede ser menor a 1900.');
                    }
                },
            ],
        ];

        $messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no debe exceder los 30 caracteres.',
            'nombre.regex' => 'El nombre solo debe contener letras, espacios o guiones.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.max' => 'El apellido no debe exceder los 30 caracteres.',
            'apellido.regex' => 'El apellido solo debe contener letras, espacios o guiones.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'El formato del correo es inválido.',
            'correo.max' => 'El correo no debe exceder los 30 caracteres.',
            'correo.unique' => 'Este correo ya está registrado.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.max' => 'El teléfono debe tener 8 dígitos.',
            'telefono.regex' => 'El formato del teléfono es inválido (debe iniciar con 2, 3, 8 o 9).',
            'telefono.unique' => 'Este teléfono ya está registrado.',
            'sexo.required' => 'El sexo es obligatorio.',
            'sexo.in' => 'El sexo seleccionado no es válido.',
            'puesto.required' => 'El puesto es obligatorio.',

            'salario.required' => 'El salario es obligatorio.',
            'salario.integer' => 'El salario debe ser un número entero (sin decimales).',
            'salario.min' => 'El salario debe ser un número positivo.',
            'salario.max' => 'El salario no debe exceder L. 99,999.',

            'fecha_contratacion.required' => 'La fecha de contratación es obligatoria.',
            'fecha_contratacion.date' => 'El formato de la fecha es incorrecto.',
            'fecha_contratacion.after_or_equal' => 'La fecha de contratación no puede ser anterior al 01/01/2000.',
            'fecha_contratacion.before_or_equal' => 'La fecha de contratación no puede ser futura.',

            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.max' => 'La dirección no debe exceder los 100 caracteres.',
            'direccion.regex' => 'La dirección debe contener letras.',

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
        $input = $request->all();
        $input['nombre'] = trim($input['nombre'] ?? '');
        $input['apellido'] = trim($input['apellido'] ?? '');
        $input['correo'] = trim($input['correo'] ?? '');
        $input['direccion'] = trim($input['direccion'] ?? '');
        $request->replace($input);

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
            'puesto' => ['required', 'string', 'max:255'],
            // 3. CAMBIO: Salario debe ser entero (integer)
            'salario' => ['required', 'integer', 'min:1', 'max:99999'],
            'fecha_contratacion' => ['required', 'date', 'after_or_equal:2000-01-01', 'before_or_equal:today'],
            // 4. CAMBIO: Dirección debe contener letras
            'direccion' => ['required', 'string', 'max:100', 'regex:/[a-zA-Z]/'],
            'estado' => ['required', 'in:Activo,Inactivo'],
            'identidad' => [
                'required',
                'regex:/^\d{4}-\d{4}-\d{5}$/',
                Rule::unique('empleados')->ignore($empleado->id),
                function ($attribute, $value, $fail) {
                    $partes = explode('-', $value);
                    // CAMBIO APLICADO: Asegurarse de que el formato de la identidad es correcto
                    if (count($partes) !== 3) {
                        return $fail('El formato del número de identidad es inválido: debe ser ####-####-#####.');
                    }
                    [$lugar, $anio, $correlativo] = $partes;

                    $departamento = (int)substr($lugar, 0, 2);
                    $municipio = (int)substr($lugar, 2, 2);

                    // 2. CAMBIO: No permitir menores de 18 años (solo se puede verificar el año)
                    $anioActual = date('Y');
                    $edad = $anioActual - (int)$anio;
                    $limiteAnio = $anioActual - 18;


                    if ($departamento < 1 || $departamento > 18) {
                        return $fail('El código de departamento es inválido (debe ser entre 01 y 18).');
                    }
                    if ($municipio < 1 || $municipio > 28) {
                        // return $fail('El código de municipio es inválido.'); // Mensaje menos específico
                    }

                    if ((int)$anio > (int)$limiteAnio) {
                        return $fail('El empleado debe ser mayor de 18 años.');
                    }
                    if ((int)$anio > (int)$anioActual) {
                        return $fail('El año de nacimiento no puede ser futuro.');
                    }
                    if ((int)$anio < 1900) {
                        return $fail('El año de nacimiento no puede ser menor a 1900.');
                    }
                },
            ],
        ];

        // 1. CAMBIO: Mensajes de validación en español (se repiten para update)
        $messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no debe exceder los 30 caracteres.',
            'nombre.regex' => 'El nombre solo debe contener letras, espacios o guiones.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.max' => 'El apellido no debe exceder los 30 caracteres.',
            'apellido.regex' => 'El apellido solo debe contener letras, espacios o guiones.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'El formato del correo es inválido.',
            'correo.max' => 'El correo no debe exceder los 30 caracteres.',
            'correo.unique' => 'Este correo ya está registrado.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.max' => 'El teléfono debe tener 8 dígitos.',
            'telefono.regex' => 'El formato del teléfono es inválido (debe iniciar con 2, 3, 8 o 9).',
            'telefono.unique' => 'Este teléfono ya está registrado.',
            'sexo.required' => 'El sexo es obligatorio.',
            'sexo.in' => 'El sexo seleccionado no es válido.',
            'puesto.required' => 'El puesto es obligatorio.',

            'salario.required' => 'El salario es obligatorio.',
            // 3. CAMBIO: Mensajes para salario entero
            'salario.integer' => 'El salario debe ser un número entero (sin decimales).',
            'salario.min' => 'El salario debe ser un número positivo.',
            'salario.max' => 'El salario no debe exceder L. 99,999.',

            'fecha_contratacion.required' => 'La fecha de contratación es obligatoria.',
            'fecha_contratacion.date' => 'El formato de la fecha es incorrecto.',
            'fecha_contratacion.after_or_equal' => 'La fecha de contratación no puede ser anterior al 01/01/2000.',
            'fecha_contratacion.before_or_equal' => 'La fecha de contratación no puede ser futura.',

            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.max' => 'La dirección no debe exceder los 100 caracteres.',
            // 4. CAMBIO: Mensaje para evitar solo números en dirección
            'direccion.regex' => 'La dirección debe contener letras.',

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