<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'conexion.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function convertirColumnaExcel($numero) {
    $letra = '';
    while ($numero > 0) {
        $resto = ($numero - 1) % 26;
        $letra = chr(65 + $resto) . $letra;
        $numero = intval(($numero - 1) / 26);
    }
    return $letra;
}


try {
    $spreadsheet = new Spreadsheet();

    // -------- Hoja para "productos" --------
    $sheet1 = $spreadsheet->getActiveSheet();
    $sheet1->setTitle('Productos');

    $stmt1 = $pdo_inv->query("SELECT * FROM productos");
    $productos = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($productos)) {
        // Encabezados
        $col = 1;
        foreach (array_keys($productos[0]) as $header) {
            $sheet1->setCellValue(convertirColumnaExcel($col++) . '1', $header);
        }

        // Datos
        $row = 2;
        foreach ($productos as $producto) {
            $col = 1;
            foreach ($producto as $valor) {
                $sheet1->setCellValue(convertirColumnaExcel($col++) . $row, $valor);
            }
            $row++;
        }
    }

    // -------- Hoja para "productos_prov" --------
    $sheet2 = $spreadsheet->createSheet();
    $sheet2->setTitle('Productos Prov');

    $stmt2 = $pdo_inv->query("SELECT * FROM productos_prov");
    $productosProv = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($productosProv)) {
        // Encabezados
        $col = 1;
        foreach (array_keys($productosProv[0]) as $header) {
            $sheet2->setCellValue(convertirColumnaExcel($col++) . '1', $header);
        }

        // Datos
        $row = 2;
        foreach ($productosProv as $producto) {
            $col = 1;
            foreach ($producto as $valor) {
                $sheet2->setCellValue(convertirColumnaExcel($col++) . $row, $valor);
            }
            $row++;
        }

    }

    // -------- Descarga --------
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="inventario_completo.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;

} catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error al generar el Excel: " . $e->getMessage();
}

