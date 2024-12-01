<?php
include 'head.php';
include 'BaseDatos/db.php';

// Obtener información de las Scorts
$queryScorts = "SELECT id_usuario, alias, ciudad, contacto, estatura, peso, medidas FROM scort";
$resultScorts = $conn->query($queryScorts);
$scorts = $resultScorts->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Scorts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/styles_index.css">
    <style>
        .catalogo-container {
            margin-top: 20px;
        }

        .card {
            margin: 15px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            max-height: 350px;
            object-fit: cover;
        }

        .card-body h5, 
        .card-body p, 
        .card-body .btn {
            color: black;
        }
    </style>
</head>

<body>
<div class="container my-5">
    <h1 class="text-center">Catalogo de Talentos 🔥</h1>

    <!-- Catálogo -->
    <div class="row catalogo-container">
        <?php if (!empty($scorts)): ?>
            <?php foreach ($scorts as $scort): ?>
                <div class="col-md-4">
                    <div class="card">
                        <!-- Construir la ruta de la imagen -->
                        <?php
                        // Comprobar si la imagen con el id_usuario seguido del nombre existe
                        $imageName = $scort['id_usuario'] . '_*.png'; // Para imágenes PNG
                        $imagePath = glob("IMAGENES/users/{$imageName}"); // Buscar la imagen con cualquier nombre después del id_usuario

                        // Si no se encuentra la imagen en formato PNG, buscar en otros formatos
                        if (empty($imagePath)) {
                            $imageName = $scort['id_usuario'] . '_*.jpg'; // Para imágenes JPG
                            $imagePath = glob("IMAGENES/users/{$imageName}");
                        }

                        if (empty($imagePath)) {
                            $imageName = $scort['id_usuario'] . '_*.jpeg'; // Para imágenes JPEG
                            $imagePath = glob("IMAGENES/users/{$imageName}");
                        }

                        // Si no se encuentra ninguna imagen, se muestra una imagen por defecto
                        if (empty($imagePath)) {
                            $imagePath = ['IMAGENES/users/default.png']; // Imagen por defecto
                        }
                        ?>
                        <img src="<?= $imagePath[0] ?>" class="card-img-top" alt="<?= htmlspecialchars($scort['alias']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($scort['alias']) ?></h5>
                            <p><strong>Ciudad:</strong> <?= htmlspecialchars($scort['ciudad']) ?></p>
                            <p><strong>Contacto:</strong> <?= htmlspecialchars($scort['contacto']) ?></p>
                            <p><strong>Estatura:</strong> <?= htmlspecialchars($scort['estatura']) ?> cm</p>
                            <p><strong>Peso:</strong> <?= htmlspecialchars($scort['peso']) ?> kg</p>
                            <p><strong>Medidas:</strong> <?= htmlspecialchars($scort['medidas']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p>No hay Scorts disponibles en este momento.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
