@extends('layouts.app')

@section('title', 'Lista de Productos de Moto')

@section('content')
    <div class="container py-5">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0 text-white">Lista de productos de moto</h2>
                <span class="text-white">Total: <strong>{{ $productos->total() }}</strong></span>
            </div>

            {{-- Mensajes de sesión --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            {{-- Botones y botón de regresar --}}
            <div class="d-flex mb-3 gap-2 align-items-center">
                <a href="{{ route('productos_moto.create') }}" class="btn btn-danger">+ Nuevo producto</a>
                <a href="{{ route('welcome') }}" class="btn btn-danger">Inicio</a>

                @if(request()->filled('nombre') || request()->filled('modelo') || request()->filled('anio') || request()->filled('marca') || request()->filled('categoria'))
                    <a href="{{ route('productos_moto.index') }}" class="btn btn-secondary ms-auto">Regresar a la lista</a>
                @endif
            </div>

            {{-- Filtros --}}
            <form action="{{ route('productos_moto.index') }}" method="GET" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-3">
                        <input type="text" name="nombre" class="form-control"
                               placeholder="Buscar por nombre" value="{{ request('nombre') }}">
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="modelo" class="form-control"
                               placeholder="Buscar por modelo" value="{{ request('modelo') }}">
                    </div>

                    <div class="col-md-2">
                        <input type="number" name="anio" class="form-control"
                               placeholder="Buscar por año" value="{{ request('anio') }}"
                               min="1990" max="{{ date('Y') }}">
                    </div>

                    <div class="col-md-2">
                        <select name="marca" class="form-control">
                            <option value="">Marca (todas)</option>
                            @php
                                $marcas = ['Yamaha', 'Honda', 'Suzuki', 'Kawasaki', 'BMW', 'Ducati'];
                            @endphp
                            @foreach($marcas as $marca)
                                <option value="{{ $marca }}" {{ request('marca') == $marca ? 'selected' : '' }}>
                                    {{ $marca }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="categoria" class="form-control">
                            <option value="">Categoría (todas)</option>
                            @php
                                $categorias = ['Motor', 'Frenos', 'Suspensión', 'Eléctrico', 'Accesorios'];
                            @endphp
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria }}" {{ request('categoria') == $categoria ? 'selected' : '' }}>
                                    {{ $categoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 d-grid">
                        <button type="submit" class="btn btn-danger">Buscar</button>
                    </div>
                </div>
            </form>

            {{-- Tabla --}}
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover text-center align-middle">
                    <thead class="bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Categoría</th>
                        <th>Año</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($productos as $producto)
                        <tr>
                            <td>{{ $loop->iteration + ($productos->currentPage() - 1) * $productos->perPage() }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->marca }}</td>
                            <td>{{ $producto->modelo }}</td>
                            <td>{{ $producto->categoria }}</td>
                            <td>{{ $producto->anio }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('productos_moto.show', $producto->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('productos_moto.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>

                                    {{-- Formulario de eliminación --}}
                                    <form action="{{ route('productos_moto.destroy', $producto) }}" method="POST"
                                          onsubmit="return confirm('¿Seguro que quieres eliminar este producto?');">
                                        @csrf
                                        @method('DELETE')

                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-white">No hay productos registrados.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center mt-4 mb-4">
                {{ $productos->withQueryString()->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
