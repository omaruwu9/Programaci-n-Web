<?php
include 'db.php';

$sql = "SELECT * FROM Usuario";
$result = $conn->query($sql);

echo "<table border='1' style='width: 100%; border-collapse: collapse;'>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Password</th>
            <th>Rol</th>
            <th>Género</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['id_usuario']) . "</td>
                <td>" . htmlspecialchars($row['nombre']) . "</td>
                <td>" . htmlspecialchars($row['apellidos']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['password']) . "</td>
                <td>" . htmlspecialchars($row['rol']) . "</td>
                <td>" . htmlspecialchars($row['genero']) . "</td>
                <td>" . htmlspecialchars($row['telefono']) . "</td>
                <td>
                    <a href='../BaseDatos/edit_user.php?id=" . htmlspecialchars($row['id_usuario']) . "'>📝</a> |
                    <a href='../BaseDatos/delete_user.php?id={$row['id_usuario']}' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este usuario?\")'>🗑️</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='9'>No hay usuarios registrados</td></tr>";
}
echo "</table>";

$conn->close();
?>
