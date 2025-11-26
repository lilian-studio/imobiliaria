<?php
// Configurações básicas do projeto — ajuste conforme seu ambiente
$DB_HOST = '127.0.0.1';
$DB_NAME = 'imobiliaria';
$DB_USER = 'root';
$DB_PASS = '';

// Diretório de uploads (relativo ao projeto)
$UPLOAD_DIR = __DIR__ . '/uploads';

// Garante que o diretório exista
if (!is_dir($UPLOAD_DIR)) {
    mkdir($UPLOAD_DIR, 0755, true);
}

// Limites de upload (em bytes)
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5 MB por arquivo
