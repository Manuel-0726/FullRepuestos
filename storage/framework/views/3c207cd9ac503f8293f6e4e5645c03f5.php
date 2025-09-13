

<?php $__env->startSection('title', 'Detalles del Proveedor'); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Detalles del Proveedor</h2>
        <div>
            <a href="<?php echo e(route('proveedores.edit', $proveedor->id)); ?>" class="btn btn-danger">Editar</a>
            <a href="<?php echo e(route('proveedores.index')); ?>" class="btn btn-danger">Volver</a>
        </div>
    </div>

    <div class="card bg-dark text-white mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title mb-3">Información principal</h5>
                    <p><strong>Empresa:</strong> <?php echo e($proveedor->nombre_empresa); ?></p>
                    <p><strong>País de origen:</strong> <?php echo e($proveedor->pais_origen); ?></p>
                    <p><strong>Dirección:</strong> <?php echo e($proveedor->direccion); ?></p>
                </div>
                <div class="col-md-6">
                    <h5 class="card-title mb-3">Contacto principal</h5>
                    <p><strong>Persona de contacto:</strong> <?php echo e($proveedor->persona_contacto); ?></p>
                    <p><strong>Correo electrónico:</strong> <?php echo e($proveedor->correo_electronico); ?></p>
                    <p><strong>Teléfono:</strong> <?php echo e($proveedor->telefono_contacto); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card bg-dark text-white mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title mb-3">Marcas que maneja</h5>
                    <?php if($proveedor->marcas && count($proveedor->marcas) > 0): ?>
                        <div class="row row-cols-3 g-3">
                            <?php $__currentLoopData = $proveedor->marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col text-center">
                                    <div class="marca-item">
                                        <div class="marca-logo-container mb-2">
                                            <img src="<?php echo e(asset('images/marcas/' . strtolower($marca) . '.png')); ?>"
                                                 alt="<?php echo e($marca); ?>"
                                                 class="img-fluid marca-logo"
                                                 style="max-width: 100px; height: auto;"
                                                 onerror="this.src='<?php echo e(asset('images/marcas/default.png')); ?>'">
                                        </div>
                                        <p class="marca-nombre mb-0"><?php echo e($marca); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No hay marcas registradas.</p>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <h5 class="card-title mb-3">Tipo de autopartes</h5>
                        <?php if($proveedor->tipo_autopartes && count($proveedor->tipo_autopartes) > 0): ?>
                            <div class="row row-cols-2 g-2">
                                <?php $__currentLoopData = $proveedor->tipo_autopartes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col">
                                        <div class="tipo-item">
                                            <i class="fas fa-cog me-2"></i>
                                            <?php echo e($tipo); ?>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No hay tipos de autopartes registrados.</p>
                        <?php endif; ?>
                    </div>

                    <h5 class="card-title mb-3">Contacto secundario</h5>
                    <?php if($proveedor->persona_contacto_secundaria): ?>
                        <p><strong>Persona de Contacto:</strong> <?php echo e($proveedor->persona_contacto_secundaria); ?></p>
                        <p><strong>Teléfono:</strong> <?php echo e($proveedor->telefono_contacto_secundario); ?></p>
                    <?php else: ?>
                        <p class="text-muted">No hay contacto secundario registrado.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card bg-dark text-white">
        <div class="card-body">
            <h5 class="card-title mb-3">Información adicional</h5>
            <p><strong>Fecha de Registro:</strong> <?php echo e($proveedor->created_at ? $proveedor->created_at->format('d/m/Y H:i') : 'No disponible'); ?></p>
            <p><strong>Última Actualización:</strong> <?php echo e($proveedor->updated_at ? $proveedor->updated_at->format('d/m/Y H:i') : 'No disponible'); ?></p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/proveedores/show.blade.php ENDPATH**/ ?>