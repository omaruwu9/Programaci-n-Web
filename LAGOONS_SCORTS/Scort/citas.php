<?php
include 'head.php';
include '../BaseDatos/db.php';
session_start(); // Asegúrate de que esto esté al inicio del archivo

// Verifica si el usuario está autenticado
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirige al login si no hay sesión activa
    exit();
}

$email = $_SESSION['email']; // Suponemos que el email del usuario está almacenado en la sesión.

// Obtenemos el id_scort basado en el email de la sesión
$query = "SELECT id_usuario FROM scort WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$scortData = $result->fetch_assoc();

// Si no se encuentra el scort, mostrar un error
if (!$scortData) {
    echo "Error: Usuario no encontrado.";
    exit();
}

// Guarda el id_scort
$id_scort = $scortData['id_usuario'];

// Obtenemos las citas relacionadas con ese id_scort
$queryCitas = "SELECT c.id_cita, c.id_cliente, c.fecha, c.hora, c.monto, c.total, c.estado_pago, c.estatus, c.no_transaccion, c.id_pago, c.testimonio1, c.testimonio2, cl.nombre
               FROM cita c 
               JOIN usuario cl ON c.id_cliente = cl.id_usuario
               WHERE c.id_scort = ?";
$stmtCitas = $conn->prepare($queryCitas);
$stmtCitas->bind_param("i", $id_scort);
$stmtCitas->execute();
$citasResult = $stmtCitas->get_result();

// Procesar los cambios cuando se envíe el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guardar'])) {
    $id_cita = $_POST['guardar'];
    $estado_pago = $_POST['estado_pago'][$id_cita] ?? null;
    $estatus = $_POST['estatus'][$id_cita] ?? null;
    $testimonio1 = $_POST['testimonio1'][$id_cita] ?? null;
    $monto = $_POST['monto'][$id_cita] ?? null;
    $total = $_POST['total'][$id_cita] ?? null;

    // Actualizar los campos modificados en la base de datos
    if ($estado_pago || $estatus || $testimonio1 || $monto || $total) {
        $updateQuery = "UPDATE cita SET estado_pago = ?, estatus = ?, testimonio1 = ?, monto = ?, total = ? WHERE id_cita = ?";
        $stmtUpdate = $conn->prepare($updateQuery);
        $stmtUpdate->bind_param("ssssdi", $estado_pago, $estatus, $testimonio1, $monto, $total, $id_cita);
        $stmtUpdate->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../CSS/styles_index.css">
    <style>
        .table-container {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .table {
            width: 100%;
            max-width: 1500px;
            min-width: 1200px;
        }

        .table th, .table td {
            background-color: white;
            text-align: center;
        }

        input[readonly], textarea[readonly] {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <h2 class="text-center my-4">Historial de Citas</h2>

    <form method="POST" action="citas.php">
        <div class="mt-5 table-container">
            <div class="table-responsive">
                <table class="table table-striped table-hover text-center align-middle">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Cliente</th>
                            <th>Monto</th>
                            <th>Total</th>
                            <th>Estado Pago</th>
                            <th>Estatus</th>
                            <th>No. Transacción</th>
                            <th>ID Pago</th>
                            <th>Testimonio 1</th>
                            <th>Testimonio 2</th>
                            <th>Cambiar Estado de Pago</th>
                            <th>Cambiar Estatus de Cita</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($citasResult->num_rows > 0): ?>
                            <?php while ($cita = $citasResult->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($cita['fecha']) ?></td>
                                    <td><?= htmlspecialchars($cita['hora']) ?></td>
                                    <td><?= htmlspecialchars($cita['nombre']) ?></td>
                                    <td>
                                        <input type="number" name="monto[<?= $cita['id_cita'] ?>]" value="<?= number_format($cita['monto'], 2) ?>" class="form-control" step="0.01" required>
                                    </td>
                                    <td>
                                        <input type="number" name="total[<?= $cita['id_cita'] ?>]" value="<?= number_format($cita['total'], 2) ?>" class="form-control" step="0.01" required>
                                    </td>
                                    <td>
                                        <input type="text" name="estado_pago[<?= $cita['id_cita'] ?>]" value="<?= htmlspecialchars($cita['estado_pago']) ?>" class="form-control" readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="estatus[<?= $cita['id_cita'] ?>]" value="<?= htmlspecialchars($cita['estatus']) ?>" class="form-control" readonly>
                                    </td>
                                    <td><?= htmlspecialchars($cita['no_transaccion']) ?></td>
                                    <td><?= htmlspecialchars($cita['id_pago']) ?></td>
                                    <td>
                                        <textarea name="testimonio1[<?= $cita['id_cita'] ?>]" class="form-control"><?= htmlspecialchars($cita['testimonio1']) ?></textarea>
                                    </td>
                                    <td><?= htmlspecialchars($cita['testimonio2']) ?></td>
                                    <td>
                                        <select name="estado_pago[<?= $cita['id_cita'] ?>]" class="form-select" required>
                                            <option value="Pendiente" <?= $cita['estado_pago'] == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                            <option value="Completado" <?= $cita['estado_pago'] == 'Completado' ? 'selected' : '' ?>>Completado</option>
                                            <option value="Cancelado" <?= $cita['estado_pago'] == 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="estatus[<?= $cita['id_cita'] ?>]" class="form-select" required>
                                            <option value="Pendiente" <?= $cita['estatus'] == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                            <option value="Completado" <?= $cita['estatus'] == 'Completado' ? 'selected' : '' ?>>Completado</option>
                                            <option value="Cancelado" <?= $cita['estatus'] == 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary" name="guardar" value="<?= $cita['id_cita'] ?>">Guardar Testimonio</button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="13" class="text-muted">No tienes citas registradas.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
