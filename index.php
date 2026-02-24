<?php
require 'db.php';

$sql = "SELECT recetas.*, usuarios.nombre_usuario as autor, usuarios.avatar 
        FROM recetas 
        JOIN usuarios ON recetas.usuario_id = usuarios.id 
        ORDER BY recetas.id DESC";

$stmt = $pdo->query($sql);
$recetas = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizca & Fácil - Feed Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/style/styles.css">
</head>
<body class="bg-light" style="padding-top: 100px;">
    <nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm" style="min-height: 80px;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/img/logo.png" alt="Logo" height="55" class="d-inline-block align-text-top">
                <span class="ms-2 d-none d-sm-inline fw-bold text-primary" style="font-family: 'Poppins', sans-serif; font-size: 1.2rem;">Pizca & Fácil</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <form class="d-flex mx-auto my-2 my-lg-0 w-50">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                        <input id="searchInput" class="form-control search-input bg-light border-0" type="search" placeholder="Buscar receta, ingrediente o chef...">
                    </div>
                </form>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center gap-3">
                    <li class="nav-item text-center">
                        <a class="nav-link active d-flex flex-column align-items-center p-0" href="index.php">
                            <i class="bi bi-house-door-fill fs-5"></i>
                            <span class="small" style="font-size: 0.7rem;">Inicio</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <img src="./assets/img/usuario1.png" class="rounded-circle border border-2 border-white shadow-sm" width="40" height="40" style="object-fit: cover;">
                            <span class="fw-medium ms-2 d-none d-lg-block">Mi Cuenta</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius: 12px;">
                            <li><a class="dropdown-item" href="profile.html"><i class="bi bi-person me-2"></i> Mi Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <div class="row g-4">
            <div class="col-lg-3 d-none d-lg-block">
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-body text-center">
                        <img src="./assets/img/usuario1.png" class="rounded-circle mb-3 border border-3 border-white shadow" width="80" height="80" style="object-fit: cover;">
                        <h5 class="card-title fw-bold text-primary">Chef Principiante</h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <img src="./assets/img/usuario1.png" class="rounded-circle me-2" width="40" height="40" style="object-fit: cover;">
                            <input type="text" class="form-control rounded-pill bg-light border-0 cursor-pointer" placeholder="¿Qué has cocinado hoy?" onclick="window.location.href='creacionReceta.php'">
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="creacionReceta.php" class="btn btn-primary btn-sm px-4 rounded-pill text-white text-decoration-none">Publicar</a>
                        </div>
                    </div>
                </div>

                <div id="feedContainer">
                    <?php foreach($recetas as $receta): ?>
                    <article class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="<?php echo htmlspecialchars($receta['avatar']); ?>" class="rounded-circle me-2" width="40" height="40" style="object-fit: cover;">
                                <div>
                                    <h6 class="mb-0 fw-bold"><?php echo htmlspecialchars($receta['autor']); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <p class="px-3 mb-2"><?php echo htmlspecialchars($receta['pasos']); ?></p>
                            <img src="<?php echo htmlspecialchars($receta['url_imagen']); ?>" class="w-100" style="max-height: 500px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold mb-0"><?php echo htmlspecialchars($receta['titulo']); ?></h5>
                                <span class="badge bg-light text-dark border">
                                    <i class="bi bi-clock"></i> <?php echo $receta['tiempo_coccion']; ?> min
                                </span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="detalleReceta.php?id=<?php echo $receta['id']; ?>" class="btn btn-primary flex-grow-1 rounded-pill text-white text-decoration-none">Ver Receta</a>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-lg-3 d-none d-lg-block">
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold border-0 pt-3">Populares</div>
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item border-0 px-3 py-2">
                            <div class="fw-bold">Paella Valenciana</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>