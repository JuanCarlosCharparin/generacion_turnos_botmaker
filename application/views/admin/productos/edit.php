<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Productos
        <small>Editar un producto </small>
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
                        <form action="<?php echo base_url(); ?>mantenimiento/productos/update" method="POST">
                            <input type="hidden" value="<?php echo $producto->id;?>" name="idProducto">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto->nombre ?>">
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripcion:</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $producto->descripcion ?>">
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio:</label>
                                <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $producto->precio ?>">
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock:</label>
                                <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $producto->stock ?>">
                            </div>
                            <div class="form-group">
                                <label for="categoria_id">Categoria del Producto:</label>
                                <input type="text" class="form-control" id="categoria_id" name="categoria_id" value="<?php echo $producto->categoria_id ?>">
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
