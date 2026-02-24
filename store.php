<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = 1;
    $categoria_id = $_POST['categoria_id'];
    $titulo = $_POST['titulo'];
    $pasos = $_POST['pasos'];
    $tiempo_coccion = $_POST['tiempo_coccion'];
    $dificultad = $_POST['dificultad'];
    
    $ruta_imagen_bd = 'assets/img/logo.png';

    if (isset($_FILES['url_imagen']) && $_FILES['url_imagen']['error'] === UPLOAD_ERR_OK) {
        $nombre_archivo = basename($_FILES['url_imagen']['name']);
        $ruta_final = 'assets/img/' . $nombre_archivo;

        if (move_uploaded_file($_FILES['url_imagen']['tmp_name'], $ruta_final)) {
            $ruta_imagen_bd = $ruta_final;
        }
    }

    try {
        $sql = "INSERT INTO recetas (usuario_id, categoria_id, titulo, pasos, url_imagen, tiempo_coccion, dificultad) 
                VALUES (:u, :c, :t, :p, :i, :tm, :dif)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':u' => $usuario_id,
            ':c' => $categoria_id,
            ':t' => $titulo,
            ':p' => $pasos,
            ':i' => $ruta_imagen_bd,
            ':tm' => $tiempo_coccion,
            ':dif' => $dificultad
        ]);

        header('Location: index.php');
        exit;

    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header('Location: index.php');
    exit;
}
?>