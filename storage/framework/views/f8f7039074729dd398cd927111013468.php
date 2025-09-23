

<?php $__env->startSection('title', 'Lista de empleados'); ?>

<?php $__env->startSection('content'); ?>

    <div class="container py-5">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Lista de empleados</h2>
                <span class="text-muted">Total: <strong><?php echo e($empleados->total()); ?></strong></span>
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


            <form action="<?php echo e(route('empleados.index')); ?>" method="GET" class="mb-3" id="searchForm">


                <div class="d-flex gap-3 justify-content-start mb-3">
                    <a href="<?php echo e(route('empleados.create')); ?>" class="btn btn-danger">+ Nuevo empleado</a>
                    <a href="<?php echo e(route('welcome')); ?>" class="btn btn-danger">Inicio</a>
                </div>

                <div class="input-group mb-3">
                    <input type="text" name="search" id="searchInput" class="form-control"
                           placeholder="Buscar empleado por nombre, apellido o identidad"
                           value="<?php echo e(request('search')); ?>"
                           list="employeeSuggestions"
                           maxlength="30"
                           pattern="[a-zA-Z0-9\s]*"
                           title="Solo se permiten letras, números y espacios (máximo 30 caracteres)."
                           autocomplete="off"
                    >
                    <datalist id="employeeSuggestions"></datalist>
                    <button type="submit" class="btn btn-danger">Buscar</button>
                    <button type="button" class="btn btn-secondary" id="clearSearchBtn" style="<?php echo e(request('search') ? 'display: block;' : 'display: none;'); ?>">Limpiar</button>
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
                    <?php $__empty_1 = true; $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration + ($empleados->currentPage() - 1) * $empleados->perPage()); ?></td>
                            <td><?php echo e($empleado->nombre); ?></td>
                            <td><?php echo e($empleado->apellido); ?></td>
                            <td><?php echo e($empleado->identidad); ?></td>
                            <td>
                                <a href="<?php echo e(route('empleados.show', $empleado->id)); ?>" class="btn btn-info btn-sm me-1">Ver más</a>
                                <a href="<?php echo e(route('empleados.edit', $empleado->id)); ?>" class="btn btn-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5">No hay empleados registrados que coincidan con la búsqueda.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4 mb-4">
                <?php echo e($empleados->withQueryString()->links('vendor.pagination.bootstrap-5')); ?>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/empleados/index.blade.php ENDPATH**/ ?>