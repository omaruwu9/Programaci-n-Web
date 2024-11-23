<?php
    include 'head.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="/LAGOONS_SCORTS/CSS/styles.css">
    <style>
        body {
            background-color: black; /* Fondo negro */
            color: white; 
            font-family: Arial, sans-serif; 
        }
        /* Estilos para la tabla de usuarios */
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1em;
            font-family: Arial, sans-serif;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 6px 7.5px;
            text-align: center;
        }

        th {
            background-color: #b32428;
            color: white;
            font-weight: bold;
            border-bottom: 2px solid #004080;
        }

        

        tr:hover {
            background-color: #c72e29;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        /* Estilo para los enlaces de acciones */
        td a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        td a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <center><img src="../IMAGENES/logo.png" alt="Logo" style="width: 400px;"></center>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 5vh;">
        <div class="description_aboutus">
            <p class="description">
                <center><h1>Panel de Administración</h1></center>
        </div>
    </div>

    <?php
        include '../BaseDatos/read_user.php';
    ?>

    <footer class="footer bg-dark text-white text-center py-2">
        <div class="social-icons mt-4">
            <center>
                <a href="https://www.instagram.com/omaruwu9?igsh=bDh0aG4zNW1jaXIz&utm_source=qr"><img src="../IMAGENES/instagram.png" alt="Instagram" class="social-icon" style="width: 40px;"></a>
                <a href="https://www.facebook.com/juan.o.patino?mibextid=LQQJ4d"><img src="../IMAGENES/facebook.png" alt="Facebook" class="social-icon" style="width: 40px;"></a>
                <a href="https://twitter.com/?lang=es"><img src="../IMAGENES/X.JPEG" alt="Twitter" class="social-icon" style="width: 40px;"></a>
                <a href="https://mail.google.com/mail/u/0/#inbox?compose=jrjtXFBjkjChmHtKrDhlBkpWsVZjTcGgNTbBvrvDcJXFvHmSXHfzBmcHDhFJRMsPMSQTgrpn"><img src="../IMAGENES/correo.png" alt="Email" class="social-icon" style="width: 40px;"></a>
            </center>
        </div>
        <br>
        <br>
        <p>ALL RIGHTS RESERVED, TM, ®️ & COPYRIGHT ©️ 2024 BY PROGRAMACIÓN WEB</p>
    </footer>
</body>
</html>
