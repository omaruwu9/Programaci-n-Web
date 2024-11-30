<?php
session_start(); // Asegúrate de que esto esté al inicio del archivo
include 'views/bd_rentas.php';

// Siempre obtenemos el historial de rentas, no importa si el usuario está logueado o no
$equipoObject = new Renta(); // Asegúrate de que el objeto esté instanciado correctamente
$equipoObject->action('read'); // Esto obtiene las rentas, tanto si el usuario está logueado como si no

// La variable $read debe ser la propiedad o resultado de la consulta
$read = $equipoObject->query_results; // Suponiendo que query_results contiene el resultado de la consulta
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Rentas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body class="vh-100">
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Sidebar -->
            <?php include './views/navbar-user.php'; ?>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 overflow-auto align-content-center">
                <div class="container">
                    <h1 class="text-center my-4">Historial de Rentas</h1>

                    <!-- Tabla para mostrar el historial de rentas -->
                    <div class="mt-5">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center align-middle">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Duración</th>
                                        <th>Forma de pago</th>
                                        <th>Estado</th>
                                        <th>Costo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($read)): ?>
                                        <?php foreach ($read as $renta): ?>
                                            <tr>
                                                <td><?= $renta['fecha'] ?></td>
                                                <td><?= $renta['duracion'] ?> días</td>
                                                <td><?= $renta['forma_pago'] ?></td>
                                                <td><?= $renta['estado_renta'] ?></td>
                                                <td>$<?= number_format($renta['costo'], 2) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-muted">No tienes rentas registradas.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
