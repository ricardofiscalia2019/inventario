<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
require "conexion.php";

$busqueda = $_GET['busqueda'] ?? '';
$busqueda = trim($busqueda);

if ($busqueda === '') {
    echo json_encode(["success" => false, "equipos" => []]);
    exit;
}

$resultado = [];

function buscarEnTabla($pdo, $tabla) {
    global $busqueda, $resultado;

    $sql = "SELECT * FROM $tabla WHERE sn = :busqueda OR usuario = :busqueda";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['busqueda' => $busqueda]);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $item = [
            "tabla" => $tabla,
            "id" => $row['id'],
            "tipo" => $row['tipo'] ?? '',
            "marca" => $row['marca'] ?? '',
            "modelo" => $row['modelo'] ?? '',
            "sn" => $row['sn'] ?? '',
            "usuario" => $row['usuario'] ?? '',
            "estado" => $row['estado'] ?? '',
            "asignado" => $row['asignado'] ?? '',
            "funcionario" => $row['funcionario'] ?? '',
            "edificio" => $row['edificio'] ?? '',
            "unidad_fl" => $row['unidad_fl'] ?? '',
            "piso" => $row['piso'] ?? '',
            "fecha_asignacion" => $row['fecha_asignacion'] ?? '',
            "fecha_baja" => $row['fecha_baja'] ?? '',
            "descripcion" => $row['descripcion'] ?? ''
        ];
        $resultado[] = $item;
    }
}

buscarEnTabla($pdo_inv, "productos");
buscarEnTabla($pdo_inv, "productos_prov");

if (empty($resultado)) {
    echo json_encode(["success" => false, "error" => "Sin resultados"]);
    exit;
}


echo json_encode([
    "success" => true,
    "equipos" => $resultado
]);
