

<?php $__env->startSection('title', 'Lista de Productos de Moto'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0 text-white">Lista de productos de moto</h2>
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

            
            <div class="d-flex mb-3 gap-2 align-items-center">
                <a href="<?php echo e(route('productos_moto.create')); ?>" class="btn btn-danger">+ Nuevo producto</a>
                <a href="<?php echo e(route('welcome')); ?>" class="btn btn-danger">Inicio</a>

                <?php if(request()->filled('nombre') || request()->filled('modelo') || request()->filled('anio') || request()->filled('marca') || request()->filled('categoria')): ?>
                    <a href="<?php echo e(route('productos_moto.index')); ?>" class="btn btn-secondary ms-auto">Regresar a la lista</a>
                <?php endif; ?>
            </div>

            
            <form action="<?php echo e(route('productos_moto.index')); ?>" method="GET" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-3">
                        <input type="text" name="nombre" class="form-control"
                               placeholder="Buscar por nombre" value="<?php echo e(request('nombre')); ?>">
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="modelo" class="form-control"
                               placeholder="Buscar por modelo" value="<?php echo e(request('modelo')); ?>">
                    </div>

                    <div class="col-md-2">
                        <input type="number" name="anio" class="form-control"
                               placeholder="Buscar por año" value="<?php echo e(request('anio')); ?>"
                               min="1990" max="<?php echo e(date('Y')); ?>">
                    </div>

                    <div class="col-md-2">
                        <select name="marca" class="form-control">
                            <option value="">Marca (todas)</option>
                            <?php
                                $marcas = ['Yamaha', 'Honda', 'Suzuki', 'Kawasaki', 'BMW', 'Ducati'];
                            ?>
                            <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($marca); ?>" <?php echo e(request('marca') == $marca ? 'selected' : ''); ?>>
                                    <?php echo e($marca); ?>

                                </option>
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
                                <option value="<?php echo e($categoria); ?>" <?php echo e(request('categoria') == $categoria ? 'selected' : ''); ?>>
                                    <?php echo e($categoria); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 d-grid">
                        <button type="submit" class="btn btn-danger">Buscar</button>
                    </div>
                </div>
            </form>

            
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
                    <?php $__empty_1 = true; $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration + ($productos->currentPage() - 1) * $productos->perPage()); ?></td>
                            <td><?php echo e($producto->nombre); ?></td>
                            <td><?php echo e($producto->marca); ?></td>
                            <td><?php echo e($producto->modelo); ?></td>
                            <td><?php echo e($producto->categoria); ?></td>
                            <td><?php echo e($producto->anio); ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?php echo e(route('productos_moto.show', $producto->id)); ?>" class="btn btn-info btn-sm">Ver</a>
                                    <a href="<?php echo e(route('productos_moto.edit', $producto->id)); ?>" class="btn btn-warning btn-sm">Editar</a>

                                    
                                    <form action="<?php echo e(route('productos_moto.destroy', $producto)); ?>" method="POST"
                                          onsubmit="return confirm('¿Seguro que quieres eliminar este producto?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                    </form>
                                </div>
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

            
            <div class="d-flex justify-content-center mt-4 mb-4">
                <?php echo e($productos->withQueryString()->links('vendor.pagination.bootstrap-5')); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/productosMoto/index.blade.php ENDPATH**/ ?>