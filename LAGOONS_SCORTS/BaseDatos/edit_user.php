<?php
include 'db.php';
include '../Administrador/head.php';

$id = $_GET['id'];

// Ejecuta la consulta y verifica si devuelve un registro
$sql = "SELECT * FROM Usuario WHERE id_usuario = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    echo "<p>No se encontró el usuario con ID: $id</p>";
    exit; // Detenemos el script si no se encontró el usuario
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="/LAGOONS_SCORTS/CSS/styles_index.css">

    <style>
/* Estilo general */
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            flex-direction: column;
            min-height: 100vh;
            align-content: justify;
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
            align-content: justify;
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
            text-align: left; /* Justifica las etiquetas a la izquierda */
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
            box-sizing: border-box;
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
    </style>

</head>
<body>
    <div class="main-content">
        <h2>Editar Usuario</h2>
        <hr>

        <div class="container">
            <div class="form-container mx-auto col-md-6">
                <form action="update_user.php" method="POST">
                    <input type="hidden" name="id_usuario" value="<?php echo $row['id_usuario']; ?>">
                    
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" value="<?php echo $row['nombre'] ?? ''; ?>" required><br>
                    </div>
                    
                    <div class="form-group">
                        <label>Apellidos:</label>
                        <input type="text" name="apellidos" value="<?php echo $row['apellidos'] ?? ''; ?>" required><br>
                    </div>
                    
                    <div class="form-group">
                        <label>Correo:</label>
                        <input type="email" name="email" value="<?php echo $row['email'] ?? ''; ?>" required><br>
                    </div>

                    <div class="form-group">
                        <label>Password:</label>
                        <input type="Password" name="password" value="<?php echo $row['password'] ?? ''; ?>" required><br>
                    </div>
                    
                    <div class="form-group">
                        <label>Rol:</label>
                        <select name="rol" required>
                            <option value="C" <?php if ($row['rol'] == 'C') echo 'selected'; ?>>Cliente</option>
                            <option value="S" <?php if ($row['rol'] == 'S') echo 'selected'; ?>>Scort</option>
                        </select><br>
                    </div>
                    
                    <div class="form-group">
                        <label>Género:</label>
                        <select name="genero" required>
                            <option value="H" <?php if ($row['genero'] == 'H') echo 'selected'; ?>>Masculino</option>
                            <option value="M" <?php if ($row['genero'] == 'M') echo 'selected'; ?>>Femenino</option>
                            <option value="O" <?php if ($row['genero'] == 'O') echo 'selected'; ?>>Otro</option>
                        </select><br>
                    </div>
                    
                    <div class="form-group">
                        <label>Teléfono:</label>
                        <input type="text" name="telefono" value="<?php echo $row['telefono'] ?? ''; ?>"><br>
                        <br>
                    </div>

                    <div class="row">
                        <input type="submit" value="Actualizar Usuario">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
