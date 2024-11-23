<?php
include 'db.php';

$id_usuario = $_POST['id_usuario'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$password = $_POST['password'];
$rol = $_POST['rol'];
$genero = $_POST['genero'];
$telefono = $_POST['telefono'];

$sql = "UPDATE Usuario SET nombre='$nombre', apellidos='$apellidos', email='$email', password='$password', rol='$rol', genero='$genero', telefono='$telefono' WHERE id_usuario=$id_usuario";

if ($conn->query($sql) === TRUE) {
     echo "<script>
                alert('Usuario actualizado exitosamente');
                window.location.href = '/LAGOONS_SCORTS/Administrador/classAdmin.php';
              </script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
