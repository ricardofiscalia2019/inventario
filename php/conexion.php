<?php
$host = "localhost";
$dbname = "inventario"; 
$user = "inventariosur";
$password = "frms2024.";

try {
    $pdo_inv = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo_inv->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos INVENTARIO: " . $e->getMessage());
}
?>
