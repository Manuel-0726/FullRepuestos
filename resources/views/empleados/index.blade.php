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
                <input type="text" name="search" id="searchInput" class="form-control"
                       placeholder="Buscar empleado por nombre, apellido o identidad"
                       value="{{ request('search') }}"
                       list="employeeSuggestions"
                       maxlength="30"
                       pattern="[a-zA-Z0-9\s]*"
                       title="Solo se permiten letras, números y espacios (máximo 30 caracteres)."
                       autocomplete="off"
                >
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

        if (searchInput.value.trim() !== '') {
            searchInput.focus();
        }

        clearSearchBtn.addEventListener('click', function() {
            searchInput.value = '';

            if (window.history.pushState) {
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.delete('search');
                window.history.pushState({ path: newUrl.href }, '', newUrl.href);
            }

            searchForm.submit();
        });

        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.has('search') && urlParams.get('search') !== '') {
            if (window.history.pushState) {
                urlParams.delete('search');
                const newUrl = window.location.pathname + urlParams.toString();
                window.history.replaceState({}, '', newUrl);
            }
        }

        window.addEventListener('pageshow', function(event) {
            if (event.persisted && !new URLSearchParams(window.location.search).has('search')) {
                searchInput.value = '';
                clearSearchBtn.style.display = 'none';
            }
        });

        searchInput.addEventListener('input', function(e) {
            let value = this.value;

            if (value.startsWith(' ')) {
                this.value = value.trimStart();
                value = this.value;
            }

            const cleanValue = value.replace(/[^a-zA-Z0-9\s]/g, '');

            if (value !== cleanValue) {
                this.value = cleanValue;
            }

            if (this.value.trim() !== '') {
                clearSearchBtn.style.display = 'block';
            } else {
                clearSearchBtn.style.display = 'none';
            }

            clearTimeout(debounceTimeout);
            if (this.value === cleanValue) {
                debounceTimeout = setTimeout(() => {
                    const query = this.value.trim();
                    if (query.length > 1) {
                        fetch(`/empleados/autocomplete?query=${encodeURIComponent(query)}`)
                            .then(response => response.json())
                            .then(data => {
                                employeeSuggestions.innerHTML = '';
                                if (data.length > 0) {
                                    data.forEach(item => {
                                        const option = document.createElement('option');
                                        option.value = item;
                                        employeeSuggestions.appendChild(option);
                                    });
                                }
                            })
                            .catch(error => console.error('Error al obtener datos de autocompletado de empleados:', error));
                    } else {
                        employeeSuggestions.innerHTML = '';
                    }
                }, 300);
            } else {
                employeeSuggestions.innerHTML = '';
            }
        });

        if (searchInput.value.trim() !== '') {
            clearSearchBtn.style.display = 'block';
        } else {
            clearSearchBtn.style.display = 'none';
        }
    });
</script>
</body>
</html>