<?php
header('Content-Type: application/json');
require "conexion.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
    exit;
}

$id = $_POST['id'] ?? null;
$origen = $_POST['origen'] ?? null;

if (!$id || !$origen) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit;
}

// Manejo de documento adjunto (acta) - opcional
$archivoActa = $_FILES['documento'] ?? null;
$rutaActa = null;
if ($archivoActa && isset($archivoActa['name']) && $archivoActa['error'] === UPLOAD_ERR_OK) {
    $candidatas = [
        '\\172.17.216.10\actas\\',
        '//172.17.216.10/actas/',
        '/mnt/actas/',
        __DIR__ . '/../public/actas/'
    ];

    $nombreOriginal = basename($archivoActa['name']);
    $nombreSeguro = preg_replace('/[^A-Za-z0-9_\\.-]/', '_', $nombreOriginal);
    $timestamp = date('Ymd_His');
    $nombreFinal = $timestamp . '_' . $nombreSeguro;

    foreach ($candidatas as $dir) {
        if (!is_dir($dir) && !@mkdir($dir, 0777, true) && !is_dir($dir)) {
            continue;
        }

        $destino = rtrim($dir, '/\\') . DIRECTORY_SEPARATOR . $nombreFinal;
        if (@move_uploaded_file($archivoActa['tmp_name'], $destino)) {
            $rutaActa = str_replace('\\', '/', $destino);
            break;
        }
    }
}

$tipo = $_POST['tipo'] ?? '';
$marca = $_POST['marca'] ?? '';
$modelo = $_POST['modelo'] ?? '';
$sn = $_POST['sn'] ?? '';
$estado = $_POST['estado'] ?? '';
$asignado = $_POST['asignado'] ?? '';
$usuario = $_POST['usuario'] ?? '';
$funcionario = $_POST['funcionario'] ?? '';
$edificio = $_POST['edificio'] ?? '';
$unidadFL = $_POST['unidadFL'] ?? $_POST['unidad_fl'] ?? '';
$piso = $_POST['piso'] ?? '';
$fechaAsignacion = (!empty($_POST['fechaAsignacion'])) ? $_POST['fechaAsignacion'] : ( (!empty($_POST['fecha_asignacion'])) ? $_POST['fecha_asignacion'] : null );
$fechaBaja = (!empty($_POST['fechaBaja'])) ? $_POST['fechaBaja'] : ( (!empty($_POST['fecha_baja'])) ? $_POST['fecha_baja'] : null );
$descripcion = $_POST['descripcion'] ?? '';

$actaActual = null;
$stmtActual = $pdo_inv->prepare("SELECT acta FROM $origen WHERE id = :id");
$stmtActual->execute([':id' => $id]);
$actaActual = $stmtActual->fetchColumn();
$actaFinal = $rutaActa ?? $actaActual;

try {
    if ($origen === 'productos_prov') {
        $query = "UPDATE $origen SET estado=?, asignado=?, usuario=?, funcionario=?, edificio=?, unidad_fl=?, piso=?, fecha_asignacion=?, fecha_baja=?, descripcion=?, acta=? WHERE id=?";
        $stmt = $pdo_inv->prepare($query);
        $stmt->execute([$estado, $asignado, $usuario, $funcionario, $edificio, $unidadFL, $piso, $fechaAsignacion, $fechaBaja, $descripcion, $actaFinal, $id]);
    } else {
        $query = "UPDATE $origen SET estado=?, asignado=?, usuario=?, funcionario=?, edificio=?, unidad_fl=?, piso=?, fecha_asignacion=?, fecha_baja=?, descripcion=?, acta=? WHERE id=?";
        $stmt = $pdo_inv->prepare($query);
        $stmt->execute([$estado, $asignado, $usuario, $funcionario, $edificio, $unidadFL, $piso, $fechaAsignacion, $fechaBaja, $descripcion, $actaFinal, $id]);
    }

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
