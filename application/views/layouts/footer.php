<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
</footer>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/template/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/jquery-ui/jquery-ui.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/v/dt/dt-2.0.7/datatables.min.js"></script>

<!-- DataTables Export -->
<script src="<?php echo base_url(); ?>assets/template/datatables-export/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/datatables-export/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/datatables-export/js/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/datatables-export/js/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/datatables-export/js/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/template/datatables-export/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/datatables-export/js/buttons.print.min.js"></script>

<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>assets/template/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/template/fastclick/lib/fastclick.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/template/dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/template/dist/js/demo.js"></script>

<!-- Inicialización de scripts -->
<script>
    $(document).ready(function () {

        var base_url = "<?php echo base_url(); ?>";

        $(".btn-remove").on("click", function (e) {
            e.preventDefault();
            var ruta = $(this).attr("href");
            //alert(ruta);
            $.ajax({
                url: ruta,
                type: "POST",
                success: function (resp) {

                    window.location.href = base_url + resp;
                }
            })
        })

        $(".btn-view-cliente").on("click", function () {
            var cliente = $(this).val();
            //alert(cliente);
            var infocliente = cliente.split("*");
            html = "<p><strong>Nombres:</strong>" + infocliente[1] + "</p>"
            html += "<p><strong>Apellidos:</strong>" + infocliente[2] + "</p>"
            html += "<p><strong>Telefono:</strong>" + infocliente[3] + "</p>"
            html += "<p><strong>Direccion:</strong>" + infocliente[4] + "</p>"
            html += "<p><strong>Ruc:</strong>" + infocliente[5] + "</p>"
            html += "<p><strong>Empresa:</strong>" + infocliente[6] + "</p>"
            $("#modal-default .modal-body").html(html);
        })

        $(".btn-view").on("click", function () {
            var id = $(this).val();
            $.ajax({
                url: base_url + "mantenimiento/categorias/view/" + id,
                type: "POST",
                success: function (resp) {
                    $("#modal-default .modal-body").html(resp);

                }
            });
        })

        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });

        $('#dataTables').DataTable();

        $('.sidebar-menu').tree();

        $("#comprobantes").on("change", function () {
            option = $(this).val();
            if (option != "") {
                infocomprobante = option.split("*");

                $("#idcomprobante").val(infocomprobante[0]);
                $("#igv").val(infocomprobante[2]);
                $("#serie").val(infocomprobante[3]);
                $("#numero").val(generarNumero(infocomprobante[1]))
            } else {
                $("#idcomprobante").val(null);
                $("#igv").val(null);
                $("#serie").val(null);
                $("#numero").val(null)
            }
        })

        $(document).on("click", ".btn-check", function () {
            cliente = $(this).val();
            infocliente = cliente.split("*");
            $("#idcliente").val(infocliente[0]);
            $("#cliente").val(infocliente[1]);
            $("#modal-default").modal("hide");
        });

        $("#producto").autocomplete({
            source: function (request, response) {
                console.log("Request term:", request.term);
                $.ajax({
                    url: base_url + "movimientos/ventas/getproductos",
                    type: "POST",
                    dataType: "json",
                    data: { valor: request.term },
                    success: function (data) {
                        console.log("Data received:", data);
                        response(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("AJAX error:", textStatus, errorThrown);
                    }
                });
            },
            minLength: 1,
            select: function (event, ui) {
                console.log("Selected item:", ui.item);
                data = ui.item.id + "*" + ui.item.codigo + "*" + ui.item.label + "*" + ui.item.precio + "*" + ui.item.stock;
                $("#btn-agregar").val(data);
            }
        });


    });

    function generarNumero(numero) {
        if (numero >= 99999 && numero < 999999) {
            return (Number(numero) + 1);
        }
        if (numero >= 9999 && numero < 99999) {
            return "0" + (Number(numero) + 1);
        }
        if (numero >= 999 && numero < 9999) {
            return "00" + (Number(numero) + 1);
        }
        if (numero >= 99 && numero < 999) {
            return "000" + (Number(numero) + 1);
        }
        if (numero >= 9 && numero < 99) {
            return "0000" + (Number(numero) + 1);
        }
        if (numero < 9) {
            return "00000" + (Number(numero) + 1);
        }
    }

</script>

</body>

</html>