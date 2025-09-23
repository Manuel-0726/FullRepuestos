

<?php $__env->startSection('title', 'Lista de lubricantes y otros productos'); ?>

<?php $__env->startSection('content'); ?>
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de lubricantes y otros productos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container py-5">
    <div class="table-container">

        <div class="d-flex justify-content-between align-items-center mb-4 text-white">
            <h2 class="mb-0">Lista de lubricantes y otros productos</h2>
            <span class="text-muted">Total: <strong><?php echo e($lubricantes->total()); ?></strong></span>
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
            <a href="<?php echo e(route('lubricantes.create')); ?>" class="btn btn-danger">
                <i class="fas fa-plus me-1"></i> Nuevo producto
            </a>
            <a href="<?php echo e(route('welcome')); ?>" class="btn btn-danger">Inicio</a>
        </div>

        <form method="GET" action="<?php echo e(route('lubricantes.index')); ?>" class="mb-3" id="searchForm" autocomplete="off">
            <div class="input-group">
                <input
                        type="search"
                        name="search"
                        id="searchInput"
                        class="form-control bg-dark text-white"
                        placeholder="Buscar por nombre, código o marca"
                        value="<?php echo e(request('search')); ?>"
                        maxlength="50"
                        autocomplete="off"
                >
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-search"></i> Buscar
                </button>
                <button type="button" class="btn btn-secondary" id="clearSearchBtn"
                        style="<?php echo e(request('search') ? 'display: block;' : 'display: none;'); ?>" title="Limpiar búsqueda">
                    Limpiar
                </button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover text-center align-middle">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Nombre/Descripción</th>
                    <th>Marca</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $lubricantes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lubricante): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration + ($lubricantes->currentPage() - 1) * $lubricantes->perPage()); ?></td>

                        <td><?php echo e($lubricante->codigo ?? 'N/A'); ?></td>
                        <td><?php echo e($lubricante->nombre); ?></td>
                        <td><?php echo e($lubricante->marca); ?></td>
                        <td><?php echo e($lubricante->tipo_producto); ?></td>

                        <td class="<?php echo e($lubricante->stock == 0 ? 'text-warning fw-bold' : ($lubricante->stock < 5 ? 'text-danger fw-bold' : 'text-success')); ?>">
                            <?php echo e($lubricante->stock); ?>

                            <?php if($lubricante->stock == 0): ?>
                                <span class="badge bg-warning text-dark ms-1">Agotado</span>
                            <?php elseif($lubricante->stock < 5): ?>
                                <span class="badge bg-danger ms-1">Bajo</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="<?php echo e(route('lubricantes.show', $lubricante->id)); ?>" class="btn btn-info btn-sm me-1">Ver más</a>
                            <a href="<?php echo e(route('lubricantes.edit', $lubricante->id)); ?>" class="btn btn-warning btn-sm">Editar</a>
                            <form action="<?php echo e(route('lubricantes.destroy', $lubricante->id)); ?>" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este cliente?');" style="display:inline-block;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center text-light py-3">
                            <i class="fas fa-box-open me-2"></i> No se encontraron lubricantes o productos varios que coincidan con la búsqueda.
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            <?php echo e($lubricantes->appends(['search' => request('search')])->links('vendor.pagination.bootstrap-5')); ?>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        // const clientSuggestions = document.getElementById('clientSuggestions'); // No se usa en lubricantes
        const clearSearchBtn = document.getElementById('clearSearchBtn');
        const searchForm = document.getElementById('searchForm');
        // let debounceTimeout; // No se usa en lubricantes

        // Enfocar el input si ya tiene un valor (comportamiento del script de clientes)
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

        // Bloque del script de clientes que resetea la URL si está cargada con 'search' (usando history.replaceState)
        if (urlParams.has('search') && urlParams.get('search') !== '') {
            if (window.history.pushState) {
                // Si recargas y hay un parámetro 'search', este código lo elimina del historial visible,
                // preparando el navegador para que no persista el valor en futuras recargas.
                urlParams.delete('search');
                const newUrl = window.location.pathname + urlParams.toString();
                window.history.replaceState({}, '', newUrl);
            }
        }

        // La lógica de reseteo al recargar (persisted)
        window.addEventListener('pageshow', function(event) {
            if (event.persisted && !new URLSearchParams(window.location.search).has('search')) {
                searchInput.value = '';
                clearSearchBtn.style.display = 'none';
            }
        });

        // La lógica del evento 'input' para limpiar espacios y caracteres no válidos (adaptada de clientes)
        searchInput.addEventListener('input', function(e) {
            let value = this.value;

            if (value.startsWith(' ')) {
                this.value = value.trimStart();
                value = this.value;
            }

            // Nota: Aquí no se aplica la restricción pattern="[a-zA-Z0-9\s]*"
            // de clientes, porque buscar por código puede requerir caracteres especiales,
            // pero mantenemos la lógica de limpieza de espacios iniciales.

            if (this.value.trim() !== '') {
                clearSearchBtn.style.display = 'block';
            } else {
                clearSearchBtn.style.display = 'none';
            }
        });

        // Asegurar la visibilidad inicial del botón Limpiar
        if (searchInput.value.trim() !== '') {
            clearSearchBtn.style.display = 'block';
        } else {
            clearSearchBtn.style.display = 'none';
        }
    });
</script>
</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/lubricantes/index.blade.php ENDPATH**/ ?>