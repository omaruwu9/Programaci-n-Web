<?php
    session_start();

    if( !( isset($_SESSION['rol']) && $_SESSION['id_rol'] == 1 ) ){
        // Redirección a no c dónde
    }

    include './views/header-admin.php';
?>
    
    <h1 class="text-center mb-4 color-dark-blue">Pestaña de Estado de las rentas</h1>

    <div class="container mt-4">
        <?php 
            include '../classes/class_estado_renta.php';
        ?>

    </div>
</body>
<br>
<br>
<br>
<?php include 'views/footer.php'; ?>
</html>