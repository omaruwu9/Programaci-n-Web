<?php
include '/LAGOONS_SCORTS/BaseDatos/db.php';

$query = "SELECT pregunta, respuesta FROM preguntasfrecuentes";
$stmt = $pdo->query($query);
$faqs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>