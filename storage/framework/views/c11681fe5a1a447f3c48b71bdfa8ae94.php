

<?php $__env->startSection('title', 'FullRepuestos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="text-center mb-5">
        
        <img src="<?php echo e(asset('logo.png/log.png')); ?>" alt="Logo RacingParts" class="mb-4 img-fluid" style="max-height: 100px; max-width: 100%;">

        <h1 class="display-4 fw-bold text-dark">Full Repuestos</h1>
        <p class="lead text-secondary">Seleccione el sistema que desea gestionar</p>
    </div>

    <div class="row justify-content-center g-4">
        
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-danger">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-4x text-danger mb-3"></i>
                    <h3 class="card-title mb-3 fw-semibold text-danger">Sistema de Empleados</h3>
                    <p class="card-text mb-4">Gestione la información de los empleados, incluyendo datos personales, laborales y estado.</p>
                    <a href="<?php echo e(route('empleados.index')); ?>" class="btn btn-danger btn-lg w-100 rounded-pill">Acceder</a>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-danger">
                <div class="card-body text-center">
                    <i class="fas fa-truck fa-4x text-danger mb-3"></i>
                    <h3 class="card-title mb-3 fw-semibold text-danger">Sistema de Proveedores</h3>
                    <p class="card-text mb-4">Administre proveedores, marcas y tipos de autopartes disponibles.</p>
                    <a href="<?php echo e(route('proveedores.index')); ?>" class="btn btn-danger btn-lg w-100 rounded-pill">Acceder</a>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-danger">
                <div class="card-body text-center">
                    <i class="fas fa-cogs fa-4x text-danger mb-3"></i>
                    <h3 class="card-title mb-3 fw-semibold text-danger">Sistema de Productos</h3>
                    <p class="card-text mb-4">Gestione el inventario de autopartes: nombre, marca, modelo, año, precio y stock.</p>
                    <a href="<?php echo e(route('productos.index')); ?>" class="btn btn-danger btn-lg w-100 rounded-pill">Acceder</a>
                </div>
            </div>
        </div>


        
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-danger">
                <div class="card-body text-center">
                    <i class="fas fa-user fa-4x text-danger mb-3"></i>
                    <h3 class="card-title mb-3 fw-semibold text-danger">Sistema de Clientes</h3>
                    <p class="card-text mb-4">Registre clientes y consulte la lista de clientes.</p>
                    <a href="<?php echo e(route('cliente.index')); ?>" class="btn btn-danger btn-lg w-100 rounded-pill">Acceder</a>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-danger">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-cart fa-4x text-danger mb-3"></i>
                    <h3 class="card-title mb-3 fw-semibold text-danger">Sistema de Facturas de Compra</h3>
                    <p class="card-text mb-4">Registre compras, actualice inventarios y costos.</p>
                    <a href="<?php echo e(route('facturas-compra.index')); ?>" class="btn btn-danger btn-lg w-100 rounded-pill">Acceder</a>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-danger">
                <div class="card-body text-center">
                    <i class="fas fa-file-invoice-dollar fa-4x text-danger mb-3"></i>
                    <h3 class="card-title mb-3 fw-semibold text-danger">Sistema de Facturas de Venta</h3>
                    <p class="card-text mb-4">Gestione facturas de venta, agregue productos y vea detalles.</p>
                    <a href="<?php echo e(route('facturas.index')); ?>" class="btn btn-danger btn-lg w-100 rounded-pill">Acceder</a>
                </div>
            </div>
        </div>


        
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-danger">
                <div class="card-body text-center">
                    <i class="fas fa-tags fa-4x text-danger mb-3"></i>
                    <h3 class="card-title mb-3 fw-semibold text-danger">Sistema de Promociones</h3>
                    <p class="card-text mb-4">Cree, administre y asigne promociones a productos y clientes.</p>
                    <a href="<?php echo e(route('promociones.index')); ?>" class="btn btn-danger btn-lg w-100 rounded-pill">Acceder</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/welcome.blade.php ENDPATH**/ ?>