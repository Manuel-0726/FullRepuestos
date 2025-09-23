

<?php $__env->startSection('title', 'Full Repuestos'); ?>

<?php $__env->startSection('content'); ?>

    
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo e(asset('images/precio.png')); ?>" class="d-block w-100 hero-carousel-img" alt="Promoción de repuestos">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="display-3 fw-bold">Grandes Ofertas</h2>
                    <p class="lead">Encuentra los mejores precios en repuestos de alta calidad.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo e(asset('images/todoV.png')); ?>" class="d-block w-100 hero-carousel-img" alt="Variedad de productos">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="display-3 fw-bold">Todo para tu Vehículo</h2>
                    <p class="lead">Desde frenos y aceites hasta partes de motor, tenemos todo lo que buscas.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo e(asset('images/rMoto.png')); ?>" class="d-block w-100 hero-carousel-img" alt="Repuestos de moto">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="display-3 fw-bold">Repuestos de Moto</h2>
                    <p class="lead">Potencia tu moto con los mejores accesorios y repuestos del mercado.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo e(asset('images/rMoto.png')); ?>" class="d-block w-100 hero-carousel-img" alt="Repuestos de moto">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="display-3 fw-bold">Repuestos de Moto</h2>
                    <p class="lead">Potencia tu moto con los mejores accesorios y repuestos del mercado.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    
    <div class="bg-light shadow-sm">
        <div class="container-fluid">
            <ul class="nav nav-pills justify-content-center py-2">
                <li class="nav-item"><a href="<?php echo e(route('productos.index')); ?>" class="nav-link text-dark">Repuestos de carro</a></li>
                <li class="nav-item"><a href="<?php echo e(route('productos_moto.index')); ?>" class="nav-link text-dark">Repuestos de moto</a></li>
                <li class="nav-item"><a href="<?php echo e(route('lubricantes.index')); ?>" class="nav-link text-dark">Lubricantes y otros productos</a></li>
                <li class="nav-item"><a href="<?php echo e(route('promociones.index')); ?>" class="nav-link text-dark">Promociones</a></li>
            </ul>
        </div>
    </div>

    
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-white">Full Repuestos</h1>
            <p class="lead text-white-50">Encuentra el repuesto perfecto para tu vehículo. ¡Calidad y servicio garantizados!</p>
        </div>

        <div class="row justify-content-center g-4">
            <?php
                $sections = [
                    [
                        'route' => route('productos.index'),
                        'title' => 'Repuestos de Carro',
                        'desc'  => 'Explora nuestro extenso catálogo de repuestos para vehículos. Desde frenos hasta motores, tenemos lo que necesitas.',
                        'img'   => asset('images/repuestosC.jpg'),
                        'bg'    => 'rgba(220,20,60,0.6)'
                    ],
                    [
                        'route' => route('productos_moto.index'),
                        'title' => 'Repuestos de Moto',
                        'desc'  => 'Encuentra las piezas de alta calidad para mantener tu moto en perfectas condiciones. ¡Potencia y seguridad en cada viaje!',
                        'img'   => asset('images/moto.jpg'),
                        'bg'    => 'rgba(220,20,60,0.6)'
                    ],
                    [
                        'route' => route('lubricantes.index'),
                        'title' => 'Lubricantes y Fluidos',
                        'desc'  => 'Protege tu motor con nuestra gama de lubricantes y fluidos de las mejores marcas. Mantenimiento de primer nivel.',
                        'img'   => asset('images/lubricante.png'),
                        'bg'    => 'rgba(220,20,60,0.6)'
                    ],
                    [
                        'route' => route('promociones.index'),
                        'title' => 'Promociones del Mes',
                        'desc'  => 'No te pierdas nuestras ofertas especiales en productos seleccionados. ¡Aprovecha los descuentos para ahorrar en tus compras!',
                        'img'   => asset('images/promocion.png'),
                        'bg'    => 'rgba(220,20,60,0.6)'
                    ],
                ];
            ?>

            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <a href="<?php echo e($section['route']); ?>" class="text-decoration-none">
                        <div class="card section-card h-100 shadow-lg rounded-4 overflow-hidden">
                            <div class="card-img-top position-relative"
                                 style="height: 200px; background: url('<?php echo e($section['img']); ?>') center center / cover no-repeat;">
                                <div class="overlay position-absolute top-0 start-0 w-100 h-100"
                                     style="background: <?php echo e($section['bg']); ?>;"></div>
                                <div class="position-absolute bottom-0 start-0 p-3 text-white">
                                    <h3 class="fw-semibold"><?php echo e($section['title']); ?></h3>
                                </div>
                            </div>
                            <div class="card-body text-center p-4">
                                <p class="card-text text-white mb-4"><?php echo e($section['desc']); ?></p>
                                <button class="btn btn-danger btn-lg rounded-pill w-100">Acceder</button>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <footer class="bg-dark text-white pt-5 pb-4 mt-auto w-100">
        <div class="container-fluid text-center text-md-start">
            <div class="row text-center text-md-start">
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold text-danger">Full Repuestos</h5>
                    <p>Somos una empresa dedicada a la venta y distribución de repuestos de alta calidad para vehículos y motocicletas. Nuestro compromiso es ofrecerle los mejores productos y un servicio excepcional.</p>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold text-danger">Productos</h5>
                    <p><a href="<?php echo e(route('productos.index')); ?>" class="text-white" style="text-decoration: none;">Repuestos de Carro</a></p>
                    <p><a href="<?php echo e(route('productos_moto.index')); ?>" class="text-white" style="text-decoration: none;">Repuestos de Moto</a></p>
                    <p><a href="<?php echo e(route('lubricantes.index')); ?>" class="text-white" style="text-decoration: none;">Lubricantes</a></p>
                    <p><a href="<?php echo e(route('promociones.index')); ?>" class="text-white" style="text-decoration: none;">Promociones</a></p>
                </div>

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold text-danger">Enlaces</h5>
                    <p><a href="<?php echo e(route('about')); ?>" class="text-white" style="text-decoration: none;">Nuestra Historia</a></p>
                    <p><a href="#" class="text-white" style="text-decoration: none;">Guía de compras</a></p>
                    <p><a href="#" class="text-white" style="text-decoration: none;">Preguntas Frecuentes</a></p>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold text-danger">Contacto</h5>
                    <p><i class="fas fa-home me-3"></i> Barrio Abajo, Danli, El Paraíso, Honduras</p>
                    <p><i class="fas fa-envelope me-3"></i> fullrepuestos@gmail.com</p>
                    <p><i class="fas fa-phone me-3"></i> +504 9558-7343</p>
                </div>
            </div>

            <hr class="mb-4">

            <div class="row align-items-center">
                <div class="col-md-7 col-lg-8">
                    <p class="text-center text-md-start">© 2025 Full Repuestos. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="text-center text-md-end">
                        <ul class="list-unstyled list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-google-plus-g"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-linkedin-in"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<?php $__env->stopSection(); ?>

<style>
    /* Estilos para el carrusel de héroe */
    .hero-carousel-img {
        object-fit: cover;
        height: 450px; /* Ajusta la altura a tu preferencia */
        filter: brightness(0.7); /* Oscurece las imágenes para que el texto sea más legible */
    }

    .carousel-caption {
        background-color: rgba(0, 0, 0, 0.5); /* Fondo semitransparente para el texto */
        padding: 20px;
        border-radius: 10px;
    }
</style>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ardon\PhpstormProjects\FullRepuestos\resources\views/welcome.blade.php ENDPATH**/ ?>