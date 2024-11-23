<?php
    include 'head.php';
    include '../BaseDatos/db.php';
    session_start();

    // Suponiendo que tienes una conexión a la base de datos abierta
    //$userId = $_SESSION['id_scort']; // Supón que el usuario está autenticado y su ID está almacenado en la sesión

    // Consulta para obtener los datos del perfil del usuario
    $queryProfile = "SELECT alias, imagen FROM scort WHERE id_scort = ?";
    $stmtProfile = $conn->prepare($queryProfile);
    $stmtProfile->bind_param("i", $userId);
    $stmtProfile->execute();
    $resultProfile = $stmtProfile->get_result();
    $user = $resultProfile->fetch_assoc();

    // Consulta para obtener el historial de citas del usuario
    $queryHistorial = "SELECT fecha, testimonio1 FROM cita WHERE id_cliente = ? ORDER BY fecha DESC";
    $stmtHistorial = $conn->prepare($queryHistorial);
    $stmtHistorial->bind_param("i", $userId);
    $stmtHistorial->execute();
    $resultHistorial = $stmtHistorial->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lagons VIP</title>
    <link rel="stylesheet" href="../CSS/styles_index.css">
</head>
<body>
    <!-- Main Content -->
    <div class="container my-5">
        <div class="row">
            <!-- Left Column (Profile Picture and User Name) -->
            <div class="col-md-4 text-center">
                <?php if($user): ?>
                    <img src="../IMAGENES/foto_perfil.jpg<?php echo $user['imagen']; ?>" alt="Foto de perfil" class="img-fluid rounded-circle mb-4" style="max-width: 150px;">
                <?php else: ?>
                    <img src="../IMAGENES/default-profile.jpg" alt="Foto de perfil" class="img-fluid rounded-circle mb-4" style="max-width: 150px;">
                <?php endif; ?>
            </div>

            <!-- Middle Column (Buttons) -->
            <div class="col-md-4 text-center">
                <button onclick="window.location.href='editar_perfil.php'" class="btn btn-primary mb-3 w-100">Edición del perfil</button>
                <button onclick="window.location.href='metodo_pago.php'" class="btn btn-secondary w-100">Método de Cobro</button>
            </div>

            <!-- Right Column (Historial de Citas) -->
            <div class="col-md-4">
                <h4>Historial de Citas</h4>
                <ul class="list-group">
                    <?php while($cita = $resultHistorial->fetch_assoc()): ?>
                        <li class="list-group-item">
                            <strong><?php echo date("d-m-Y", strtotime($cita['fecha'])); ?></strong>: <?php echo htmlspecialchars($cita['descripcion']); ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php 
        include 'footer.php';
    ?>
</body>
</html>
