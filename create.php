<?php
// Formulário para cadastrar imóvel
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastrar Imóvel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <style> textarea { min-height: 140px; } </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="/">Imobiliária</a>
    </div>
  </nav>

  <div class="container my-5">
    <h3>Cadastrar novo imóvel</h3>

    <form action="upload.php" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Título</label>
        <input name="title" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Preço (BRL)</label>
        <input name="price" type="number" step="0.01" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Endereço</label>
        <input name="address" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="description" class="form-control"></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Imagens (múltiplas)</label>
        <input name="images[]" type="file" class="form-control" accept="image/*" multiple>
        <div class="form-text">Até <?php echo (MAX_UPLOAD_SIZE/1024/1024); ?> MB por imagem.</div>
      </div>

      <button class="btn btn-success" type="submit">Cadastrar</button>
      <a class="btn btn-secondary" href="index.php">Cancelar</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
