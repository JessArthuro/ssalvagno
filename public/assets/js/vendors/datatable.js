// $(document).ready(function(){$("#example").DataTable({responsive:!0})});

$("#example").DataTable({
  responsive: true,
  autoWidth: false,
  language: {
      lengthMenu: "Mostrar _MENU_ registros / página",
      zeroRecords: "No se encontraron registros coincidentes",
      info: "Mostrando _PAGE_ de _PAGES_ páginas, _MAX_ registros",
      infoEmpty: "No hay registros disponibles",
      infoFiltered: "(filtrado de _MAX_ registros en total)",
      search: "Buscar:",
      paginate: {
          next: "Siguiente",
          previous: "Anterior",
      },
  },
});