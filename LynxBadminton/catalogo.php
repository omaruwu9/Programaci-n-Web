<?php 
    session_start();
    session_destroy();
    
    include './views/header.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos de Badminton</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/jquery-confirm.css">
    <!-- JS -->
    <script src="../js/lib/jquery-3.7.1.min.js"></script>
    <script src="../js/lib/jquery-confirm.js"></script>
</head>
<body class="vh-100">
    <div class="container-fluid vh-100">
        <div class="row h-100">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <!-- Card 1 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="images/products/gallitos-de-colores.jpg" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Kit de gallos para badminton</h5>
                                <p class="card-text">Añade un toque de color y diversión a tus juegos con nuestros gallitos de colores. Fabricados con materiales de alta calidad para una mayor durabilidad y vuelo consistente, estos gallitos están diseñados para soportar intensas sesiones de práctica o emocionantes partidos. Disponibles en colores vibrantes que aseguran visibilidad incluso en las jugadas más rápidas.</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100">Ver detalles</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="images/products/Rauqetas azules.jpg" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Raqueta Azul</h5>
                                <p class="card-text">Descubre el equilibrio perfecto entre potencia y control con nuestra raqueta azul de alto rendimiento. Diseñada con tecnología ligera de grafito, esta raqueta ofrece un manejo ágil y una gran resistencia. Su diseño aerodinámico permite golpes precisos y mayor velocidad, ideal tanto para jugadores recreativos como para competidores apasionados.</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100">Ver detalles</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="images/products/mochila-negra.jpg" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Mochila Negra</h5>
                                <p class="card-text">Transporta tu equipo con comodidad y elegancia con nuestra mochila negra de diseño ergonómico. Fabricada con materiales resistentes al desgaste, cuenta con múltiples compartimentos para organizar tus raquetas, ropa y accesorios de manera segura. Perfecta para jugadores que buscan practicidad sin sacrificar estilo. Ideal para cualquier jugador de bádminton, desde principiantes hasta profesionales.</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100">Ver detalles</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="images/products/zapatillas.png" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Tenis Negro/Blanco</h5>
                                <p class="card-text">Descubre el equilibrio perfecto entre estilo y rendimiento con estos tenis blancos con detalles en negro. Diseñados para ofrecer comodidad y soporte, son ideales para practicar deportes de alto impacto como el bádminton. Su suela antideslizante proporciona excelente tracción en cualquier superficie, mientras que su diseño moderno asegura que destaques tanto dentro como fuera de la cancha. ¡Haz que cada movimiento cuente!</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100">Ver detalles</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 5 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="images/products/conjunto_deportivo.png" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Conjunto Deportivo Negro</h5>
                                <p class="card-text">Eleva tu experiencia deportiva con este conjunto diseñado para brindar máxima flexibilidad y confort. Fabricado con materiales ligeros y transpirables, este conjunto deportivo para hombre incluye una camiseta de ajuste relajado y pantalones con cintura elástica que se adaptan perfectamente a cualquier movimiento. Su diseño clásico con detalles modernos lo convierte en la opción perfecta para entrenamientos, partidos o actividades al aire libre. ¡Siéntete cómodo y luce increíble!</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100">Ver detalles</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 6 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="images/products/gorra.png" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Gorra Negra Deportiva</h5>
                                <p class="card-text">Protege tu rostro del sol mientras mantienes un estilo fresco con esta gorra negra deportiva unisex. Fabricada con materiales ligeros y de secado rápido, cuenta con una banda interna absorbente que mantiene el sudor bajo control durante los partidos más intensos. Su diseño ajustable asegura un ajuste perfecto para cualquier tamaño, y su estilo atemporal la convierte en el accesorio ideal para cualquier outfit deportivo. ¡Funcionalidad y estilo en un solo producto!</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100">Ver detalles</button>
                            </div>
                        </div>
                    </div>
                    <!-- Additional cards can be added similarly -->
                </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php include './views/footer.php'; ?>
</html>
