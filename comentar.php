<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $receta_id = $_POST['receta_id'];
    $usuario_id = 1; // más adelante se cambia, actualemnte no hay sistema de usuarios
    $contenido = $_POST['contenido'];
    $puntuacion = $_POST['puntuacion'];

    try {
        // Guardar el comentario en la base de datos
        $stmt = $pdo->prepare("INSERT INTO comentarios (usuario_id, receta_id, contenido) VALUES (?, ?, ?)");
        $stmt->execute([$usuario_id, $receta_id, $contenido]);

        // Guardar la valoración por estrellas
        if (!empty($puntuacion)) {
            $stmt2 = $pdo->prepare("INSERT INTO valoraciones (usuario_id, receta_id, puntuacion) VALUES (?, ?, ?)");
            $stmt2->execute([$usuario_id, $receta_id, $puntuacion]);
        }

        // Volver a la receta después de comentar
        header("Location: detalleReceta.php?id=$receta_id");
        exit;
    } catch (PDOException $e) {
        die("Error al comentar: " . $e->getMessage());
    }
}
?>