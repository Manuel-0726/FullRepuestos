@extends('layouts.app')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Proveedores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>
<div class="container py-5">
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Lista de Proveedores</h2>
            <span class="text-pagination-summary">Total: <strong>{{ $proveedores->total() }}</strong></span>
        </div>

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
        <div class="d-flex mb-3 gap-2">
            <a href="{{ route('proveedores.create') }}" class="btn btn-danger">+ Nuevo Proveedor</a>
            <a href="{{ route('welcome') }}" class="btn btn-danger">Inicio</a>
        </div>


        <form action="{{ route('proveedores.index') }}" method="GET" class="mb-3" id="searchForm">


            <div class="input-group">
                <input type="text" name="search" id="searchInput" class="form-control search-input" placeholder="Buscar por empresa, país o teléfono" value="{{ request('search') }}" list="providerSuggestions">
                <datalist id="providerSuggestions"></datalist>
                <button type="submit" class="btn btn-danger">Buscar</button>
                <button type="button" class="btn btn-danger" id="clearSearchBtn" style="{{ request('search') ? 'display: block;' : 'display: none;' }}">Limpiar</button>
            </div>
        </form>



        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Empresa</th>
                        <th>País</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($proveedores as $proveedor)
                        <tr>
                            <td>{{ $loop->iteration + ($proveedores->currentPage() - 1) * $proveedores->perPage() }}</td>
                            <td>{{ $proveedor->nombre_empresa }}</td>
                            <td>{{ $proveedor->pais_origen }}</td>
                            <td>{{ $proveedor->telefono_contacto }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('proveedores.show', $proveedor->id) }}" class="btn btn-info btn-sm">Ver más</a>
                                    <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No hay proveedores registrados que coincidan con la búsqueda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4 mb-4">
            {{ $proveedores->withQueryString()->links('vendor.pagination.bootstrap-5') }}
        </div>


    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const providerSuggestions = document.getElementById('providerSuggestions');
        const clearSearchBtn = document.getElementById('clearSearchBtn');
        const searchForm = document.getElementById('searchForm');

        let debounceTimeout;

        // Mostrar/ocultar botón "Limpiar" al cargar la página si hay texto en el input
        if (searchInput.value.trim() !== '') {
            clearSearchBtn.style.display = 'block';
        } else {
            clearSearchBtn.style.display = 'none';
        }

        // Manejador para el botón "Limpiar"
        clearSearchBtn.addEventListener('click', function() {
            searchInput.value = '';
            clearSearchBtn.style.display = 'none';
            searchForm.submit(); // Envía el formulario para recargar sin búsqueda
        });

        // Manejador para el input de búsqueda (autocompletado)
        searchInput.addEventListener('input', function() {
            // Mostrar/ocultar botón "Limpiar" mientras se escribe
            if (this.value.trim() !== '') {
                clearSearchBtn.style.display = 'block';
            } else {
                clearSearchBtn.style.display = 'none';
            }

            clearTimeout(debounceTimeout); // Limpiar el timeout anterior
            debounceTimeout = setTimeout(() => {
                const query = this.value.trim();

                // Solo hacer la petición si la consulta tiene al menos 2 caracteres
                if (query.length > 1) {
                    fetch(`/proveedores/autocomplete?query=${encodeURIComponent(query)}`)
                        .then(response => {
                            if (!response.ok) {
                                return response.text().then(text => {
                                    throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            providerSuggestions.innerHTML = ''; // Limpiar sugerencias anteriores
                            if (data.length > 0) {
                                data.forEach(item => {
                                    const option = document.createElement('option');
                                    option.value = item;
                                    providerSuggestions.appendChild(option);
                                });
                            }
                        })
                        .catch(error => console.error('Error al obtener datos de autocompletado de proveedores:', error));
                } else {
                    providerSuggestions.innerHTML = ''; // Limpiar sugerencias si la consulta es muy corta
                }
            }, 300); // Retraso de 300ms (debounce) para evitar muchas peticiones
        });

        // NUEVO: Manejador para detectar cuándo se selecciona una sugerencia y enviar el formulario
        searchInput.addEventListener('change', function() {
            // Este evento 'change' se dispara cuando el usuario selecciona una opción de la datalist
            // o cuando el valor del input cambia y el foco sale.
            // Si el valor del input coincide con una opción del datalist, se considera una selección.
            
            // Un pequeño retraso asegura que el valor del input se haya actualizado
            // después de la selección del datalist.
            setTimeout(() => {
                const selectedValue = this.value;
                const options = Array.from(providerSuggestions.options).map(option => option.value);

                if (options.includes(selectedValue)) {
                    // Si el valor actual del input es una de las sugerencias,
                    // significa que el usuario seleccionó una.
                    searchForm.submit(); // Envía el formulario para buscar
                }
            }, 0); // Retraso mínimo
        });
    });
</script>
</body>
</html>