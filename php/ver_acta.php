<?php
require_once 'conexion.php';

$id = $_GET['id'] ?? null;
$tabla = $_GET['tabla'] ?? 'productos';

if (!$id) {
    http_response_code(400);
    exit('ID requerido');
}

$stmt = $pdo_inv->prepare("SELECT acta FROM $tabla WHERE id = :id");
$stmt->execute([':id' => $id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row || empty($row['acta'])) {
    http_response_code(404);
    exit('Archivo no encontrado');
}

$ruta = $row['acta'];

if (!file_exists($ruta)) {
    http_response_code(404);
    exit('Archivo no encontrado en el servidor');
}

$ext = strtolower(pathinfo($ruta, PATHINFO_EXTENSION));
$mime = match ($ext) {
    'pdf' => 'application/pdf',
    'png' => 'image/png',
    'jpg', 'jpeg' => 'image/jpeg',
    'gif' => 'image/gif',
    'doc' => 'application/msword',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    default => 'application/octet-stream',
};

header('Content-Type: ' . $mime);
header('Content-Disposition: inline; filename="' . basename($ruta) . '"');
readfile($ruta);
