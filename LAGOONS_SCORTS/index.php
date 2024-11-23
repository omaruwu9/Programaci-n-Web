<?php
    include 'head.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lagons VIP</title>
    <link rel="stylesheet" href="CSS/styles_index.css">
</head>
<body>
    <!-- Main Content -->
    <div class="container my-5">
        <div class="row">
            <!-- Left Column (Logo and Login) -->
            <div class="col-md-6 text-center text-md-start">
                <center><img src="IMAGENES/LOGO.png" alt="Lagons VIP Logo" class="img-fluid mb-4" style="max-width: 300px;"></center>
                <!-- Login Form -->
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Correo electronico" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                </form>

                <button onclick="window.location.href='registro.php'" class="btn btn-secondary w-100 mt-3">Registrarse</button>
                
                <!-- Social Media Links -->
                <div class="social-icons mt-4">
                    <center>
                    <a href="https://www.instagram.com/omaruwu9?igsh=bDh0aG4zNW1jaXIz&utm_source=qr"><img src="IMAGENES/instagram.png" alt="Instagram" class="social-icon" style="width: 40px;"></a>
                    <a href="https://www.facebook.com/juan.o.patino?mibextid=LQQJ4d"><img src="IMAGENES/facebook.png" alt="Facebook" class="social-icon" style="width: 40px;"></a>
                    <a href="https://twitter.com/?lang=es"><img src="IMAGENES/X.JPEG" alt="Twitter" class="social-icon" style="width: 40px;"></a>
                    <a href="https://mail.google.com/mail/u/0/#inbox?compose=jrjtXFBjkjChmHtKrDhlBkpWsVZjTcGgNTbBvrvDcJXFvHmSXHfzBmcHDhFJRMsPMSQTgrpn"><img src="IMAGENES/correo.png" alt="Email" class="social-icon" style="width: 40px;"></a>
                    </center>
                </div>
            </div>

            <!-- Right Column (Text) -->
            <div class="col-md-6 text-white text-center text-md-start d-flex align-items-center">
                <p>Bienvenido a Lagons VIP, el sitio web donde encontrarás un servicio exclusivo y discreto de acompañantes de alto nivel. Nuestro objetivo es brindarte una experiencia única, personalizada y segura, con perfiles verificados de profesionales que destacan por su elegancia y sofisticación. Navega con confianza y descubre la compañía perfecta para cada ocasión.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-dark text-white text-center py-1">
        <br>
        <p>ALL RIGHTS RESERVED, TM, ®️ & COPYRIGHT ©️ 2024 BY PROGRAMACIÓN WEB</p>
    </footer>
</body>
</html>
