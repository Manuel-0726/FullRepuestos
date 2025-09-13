

<?php $__env->startSection('content'); ?>
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8 text white">
    <title>Detalles del cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
<div class="container py-5">
    <h3 class="text-white fw-bold">Detalles del Cliente</h3>


        <div class="card-body p-4 bg-dark text-white">
            <div class="row mb-4 card-body p-4 bg-dark text-white">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Nombre Completo:</strong> <?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?></p>
                    <p class="mb-1"><strong>Correo:</strong> <?php echo e($cliente->correo); ?></p>
                    <p class="mb-1"><strong>Teléfono:</strong> <?php echo e($cliente->telefono); ?></p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Identidad:</strong> <?php echo e($cliente->identidad); ?></p>
                    <p class="mb-1"><strong>Sexo:</strong> <?php echo e($cliente->sexo); ?></p>
                    <p class="mb-1"><strong>Dirección:</strong> <?php echo e($cliente->direccion); ?></p>
                    <p class="mb-1"><strong>Registrado:</strong> <?php echo e($cliente->created_at->format('d/m/Y H:i')); ?></p>
                    <p class="mb-1"><strong>Última Actualización:</strong> <?php echo e($cliente->updated_at->diffForHumans()); ?></p>
                </div>
            </div>

            <hr class="border-secondary mb-4">

            <div class="d-flex justify-content-center gap-2">
                
                <a href="<?php echo e(route('cliente.edit', $cliente->id)); ?>" class="btn btn-warning btn-lg rounded-pill shadow-sm">
                    <i class="fas fa-edit me-2"></i> Editar Cliente
                </a>
                
                <a href="<?php echo e(route('cliente.index')); ?>" class="btn btn-outline-light btn-lg rounded-pill shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i> Volver a la lista
                </a>
            </div>
        </div>
        <div class="card-footer bg-darker text-center py-3 rounded-bottom-3">

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/cliente/show.blade.php ENDPATH**/ ?>