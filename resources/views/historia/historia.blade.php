@extends('layouts.app')

@section('title', 'Historia de Full Repuestos')

@section('content')

    <style>
        /* Estilos específicos para la página de historia */
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Arial', sans-serif;
        }
        .fw-700 {
            font-weight: 700;
        }
        .history-section {
            background-color: #1e1e1e;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        }
        .history-section h3 {
            color: #f80320;
            font-weight: 700;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        /* CAMBIO AQUÍ: Se eliminó 'font-style: italic;' */
        .history-section p, .history-section ul {
            color: #ccc;
            line-height: 1.8;
            font-size: 1.05rem;
        }
        .vision-mision p {
            font-size: 1.15rem;
            border-left: 4px solid #f80320;
            padding-left: 15px;
        }
        .values-list {
            list-style-type: none;
            padding-left: 0;
        }
        .values-list li {
            margin-bottom: 10px;
            color: #ffffff;
        }
        .values-list li i {
            color: #f80320;
            margin-right: 10px;
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="text-white mb-5 text-center fw-700">
                    Conoce Full Repuestos: Nuestra Historia
                </h1>

                <div class="history-section">
                    <h3 class="text-center"><i class="fas fa-book-open me-2"></i> Nuestra Historia</h3>
                    <p>
                        Full Repuestos fue fundada con el objetivo de llenar un vacío en el mercado de repuestos automotrices de alta calidad y servicio excepcional. Desde nuestros inicios, nuestra idea ha sido clara: ofrecer solo lo mejor, con la asesoría experta que nuestros clientes merecen.
                    </p>
                    <p>
                        Hoy, seguimos innovando en la gestión de inventario y la eficiencia logística para asegurar que el repuesto correcto esté disponible cuando más se necesita, apoyando tanto a talleres profesionales como a entusiastas del motor.
                    </p>
                </div>

                <div class="history-section vision-mision">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h3><i class="fas fa-star me-2"></i> Nuestra Misión</h3>
                            <p>
                                Ser el socio estratégico número uno de nuestros clientes, proveyendo un catálogo completo y garantizado de repuestos, lubricantes y productos varios, atendido por un equipo de excelencia y procesos tecnológicos eficientes.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h3><i class="fas fa-bullseye me-2"></i> Nuestra Visión</h3>
                            <p>
                                Expandir nuestra presencia a nivel nacional, consolidando a Full Repuestos como la cadena líder y más confiable en la distribución de soluciones automotrices, reconocida por su integridad y compromiso con la calidad.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="history-section">
                    <h3><i class="fas fa-heart me-2"></i> Nuestros Valores</h3>
                    <p>Estos principios guían cada una de nuestras decisiones diarias:</p>
                    <ul class="values-list">
                        <li>
                            <i class="fas fa-check-circle"></i> Calidad Garantizada: Solo trabajamos con marcas y productos que cumplen con los más altos estándares de la industria.
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i> Integridad y Transparencia: Actuamos con honestidad en precios y en la información sobre nuestros productos.
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i> Excelencia en el Servicio: Buscamos superar las expectativas del cliente en cada interacción, ofreciendo asesoría técnica especializada.
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i> Innovación: Utilizamos la tecnología para mejorar la gestión de inventarios y la experiencia de compra.
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i> Compromiso Ambiental: Promovemos el uso responsable de lubricantes y la gestión adecuada de residuos.
                        </li>
                    </ul>
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('welcome') }}" class="btn btn-lg btn-danger">
                        <i class="fas fa-chevron-left me-2"></i> Volver al menú principal
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection