<?php 
include 'head.php';
include '../BaseDatos/db.php';
session_start();

// Verifica si el usuario está autenticado (por correo, por ejemplo)
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirige al login si no hay sesión activa
    exit();
}

$email = $_SESSION['email']; // Suponemos que el email del usuario está almacenado en la sesión.

try {
    // Consulta para obtener el id_scort basado en el email
    $queryIdScort = "SELECT id_usuario FROM scort WHERE email = ?";
    $stmtIdScort = $conn->prepare($queryIdScort);
    $stmtIdScort->bind_param("s", $email);
    $stmtIdScort->execute();
    $resultIdScort = $stmtIdScort->get_result();
    $scortData = $resultIdScort->fetch_assoc();

    if (!$scortData) {
        echo "Error: Usuario no encontrado.";
        exit();
    }

    // Guarda el id_scort en la variable
    $userId = $scortData['id_usuario'];

    // Consulta para obtener los datos del perfil del usuario
    $queryProfile = "SELECT alias, imagen FROM scort WHERE id_usuario = ?";
    $stmtProfile = $conn->prepare($queryProfile);
    $stmtProfile->bind_param("i", $userId);
    $stmtProfile->execute();
    $resultProfile = $stmtProfile->get_result();
    $user = $resultProfile->fetch_assoc();

    // Manejo de casos donde no se encuentra el perfil
    if (!$user) {
        echo "Error: Datos de perfil no encontrados.";
        exit();
    }
} catch (Exception $e) {
    echo "Error en la consulta: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lagons VIP</title>
    <link rel="stylesheet" href="../CSS/styles_index.css">
    <style>
        body {
            background-color: #333; /* Fondo oscuro para resaltar el texto blanco */
            color: white; /* Color de texto blanco */
            font-family: Arial, sans-serif;
        }
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Altura total de la ventana */
        }
        .profile-image {
            border-radius: 50%;
            margin-bottom: 20px;
            width: 300px;
            height: 300px;
            object-fit: cover; /* Para asegurar que la imagen se vea bien */
            border: 5px solid white; /* Borde blanco */
        }
        .profile-welcome {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .profile-name {
            font-size: 2rem;
            font-weight: normal;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Main Content -->
    <div class="profile-container">
        <img src="<?php 
            echo isset($user['imagen']) && !empty($user['imagen']) 
                ? '../IMAGENES/' . htmlspecialchars($user['imagen']) 
                : '../IMAGENES/default-profile.jpg';
        ?>" 
        alt="Foto de perfil" 
        class="profile-image">
        
        <h1 class="profile-welcome">Bienvenida</h1>
        
        <h2 class="profile-name">
            <?php 
                echo htmlspecialchars($user['alias']);
            ?>
        </h2>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>
</html>
