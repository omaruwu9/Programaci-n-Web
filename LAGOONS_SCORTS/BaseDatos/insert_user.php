<?php
// BaseDatos/insert_user.php
function insertar_usuario($nombre, $apellidos, $email, $password, $rol, $genero, $telefono) {
    // Conexión a la base de datos
    $host = "localhost";
	$user = "scortsdb";
	$pass = "scortsdb";
	$db = "ScortsDB";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta de inserción
        $sql = "INSERT INTO Usuario (nombre, apellidos, email, password, rol, genero, telefono) 
                VALUES (:nombre, :apellidos, :email, :password, :rol, :genero, :telefono)";

        $stmt = $conn->prepare($sql);

        // Enlace de los parámetros
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':telefono', $telefono);

        // Ejecutar la consulta
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
?>
