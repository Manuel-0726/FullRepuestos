

<?php $__env->startSection('title', 'Resultados de Búsqueda'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <!-- Botón para volver al inicio -->
        <a href="<?php echo e(url('/')); ?>" class="btn btn-danger mb-4"><i class="fas fa-arrow-left me-2"></i> Volver al inicio</a>

        <h1 class="text-white mb-4">Resultados de búsqueda para: "<?php echo e($query); ?>"</h1>

        <?php if($productos->isEmpty()): ?>
            <div class="alert alert-warning">
                No se encontraron productos que coincidan con tu búsqueda.
            </div>
        <?php else: ?>
            <div class="row">
                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-dark text-white h-100">
                            <?php if($producto->imagen): ?>
                                <!-- Cambio aquí: la ruta apunta a la carpeta de almacenamiento pública -->
                                <img src="<?php echo e(asset('storage/' . $producto->imagen)); ?>" class="card-img-top" alt="<?php echo e($producto->nombre); ?>">
                            <?php else: ?>
                                <img src="https://placehold.co/600x400/2c2c2c/ffffff?text=Sin+Imagen" class="card-img-top" alt="Imagen no disponible">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo e($producto->nombre); ?></h5>
                                <p class="card-text"><?php echo e($producto->descripcion ?? ''); ?></p>
                                <p class="card-text"><strong>Precio:</strong> L. <?php echo e(number_format($producto->precio, 2)); ?></p>
                                <a href="#" class="btn btn-danger w-100">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const input = document.querySelector('input[name="query"]');
            if (input) {
                // Mueve el cursor al final del texto si hay un valor
                const end = input.value.length;
                input.setSelectionRange(end, end);
                input.focus();
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/search_results.blade.php ENDPATH**/ ?>