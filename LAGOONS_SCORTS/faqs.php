<?php
include 'head.php';
include 'BaseDatos/db.php';

// Realizar la consulta utilizando mysqli
$query = "SELECT pregunta, respuesta FROM preguntasfrecuentes";
$result = $conn->query($query);

// Verificar si hay resultados
$faqs = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $faqs[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas Frecuentes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <br>
    <br>
    <h2 class="text-center mb-4">Preguntas Frecuentes</h2>
    <div class="container mt-5">
        <div id="faqCarousel" class="carousel slide" data-ride="carousel" data-interval="4000">
            <div class="carousel-inner">
                <?php if (!empty($faqs)): ?>
                    <?php foreach ($faqs as $index => $faq): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($faq['pregunta']) ?></h5>
                                    <p class="card-text"><?= nl2br(htmlspecialchars($faq['respuesta'])) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="carousel-item active">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">No hay preguntas disponibles</h5>
                                <p class="card-text">Actualmente no hay preguntas frecuentes para mostrar.</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <a class="carousel-control-prev" href="#faqCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#faqCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>

    </div>
    <center><a href="faqs2.php" class="btn btn-primary">Saber más</a></center>
    <br>
    <br>


    <?php
        include 'footer.php'
    ?>
</body>
</html>
