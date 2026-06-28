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
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar Productos</title>
    <link rel="stylesheet" href="../css/style.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
      <h1 class="text-2xl font-bold mb-4 text-center text-gray-800">Modificar Productos</h1>
  
      <div class="flex flex-col sm:flex-row items-center gap-4 mb-6">
        <input
          type="text"
          id="buscar"
          placeholder="Buscar por número de serie o usuario"
          class="flex-1 p-2 border rounded-lg w-full"
        />
        <button
        id="buscarBtn"
        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition-colors"
        >
          Buscar
        </button>

        <button id="volver" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
        onclick="window.location.href='../index.php'"
      
        >
          Volver
        </button>

      </div>
  
      <div id="resultados"></div>
    </div>
    <script src="../js/modificar.js"></script>
  </body>
</html>

