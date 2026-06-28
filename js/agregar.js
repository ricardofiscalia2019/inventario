document.addEventListener("DOMContentLoaded", function () {
  const tipoSelect = document.getElementById("tipo");
  const otroTipoInput = document.getElementById("otroTipo");
  const asignadoSelect = document.getElementById("asignado");
    const asignadoSelect = document.getElementById("funcionario");
  const usuarioInput = document.getElementById("usuario");
  const fechaAsignacionInput = document.getElementById("fechaAsignacion");
  const fechaBajaInput = document.getElementById("fechaBaja");

  const usuarioGroup = usuarioInput.closest(".form-group");
  const fechaAsignacionGroup = fechaAsignacionInput.closest(".form-group");
  const fechaBajaGroup = fechaBajaInput.closest(".form-group");

  // Mostrar/ocultar campo "Otro tipo"
  tipoSelect.addEventListener("change", function () {
    if (tipoSelect.value === "otro") {
      otroTipoInput.style.display = "block";
      otroTipoInput.setAttribute("required", "true");
    } else {
      otroTipoInput.style.display = "none";
      otroTipoInput.removeAttribute("required");
      otroTipoInput.value = "";
    }
  });

  // Mostrar/ocultar campos según asignación
  asignadoSelect.addEventListener("change", function () {
    if (asignadoSelect.value === "no-asignado") {
      usuarioGroup.style.display = "none";
      usuarioInput.removeAttribute("required");

      fechaAsignacionGroup.style.display = "none";
      fechaAsignacionInput.removeAttribute("required");

      fechaBajaGroup.style.display = "none";
      fechaBajaInput.removeAttribute("required");
    } else {
      usuarioGroup.style.display = "block";
      usuarioInput.setAttribute("required", "true");

      fechaAsignacionGroup.style.display = "block";
      fechaAsignacionInput.setAttribute("required", "true");

      fechaBajaGroup.style.display = "block";
      // fechaBaja puede no ser obligatoria
    }
  });

  // Ejecutar en carga inicial si ya hay valor
  function updateFormVisibility() {
    asignadoSelect.dispatchEvent(new Event("change"));
  }

  updateFormVisibility();  // Llamada inicial para aplicar la visibilidad correctamente
});
