<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Seleccionar Acción</title>
  </head>
  <body class="body-opcion">
    <h1 class="h1-accion">Seleccionar Acción</h1>
    <div class="button-opcion">
      <button onclick="window.location.href='agregar.php'">
        Agregar Equipo Fiscalía
      </button>
      <button onclick="window.location.href='agregar_prov.php'">
        Agregar Equipo Proveedor
      </button>
      <button onclick="window.location.href='../index.php'">Volver</button>
    </div>
  </body>
</html>
