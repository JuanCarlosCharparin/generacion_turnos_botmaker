<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Clientes
            <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url(); ?>mantenimiento/clientes/add"
                            class="btn btn-primary btn-flat"><span class="fa fa-plus">Agregar Clientes</span></a>
                    </div>
                </div>
                <hr>
                <!-- Buscador -->
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre...">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover" id="categoriasTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Telefono</th>
                                    <th>Direccion</th>
                                    <th>Ruc</th>
                                    <th>Empresa</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($clientes)): ?>
                                    <?php foreach ($clientes as $cliente): ?>
                                        <tr>
                                            <td><?php echo $cliente->id; ?></td>
                                            <td><?php echo $cliente->nombres; ?></td>
                                            <td><?php echo $cliente->apellidos; ?></td>
                                            <td><?php echo $cliente->telefono; ?></td> 
                                            <td><?php echo $cliente->direccion; ?></td>
                                            <td><?php echo $cliente->ruc; ?></td>
                                            <td><?php echo $cliente->empresa; ?></td>
                                            <?php $datacliente = $cliente->id."*".$cliente->nombres."*".$cliente->apellidos."*".$cliente->telefono
                                            ."*".$cliente->direccion."*".$cliente->ruc."*".$cliente->empresa; ?>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-view-cliente" data-toggle="modal"
                                                        data-target="#modal-default" value="<?php echo $datacliente ?>">
                                                        <span class="fa fa-search"></span>
                                                    </button>

                                                        

                                                    <a href="<?php echo base_url() ?>mantenimiento/clientes/edit/<?php echo $cliente->id; ?>"
                                                        class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    <a href="<?php echo base_url(); ?>mantenimiento/clientes/delete/<?php echo $cliente->id;?>" 
                                                    class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
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

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Informacion de la categoria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                
            </div>
        </div>

    </div>

</div>