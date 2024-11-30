<?php 
    session_start();
    session_destroy();
    
    include './views/header.php'; 
?>

<div class="container text-center mt-5">
    <!-- Encabezado principal -->
    <h1 class="display-4">Bienvenidos a LynxBadminton</h1>
    <p class="lead">Tu aliado perfecto para la renta de equipo de bádminton</p>
    
    <!-- Imagen o banner -->
    <img src="images/equipo_badminon.png" alt="Equipo de Bádminton" class="img-fluid rounded mt-3" style="max-width: 50%; height: auto;">
    
    <!-- Breve descripción -->
    <section class="mt-5">
        <h2 class="h4">¿Quiénes somos?</h2>
        <p>En <strong>LynxBadminton</strong>, nos apasiona el bádminton tanto como a ti. Ofrecemos equipos de alta calidad, desde raquetas y volantes hasta redes, para que disfrutes de este deporte con comodidad y confianza.</p>
    </section>
    
    <!-- Llamada a la acción -->
    <section class="mt-4">
        <h2 class="h4">¿Qué necesitas?</h2>
        <p>Explora nuestra variedad de productos y encuentra el equipo ideal para tus juegos. Ya sea para un partido casual o un torneo profesional, tenemos lo que buscas.</p>
        <a href="catalogo.php" class="btn btn-primary btn-lg mt-3">Ver Catálogo</a>
    </section>
</div>

<!-- Mensaje dinámico -->
<?php
if (isset($_GET['m'])) {
    $message = htmlspecialchars($_GET['m']); // Evitar inyección de código
    echo "<div class='alert alert-info text-center mt-4'>$message</div>";
}
?>
<br>
<?php include './views/footer.php'; ?>
