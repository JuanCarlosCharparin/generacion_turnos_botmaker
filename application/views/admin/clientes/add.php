<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Clientes
        <small>Nuevo Cliente</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                </div>
                <hr>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <form action="<?php echo base_url(); ?>mantenimiento/clientes/store" method="POST">
                            <div class="form-group <?php  echo form_error("nombres") != false ?'has-error':'';?>">
                                <label for="nombres">Nombres:</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo set_value("nombres");?>">
                                <?php echo form_error("nombres", "<span class='help-block'>","</span>") ?>
                            </div>
                            <div class="form-group <?php  echo form_error("apellidos") != false ?'has-error':'';?>" >
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo set_value("apellidos");?>">
                                <?php echo form_error("apellidos", "<span class='help-block'>","</span>") ?>
                            </div>
                            <div class="form-group <?php  echo form_error("telefono") != false ?'has-error':'';?>">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo set_value("telefono");?>">
                                <?php echo form_error("telefono", "<span class='help-block'>","</span>") ?>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                            <div class="form-group<?php  echo form_error("ruc") != false ?'has-error':'';?>">
                                <label for="ruc">Ruc:</label>
                                <input type="text" class="form-control" id="ruc" name="ruc" value="<?php echo set_value("ruc");?>">
                                <?php echo form_error("ruc", "<span class='help-block'>","</span>") ?>
                            </div>
                            <div class="form-group">
                                <label for="empresa">Empresa:</label>
                                <input type="text" class="form-control" id="empresa" name="empresa">
                            </div>
                            <div class="form-group">
                                <button type= "submit" class="btn btn-success btn-flat">Guardar</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Agregar el script JavaScript al final del documento, antes de la etiqueta de cierre del body -->
<script>
// Obtener el input del buscador y la tabla
var searchInput = document.getElementById('searchInput');
var table = document.getElementById('categoriasTable');
var rows = table.getElementsByTagName('tr');

// Agregar evento de escucha para el input del buscador
searchInput.addEventListener('keyup', function() {
    var filter = searchInput.value.toUpperCase();

    // Recorrer todas las filas de la tabla, excepto el encabezado
    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var found = false;

        // Recorrer todas las celdas de la fila
        for (var j = 0; j < cells.length; j++) {
            if (cells[j]) {
                if (cells[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }

        // Mostrar u ocultar la fila según el resultado del filtro
        if (found) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});
</script>
