<?php
session_start();

include 'views/bd_equipo.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos de Bádminton</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body class="vh-100">
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Sidebar -->
            <?php
            include './views/navbar-user.php';
            ?>
            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 overflow-auto align-content-center">
                <div class="container">
                    <h1 class="text-center my-4">Equipos Disponibles</h1>
                    
                    <!-- Tabla para mostrar los equipos -->
                    <div class="mt-5">
                        <h2 class="h4 text-center">Listado de Equipos</h2>
                        <table class="table table-striped" id="equiposTable">
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Marca</th>
                                    <th>Número de Serie</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Los equipos serán cargados aquí por AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
    // Aquí va el JSON que has proporcionado
    const equiposData = [
        {"ID_Equipo":2,"Marca":"Void","Numero_Serie":1,"Descripcion":"Tenis negro numero 27 para hombre"},
        {"ID_Equipo":3,"Marca":"Void","Numero_Serie":2,"Descripcion":"Calcetas color blanco"},
        {"ID_Equipo":6,"Marca":"Void","Numero_Serie":3,"Descripcion":"Raquetas de red de hilo de seda ultra ligero ultra"},
        {"ID_Equipo":7,"Marca":"Void","Numero_Serie":4,"Descripcion":"Tenis color rojo Talla #24"}
    ];

    // Cargar los datos en la tabla
    $(document).ready(function() {
        const tbody = $('#equiposTable tbody');
        equiposData.forEach(equipo => {
            tbody.append(`
                <tr>
                    <td>${equipo.Descripcion}</td>
                    <td>${equipo.Marca}</td>
                    <td>${equipo.Numero_Serie}</td>
                </tr>
            `);
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>