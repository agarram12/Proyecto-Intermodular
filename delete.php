<?php
require 'db.php';

// Comprobamos si nos han pasado un ID por la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Borrar la receta
        $stmt = $pdo->prepare("DELETE FROM recetas WHERE id = ?");
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        die("Error al eliminar: " . $e->getMessage());
    }
}

// Redirigimos al feed
header('Location: index.php');
exit;
?>