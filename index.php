<?php
require_once __DIR__ . '/src/db.php';

$stmt = $pdo->query("SELECT p.*, (SELECT filename FROM property_images pi WHERE pi.property_id = p.id LIMIT 1) as thumb FROM properties p ORDER BY p.created_at DESC");
$properties = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Imobiliária - Lista de Imóveis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <style> .card-img-top { height: 200px; object-fit: cover; } </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand fw-bold" href="/">Imobiliária</a>
      <div class="d-flex">
        <a class="btn btn-outline-light me-2" href="create.php">Cadastrar Imóvel</a>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <h2 class="mb-4">Imóveis disponíveis</h2>

    <div class="row g-4">
      <?php if (empty($properties)): ?>
        <div class="col-12">
          <div class="alert alert-info">Nenhum imóvel cadastrado ainda. <a href="create.php">Cadastre o primeiro</a>.</div>
        </div>
      <?php endif; ?>

      <?php foreach ($properties as $p): ?>
        <div class="col-sm-6 col-md-4">
          <div class="card shadow-sm">
            <?php if (!empty($p['thumb']) && file_exists(__DIR__.'/uploads/'.$p['thumb'])): ?>
              <img src="uploads/<?php echo htmlspecialchars($p['thumb']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($p['title']); ?>">
            <?php else: ?>
              <img src="https://via.placeholder.com/800x450?text=Sem+imagem" class="card-img-top" alt="sem-imagem">
            <?php endif; ?>

            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($p['title']); ?></h5>
              <p class="card-text text-truncate"><?php echo htmlspecialchars($p['description']); ?></p>
              <p class="mb-1 fw-bold">R$ <?php echo number_format($p['price'], 2, ',', '.'); ?></p>
              <a href="view.php?id=<?php echo $p['id']; ?>" class="btn btn-primary">Ver detalhes</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
