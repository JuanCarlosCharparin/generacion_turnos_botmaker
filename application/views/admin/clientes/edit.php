<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Cliente
        <small>Editar Cliente</small>
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
                        <form action="<?php echo base_url(); ?>mantenimiento/clientes/update" method="POST">
                            <input type="hidden" value="<?php echo $cliente->id;?>" name="idCliente">
                            <div class="form-group">
                                <label for="nombres">Nombres:</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $cliente->nombres ?>">
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $cliente->apellidos ?>">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $cliente->telefono ?>">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $cliente->direccion ?>">
                            </div>
                            <div class="form-group">
                                <label for="ruc">Ruc:</label>
                                <input type="text" class="form-control" id="ruc" name="ruc" value="<?php echo $cliente->ruc ?>">
                            </div>
                            <div class="form-group">
                                <label for="empresa">Empresa:</label>
                                <input type="text" class="form-control" id="empresa" name="empresa" value="<?php echo $cliente->empresa ?>">
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
