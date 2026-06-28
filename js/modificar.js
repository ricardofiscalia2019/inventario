//BUSCAR

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("buscarBtn").addEventListener("click", function () {
    const busqueda = document.getElementById("buscar").value.trim();

    if (busqueda === "") {
      Swal.fire("Error", "Ingrese un número de serie o usuario", "warning");
      return;
    }

    fetch("../php/buscar.php?busqueda=" + encodeURIComponent(busqueda))
      .then((response) => response.json())
      .then((data) => {
        if (data.success && data.equipos.length > 0) {
          mostrarResultados(data.equipos);
        } else {
          Swal.fire("No encontrado", "No se encontraron equipos", "info");
          document.getElementById("resultados").innerHTML = "";
        }
      })
      .catch((error) => {
        console.error("Error en la búsqueda:", error);
        Swal.fire("Error", "No se pudo realizar la búsqueda.", "error");
      });
  });
});

//MODIFICAR 

function mostrarResultados(equipos) {
  const contenedor = document.getElementById("resultados");
  contenedor.innerHTML = "";

  equipos.forEach((equipo) => {
    const form = document.createElement("form");
    form.classList.add("bg-white", "p-4", "rounded-lg", "shadow-md", "mb-4");
    form.dataset.tabla = equipo.tabla;
    form.dataset.id = equipo.id;

    ["tipo", "marca", "modelo", "sn"].forEach((campo) => {
      const label = document.createElement("label");
      label.textContent = campo.toUpperCase();
      label.classList.add("block", "text-sm", "font-semibold", "mt-2");
    
      const input = document.createElement("input");
      input.type = "text";
      input.name = campo;
      input.value = equipo[campo] || "";
      input.readOnly = true;
      input.disabled = true;
      input.classList.add("p-2", "border", "rounded-lg", "w-full", "bg-gray-100", "cursor-not-allowed");
    
      form.appendChild(label);
      form.appendChild(input);
    });

    const campos = [
      "estado",
      "asignado",
      "usuario",
      "funcionario",
      "edificio",
      "unidad_fl",
      "piso",
      "fecha_asignacion",
      "fecha_baja",
      "descripcion"
    ];

    const opciones = {
      estado: ["Nuevo", "Usado", "Defectuoso"],
      asignado: ["Asignado", "no-asignado"],
      edificio: [
        "San_miguel", "Departamental", "Puente_Alto", "Ochagavia", "UJO",
        "CJ", "TPuente", "ECOH"
      ],
      unidad_fl: [
        "1701", "1702", "1703", "1704", "1705", "1706", "1707", "1708", "1709", "1711",
        "RRHH", "UAF", "UGI", "Gabinete", "ASJUR", "URAVIT", "Custodia", "Atención Público"
      ]
    };

    campos.forEach((campo) => {
      if (equipo[campo] !== undefined) {
        const label = document.createElement("label");
        label.textContent = campo.replace(/_/g, " ").toUpperCase();
        label.classList.add("block", "text-sm", "font-semibold", "mt-2");

        let input;

        if (campo === "estado" || campo === "asignado" || campo === "edificio" || campo === "unidad_fl") {
          input = document.createElement("select");
          input.name = campo;
          input.classList.add("p-2", "border", "rounded-lg", "w-full");

          opciones[campo].forEach((op) => {
            const option = document.createElement("option");
            option.value = op;
            option.textContent = campo === "unidad_fl" ? `${op} - ${unidadNombre(op)}` : op;
            if (equipo[campo] === op) option.selected = true;
            input.appendChild(option);
          });
        } else if (campo === "fecha_asignacion" || campo === "fecha_baja") {
          input = document.createElement("input");
          input.type = "date";
          input.name = campo;
          input.value = equipo[campo] ? equipo[campo].split("T")[0] : ""; // formatear fecha
          input.classList.add("p-2", "border", "rounded-lg", "w-full");
        } else {
          input = document.createElement("input");
          input.type = "text";
          input.name = campo;
          input.value = equipo[campo] || "";
          input.classList.add("p-2", "border", "rounded-lg", "w-full");
        }

        form.appendChild(label);
        form.appendChild(input);
      }
    });

    const btn = document.createElement("button");
    btn.type = "submit";
    btn.textContent = "Modificar";
    btn.classList.add(
      "bg-[rgb(248,117,22)]",
      "text-white",
      "font-bold",
      "py-2",
      "px-4",
      "rounded-lg",
      "hover:bg-[rgb(24,45,152)]",
      "transition-colors",
      "mt-4"
    );

    form.appendChild(btn);

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      const formData = new FormData(form);
      formData.append("id", form.dataset.id);
      formData.append("origen", form.dataset.tabla);

      fetch("../php/modificar_equipo.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            Swal.fire("Éxito", "Producto modificado exitosamente", "success");
          } else {
            Swal.fire("Error", data.error || "No se pudo modificar", "error");
          }
        })
        .catch((error) => {
          console.error("Error al modificar:", error);
          Swal.fire("Error", "No se pudo modificar el equipo", "error");
        });
    });

    contenedor.appendChild(form);
  });
}

// Opcional: nombres personalizados para unidad_fl
function unidadNombre(codigo) {
  const nombres = {
    "1701": "Puente Alto",
    "1702": "VIF, Sexuales y Género",
    "1703": "Antinarcóticos y Crimen Organizado",
    "1704": "Robos y Delitos Contra Propiedad",
    "1705": "Violentos, Económicos y Funcionario",
    "1706": "Flagrancia",
    "1707": "Preclasificación y Primeras Diligencias",
    "1708": "SACFI",
    "1709": "Tramitación Intermedia y Delitos Generales",
    "1711": "ECOH",
    "RRHH": "RRHH",
    "UAF": "UAF",
    "UGI": "UGI",
    "Gabinete": "Gabinete",
    "ASJUR": "UAJ",
    "URAVIT": "URAVIT",
    "Custodia": "Custodia",
    "Atención Público": "Atención a Público"
  };
  return nombres[codigo] || "";
}