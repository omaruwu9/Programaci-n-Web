<?php 
    session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos de Bádminton</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/jquery-confirm.css">
    <!-- JS -->
    <script src="../js/lib/jquery-3.7.1.min.js"></script>
    <script src="../js/lib/jquery-confirm.js"></script>
</head>
<body class="vh-100">
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Sidebar -->
            <?php 
                include './views/navbar-user.php';
            ?>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 overflow-auto">
                <div class="container">
                <h1 class="my-4 text-center">¡Bievenid@!</h1>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <!-- Card 1 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="../images/products/gallitos-de-colores.jpg" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Kit de gallos para badminton</h5>
                                <p class="card-text">Añade un toque de color y diversión a tus juegos con nuestros gallitos de colores. Fabricados con materiales de alta calidad para una mayor durabilidad y vuelo consistente, estos gallitos están diseñados para soportar intensas sesiones de práctica o emocionantes partidos. Disponibles en colores vibrantes que aseguran visibilidad incluso en las jugadas más rápidas.</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100" onclick="window.open('https://articulo.mercadolibre.com.mx/MLM-2325870740-set-paquete-de-12-gallitos-para-badminton-plumas-_JM#polycard_client=search-nordic&position=7&search_layout=grid&type=item&tracking_id=b7627eb0-92c5-4a9e-bcb1-e3e14d0aeadf', '_blank')">Ver detalles</button>

                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="../images/products/Rauqetas azules.jpg" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Raqueta Azul</h5>
                                <p class="card-text">Descubre el equilibrio perfecto entre potencia y control con nuestra raqueta azul de alto rendimiento. Diseñada con tecnología ligera de grafito, esta raqueta ofrece un manejo ágil y una gran resistencia. Su diseño aerodinámico permite golpes precisos y mayor velocidad, ideal tanto para jugadores recreativos como para competidores apasionados.</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100" onclick="window.open('https://articulo.mercadolibre.com.mx/MLM-2325870740-set-paquete-de-12-gallitos-para-badminton-plumas-_JM#polycard_client=search-nordic&position=7&search_layout=grid&type=item&tracking_id=b7627eb0-92c5-4a9e-bcb1-e3e14d0aeadf', '_blank')">Ver detalles</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="../images/products/mochila-negra.jpg" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Mochila Negra</h5>
                                <p class="card-text">Transporta tu equipo con comodidad y elegancia con nuestra mochila negra de diseño ergonómico. Fabricada con materiales resistentes al desgaste, cuenta con múltiples compartimentos para organizar tus raquetas, ropa y accesorios de manera segura. Perfecta para jugadores que buscan practicidad sin sacrificar estilo. Ideal para cualquier jugador de bádminton, desde principiantes hasta profesionales.</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100" onclick="window.open('https://www.tradeinn.com/smashinn/es/dunlop-mochila-tac-pro-series-long/140620831/p?utm_source=google_products&utm_medium=merchant&id_producte=142283301&country=mx&gad_source=1&gclid=CjwKCAiA6aW6BhBqEiwA6KzDc29BLrm2UN-ge4s-nETW3kVlPGIlbQ7utEgOTQBCrrBU34t7FZoTZBoC7NwQAvD_BwE&gclsrc=aw.ds', '_blank')">Ver detalles</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="../images/products/zapatillas.png" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Tenis Negro/Blanco</h5>
                                <p class="card-text">Descubre el equilibrio perfecto entre estilo y rendimiento con estos tenis blancos con detalles en negro. Diseñados para ofrecer comodidad y soporte, son ideales para practicar deportes de alto impacto como el bádminton. Su suela antideslizante proporciona excelente tracción en cualquier superficie, mientras que su diseño moderno asegura que destaques tanto dentro como fuera de la cancha. ¡Haz que cada movimiento cuente!</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100" onclick="window.open('https://articulo.mercadolibre.com.mx/MLM-2402447070-nuevos-zapatos-de-badminton-zapatos-de-tenis-zapatillas-_JM', '_blank')">Ver detalles</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 5 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="../images/products/conjunto_deportivo.png" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Conjunto Deportivo Negro</h5>
                                <p class="card-text">Eleva tu experiencia deportiva con este conjunto diseñado para brindar máxima flexibilidad y confort. Fabricado con materiales ligeros y transpirables, este conjunto deportivo para hombre incluye una camiseta de ajuste relajado y pantalones con cintura elástica que se adaptan perfectamente a cualquier movimiento. Su diseño clásico con detalles modernos lo convierte en la opción perfecta para entrenamientos, partidos o actividades al aire libre. ¡Siéntete cómodo y luce increíble!</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100" onclick="window.open('https://articulo.mercadolibre.com.mx/MLM-1892998693-5-uds-conjuntos-atleticos-ropa-de-gimnasio-entrenamiento-_JM?searchVariation=177695619312#polycard_client=search-nordic&searchVariation=177695619312&position=5&search_layout=grid&type=item&tracking_id=56fd2ada-f22f-4fe4-a4ab-dfeefbe1929b', '_blank')">Ver detalles</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 6 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="../images/products/gorra.png" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Gorra Negra Deportiva</h5>
                                <p class="card-text">Protege tu rostro del sol mientras mantienes un estilo fresco con esta gorra negra deportiva unisex. Fabricada con materiales ligeros y de secado rápido, cuenta con una banda interna absorbente que mantiene el sudor bajo control durante los partidos más intensos. Su diseño ajustable asegura un ajuste perfecto para cualquier tamaño, y su estilo atemporal la convierte en el accesorio ideal para cualquier outfit deportivo. ¡Funcionalidad y estilo en un solo producto!</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100" onclick="window.open('https://articulo.mercadolibre.com.mx/MLM-2137527597-gorra-swoosh-para-ninos-nike-dri-fit-club-fb5064-010-_JM?searchVariation=181581790176#polycard_client=search-nordic&searchVariation=181581790176&position=3&search_layout=grid&type=item&tracking_id=cfffeca8-d078-4ca1-93f0-d0166af0f2b6&gid=1&pid=1', '_blank')">Ver detalles</button>
                            </div>
                        </div>
                    </div>
                    <!-- Additional cards can be added similarly -->
                </div>
            </main>
        </div>

        <br>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<br>

</html>
