@extends('layouts.app')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de empleados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>
<div class="container py-5">
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Lista de empleados</h2>
            <span class="text-muted">Total: <strong>{{ $empleados->total() }}</strong></span>
        </div>

        {{-- Mensajes de éxito y error --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif



        <form action="{{ route('empleados.index') }}" method="GET" class="mb-3" id="searchForm">


            <div class="d-flex gap-3 justify-content-start mb-3">
                <a href="{{ route('empleados.create') }}" class="btn btn-danger">+ Nuevo empleado</a>
                <a href="{{ route('welcome') }}" class="btn btn-danger">Inicio</a>
            </div>

            <div class="input-group mb-3">
                <input type="text" name="search" id="searchInput" class="form-control" placeholder="Buscar empleado por nombre, apellido o identidad" value="{{ request('search') }}" list="employeeSuggestions">
                <datalist id="employeeSuggestions"></datalist>
                <button type="submit" class="btn btn-danger">Buscar</button>
                <button type="button" class="btn btn-secondary" id="clearSearchBtn" style="{{ request('search') ? 'display: block;' : 'display: none;' }}">Limpiar</button>
            </div>

        </form>

        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Identidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($empleados as $empleado)
                        <tr>
                            <td>{{ $loop->iteration + ($empleados->currentPage() - 1) * $empleados->perPage() }}</td>
                            <td>{{ $empleado->nombre }}</td>
                            <td>{{ $empleado->apellido }}</td>
                            <td>{{ $empleado->identidad }}</td>
                            <td>
                                <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-info btn-sm me-1">Ver más</a>
                                <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No hay empleados registrados que coincidan con la búsqueda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación personalizada (¡IMPORTANTE: Asegúrate de tener la vista 'vendor.pagination.bootstrap-5' actualizada!) --}}
        <div class="d-flex justify-content-center mt-4 mb-4">
            {{ $empleados->withQueryString()->links('vendor.pagination.bootstrap-5') }}
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const employeeSuggestions = document.getElementById('employeeSuggestions');
        const clearSearchBtn = document.getElementById('clearSearchBtn');
        const searchForm = document.getElementById('searchForm');

        let debounceTimeout;

        // Función para limpiar la búsqueda
        clearSearchBtn.addEventListener('click', function() {
            searchInput.value = ''; // Limpiar el input
            searchForm.submit(); // Enviar el formulario para recargar la página sin búsqueda
        });

        // Mostrar/ocultar el botón de limpiar basado en si hay texto en el input
        searchInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                clearSearchBtn.style.display = 'block';
            } else {
                clearSearchBtn.style.display = 'none';
            }

            // Lógica de autocompletado
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                const query = this.value.trim();
                console.log('Query para autocompletar:', query); // DEBUG: Muestra la consulta
                if (query.length > 1) { // Mínimo 2 caracteres para autocompletar
                    fetch(`/empleados/autocomplete?query=${encodeURIComponent(query)}`)
                        .then(response => {
                            console.log('Response status:', response.status); // DEBUG: Muestra el estado de la respuesta
                            if (!response.ok) {
                                // Intenta leer el cuerpo del error si la respuesta no es OK
                                return response.text().then(text => {
                                    throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Datos de autocompletado recibidos:', data); // DEBUG: Muestra los datos recibidos
                            employeeSuggestions.innerHTML = ''; // Limpiar sugerencias anteriores
                            if (data.length > 0) {
                                data.forEach(item => {
                                    const option = document.createElement('option');
                                    option.value = item;
                                    employeeSuggestions.appendChild(option);
                                });
                            } else {
                                console.log('No se encontraron sugerencias.');
                            }
                        })
                        .catch(error => console.error('Error al obtener datos de autocompletado:', error)); // DEBUG: Muestra cualquier error de fetch
                } else {
                    employeeSuggestions.innerHTML = ''; // Limpiar si el query es muy corto
                    console.log('Consulta muy corta para autocompletar.');
                }
            }, 300); // Debounce de 300ms
        });

        // Inicializar el estado del botón de limpiar al cargar la página
        if (searchInput.value.trim() !== '') {
            clearSearchBtn.style.display = 'block';
        } else {
            clearSearchBtn.style.display = 'none';
        }
    });
</script>
</body>
</html>
