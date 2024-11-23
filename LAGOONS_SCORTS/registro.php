<?php
    include 'head.php';

    include 'BaseDatos/insert_user.php'; // Aquí se incluirá el archivo de inserción en la base de datos


    $registro_exitoso = false; // Variable de control para saber si la inserción fue exitosa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Aquí puedes capturar y validar los datos del formulario
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rol = $_POST['rol'];
        $genero = $_POST['genero'];
        $telefono = $_POST['telefono'];

        // Inserta el usuario en la base de datos
    $registro_exitoso = insertar_usuario($nombre, $apellidos, $email, $password, $rol, $genero, $telefono);
    } else {
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">

    <style type="text/css">
    	/* Estilo general */
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Contenedor principal para centrar el formulario */
        .main-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 100px); /* Ajuste de 100px dependiendo de la altura del footer */
            padding: 20px;
        }

        /* Contenedor del formulario */
        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background-color: #1c1c1c;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.1);
            margin-bottom: 40px;
        }

        h2 {
            text-align: center;
            color: #d43f3a;
            margin-bottom: 10px;
        }

        .form-container {
            margin-top: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #c9c9c9;
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: 1px solid #555;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        /* Botón de enviar centrado */
        .row {
            display: flex;
            justify-content: center;
        }

        input[type="submit"] {
            background-color: #d43f3a;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            max-width: 200px;
            width: 100%;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #c72e29;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            .form-control {
                padding: 8px;
                font-size: 14px;
            }
        }

    </style>


    <!-- Script para mostrar el popup -->
    <script type="text/javascript">
        <?php if ($registro_exitoso): ?>
            alert("¡Registro exitoso!");
        <?php endif; ?>
    </script>
</head>
<body>
    <div class="main-content">
        <h2>Para tu registro, por favor, ingresa la siguiente información:</h2>
        <hr>

        <div class="container">
            <div class="form-container mx-auto col-md-6">
                <form action="registro.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nombre">Ingresa tu nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="apellidos">Ingresa tus apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Ingresa tu correo:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Ingresa una contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="genero">Selecciona tu genero:</label>
                        <select class="form-control" id="genero" name="genero" required>
                            <option value="" disabled selected>Selecciona un genero</option>
                            <option value="H">Hombre</option>
                            <option value="M">Mujer</option>
                            <option value="O">Otro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="rol">Selecciona tu tipo de usuario:</label>
                        <select class="form-control" id="rol" name="rol" required>
                            <option value="" disabled selected>Selecciona un usuario</option>
                            <option value="C">Cliente</option>
                            <option value="S">Scort</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Ingresa tu telefono a 10 dígitos:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>

                    <div class="row">
                        <input type="submit" value="Enviar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
        include 'footer.php';
    ?>
</body>
</html>
