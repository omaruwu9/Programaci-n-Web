<?php
include 'head.php';
include '../BaseDatos/db.php';
session_start();

// Verifica si el cliente está autenticado
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email']; // Suponemos que el email del cliente está almacenado en la sesión

// Obtener información del cliente
$query = "SELECT id_usuario FROM usuario WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$clienteData = $result->fetch_assoc();

if (!$clienteData) {
    echo "Error: Usuario no encontrado.";
    exit();
}

$id_cliente = $clienteData['id_usuario'];

// Obtener citas del cliente junto con el alias del Scort y monto (asumido)
$queryCitas = "
    SELECT c.id_cita, c.fecha, c.hora, c.estado_pago, c.estatus, c.testimonio2, s.alias AS scort_alias, c.monto, c.total
    FROM cita c
    JOIN scort s ON c.id_scort = s.id_usuario
    WHERE c.id_cliente = ?
";
$stmtCitas = $conn->prepare($queryCitas);
$stmtCitas->bind_param("i", $id_cliente);
$stmtCitas->execute();
$citasResult = $stmtCitas->get_result();

// Procesar formulario para agregar cita
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['agregar_cita'])) {
        $id_scort = $_POST['id_scort'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $id_pago = $_POST['id_pago'];
        $estado_pago = "Pendiente";
        $estatus = "Pendiente";

        $queryInsert = "INSERT INTO cita (id_cliente, id_scort, fecha, hora, id_pago, estado_pago, estatus) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($queryInsert);
        $stmtInsert->bind_param("iisssss", $id_cliente, $id_scort, $fecha, $hora, $id_pago, $estado_pago, $estatus);
        $stmtInsert->execute();
    }

    // Procesar edición de testimonio2
    if (isset($_POST['editar_testimonio'])) {
        $id_cita = $_POST['id_cita'];
        $testimonio2 = $_POST['testimonio2'];

        $queryUpdate = "UPDATE cita SET testimonio2 = ? WHERE id_cita = ?";
        $stmtUpdate = $conn->prepare($queryUpdate);
        $stmtUpdate->bind_param("si", $testimonio2, $id_cita);
        $stmtUpdate->execute();
    }

    // Procesar edición de estatus
    if (isset($_POST['editar_estatus'])) {
        $id_cita = $_POST['id_cita'];
        $nuevo_estatus = $_POST['estatus'];

        $queryUpdateEstatus = "UPDATE cita SET estatus = ? WHERE id_cita = ?";
        $stmtUpdateEstatus = $conn->prepare($queryUpdateEstatus);
        $stmtUpdateEstatus->bind_param("si", $nuevo_estatus, $id_cita);
        $stmtUpdateEstatus->execute();
    }
}

// Obtener lista de scorts para el formulario
$queryScorts = "SELECT id_usuario, alias FROM scort";
$resultScorts = $conn->query($queryScorts);
$scorts = $resultScorts->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="../CSS/styles_index.css">
    <style>
        /* Estilo para centrar la tabla */
        .table-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        /* Estilo para las celdas de la tabla */
        .table th, .table td {
            background-color: white; /* Fondo blanco para las celdas */
        }

        .modal-body label, 
        .modal-body input, 
        .modal-body select {
            color: black; /* Asegura que las etiquetas y entradas sean negras */
        }

        .modal-body input::placeholder {
            color: black; /* Asegura que los placeholders también sean negros */
        }
    </style>
</head>

<body>
<div class="container my-5">
    <h1 class="text-center">Gestión de Citas</h1>

    <!-- Tabla de citas -->
    <table class="table table-striped table-hover mt-4">
        <thead>
        <tr>
            <th>Scort</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado Pago</th>
            <th>Estatus</th>
            <th>Monto</th>
            <th>Total</th>
            <th>Testimonio</th>
            <th>Modificar Estatus</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($citasResult->num_rows > 0): ?>
            <?php while ($cita = $citasResult->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($cita['scort_alias']) ?></td>
                    <td><?= htmlspecialchars($cita['fecha']) ?></td>
                    <td><?= htmlspecialchars($cita['hora']) ?></td>
                    <td><?= htmlspecialchars($cita['estado_pago']) ?></td>
                    <td><?= htmlspecialchars($cita['estatus']) ?></td>
                    <td><?= htmlspecialchars($cita['monto']) ?></td>
                    <td><?= htmlspecialchars($cita['total']) ?></td>
                    <td>
                        <form method="POST">
                            <textarea name="testimonio2" class="form-control"><?= htmlspecialchars($cita['testimonio2']) ?></textarea>
                            <input type="hidden" name="id_cita" value="<?= $cita['id_cita'] ?>">
                            <button type="submit" name="editar_testimonio" class="btn btn-primary mt-2">Guardar</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id_cita" value="<?= $cita['id_cita'] ?>">
                            <select name="estatus" class="form-select" required>
                                <option value="Cancelado" <?= $cita['estatus'] == 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
                            </select>
                            <button type="submit" name="editar_estatus" class="btn btn-warning mt-2">Actualizar Estatus</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="9" class="text-center">No tienes citas registradas.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Botón para agregar nueva cita -->
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarCitaModal">Agregar Cita</button>

    <!-- Modal para agregar cita -->
    <div class="modal fade" id="agregarCitaModal" tabindex="-1" aria-labelledby="agregarCitaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarCitaModalLabel">Nueva Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="id_scort" class="form-label">Scort</label>
                            <select name="id_scort" class="form-select" required>
                                <option value="">Selecciona un scort</option>
                                <?php foreach ($scorts as $scort): ?>
                                    <option value="<?= $scort['id_usuario'] ?>"><?= htmlspecialchars($scort['alias']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" name="fecha" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" name="hora" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_pago" class="form-label">Pago (1- efectivo, 2- tarjeta, 3- transferencia)</label>
                            <input type="text" name="id_pago" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="agregar_cita" class="btn btn-success">Guardar Cita</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
