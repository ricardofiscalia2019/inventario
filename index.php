<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.html');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Este sitio es para el uso interno de la Fiscalia Sur de Chile"
    />
    <meta name="keywords" content="inventario, fiscalia" />
    <meta name="author" content="Ricardo Quilodran" />
    <meta name="copyright" content="Ricardo Quilodran" />
    <meta name="robots" content="index, no follow" />
    <title>Inventario</title>
    <link
      rel="shortcut icon"
      href="./assets/img/logo3.ico"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="./css/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
    <header>
      <div class="logo">
        <a href=""><img src="./assets/img/logo.png" alt="" /></a>
      </div>
    </header>
    <main>
      <section class="principal">
        <div class="foto_principal">
          <a href=""
            ><img src="./assets/img/inventario_principal.png" alt=""
          /></a>
        </div>
        <div class="titulo">
          <h1>Sistema de Inventario</h1>
          <h2>Fiscalia Sur</h2>
        </div>
      </section>
      <section id="contenido">
        <div class="ingreso">
          <button
            id="agregarProducto"
            type="button"
            onclick="window.location.href='./pages/agregar_opcion.php'"
          >
            Agregar Equipo
          </button>
          <button
            id="modificarProducto"
            type="button"
            onclick="window.location.href='./pages/modificar.php'"
          >
            Modificar Equipo
          </button>
          <!--
          <button
            id="buscarProducto"
            type="button"
            onclick="window.location.href='./pages/buscar.html'"
          >
            Buscar por Usuario
          </button>
          <button
            id="eliminarProducto"
            type="button"
            onclick="window.location.href='./pages/eliminar.html'"
          >e
            Eliminar Equipo
          </button>
          -->
          <button
            id="exportarExcel"
            type="button"
            onclick="window.location.href='../php/exportar_excel.php'"
          >
            Exportar a Excel
          </button>
          <button id="salirSistema" class="boton-salir" type="button">Salir del sistema</button>
        </div>
      </section>
    </main>
    <footer>
      <p>
        Este sitio web ha sido desarrollado y mantenido por el equipo de Soporte Informático y Desarrollo de la Fiscalia Sur. 
        Si tiene alguna sugerencia, comentario o reclamo, puede enviarnos un mensaje directamente a nuestro correo electrónico: 
        soporte@minpublico.cl.
      </p>
    </footer>

    <!-- < > -->
    <script src="./js/exportar.js"></script>
    <script src="./js/salir.js"></script>
  </body>
</html>
