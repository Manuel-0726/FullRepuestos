@extends('layouts.app')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de clientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>
<div class="container py-5">
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Lista de clientes</h2>
            <span class="text-muted">Total: <strong>{{ $clientes->total() }}</strong></span>
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

        {{-- Enlace para crear nuevo cliente, corregido a 'cliente.create' --}}

        <div class="d-flex mb-3 gap-2">
            <a href="{{ route('cliente.create') }}" class="btn btn-danger">+ Nuevo cliente</a>

            <a href="{{ route('welcome') }}" class="btn btn-danger">Inicio</a>
        </div>
        <form action="{{ route('cliente.index') }}" method="GET" class="mb-3" id="searchForm"> {{-- Formulario de búsqueda corregido a 'cliente.index' --}}
            <div class="input-group">
                <input type="text" name="search" id="searchInput" class="form-control" placeholder="Buscar cliente por nombre, apellido o identidad" value="{{ request('search') }}" list="clientSuggestions">
                <datalist id="clientSuggestions"></datalist>
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
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($clientes as $cliente)
                    <tr>
                        <td>{{ $loop->iteration + ($clientes->currentPage() - 1) * $clientes->perPage() }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->apellido }}</td>
                        <td>{{ $cliente->identidad }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>
                            {{-- Enlaces de acciones, corregidos a 'cliente.show', 'cliente.edit', 'cliente.destroy' --}}
                            <a href="{{ route('cliente.show', $cliente->id) }}" class="btn btn-info btn-sm me-1">Ver más</a>
                            <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este cliente?');" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No hay clientes registrados que coincidan con la búsqueda.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $clientes->withQueryString()->links('vendor.pagination.bootstrap-5') }}
        </div>


    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const clientSuggestions = document.getElementById('clientSuggestions');
        const clearSearchBtn = document.getElementById('clearSearchBtn');
        const searchForm = document.getElementById('searchForm');

        let debounceTimeout;

        clearSearchBtn.addEventListener('click', function() {
            searchInput.value = '';
            searchForm.submit();
        });

        searchInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                clearSearchBtn.style.display = 'block';
            } else {
                clearSearchBtn.style.display = 'none';
            }

            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                const query = this.value.trim();
                if (query.length > 1) {
                    // Ruta de autocompletado para clientes, corregida a 'cliente.autocomplete'
                    fetch(`/cliente/autocomplete?query=${encodeURIComponent(query)}`)
                        .then(response => {
                            if (!response.ok) {
                                return response.text().then(text => {
                                    throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            clientSuggestions.innerHTML = '';
                            if (data.length > 0) {
                                data.forEach(item => {
                                    const option = document.createElement('option');
                                    option.value = item;
                                    clientSuggestions.appendChild(option);
                                });
                            }
                        })
                        .catch(error => console.error('Error al obtener datos de autocompletado de clientes:', error));
                } else {
                    clientSuggestions.innerHTML = '';
                }
            }, 300);
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
