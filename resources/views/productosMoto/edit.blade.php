@extends('layouts.app')

@section('title', 'Editar producto de moto')

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-container">
                    <h2 class="mb-4">Editar producto de moto</h2>

                    <form id="formProductoMoto"
                          action="{{ route('productos_moto.update', $productos_moto) }}"
                          method="POST"
                          enctype="multipart/form-data"
                          novalidate>

                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input
                                        type="text"
                                        class="form-control @error('nombre') is-invalid @enderror"
                                        id="nombre"
                                        name="nombre"
                                        value="{{ old('nombre', $productos_moto->nombre) }}"
                                        required>
                                @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="marca" class="form-label">Marca:</label>
                                <select class="form-select @error('marca') is-invalid @enderror" id="marca" name="marca" required>
                                    <option value="">Seleccione una marca...</option>
                                    @php
                                        $marcas = ['Yamaha', 'Honda', 'Suzuki', 'Kawasaki', 'BMW', 'Ducati'];
                                    @endphp
                                    @foreach($marcas as $marca)
                                        <option value="{{ $marca }}" {{ old('marca', $productos_moto->marca) == $marca ? 'selected' : '' }}>
                                            {{ $marca }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('marca')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="modelo" class="form-label">Modelo:</label>
                                <input
                                        type="text"
                                        class="form-control @error('modelo') is-invalid @enderror"
                                        id="modelo"
                                        name="modelo"
                                        value="{{ old('modelo', $productos_moto->modelo) }}">
                                @error('modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="anio" class="form-label">Año:</label>
                                <input
                                        type="number"
                                        class="form-control @error('anio') is-invalid @enderror"
                                        id="anio"
                                        name="anio"
                                        value="{{ old('anio', $productos_moto->anio) }}">
                                @error('anio')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="categoria" class="form-label">Categoría:</label>
                                <select
                                        class="form-select @error('categoria') is-invalid @enderror"
                                        id="categoria"
                                        name="categoria">
                                    <option value="">Seleccione una categoría</option>
                                    @php
                                        $categorias = ['Motor', 'Frenos', 'Suspensión', 'Eléctrico', 'Accesorios'];
                                    @endphp
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria }}" {{ old('categoria', $productos_moto->categoria) == $categoria ? 'selected' : '' }}>
                                            {{ $categoria }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categoria')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="imagen" class="form-label">Imagen:</label>
                                <input
                                        type="file"
                                        class="form-control @error('imagen') is-invalid @enderror"
                                        id="imagen"
                                        name="imagen">
                                @error('imagen')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($productos_moto->imagen)
                                    <div class="mt-2">
                                        <p>Imagen actual:</p>
                                        <img src="{{ asset('storage/' . $productos_moto->imagen) }}" alt="Imagen del producto" class="img-thumbnail" style="max-width: 150px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea
                                    class="form-control @error('descripcion') is-invalid @enderror"
                                    id="descripcion"
                                    name="descripcion"
                                    rows="3">{{ old('descripcion', $productos_moto->descripcion) }}</textarea>
                            @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-warning">Guardar cambios</button>
                            <a href="{{ route('productos_moto.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
