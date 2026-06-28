<?php
$host = "localhost";
$dbname = "inventario";
$user = "inventariosur";
$password = "frms2024.";

try {
    $pdo_prov = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo_prov->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos INVENTARIO_PROV: " . $e->getMessage());
}
?>

