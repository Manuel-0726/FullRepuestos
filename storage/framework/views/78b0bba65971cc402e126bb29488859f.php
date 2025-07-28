<?php $__env->startSection('title', 'Sistema de Gestión'); ?>

<?php $__env->startSection('content'); ?>
    <div class="text-center mb-5">
        <h1 class="display-4 mb-4">Sistema de Gestión</h1>
        <p class="lead">Seleccione el sistema que desea gestionar</p>
    </div>

    <div class="row justify-content-center">
        
        <div class="col-md-5 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="system-icon mb-4">
                        <i class="fas fa-users fa-4x text-primary"></i>
                    </div>
                    <h3 class="card-title mb-4">Sistema de Empleados</h3>
                    <p class="card-text mb-4">Gestione la información de los empleados, incluyendo datos personales, laborales y estado.</p>
                    <a href="<?php echo e(route('empleados.menu')); ?>" class="btn btn-primary btn-lg w-100">Acceder</a>
                </div>
            </div>
        </div>

        
        <div class="col-md-5 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="system-icon mb-4">
                        <i class="fas fa-truck fa-4x text-success"></i>
                    </div>
                    <h3 class="card-title mb-4">Sistema de Proveedores</h3>
                    <p class="card-text mb-4">Administre la información de proveedores, marcas y tipos de autopartes disponibles.</p>
                    <a href="<?php echo e(route('proveedores.menu')); ?>" class="btn btn-success btn-lg w-100">Acceder</a>
                </div>
            </div>
        </div>

        
        <div class="col-md-5 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="system-icon mb-4">
                        <i class="fas fa-cogs fa-4x text-warning"></i>
                    </div>
                    <h3 class="card-title mb-4">Sistema de Productos</h3>
                    <p class="card-text mb-4">Gestione el inventario de autopartes, incluyendo nombre, marca, modelo, año, precio y stock.</p>
                    <a href="<?php echo e(route('productos.menu')); ?>" class="btn btn-warning btn-lg w-100 text-white">Acceder</a>
                </div>
            </div>
        </div>

        
        <div class="col-md-5 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="system-icon mb-4">
                        <i class="fas fa-file-invoice-dollar fa-4x text-info"></i>
                    </div>
                    <h3 class="card-title mb-4">Sistema de Facturas</h3>
                    <p class="card-text mb-4">Gestione las facturas de venta, agregue productos y visualice detalles de cada factura.</p>
                    <a href="<?php echo e(route('facturas.index')); ?>" class="btn btn-info btn-lg w-100">Acceder</a>
                </div>
            </div>
        </div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\manue\PhpstormProjects\RacingParts2.0\resources\views/welcome.blade.php ENDPATH**/ ?>