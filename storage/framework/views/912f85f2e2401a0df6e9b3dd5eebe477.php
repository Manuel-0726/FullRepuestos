<?php $__env->startSection('title', 'Lista de Productos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Lista de productos</h2>
                <span class="text-white">Total: <strong><?php echo e($productos->total()); ?></strong></span>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            <?php endif; ?>

            <a href="<?php echo e(route('productos.create')); ?>" class="btn btn-primary mb-3">+ Nuevo producto</a>

            <form action="<?php echo e(route('productos.index')); ?>" method="GET" class="mb-4">
                <?php if(request()->hasAny(['nombre', 'modelo', 'anio', 'marca', 'categoria'])): ?>
                    <div class="mb-2 d-flex justify-content-end">
                        <a href="<?php echo e(route('productos.index')); ?>" class="btn btn-outline-light btn-sm">
                            Ver todos los productos
                        </a>
                    </div>
                <?php endif; ?>

                <div class="row g-2">
                    <div class="col-md-3">
                        <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            placeholder="Buscar por nombre"
                            value="<?php echo e(request('nombre')); ?>"
                        >
                    </div>

                    <div class="col-md-3">
                        <input
                            type="text"
                            name="modelo"
                            class="form-control"
                            placeholder="Buscar por modelo"
                            value="<?php echo e(request('modelo')); ?>"
                        >
                    </div>

                    <div class="col-md-2">
                        <input
                            type="number"
                            name="anio"
                            class="form-control"
                            placeholder="Buscar por año"
                            value="<?php echo e(request('anio')); ?>"
                            min="1990"
                            max="<?php echo e(date('Y')); ?>"
                        >
                    </div>

                    <div class="col-md-2">
                        <select name="marca" class="form-control">
                            <option value="">Marca (todas)</option>
                            <?php
                                $marcas = ['Toyota', 'Honda', 'Ford', 'Chevrolet', 'Nissan', 'Volkswagen', 'Hyundai', 'Mazda', 'Kia'];
                            ?>
                            <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($marca); ?>" <?php echo e(request('marca') == $marca ? 'selected' : ''); ?>><?php echo e($marca); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="categoria" class="form-control">
                            <option value="">Categoría (todas)</option>
                            <?php
                                $categorias = ['Motor', 'Frenos', 'Suspensión', 'Eléctrico', 'Accesorios'];
                            ?>
                            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($categoria); ?>" <?php echo e(request('categoria') == $categoria ? 'selected' : ''); ?>><?php echo e($categoria); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 d-grid">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover text-center align-middle">
                    <thead>
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
                    <?php $__empty_1 = true; $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration + ($productos->currentPage() - 1) * $productos->perPage()); ?></td>
                            <td><?php echo e($producto->nombre); ?></td>
                            <td><?php echo e($producto->marca); ?></td>
                            <td><?php echo e($producto->modelo); ?></td>
                            <td><?php echo e($producto->categoria); ?></td>
                            <td><?php echo e($producto->anio); ?></td>
                            <td>
                                <a href="<?php echo e(route('productos.show', $producto->id)); ?>" class="btn btn-info btn-sm me-1">Ver</a>
                                <a href="<?php echo e(route('productos.edit', $producto->id)); ?>" class="btn btn-warning btn-sm me-1">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-white">No hay productos registrados.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if(request()->hasAny(['nombre', 'modelo', 'anio', 'marca', 'categoria']) && isset($productosFiltrados)): ?>
                <div class="mt-4 mb-4 text-center">
                    <div class="d-inline-block bg-dark text-white py-2 px-4 rounded shadow">
                        Se encontraron <strong><?php echo e($productosFiltrados); ?></strong> resultados de <strong><?php echo e($totalProductos); ?></strong> productos en total.
                    </div>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-center mt-4 mb-4">
                <?php echo e($productos->withQueryString()->links('vendor.pagination.bootstrap-5')); ?>

            </div>

            <div class="d-flex gap-2 align-items-center mt-3 mb-4">
                <a href="<?php echo e(route('welcome')); ?>" class="btn btn-outline-light">Inicio</a>
                <button type="button" class="btn btn-outline-light" onclick="window.history.back();">Volver</button>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\RacingParts2.0\resources\views/productos/index.blade.php ENDPATH**/ ?>