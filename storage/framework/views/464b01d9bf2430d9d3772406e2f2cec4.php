

<?php $__env->startSection('title', 'Detalles del Empleado'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-3"> 
    
    <div class="col-md-4">
        <div class="card bg-dark text-white h-100 shadow-lg"> 
            <div class="card-body text-center pb-3 d-flex flex-column"> 
                <div class="avatar-container mb-3"> 
                    
                    <i class="fas <?php echo e($empleado->sexo === 'Masculino' ? 'fa-male' : 'fa-female'); ?> fa-4x <?php echo e($empleado->sexo === 'Masculino' ? 'text-primary' : 'text-danger'); ?>"></i>
                </div>
                <h4 class="card-title mb-2"><?php echo e($empleado->nombre); ?> <?php echo e($empleado->apellido); ?></h4>
                <p class="text-muted mb-3 text-wrap"><?php echo e($empleado->puesto); ?></p> 
                <div class="empleado-status <?php echo e($empleado->estado === 'Activo' ? 'status-activo' : 'status-inactivo'); ?> mb-4">
                    <?php echo e($empleado->estado); ?>

                </div>
                <div class="d-flex justify-content-center gap-2 mt-auto pt-2"> 
                    <a href="<?php echo e(route('empleados.edit', $empleado->id)); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="<?php echo e(route('empleados.index')); ?>" class="btn btn-outline-light btn-sm">Volver a la lista</a>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-md-8">
        <div class="card bg-dark text-white h-100 shadow-lg"> 
            <div class="card-body pb-3"> 
                <h5 class="card-title mb-3 border-bottom border-secondary pb-2">Información personal</h5>
                <div class="row gx-3 gy-2"> 
                    <div class="col-md-6">
                        <p class="mb-2 text-wrap"><i class="fas fa-id-card me-2"></i><strong>Identidad:</strong> <?php echo e($empleado->identidad); ?></p>
                        <p class="mb-2 text-wrap"><i class="fas fa-venus-mars me-2"></i><strong>Sexo:</strong> <?php echo e($empleado->sexo); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2 text-wrap"><i class="fas fa-envelope me-2"></i><strong>Correo:</strong> <?php echo e($empleado->correo); ?></p>
                        <p class="mb-2 text-wrap"><i class="fas fa-phone me-2"></i><strong>Teléfono:</strong> <?php echo e($empleado->telefono); ?></p>
                        <p class="mb-2 text-wrap"><i class="fas fa-map-marker-alt me-2"></i><strong>Dirección:</strong> <?php echo e($empleado->direccion); ?></p>
                    </div>
                </div>

                <h5 class="card-title mt-4 mb-3 border-bottom border-secondary pb-2">Información laboral y adicional</h5>
                <div class="row gx-3 gy-2">
                    <div class="col-md-6">
                        <p class="mb-2 text-wrap"><i class="fas fa-briefcase me-2"></i><strong>Puesto:</strong> <?php echo e($empleado->puesto); ?></p>
                        <p class="mb-2 text-wrap"><i class="fas fa-calendar-alt me-2"></i><strong>Fecha contratación:</strong> <?php echo e($empleado->fecha_contratacion); ?></p>
                        
                        <p class="mb-2 text-wrap info-fecha"><i class="fas fa-calendar-plus me-2"></i><strong>Registro:</strong> <?php echo e($empleado->created_at ? $empleado->created_at->format('d/m/Y H:i') : 'No disponible'); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2 text-wrap"><i class="fas fa-money-bill-wave me-2"></i><strong>Salario:</strong> L. <?php echo e(number_format($empleado->salario, 2, '.', ',')); ?></p>
                        
                        <p class="mb-2 text-wrap info-fecha"><i class="fas fa-calendar-check me-2"></i><strong>Última actualización:</strong> <?php echo e($empleado->updated_at ? $empleado->updated_at->format('d/m/Y H:i') : 'No disponible'); ?></p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/empleados/show.blade.php ENDPATH**/ ?>