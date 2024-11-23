<?php
include 'BaseDatos/db.php'; // Asegúrate de incluir la conexión a la base de datos

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar si el usuario existe en la base de datos
    $sql = "SELECT email, password, rol FROM Usuario WHERE email = ?";  // Usamos ? para evitar inyecciones SQL
    $stmt = $conn->prepare($sql);

    // Verificamos si la preparación fue exitosa
    if ($stmt === false) {
        die('Error en la consulta SQL: ' . $conn->error);
    }

    // Vinculamos el parámetro para el email
    $stmt->bind_param("s", $email);  // "s" significa string
    
    // Ejecutamos la consulta
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Vinculamos las columnas resultantes
        $stmt->bind_result($db_email, $db_password, $rol);
        $stmt->fetch();

        // Verificamos la contraseña
        if ($password == $db_password) {  // O usa password_verify si las contraseñas están cifradas
            // La contraseña es correcta, guardamos los datos en la sesión
            $_SESSION['email'] = $db_email;
            $_SESSION['rol'] = $rol;

            // Redirige según el rol
            switch ($rol) {
                case 'C':
                    header("Location: /LAGOONS_SCORTS/Usuario/cliente_home.php");
                    break;
                case 'S':
                    header("Location: /LAGOONS_SCORTS/Scort/scort_home.php");
                    break;
                default:
                    header("Location: /LAGOONS_SCORTS/Administrador/classAdmin.php"); // Para otros roles como administrador
                    break;
            }
            exit();
        } else {
            // Contraseña incorrecta
            echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='index.php';</script>";
        }
    } else {
        // Si no se encontró el usuario
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='index.php';</script>";
    }

    // Cierra la consulta y la conexión
    $stmt->close();
    $conn->close();
}
?>
