<?php
include '../BaseDatos/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $query = "SELECT imagen FROM scort WHERE id_scort = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imagen);
    $stmt->fetch();

    if ($imagen) {
        header("Content-Type: image/png"); // Cambia según el formato de tus imágenes
        echo $imagen;
    } else {
        // Mostrar imagen predeterminada
        header("Content-Type: image/png");
        readfile("../IMAGENES/default-profile.jpg");
    }
}
?>
