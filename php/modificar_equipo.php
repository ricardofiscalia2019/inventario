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

try {
    if ($origen === 'productos_prov') {
        $query = "UPDATE $origen SET estado=?, asignado=?, usuario=?, funcionario=?, edificio=?, unidad_fl=?, piso=?, fecha_asignacion=?, fecha_baja=?, descripcion=? WHERE id=?";
        $stmt = $pdo_inv->prepare($query);
        $stmt->execute([$estado, $asignado, $usuario, $funcionario, $edificio, $unidadFL, $piso, $fechaAsignacion, $fechaBaja, $descripcion, $id]);
    } else {
        $query = "UPDATE $origen SET estado=?, asignado=?, usuario=?, funcionario=?, edificio=?, unidad_fl=?, piso=?, fecha_asignacion=?, fecha_baja=?, descripcion=? WHERE id=?";
        $stmt = $pdo_inv->prepare($query);
        $stmt->execute([$estado, $asignado, $usuario, $funcionario, $edificio, $unidadFL, $piso, $fechaAsignacion, $fechaBaja, $descripcion, $id]);
    }

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
