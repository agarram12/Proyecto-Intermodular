<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Receta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/style/styles.css">
</head>
<body class="bg-light" style="padding-top: 100px;">
    <nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm" style="min-height: 80px;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/img/logo.png" height="55" class="d-inline-block align-text-top">
                <span class="ms-2 d-none d-sm-inline fw-bold text-primary">Pizca & Fácil</span>
            </a>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link" href="index.php">Cancelar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form id="createRecipeForm" action="store.php" method="POST" enctype="multipart/form-data">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-primary mb-3">Portada y Descripción</h5>
                            <div class="mb-4">
                                <label class="form-label fw-medium">Foto del plato</label>
                                <input type="file" class="form-control" name="url_imagen" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-medium">Título de la receta</label>
                                <input type="text" class="form-control form-control-lg bg-light border-0" name="titulo" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-medium">Descripción / Pasos</label>
                                <textarea class="form-control bg-light border-0" name="pasos" rows="3" required></textarea>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label small text-muted text-uppercase fw-bold">Categoría</label>
                                    <select class="form-select bg-light border-0" name="categoria_id">
                                        <option value="1">Tradicional</option>
                                        <option value="2">Postres</option>
                                        <option value="3">Vegano</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted text-uppercase fw-bold">Tiempo (min)</label>
                                    <input type="number" class="form-control bg-light border-0" name="tiempo_coccion" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted text-uppercase fw-bold">Dificultad</label>
                                    <select class="form-select bg-light border-0" name="dificultad">
                                        <option value="Fácil">Fácil</option>
                                        <option value="Media" selected>Media</option>
                                        <option value="Difícil">Difícil</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mb-5">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm py-3 fw-bold">Publicar Receta</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>