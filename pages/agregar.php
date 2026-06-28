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
    <title>Agregar Equipo Fiscalía</title>
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <header>
      <h1>Agregar Equipo Fiscalía</h1>
    </header>
    <form
      id="formProducto"
      action="../php/guardar_producto.php"
      method="POST"
      enctype="multipart/form-data"
    >
      <!-- COLUMNA IZQUIERDA -->
      <div class="form-group">
        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
          <option value="" disabled selected>Seleccionar</option>
          <option value="Notebook">Notebook</option>
          <option value="Cámara web">Cámara web</option>
          <option value="Disco duro">Disco duro</option>
          <option value="Parlantes">Parlantes</option>
          <option value="Monitor">Monitor</option>
          <option value="otro">Otro</option>
        </select>
        <input
          type="text"
          id="otroTipo"
          name="otroTipo"
          placeholder="Especificar otro tipo"
          style="display: none"
        />
      </div>
      <div class="form-group">
        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required />
      </div>
      <div class="form-group">
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required />
      </div>
      <div class="form-group">
        <label for="sn">Número de Serie (S/N):</label>
        <input type="text" id="sn" name="sn" required />
      </div>
      <div class="form-group">
        <label for="mac">MAC:</label>
        <input type="text" id="mac" name="mac" />
      </div>
      <div class="form-group">
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
          <option value="" disabled selected>Seleccionar</option>
          <option value="Nuevo">Nuevo</option>
          <option value="Usado">Usado</option>
          <option value="Defectuoso">Defectuoso</option>
        </select>
      </div>

      <!-- COLUMNA DERECHA -->
      <div class="form-group">
        <label for="asignado">Asignación:</label>
        <select id="asignado" name="asignado" >
          <option value="" disabled selected>Seleccionar</option>
          <option value="Asignado">Asignado</option>
          <option value="no-asignado">Sin Asignar</option>
        </select>
      </div>
      <div class="form-group">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" />
      </div>
      <div class="form-group">
        <label for="edificio">Edificio:</label>
        <select id="edificio" name="edificio" required>
          <option value="" disabled selected>Seleccionar</option>
          <option value="San_miguel">San Miguel</option>
          <option value="Departamental">Departamental</option>
          <option value="Puente_Alto">Puente Alto</option>
          <option value="Ochagavia">Bodega Ochagavía</option>
          <option value="UJO">UJO</option>
          <option value="CJ">Centro Justicia Santiago</option>
          <option value="TPuente">Tribunal Puente Alto</option>
          <option value="ECOH">Catedral - ECOH RM</option>
        </select>
      </div>
      <div class="form-group">
        <label for="unidadFL">Unidad o FL:</label>
        <select id="unidadFL" name="unidadFL" required>
          <option value="" disabled selected>Seleccionar</option>
          <option value="1701">1701-Puente Alto</option>
          <option value="1702">1702-VIF, Sexuales y Género</option>
          <option value="1703">1703-Antinarcóticos y Crimen Organizado</option>
          <option value="1704">1704-Robos y Delitos Contra Propiedad</option>
          <option value="1705">1705-Violentos, Económicos y Funcionario</option>
          <option value="1706">1706-Flagrancia</option>
          <option value="1707">
            1707-Preclasificación y Primeras Diligencias
          </option>
          <option value="1708">1708-SACFI</option>
          <option value="1709">
            1709-Tramitación Intermedia y Delitos Generales
          </option>
          <option value="1711">1711-ECOH</option>
          <option value="RRHH">RRHH</option>
          <option value="UAF">UAF</option>
          <option value="UGI">UGI</option>
          <option value="Gabinete">Gabinete</option>
          <option value="ASJUR">UAJ</option>
          <option value="URAVIT">URAVIT</option>
          <option value="Custodia">Custodia</option>
          <option value="Atención Público">Atención a Público</option>
        </select>
      </div>
      <div class="form-group">
        <label for="piso">Piso:</label>
        <input type="number" id="piso" name="piso" min="1" />
      </div>
      <div class="form-group">
        <label for="fechaAsignacion">Fecha de asignación:</label>
        <input
          type="date"
          id="fechaAsignacion"
          name="fechaAsignacion"
        />
      </div>
      <div class="form-group">
        <label for="fechaBaja">Fecha de baja:</label>
        <input 
          type="date" 
          id="fechaBaja" 
          ame="fechaBaja" />
      </div>
      <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion"></textarea>
      </div>

      <div class="form-group">
        <label for="documento">Acta / documento (PDF, Word o imagen):</label>
        <input
          type="file"
          id="documento"
          name="documento"
          accept=".pdf,.doc,.docx,image/*"
        />
      </div>

      <div class="button-container">
        <button id="volver" onclick="window.location.href='../index.php'">
          Volver
        </button>

        <button type="submit">Guardar</button>
      </div>
    </form>

    <script src="../js/agregar.js"></script>
  </body>
</html>
