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
</head>
<body>
    <div class="container">
        <div class="col-md-6 text-center text-md-start align-items-center">
            <?php 
            include 'CLASS/classCalendario.php';
            echo $calendario; 
            ?>
            <br>
            <center>
	            <button onclick="location.href='?mes=<?php echo $mes - 1; ?>&año=<?php echo $año; ?>'">Anterior</button>
	            <button onclick="location.href='?mes=<?php echo $mes + 1; ?>&año=<?php echo $año; ?>'">Siguiente</button>
            </center>
        </div>
        
        <div class="reservacion-container">
            <center>
	            <h2>¡RESERVA AHORA!</h2>
	            <button>Reservar</button>
        	</center>
            <div id="informacion_reservacion" style="margin-top: 20px;">
                <!-- Aquí puedes agregar información adicional sobre la reservación -->
                <p>Detalles de la reservación irán aquí.</p>
            </div>
        </div>
    </div>

    <?php
    	include 'footer.php'
    ?>
</body>
</html>
