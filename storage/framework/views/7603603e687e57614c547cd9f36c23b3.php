<?php $__env->startSection('title', 'Sistema de Empleados'); ?>

<?php $__env->startSection('content'); ?>
<div class="text-center mb-5">
    <h1 class="display-4 mb-4">Sistema de empleados</h1>
    <p class="lead">Seleccione la operación que desea realizar</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-5 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="system-icon mb-4">
                    <i class="fas fa-user-plus fa-4x text-primary"></i>
                </div>
                <h3 class="card-title mb-4">Registrar empleado</h3>
                <p class="card-text mb-4">Registre un nuevo empleado en el sistema con toda su información personal y laboral.</p>
                <a href="<?php echo e(route('empleados.create')); ?>" class="btn btn-primary btn-lg w-100">Registrar</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-5 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="system-icon mb-4">
                    <i class="fas fa-list fa-4x text-primary"></i>
                </div>
                <h3 class="card-title mb-4">Lista de empleados</h3>
                <p class="card-text mb-4">Visualice y gestione la lista completa de empleados registrados en el sistema.</p>
                <a href="<?php echo e(route('empleados.index')); ?>" class="btn btn-primary btn-lg w-100">Ver Lista</a>
            </div>
        </div>
    </div>
</div>

<div class="text-center mt-4">
    <a href="<?php echo e(route('welcome')); ?>" class="btn btn-outline-light btn-lg">
        <i class="fas fa-arrow-left me-2"></i>Volver al inicio
    </a>
</div>

<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 15px;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .system-icon {
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
    }
    .card-text {
        font-size: 1.1rem;
        color: #6c757d;
    }
    .btn {
        padding: 12px 30px;
        font-weight: 500;
        border-radius: 8px;
    }
</style>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\RacingParts2.0\resources\views/empleados/menu.blade.php ENDPATH**/ ?>