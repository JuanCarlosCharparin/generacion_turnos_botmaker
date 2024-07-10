<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Usuarios
        <small>Nuevo Usuario</small>
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
                        <form action="<?php echo base_url(); ?>administrador/usuarios/store" method="POST">
                            <div class="form-group">
                                <label for="nombres">Nombres:</label>
                                <input type="text" class="form-control" id="nombre" name="nombres">
                            </div>
                            <div class="form-group">
                                <label for="apeliidos">Apellidos:</label>
                                <input type="text" class="form-control" id="apeliidos" name="apeliidos">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="rol">Rol:</label>
                                <select name="rol" id="rol" class="form-control">
                                    <?php foreach($roles as $rol): ?>
                                        <option value="<?php echo $rol->id; ?>"> <?php echo $rol->nombre ?> </option>
                                    <?php endforeach; ?>
                                </select>
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
