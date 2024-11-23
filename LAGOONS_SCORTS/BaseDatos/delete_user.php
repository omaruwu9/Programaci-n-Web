<?php
include 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ID de usuario no válido'); window.history.back();</script>";
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM Usuario WHERE id_usuario = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('Usuario eliminado exitosamente'); window.location.href = '/LAGOONS_SCORTS/Administrador/classAdmin.php';</script>";
} else {
    echo "<script>alert('Error al eliminar usuario: " . $stmt->error . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
