<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Permisos
            <small>Nuevo Permiso</small>
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
                        <form action="<?php echo base_url(); ?>administrador/permisos/store" method="POST">
                            <div class="form-group">
                                <select name="rol" id="rol" class="form-control">   
                                    <?php foreach ($roles as $rol): ?>
                                        <option value="<?php echo $rol->id; ?>"> <?php echo $rol->nombre ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="menu" id="menu" class="form-control">
                                    <?php foreach ($menus as $menu): ?>
                                        <option value="<?php echo $menu->id; ?>"> <?php echo $menu->menu ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="read">Leer:</label>
                                <label class="radio-inline">
                                    <input type="radio" value="1" name="read" checked="checked" >Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="0" name="read">No
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="insert">Agregar:</label>
                                <label class="radio-inline">
                                    <input type="radio" value="1" name="insert" checked="checked" >Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="0" name="insert">No
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="update">Editar:</label>
                                <label class="radio-inline">
                                    <input type="radio" value="1" name="update" checked="checked" >Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="0" name="update">No
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="delete">Eliminar:</label>
                                <label class="radio-inline">
                                    <input type="radio" value="1" name="delete" checked="checked" >Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="0" name="delete">No
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat">Guardar</button>
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
    searchInput.addEventListener('keyup', function () {
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