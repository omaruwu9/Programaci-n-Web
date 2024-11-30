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
    $resLogin = 0;

    $captchaLogin = getCaptcha($resLogin);
    $_SESSION['captcha_login'] = $resLogin;
?>

<?php include './views/header.php'  ?>

    <div class="container mt-5">
        <h1 class="text-center color-blue">Iniciar Sesión</h1>
        <form method="post" class="w-50 mx-auto" action="./classes/class_access.php">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Ingresa tu correo">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="pswd" id="password" placeholder="Ingresa tu contraseña">
            </div>
            <div class="mb-2">
                <label for="captcha" class="form-label">Captcha</label>
                <input name="captcha" type="captcha" class="form-control" placeholder="Ingresa el resultado de la siguiente operación: <?php echo($captchaLogin) ?>">
            </div>
            <button type="submit" class="btn bg-blue text-white">Entrar</button>
            <input name="action" value="login" type="hidden">
            <br>

            <?php 
                if (isset($_REQUEST['m'])) {
                    $message = $_REQUEST['m'];
                    
                    switch ($message) {
                        case '1':  
                            echo ('<p class="text-end color-blue"><b>Captcha incorrecto, favor de validar.</b></p>');
                            break;
                        case '2': 
                            echo ('<p class="text-end color-blue"><b>El email no está registrado.</b></p>');
                            break;
                        case '3':  
                            echo ('<p class="text-end color-blue"><b>Favor de llenar todos los campos.</b></p>');
                            break;
                        case '4':  
                            echo ('<p class="text-end color-blue"><b>Credenciales inválidas.</b></p>');
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
<br>

<?php include './views/footer.php'; ?>
