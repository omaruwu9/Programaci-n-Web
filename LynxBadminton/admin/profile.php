<?php
session_start();

if (isset($_REQUEST['action'])) {
    include '../classes/class_usuarios.php';
    $userObject->get_query('SELECT * FROM usuario WHERE id_usuario = ' . $_SESSION['user_id'] . ';');
    $userData = $userObject->query_results;
}
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
            <?php include 'views/header-admin.php'; ?>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 overflow-auto align-content-center">
                <div class="container">
                    <h1 class="text-center" style="color: var(--blue);">Editar perfil</h1>
                    <form method="post" enctype="multipart/form-data" action="../classes/class_usuarios.php" class="w-50 mx-auto">
                        <div class="mb-2">
                            <label for="name" class="form-label color-blue">Nombres</label>
                            <input name="nombres" type="text" class="form-control" id="name" value="<?php echo $userData[1]['nombres'] ?>">
                        </div>
                        <div class="mb-2">
                            <label for="name" class="form-label color-blue">Apellidos</label>
                            <input name="apellidos" type="text" class="form-control" id="last_name" value="<?php echo $userData[1]['apellidos'] ?>">
                        </div>

                        <div class="mb-2">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input name="email" type="email" class="form-control" id="email" value="<?php echo $userData[1]['email'] ?>">
                        </div>
                        
                        <div class="mb-2">
                            <label for="password" class="form-label color-blue">Contraseña</label>
                            <input name="clave" type="password" class="form-control" id="password" value="<?php echo $userData[1]['clave'] ?>">
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label color-blue">Foto de perfil</label>
                            <input name="foto_perfil" type="file" class="form-control" id="password" value="<?php echo $userData[1]['foto'] ?>">
                        </div>

                        <!-- <label for="password" class="form-label">Genero</label>
            <select name="genero" class="form-select mb-2" aria-label="Default select example">
                <option value="h">Hombre</option>
                <option value="m">Mujer</option>
                <option value="o">Otro</option>
            </select> -->
                        <button type="submit" class="btn bg-blue">Actualizar</button>
                        <input name="action" value="update_profile" type="hidden">

                        <?php
                        if (isset($_REQUEST['m'])) {
                            $message = $_REQUEST['m'];

                            switch ($message) {
                                case '2':
                                    echo ('<p class="text-end color-blue"><b>El email ya está registrado.</b></p>');
                                    break;
                                case '3':
                                    echo ('<p class="text-end color-blue"><b>Favor de llenar todos los campos.</b></p>');
                                    break;
                                case '4':
                                    echo ('<p class="text-end color-blue"><b>Usuario registrado exitosamente!!.</b></p>');
                                    break;
                                case '5':
                                    echo ('<p class="text-end color-blue"><b>Captcha incorrecto.</b></p>');
                                    break;
                            }
                        }
                        ?>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<br>
<br>
<?php include 'views/footer.php'; ?>
</html>