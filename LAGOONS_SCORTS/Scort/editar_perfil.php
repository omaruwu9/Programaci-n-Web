<?php
include 'head.php';
include '../BaseDatos/db.php';
session_start();

// Verifica si el usuario está autenticado (por correo)
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirige al login si no hay sesión activa
    exit();
}

$email = $_SESSION['email']; // El email del usuario autenticado
$errorMessage = '';
$successMessage = '';

// Obtener información actual del usuario
try {
    $query = "SELECT id_usuario, alias, ciudad, contacto, estatura, peso, medidas, imagen FROM scort WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "Error: Usuario no encontrado.";
        exit();
    }

    $userId = $user['id_usuario']; // Obtenemos el ID del usuario para procesar la imagen
} catch (Exception $e) {
    echo "Error al obtener datos: " . $e->getMessage();
    exit();
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alias = htmlspecialchars($_POST['alias']);
    $ciudad = htmlspecialchars($_POST['ciudad']);
    $contacto = htmlspecialchars($_POST['contacto']);
    $estatura = htmlspecialchars($_POST['estatura']);
    $peso = htmlspecialchars($_POST['peso']);
    $medidas = htmlspecialchars($_POST['medidas']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $imagen = $user['imagen']; // Imagen actual por defecto

    // Manejar la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imageName = $userId . "_" . basename($_FILES['imagen']['name']);
        $targetDir = "../IMAGENES/users/";
        $targetFile = $targetDir . $imageName;

        // Validar el archivo de imagen
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $targetFile)) {
                $imagen = "users/" . $imageName; // Ruta relativa para guardar en la base de datos
            } else {
                $errorMessage = "Error al subir la imagen.";
            }
        } else {
            $errorMessage = "Formato de imagen no permitido. Usa JPG, JPEG o PNG.";
        }
    }

    // Actualizar la información del usuario
    if (empty($errorMessage)) {
        try {
            $updateQuery = "UPDATE scort SET alias = ?, ciudad = ?, contacto = ?, estatura = ?, peso = ?, medidas = ?, imagen = ?, password = ? WHERE email = ?";
            $stmtUpdate = $conn->prepare($updateQuery);
            $stmtUpdate->bind_param("sssddssss", $alias, $ciudad, $contacto, $estatura, $peso, $medidas, $imagen, $password, $email);
            if ($stmtUpdate->execute()) {
                $successMessage = "Perfil actualizado exitosamente.";
            } else {
                $errorMessage = "Error al actualizar el perfil.";
            }
        } catch (Exception $e) {
            $errorMessage = "Error al actualizar: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../CSS/styles_index.css">
</head>
<body>
<div class="container my-5">
    <h2 class="text-center">Editar Perfil</h2>
    <?php if ($errorMessage): ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
    <?php elseif ($successMessage): ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="alias" class="form-label">Alias</label>
            <input type="text" class="form-control" id="alias" name="alias" value="<?php echo htmlspecialchars($user['alias']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo htmlspecialchars($user['ciudad']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="contacto" class="form-label">Contacto</label>
            <input type="text" class="form-control" id="contacto" name="contacto" value="<?php echo htmlspecialchars($user['contacto']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="estatura" class="form-label">Estatura (cm)</label>
            <input type="number" step="0.1" class="form-control" id="estatura" name="estatura" value="<?php echo htmlspecialchars($user['estatura']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="peso" class="form-label">Peso (kg)</label>
            <input type="number" step="0.1" class="form-control" id="peso" name="peso" value="<?php echo htmlspecialchars($user['peso']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="medidas" class="form-label">Medidas</label>
            <input type="text" class="form-control" id="medidas" name="medidas" value="<?php echo htmlspecialchars($user['medidas']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen de Perfil</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
            <small>Deja este campo vacío si no deseas cambiar tu imagen actual.</small>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Nueva Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>"required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
</body>
</html>
