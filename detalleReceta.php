<?php
require 'db.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$receta_id = $_GET['id'];

// 1. Obtener datos de la receta
$stmt = $pdo->prepare("SELECT recetas.*, usuarios.nombre_usuario as autor, categorias.nombre as categoria 
                       FROM recetas 
                       JOIN usuarios ON recetas.usuario_id = usuarios.id 
                       JOIN categorias ON recetas.categoria_id = categorias.id
                       WHERE recetas.id = ?");
$stmt->execute([$receta_id]);
$receta = $stmt->fetch();

if (!$receta) {
    die("La receta no existe.");
}

// 2. Obtener comentarios de esta receta
$stmtComentarios = $pdo->prepare("SELECT comentarios.*, usuarios.nombre_usuario, usuarios.avatar 
                                  FROM comentarios 
                                  JOIN usuarios ON comentarios.usuario_id = usuarios.id 
                                  WHERE receta_id = ? ORDER BY fecha_creacion DESC");
$stmtComentarios->execute([$receta_id]);
$comentarios = $stmtComentarios->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($receta['titulo']); ?> - Pizca & Fácil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/style/styles.css">
</head>
<body class="bg-light" style="padding-top: 100px;">
    
    <nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm" style="min-height: 80px;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <span class="ms-2 fw-bold text-primary">Pizca & Fácil</span>
            </a>
            <a href="index.php" class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-arrow-left"></i> Volver al Feed</a>
        </div>
    </nav>

    <main class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="card border-0 shadow-sm mb-4">
                    <img src="<?php echo htmlspecialchars($receta['url_imagen']); ?>" class="card-img-top" style="max-height: 400px; object-fit: cover;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="fw-bold mb-0"><?php echo htmlspecialchars($receta['titulo']); ?></h2>
                            <span class="badge bg-primary"><?php echo htmlspecialchars($receta['categoria']); ?></span>
                        </div>
                        <p class="text-muted"><i class="bi bi-person-circle"></i> Por <strong><?php echo htmlspecialchars($receta['autor']); ?></strong></p>
                        
                        <div class="d-flex gap-3 mb-4 bg-light p-3 rounded">
                            <div><i class="bi bi-clock"></i> <?php echo $receta['tiempo_coccion']; ?> min</div>
                            <div><i class="bi bi-bar-chart"></i> <?php echo $receta['dificultad']; ?></div>
                        </div>

                        <h5 class="fw-bold"><i class="bi bi-list-ol"></i> Pasos</h5>
                        <p style="white-space: pre-line;"><?php echo htmlspecialchars($receta['pasos']); ?></p>

                        <div class="mt-4 text-end">
                            <a href="delete.php?id=<?php echo $receta['id']; ?>" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('¿Seguro que quieres borrar esta receta?');">
                                <i class="bi bi-trash"></i> Eliminar Receta
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Comentarios (<?php echo count($comentarios); ?>)</h4>

                        <form action="comentar.php" method="POST" class="mb-4">
                            <input type="hidden" name="receta_id" value="<?php echo $receta['id']; ?>">
                            <div class="mb-3">
                                <textarea name="contenido" class="form-control bg-light border-0" rows="3" placeholder="Añade un comentario..." required></textarea>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <select name="puntuacion" class="form-select w-auto border-0 bg-light">
                                    <option value="">Sin nota</option>
                                    <option value="5">⭐⭐⭐⭐⭐ 5/5</option>
                                    <option value="4">⭐⭐⭐⭐ 4/5</option>
                                    <option value="3">⭐⭐⭐ 3/5</option>
                                    <option value="2">⭐⭐ 2/5</option>
                                    <option value="1">⭐ 1/5</option>
                                </select>
                                <button type="submit" class="btn btn-primary rounded-pill px-4">Comentar</button>
                            </div>
                        </form>

                        <hr>

                        <?php foreach($comentarios as $comentario): ?>
                            <div class="d-flex mb-3">
                                <img src="<?php echo htmlspecialchars($comentario['avatar']); ?>" class="rounded-circle me-3" width="40" height="40">
                                <div>
                                    <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($comentario['nombre_usuario']); ?></h6>
                                    <p class="mb-1"><?php echo htmlspecialchars($comentario['contenido']); ?></p>
                                    <small class="text-muted"><?php echo date('d/m/Y H:i', strtotime($comentario['fecha_creacion'])); ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>