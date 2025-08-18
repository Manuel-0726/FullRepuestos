

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <h1 class="text-white">Lista de promociones</h1>

        <?php if(session('success')): ?>
            <div id="alertSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-start mt-4 gap-2">
            <a href="<?php echo e(route('promociones.create')); ?>" class="btn btn-danger">Registrar nueva promoción</a>
            <a href="<?php echo e(url('/')); ?>" class="btn btn-danger">Inicio</a>
        </div>

        <div class="table-container table-responsive">
            <table class="table table-dark table-hover table-bordered align-middle">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descuento (%)</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Productos</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $promociones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td> 
                        <td><?php echo e($promo->nombre); ?></td>
                        <td><?php echo e($promo->descuento); ?></td>
                        <td><?php echo e($promo->fecha_inicio); ?></td>
                        <td><?php echo e($promo->fecha_fin); ?></td>
                        <td>
                            <?php $__currentLoopData = $promo->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-primary"><?php echo e($producto->nombre); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('promociones.show', $promo)); ?>" class="btn btn-info btn-sm">Ver</a>
                            <a href="<?php echo e(route('promociones.edit', $promo)); ?>" class="btn btn-warning btn-sm">Editar</a>
                            <form action="<?php echo e(route('promociones.destroy', $promo)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar esta promoción?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <?php echo e($promociones->links()); ?>


    </div>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const alert = document.getElementById('alertSuccess');
            if(alert){
                setTimeout(() => {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    bsAlert.close(); // Cierra la alerta automáticamente después de 5 segundos
                }, 5000);
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\FullRepuestos\resources\views/promociones/index.blade.php ENDPATH**/ ?>