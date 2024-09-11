<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>

<!-- JSZip -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- PDFMake -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- Buttons HTML5 Export -->
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>

<!-- Buttons Print -->
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
<!-- Page specific script -->
<script>

  $(document).ready(function () {
    $('#turnos-form').on('submit', function (e) {
      if ($('#turnos').val().trim() === '') {
        e.preventDefault();
        alert('El campo fecha es obligatorio.');
        $('#turnos').focus();
      }
    });
  });


  document.body.style.zoom = "89%";
  document.body.style.transformOrigin = "0 0"; // Fija el punto de origen de la escala

  $(function () {
    var base_url = "<?php echo base_url(); ?>";
    var num_factura = 0;

    $(".turnos").on("change", function () {
      num_factura = $(this).val();
    });


    $('#turnos-form').on('submit', function (event) {
      event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario
      updateList();
    });

    $('#turnos').on('change', function () {
      updateListMedicos();
    })

    // Otros eventos y funciones existentes aquí...

  });
  //*------------------------------------------------------------------
  //*------------------------------------------------------------------
  //*------------------------------------------------------------------
  function updateList() {
    var fecha = document.getElementById('fecha').value;
    $.ajax({
      url: '<?php echo base_url('reportes/turnos/getTurnosAjax'); ?>',
      type: 'GET',
      data: { fecha: fecha },
      success: function (response) {
        $('#list-container').html(response);
      },
      error: function (response) {
        alert('Error al obtener los datos.');
      }
    });
  }

  function exportarDatos() {
        var fecha = document.getElementById('fecha').value;

        var url = "<?php echo base_url(); ?>reportes/turnos/exportar?fecha=" + fecha;
        window.location.href = url;
    }


</script>
</body>

</html>