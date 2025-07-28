<?php $__env->startSection('title', 'Detalles del Producto'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="card bg-dark text-white shadow-lg rounded-3">
            <div class="card-header bg-darker text-center py-3 rounded-top-3">
                <h3 class="mb-0"><i class="fas fa-box me-2"></i> Detalles del Producto</h3>
            </div>
            <div class="card-body p-4">
                
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

                <div class="mb-3">
                    <p class="mb-1"><strong>Nombre:</strong> <?php echo e($producto->nombre); ?></p>
                    <p class="mb-1"><strong>Marca:</strong> <?php echo e($producto->marca); ?></p>
                    <p class="mb-1"><strong>Modelo:</strong> <?php echo e($producto->modelo); ?></p>
                    <p class="mb-1"><strong>Año:</strong> <?php echo e($producto->anio); ?></p>
                    <p class="mb-1"><strong>Categoría:</strong> <?php echo e($producto->categoria); ?></p>
                    <p class="mb-1"><strong>Descripción:</strong> <?php echo e($producto->descripcion); ?></p> 
                    <p class="mb-1"><strong>Precio:</strong> L. <?php echo e(number_format($producto->precio, 2)); ?></p> 
                    <p class="mb-1"><strong>Stock:</strong> <?php echo e($producto->stock); ?> unidades</p> 
                </div>

                <hr class="border-secondary mb-4">

                <div class="d-flex justify-content-center gap-2">
                    <a href="<?php echo e(route('productos.edit', $producto->id)); ?>" class="btn btn-warning btn-lg rounded-pill shadow-sm">
                        <i class="fas fa-edit me-2"></i> Editar Producto
                    </a>
                    <a href="<?php echo e(route('productos.index')); ?>" class="btn btn-outline-light btn-lg rounded-pill shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i> Volver a la lista
                    </a>
                </div>
            </div>
            <div class="card-footer bg-darker text-center py-3 rounded-bottom-3">
                <small class="text-muted">Última actualización: <?php echo e($producto->updated_at->diffForHumans()); ?></small>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<style>
    body {
        background-color: #343a40; /* Fondo oscuro */
        color: #f8f9fa; /* Texto claro */
    }
    .card {
        border: none;
    }
    .bg-darker {
        background-color: #212529 !important; /* Un tono más oscuro */
    }
    .text-warning {
        color: #ffc107 !important; /* Color amarillo */
    }
    .text-muted {
        color: #adb5bd !important; /* Gris claro */
    }
    .border-secondary {
        border-color: #6c757d !important;
    }
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }
    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #e0a800;
    }
    .btn-outline-light {
        color: #f8f9fa;
        border-color: #f8f9fa;
    }
    .btn-outline-light:hover {
        color: #212529;
        background-color: #f8f9fa;
    }
</style>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\RacingParts2.0\resources\views/productos/show.blade.php ENDPATH**/ ?>