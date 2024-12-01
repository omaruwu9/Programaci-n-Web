<?php
    include 'head.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calendario</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <style>
        /* Estilo para asegurar que el calendario y la información estén organizados en bloques */
        .container {
            display: flex;
            flex-direction: column;  /* Organiza los elementos en columna */
            align-items: center;
            padding: 20px;
        }

        /* Estilo para el calendario */
        .calendario-container {
            width: 100%;
            max-width: 1000px;  /* Ajusta el ancho del calendario */
            margin-bottom: 40px;  /* Espaciado debajo del calendario */
        }


        h2, h3 {
            margin-bottom: 15px;
        }

        ul {
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #c72e29;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-md-12 text-center text-md-start align-items-center">
            <!-- Calendario -->
            <div class="calendario-container" style="margin-top: 20px;">
                <?php 
                    include 'CLASS/classCalendario.php';  // Asegúrate de que aquí se genere el calendario
                ?>
            </div>

            <!-- Información de la reservación -->
            <center>
            <div class="reservacion-container" style="margin-top: 40px;">
                <center>
                    <h2>¡RESERVA AHORA!</h2>
                </center>
                <div id="informacion_reservacion">
                    <h3>1. Registro Obligatorio</h3>
                    <ul>
                        <li><strong>Usuario registrado:</strong> Solo los usuarios registrados pueden realizar una cita con una scort. Si no tienes una cuenta, primero debes registrarte en nuestra plataforma.</li>
                        <li><strong>Proceso de registro:</strong> El registro se realiza a través de un formulario en el que deberás ingresar tu nombre completo, correo electrónico, género, contraseña y cualquier otra información relevante. También puedes cargar una foto y otros detalles adicionales en tu perfil después de completar el registro.</li>
                    </ul>

                    <h3>2. Verificación de Identidad</h3>
                    <ul>
                        <li><strong>Autenticación:</strong> Una vez registrado, deberás iniciar sesión con tu correo electrónico y contraseña para acceder al sistema y poder reservar una cita.</li>
                        <li><strong>Verificación de correo electrónico:</strong> Al completar tu registro, recibirás un correo de confirmación. Debes hacer clic en el enlace de verificación para activar tu cuenta. Solo con una cuenta verificada podrás hacer una cita.</li>
                    </ul>

                    <h3>3. Disponibilidad de la Scort</h3>
                    <ul>
                        <li><strong>Consulta de disponibilidad:</strong> Antes de realizar la reserva, consulta la disponibilidad de la scort. Solo puedes agendar una cita en los horarios disponibles.</li>
                        <li><strong>Selección de hora y fecha:</strong> Al seleccionar la scort con la que deseas reservar, podrás ver su calendario y elegir una fecha y hora que se ajuste a tu agenda.</li>
                    </ul>

                    <h3>4. Condiciones de la cita</h3>
                    <ul>
                        <li><strong>Pago previo:</strong> Dependiendo de la scort, puede requerirse un pago o un depósito previo para garantizar tu cita. Verifica los métodos de pago disponibles en la plataforma.</li>
                        <li><strong>Confirmación de la cita:</strong> Una vez que completes la reserva, recibirás una confirmación en tu correo electrónico con todos los detalles de la cita (fecha, hora, lugar, monto, etc.).</li>
                        <li><strong>Cancelación de la cita:</strong> Si necesitas cancelar o reprogramar tu cita, asegúrate de hacerlo con tiempo. Cada scort puede tener una política de cancelación específica que debes respetar.</li>
                    </ul>

                    <h3>5. Restricciones</h3>
                    <ul>
                        <li><strong>Usuarios no registrados:</strong> Si no estás registrado en el sistema, no podrás hacer una cita con ninguna scort. El sistema te pedirá que te registres antes de poder proceder con cualquier solicitud de cita.</li>
                        <li><strong>Verificación de la cuenta:</strong> Si intentas hacer una cita sin haber verificado tu cuenta, se te pedirá completar la verificación antes de poder continuar.</li>
                    </ul>
                </div>

                <center><button onclick="location.href='registro.php'">Registrate Ahora</button></center>
            </div>
            </center>
        </div>
    </div>

    <?php
        include 'footer.php';
    ?>
</body>
</html>
