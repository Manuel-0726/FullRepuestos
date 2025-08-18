@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-white">Registrar nueva promoción</h1>

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div id="alertSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        {{-- Mostrar error de duplicado --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <form id="formPromocion" action="{{ route('promociones.store') }}" method="POST" enctype="multipart/form-data" class="bg-dark p-4 rounded" novalidate>
            @csrf

            <div class="mb-3">
                <label class="form-label text-white">Nombre</label>
                <input type="text" name="nombre" maxlength="60" pattern="^[^\s].*$"
                       title="El nombre no puede iniciar con un espacio"
                       class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                @error('nombre')
                <div class="text-danger">{{ $message }}</div>
                @else
                    <div class="invalid-feedback">El campo nombre es necesario.</div>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Descripción</label>
                <textarea name="descripcion" maxlength="250" pattern="^[^\s].*$"
                          title="La descripción no puede iniciar con un espacio"
                          class="form-control @error('descripcion') is-invalid @enderror" required>{{ old('descripcion') }}</textarea>
                @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
                @else
                    <div class="invalid-feedback">El campo descripción es necesario.</div>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror"
                       value="{{ old('fecha_inicio') }}" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" required>
                @error('fecha_inicio')
                <div class="text-danger">{{ $message }}</div>
                @else
                    <div class="invalid-feedback">La fecha de inicio no puede ser anterior a hoy.</div>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Fecha Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror"
                       value="{{ old('fecha_fin') }}" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" required>
                @error('fecha_fin')
                <div class="text-danger">{{ $message }}</div>
                @else
                    <div class="invalid-feedback">La fecha fin no puede ser anterior a la fecha de inicio ni a hoy.</div>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Descuento (%)</label>
                <input type="number" name="descuento" step="0.01" class="form-control @error('descuento') is-invalid @enderror" value="{{ old('descuento') }}" required>
                @error('descuento')
                <div class="text-danger">{{ $message }}</div>
                @else
                    <div class="invalid-feedback">El campo descuento es necesario.</div>
                    @enderror
            </div>

            {{-- Imagen de la promoción --}}
            <div class="mb-3">
                <label class="form-label text-white">Imagen de la promoción</label>
                <input type="file" name="imagen" accept="image/*" class="form-control" id="imagenInput">
                <div class="mt-2">
                    <img id="previewImagen" src="#" alt="Previsualización" style="max-width: 200px; display:none;" class="rounded shadow">
                </div>
            </div>

            {{-- Productos con select y tabla --}}
            <div class="mb-3">
                <label class="form-label text-white">Seleccione los productos para la promocion:</label>
                <select id="selectProducto" class="form-control mb-2">
                    <option value="" disabled selected>Seleccionar producto...</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>

                <table class="table table-dark table-striped">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody id="productosSeleccionados">
                    {{-- Aquí se agregarán productos seleccionados --}}
                    </tbody>
                </table>
                @error('productos')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="submit" class="btn btn-danger">Guardar</button>
                <button type="button" id="btnLimpiar" class="btn btn-danger">Limpiar</button>
                <a href="{{ route('promociones.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const alert = document.getElementById('alertSuccess');
            if(alert){
                setTimeout(() => {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    bsAlert.close(); // Cierra la alerta automáticamente
                }, 5000); // 5000 ms = 5 segundos
            }
        });

        (function () {
            'use strict';
            const form = document.getElementById('formPromocion');

            // Validación de formulario
            form.addEventListener('submit', function (event) {
                const tbody = document.getElementById('productosSeleccionados');
                tbody.querySelectorAll('tr').forEach(row => {
                    const productId = row.dataset.id;
                    if (!form.querySelector('input[name="productos[]"][value="'+productId+'"]')) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'productos[]';
                        input.value = productId;
                        form.appendChild(input);
                    }
                });

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);

            // Botón Limpiar
            const btnLimpiar = document.getElementById('btnLimpiar');
            if(btnLimpiar){
                btnLimpiar.addEventListener('click', function() {
                    form.querySelectorAll('input, textarea').forEach(el => el.value = '');
                    form.querySelectorAll('input[type="hidden"]').forEach(el => el.remove());
                    const tbody = document.getElementById('productosSeleccionados');
                    tbody.innerHTML = '';
                    const preview = document.getElementById('previewImagen');
                    if(preview) preview.style.display = 'none';
                    form.classList.remove('was-validated');
                });
            }

            // Evitar espacio al inicio en nombre y descripción
            const noSpaceStart = form.querySelectorAll('input[name="nombre"], textarea[name="descripcion"]');
            noSpaceStart.forEach(el => {
                el.addEventListener('keydown', function(e) {
                    if (e.key === " " && this.value.length === 0) {
                        e.preventDefault();
                    }
                });
            });

            // Previsualizar imagen
            const imagenInput = document.getElementById('imagenInput');
            const previewImagen = document.getElementById('previewImagen');
            if(imagenInput && previewImagen){
                imagenInput.addEventListener('change', function(e){
                    const file = e.target.files[0];
                    if(file){
                        const reader = new FileReader();
                        reader.onload = function(event){
                            previewImagen.src = event.target.result;
                            previewImagen.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Manejo de productos seleccionados
            const selectProducto = document.getElementById('selectProducto');
            const tbody = document.getElementById('productosSeleccionados');

            selectProducto.addEventListener('change', function() {
                const selectedId = this.value;
                const selectedText = this.options[this.selectedIndex].text;
                if (tbody.querySelector('tr[data-id="'+selectedId+'"]')) return;

                const row = document.createElement('tr');
                row.dataset.id = selectedId;
                row.innerHTML = `
                    <td>${selectedText}</td>
                    <td><button type="button" class="btn btn-sm btn-danger btn-eliminar">Eliminar</button></td>
                `;
                tbody.appendChild(row);

                row.querySelector('.btn-eliminar').addEventListener('click', function() {
                    row.remove();
                });
            });

        })();
    </script>
@endsection
