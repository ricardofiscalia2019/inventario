document.addEventListener("DOMContentLoaded", function () {
  const tipoSelect = document.getElementById("tipo");
  const otroTipoInput = document.getElementById("otroTipo");
  const telefonoFields = document.getElementById("telefonoFields");
  const asignadoSelect = document.getElementById("asignado");

  const funcionarioInput = document.getElementById("funcionario");
  const usuarioInput = document.getElementById("usuario");
  const fechaAsignacionInput = document.getElementById("fechaAsignacion");
  const fechaBajaInput = document.getElementById("fechaBaja");

  const funcionarioGroup = funcionarioInput.closest(".form-group");
  const usuarioGroup = usuarioInput.closest(".form-group");
  const fechaAsignacionGroup = fechaAsignacionInput.closest(".form-group");
  const fechaBajaGroup = fechaBajaInput.closest(".form-group");

  // Función para actualizar visibilidad de campos según el tipo
  function actualizarTipo() {
    const tipo = tipoSelect.value;

    if (tipo === "otro") {
      otroTipoInput.style.display = "block";
      otroTipoInput.setAttribute("required", "true");
    } else {
      otroTipoInput.style.display = "none";
      otroTipoInput.removeAttribute("required");
      otroTipoInput.value = "";
    }

    if (tipo === "telefono") {
      telefonoFields.style.display = "block";
      document.getElementById("telefono").setAttribute("required", "true");
      document.getElementById("anexo").setAttribute("required", "true");
    } else {
      telefonoFields.style.display = "none";
      document.getElementById("telefono").removeAttribute("required");
      document.getElementById("anexo").removeAttribute("required");
      document.getElementById("telefono").value = "";
      document.getElementById("anexo").value = "";
    }
  }

  // Función para actualizar visibilidad de campos según asignación
  function actualizarAsignado() {
    const asignado = asignadoSelect.value;

    if (asignado === "no-asignado") {
      funcionarioGroup.style.display = "none";
      funcionarioInput.removeAttribute("required");

      usuarioGroup.style.display = "none";
      usuarioInput.removeAttribute("required");

      fechaAsignacionGroup.style.display = "none";
      fechaAsignacionInput.removeAttribute("required");

      fechaBajaGroup.style.display = "none";
      fechaBajaInput.removeAttribute("required");
    } else {
      funcionarioGroup.style.display = "block";
      funcionarioInput.setAttribute("required", "true");

      usuarioGroup.style.display = "block";
      usuarioInput.setAttribute("required", "true");

      fechaAsignacionGroup.style.display = "block";
      fechaAsignacionInput.setAttribute("required", "true");

      fechaBajaGroup.style.display = "block";
    }
  }

  // Listeners
  tipoSelect.addEventListener("change", actualizarTipo);
  asignadoSelect.addEventListener("change", actualizarAsignado);

  // Ejecutar en carga inicial por si hay valores ya seleccionados
  actualizarTipo();
  actualizarAsignado();
});
