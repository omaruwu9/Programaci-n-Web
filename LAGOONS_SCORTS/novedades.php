<?php 
    include "head.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lagons VIP</title>
    <link rel="stylesheet" href="CSS/styles_index.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 text-center text-md-start align-items-center">
                        <img src="IMAGENES/logo.png" />
                    </div>
                    <div class="col-md-4">
                        <h1 class="text-center" font-family="Arial, sans-serif;">
                            <br>
                            <br>
                            <br>
                            <center>¡CONOCE NUESTROS NUEVOS TALENTOS!</center>
                        </h1>
                    </div>
                    <div class="col-md-4 text-center text-md-start align-items-center">
                        <img src="IMAGENES/logo.png" />
                    </div>
                </div>
                <center>
                <div id="dynamic-carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        // Ruta de la carpeta donde se encuentran las imágenes
                        $carpeta = 'IMAGENES/IMAGENES SCORTS/';
                        $imagenes = glob($carpeta . '*.{jpg,jpeg,png,gif}', GLOB_BRACE); // Obtener las imágenes
                        $activeClass = 'active'; // Clase para la primera imagen
                        
                        // Generar dinámicamente las imágenes
                        foreach ($imagenes as $imagen) {
                            echo '<div class="carousel-item ' . $activeClass . '">';
                            echo '<img src="' . $imagen . '" class="d-block w-50" alt="Imagen del carrusel">';
                            echo '</div>';
                            $activeClass = ''; // Solo la primera imagen tiene "active"
                        }
                        ?>
                    </div>
                </div>
                </center>
            </div>
        </div>
    </div>

    <script>
        // Configuración para que el carrusel se reproduzca automáticamente
        const carousel = document.querySelector('#dynamic-carousel');
        const bootstrapCarousel = new bootstrap.Carousel(carousel, {
            interval: 3000, // Tiempo entre cada imagen (en milisegundos)
            ride: 'carousel' // Autoplay
        });
    </script>
</body>
<br>
<br>

<!-- Footer -->
<footer class="footer bg-dark text-white text-center py-2">
    <div class="social-icons mt-4">
        <center>
            <a href="https://www.instagram.com/omaruwu9?igsh=bDh0aG4zNW1jaXIz&utm_source=qr"><img src="IMAGENES/instagram.png" alt="Instagram" class="social-icon" style="width: 40px;"></a>
            <a href="https://www.facebook.com/juan.o.patino?mibextid=LQQJ4d"><img src="IMAGENES/facebook.png" alt="Facebook" class="social-icon" style="width: 40px;"></a>
            <a href="https://twitter.com/?lang=es"><img src="IMAGENES/X.JPEG" alt="Twitter" class="social-icon" style="width: 40px;"></a>
            <a href="https://mail.google.com/mail/u/0/#inbox?compose=jrjtXFBjkjChmHtKrDhlBkpWsVZjTcGgNTbBvrvDcJXFvHmSXHfzBmcHDhFJRMsPMSQTgrpn"><img src="IMAGENES/correo.png" alt="Email" class="social-icon" style="width: 40px;"></a>
        </center>
    </div>
    <br>
    <br>
    <p>ALL RIGHTS RESERVED, TM, ®️ & COPYRIGHT ©️ 2024 BY PROGRAMACIÓN WEB</p>
</footer>
</html>
