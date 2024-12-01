<?php
include 'head.php';
include '../BaseDatos/db.php';

// Realizar la consulta
$query = "SELECT id_preguntas_frecuentes, pregunta, respuesta FROM preguntasfrecuentes";
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
    <link rel="stylesheet" type="text/css" href="../CSS/styles.css">
    <style>
        .faq-container {
            display: flex;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .faq-questions {
            width: 35%;
            border-right: 1px solid #ddd;
            padding-right: 20px;
        }
        .faq-questions ul {
            list-style: none;
            padding: 0;
        }
        .faq-questions li {
            margin: 10px 0;
            cursor: pointer;
            color: #007bff;
        }
        .faq-questions li:hover {
            text-decoration: underline;
        }
        .faq-answer {
            width: 65%;
            padding-left: 20px;
        }
        .faq-answer h5 {
            color: #333;
            margin-bottom: 10px;
        }
        .faq-answer p {
            color: #555;
        }
    </style>
</head>
<body>

<br>
<h2 class="text-center">Preguntas Frecuentes</h2>
<div class="container mt-5">
    <div class="faq-container">
        <div class="faq-questions">
            <ul>
                <?php foreach ($faqs as $faq): ?>
                    <li onclick="showAnswer(<?= $faq['id_preguntas_frecuentes'] ?>)"><?= htmlspecialchars($faq['pregunta']) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="faq-answer">
            <h5 id="answer-title">Selecciona una pregunta</h5>
            <p id="answer-content">La respuesta aparecerá aquí cuando selecciones una pregunta de la lista.</p>
        </div>
    </div>
</div>

<script>
    // Función de JavaScript para mostrar la respuesta de la pregunta seleccionada
    const faqs = <?= json_encode($faqs) ?>;

    function showAnswer(id_preguntas_frecuentes) {
        // Buscar la pregunta y respuesta en el array de FAQs
        const faq = faqs.find(f => f.id_preguntas_frecuentes == id_preguntas_frecuentes);
        
        // Actualizar el contenido de la respuesta
        if (faq) {
            document.getElementById('answer-title').textContent = faq.pregunta;
            document.getElementById('answer-content').textContent = faq.respuesta;
        }
    }
</script>

<?php
    include 'footer.php';
?>
</body>
</html>
