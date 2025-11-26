<?php
require_once __DIR__ . '/src/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    die('Imóvel não encontrado.');
}

$stmt = $pdo->prepare('SELECT * FROM properties WHERE id = ?');
$stmt->execute([$id]);
$property = $stmt->fetch();
if (!$property) {
    die('Imóvel não encontrado.');
}

$imgs = $pdo->prepare('SELECT filename FROM property_images WHERE property_id = ? ORDER BY id');
$imgs->execute([$id]);
$images = $imgs->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($property['title']); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="/">Imobiliária</a>
      <a class="btn btn-outline-light ms-auto" href="index.php">Voltar</a>
    </div>
  </nav>

  <div class="container my-5">
    <div class="row">
      <div class="col-md-8">
        <?php if (!empty($images)): ?>
          <div id="carouselImgs" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php foreach ($images as $k => $img): ?>
                <div class="carousel-item <?php echo $k===0? 'active':''; ?>">
                  <img src="uploads/<?php echo htmlspecialchars($img['filename']); ?>" class="d-block w-100" style="height:480px;object-fit:cover;" alt="">
                </div>
              <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselImgs" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselImgs" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>
        <?php else: ?>
          <img src="https://via.placeholder.com/1200x480?text=Sem+imagem" class="img-fluid mb-4" alt="">
        <?php endif; ?>
      </div>

      <div class="col-md-4">
        <h2><?php echo htmlspecialchars($property['title']); ?></h2>
        <p class="fw-bold">R$ <?php echo number_format($property['price'],2,',','.'); ?></p>
        <p><?php echo nl2br(htmlspecialchars($property['description'])); ?></p>
        <p><strong>Endereço:</strong> <?php echo htmlspecialchars($property['address']); ?></p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
