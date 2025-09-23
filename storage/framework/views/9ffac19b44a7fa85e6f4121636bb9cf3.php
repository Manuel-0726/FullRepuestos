

<?php $__env->startSection('title', 'Detalles del Producto'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }
        .card-custom {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }
        .detail-item strong {
            color: #f80320;
            font-weight: 600;
        }
        .detail-value {
            color: #ffffff;
            font-size: 1rem;
        }
        .text-muted-dark {
            color: #ccc !important;
        }
        .product-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            font-size: 0.9rem;
        }
        .status-activo {
            background-color: #28a745;
            color: #fff;
        }
        .status-inactivo {
            background-color: #6c757d;
            color: #fff;
        }
        .btn-custom-edit {
            background-color: #FFC300;
            border-color: #FFC300;
            color: #121212;
            font-weight: 600;
        }
        .btn-custom-edit:hover {
            background-color: #e0b400;
            border-color: #e0b400;
        }
        .stock-bajo {
            color: #dc3545;
            font-weight: bold;
        }
        .stock-cero {
            color: #ffc107;
            font-weight: bold;
        }
        .description-content {
            white-space: pre-wrap;
            text-align: left;
            font-size: 0.95rem;
            color: #ffffff;
            margin-top: 0.25rem;
        }
        .product-image {
            max-width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: contain;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid #444;
        }
        .image-placeholder {
            width: 100%;
            height: 200px;
            background-color: #333;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            border: 1px dashed #555;
        }
        .image-placeholder i {
            margin-right: 0.5rem;
        }
    </style>

    <div class="container py-5">
        <h3 class="text-white fw-bold mb-4">Detalles del producto:
            <span style="color: #f80320"><?php echo e($producto->nombre); ?></span>
        </h3>

        <div class="row g-3">
            
            <div class="col-md-4">
                <div class="card card-custom h-100 shadow-lg">
                    <div class="card-body text-center pb-3 d-flex flex-column">

                        <?php if($producto->imagen): ?>
                            <img src="<?php echo e(asset('storage/' . $producto->imagen)); ?>"
                                 alt="Imagen de <?php echo e($producto->nombre); ?>"
                                 class="product-image">
                        <?php else: ?>
                            <div class="image-placeholder">
                                <i class="fas fa-image"></i> Sin Imagen
                            </div>
                        <?php endif; ?>

                        <h4 class="card-title mb-2 text-white"><?php echo e($producto->nombre); ?></h4>
                        <p class="text-muted-dark mb-3 text-wrap"><?php echo e($producto->marca); ?></p>

                        <div class="product-status <?php echo e($producto->estado === 'Activo' ? 'status-activo' : 'status-inactivo'); ?> mb-4">
                            <?php echo e($producto->estado); ?>

                        </div>

                        <?php
                            $stockClass = '';
                            if ($producto->stock == 0) {
                                $stockClass = 'stock-cero';
                            } elseif ($producto->stock <= 5) {
                                $stockClass = 'stock-bajo';
                            }
                        ?>

                        <p class="mb-1 detail-value text-wrap">
                            <strong><i class="fas fa-cubes me-2"></i> Cantidad Actual:</strong>
                            <span class="<?php echo e($stockClass); ?>"><?php echo e($producto->stock ?? 'N/A'); ?></span> uds.
                        </p>

                        <div class="d-flex justify-content-center gap-3 mt-auto pt-4">
                            <a href="<?php echo e(route('productos.edit', $producto->id)); ?>" class="btn btn-custom-edit btn-sm rounded-pill shadow-sm px-4">
                                <i class="fas fa-edit me-2"></i> Editar
                            </a>
                            <a href="<?php echo e(route('productos.index')); ?>" class="btn btn-outline-light btn-sm rounded-pill shadow-sm px-4">
                                <i class="fas fa-arrow-left me-2"></i> Volver a la lista
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-8">
                <div class="card card-custom h-100 shadow-lg">
                    <div class="card-body pb-3">
                        <h5 class="card-title mb-4 border-bottom border-secondary text-light pb-2">
                            <i class="fas fa-info-circle me-2"></i> Información del Producto
                        </h5>
                        <div class="row gx-3 gy-3">
                            <div class="col-md-6">
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-tag me-2"></i> Modelo:</strong> <?php echo e($producto->modelo); ?>

                                </p>
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-calendar-alt me-2"></i> Año:</strong> <?php echo e($producto->anio); ?>

                                </p>
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-layer-group me-2"></i> Categoría:</strong> <?php echo e($producto->categoria); ?>

                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-calendar-plus me-2"></i> Registrado:</strong> <?php echo e($producto->created_at->format('d/m/Y H:i')); ?>

                                </p>
                                <p class="mb-2 detail-value text-wrap">
                                    <strong><i class="fas fa-history me-2"></i> Última actualización:</strong> <?php echo e($producto->updated_at->diffForHumans()); ?>

                                </p>
                            </div>
                        </div>

                        <h5 class="card-title mt-4 mb-3 border-bottom border-secondary text-light pb-2">
                            <i class="fas fa-clipboard-list me-2"></i> Especificaciones
                        </h5>
                        <div class="row gx-3 gy-3">
                            <div class="col-12">
                                <p class="mb-2 detail-value text-wrap">
                                    <strong class="detail-item">Descripción:</strong>
                                </p>
                                <div class="description-content"><?php echo strip_tags(trim($producto->descripcion)) ?? 'No hay descripción detallada.'; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/productos/show.blade.php ENDPATH**/ ?>