

<?php $__env->startSection('title', 'Lista de Proveedores'); ?>

<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Lista de Proveedores</h2>
                <span class="text-pagination-summary">Total: <strong><?php echo e($proveedores->total()); ?></strong></span>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="d-flex mb-3 gap-2">
                <a href="<?php echo e(route('proveedores.create')); ?>" class="btn btn-danger">+ Nuevo Proveedor</a>
                <a href="<?php echo e(route('welcome')); ?>" class="btn btn-danger">Inicio</a>
            </div>

            <form action="<?php echo e(route('proveedores.index')); ?>" method="GET" class="mb-3" id="searchForm">
                <div class="input-group">
                    <input type="text" name="search" id="searchInput" class="form-control search-input" placeholder="Buscar por empresa, país o teléfono" value="<?php echo e(request('search')); ?>" list="providerSuggestions">
                    <datalist id="providerSuggestions"></datalist>
                    <button type="submit" class="btn btn-danger">Buscar</button>
                    <button type="button" class="btn btn-danger" id="clearSearchBtn" style="<?php echo e(request('search') ? 'display: block;' : 'display: none;'); ?>">Limpiar</button>
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
                    <?php $__empty_1 = true; $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration + ($proveedores->currentPage() - 1) * $proveedores->perPage()); ?></td>
                            <td><?php echo e($proveedor->nombre_empresa); ?></td>
                            <td><?php echo e($proveedor->pais_origen); ?></td>
                            <td><?php echo e($proveedor->telefono_contacto); ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="<?php echo e(route('proveedores.show', $proveedor->id)); ?>" class="btn btn-info btn-sm">Ver más</a>
                                    <a href="<?php echo e(route('proveedores.edit', $proveedor->id)); ?>" class="btn btn-warning btn-sm">Editar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5">No hay proveedores registrados que coincidan con la búsqueda.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4 mb-4">
                <?php echo e($proveedores->withQueryString()->links('vendor.pagination.bootstrap-5')); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
                if (this.value.trim() !== '') {
                    clearSearchBtn.style.display = 'block';
                } else {
                    clearSearchBtn.style.display = 'none';
                }

                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(() => {
                    const query = this.value.trim();

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
                                providerSuggestions.innerHTML = '';
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
                        providerSuggestions.innerHTML = '';
                    }
                }, 300);
            });

            // Manejador para detectar cuando se selecciona una sugerencia y enviar el formulario
            searchInput.addEventListener('change', function() {
                setTimeout(() => {
                    const selectedValue = this.value;
                    const options = Array.from(providerSuggestions.options).map(option => option.value);

                    if (options.includes(selectedValue)) {
                        searchForm.submit();
                    }
                }, 0);
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/proveedores/index.blade.php ENDPATH**/ ?>