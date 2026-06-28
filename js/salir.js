document.getElementById("salirSistema").addEventListener("click", () => {
  Swal.fire({
    title: '¿Estás seguro?',
    text: "Vas a salir del sistema.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, salir',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = 'https://minpublicocl.sharepoint.com/sites/SoporteTIFRMS/SitePages/ITHelpdeskHome.aspx'; 
    }
  });
});