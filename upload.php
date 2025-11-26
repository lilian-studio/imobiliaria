<?php
require_once __DIR__ . '/src/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: create.php');
    exit;
}

$title = trim($_POST['title'] ?? '');
$price = floatval($_POST['price'] ?? 0);
$address = trim($_POST['address'] ?? '');
$description = trim($_POST['description'] ?? '');

if ($title === '') {
    die('Título é obrigatório. <a href="create.php">Voltar</a>');
}

// Inserir imóvel
$stmt = $pdo->prepare('INSERT INTO properties (title, description, price, address) VALUES (?, ?, ?, ?)');
$stmt->execute([$title, $description, $price, $address]);
$propertyId = $pdo->lastInsertId();

// Processar uploads
if (!empty($_FILES['images']) && is_array($_FILES['images']['tmp_name'])) {
    $allowed = ['image/jpeg','image/png','image/webp'];
    foreach ($_FILES['images']['tmp_name'] as $idx => $tmpName) {
        if (!is_uploaded_file($tmpName)) continue;
        $size = $_FILES['images']['size'][$idx];
        if ($size > MAX_UPLOAD_SIZE) continue;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $tmpName);
        finfo_close($finfo);
        if (!in_array($mime, $allowed)) continue;

        // extensão segura
        $ext = '';
        switch ($mime) {
            case 'image/jpeg': $ext = '.jpg'; break;
            case 'image/png': $ext = '.png'; break;
            case 'image/webp': $ext = '.webp'; break;
            default: $ext = '';
        }

        $filename = bin2hex(random_bytes(8)) . $ext;
        $target = __DIR__ . '/uploads/' . $filename;
        if (move_uploaded_file($tmpName, $target)) {
            $stmtImg = $pdo->prepare('INSERT INTO property_images (property_id, filename) VALUES (?, ?)');
            $stmtImg->execute([$propertyId, $filename]);
        }
    }
}

header('Location: view.php?id=' . $propertyId);
exit;
