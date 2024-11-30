<?php
    session_start();
    session_unset();

    function getCaptcha(&$res){
        $operadores = array('+','-','x');
        $operador1 = $operadores[rand(0,2)];

        $num1 = rand(1,9);
        $num2 = rand(1,9);

        $res = calculateOperation($num1, $num2, $operador1);
        $captcha = $num1 . $operador1 . $num2;
        return $captcha;
    }

    function calculateOperation($numA, $numB, $operador){
        if($operador == "+") return $numA + $numB;
        if($operador == "-") return $numA - $numB;
        return $numA * $numB;
    }

    $resLogin=$resRegister=$resRecoverPwd = 0;

    $captchaRegister = getCaptcha($resRegister);
    $_SESSION['captcha_register'] = $resRegister;
?>

<?php include './views/header.php'  ?>

    <div class="container my-3">
        <h1 class="text-center" style="color: var(--blue);">Registro</h1>
        <form method="post" action="./classes/class_access.php" class="w-50 mx-auto">
            <div class="mb-2">
                <label for="name" class="form-label">Nombres</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Ingresa tu nombre">
            </div>
            <div class="mb-2">
                <label for="name" class="form-label">Apellidos</label>
                <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Ingresa tu apellido">
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Ingresa tu correo">
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Contraseña</label>
                <input name="pswd" type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña">
            </div>
            <div class="mb-2">
                <label for="captcha" class="form-label">Captcha</label>
                <input name="captcha" type="captcha" class="form-control" placeholder="Ingresa el resultado de la siguiente operación: <?php echo($captchaRegister) ?>">
            </div>
            <select name="gender" class="form-select mb-2" aria-label="Default select example">
                <option value="h">Hombre</option>
                <option value="m">Mujer</option>
                <option value="o">Otro</option>
            </select>
            <button type="submit" class="btn bg-blue color-snow">Registrarse</button>
            <input name="action" value="register" type="hidden">

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
</body>

</html>

<?php include './views/footer.php'; ?>
