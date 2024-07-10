<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Reportes
            <small>Ventas</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content col-md-12">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                
                <div class="row">
                    <form action="<?php echo current_url(); ?>" method="POST" class="form-horizontal col-md-10">
                        <div class="form-group">
                            <label for="" class="col-md-1 control-label">Desde:</label>
                            <div class="col-md-3">
                            <input type="date" class="form-control" name="fechainicio" value="<?php echo !empty($fechainicio) ? $fechainicio: '';?>">
                            </div>
                            <label for="" class="col-md-1 control-label">Hasta:</label>
                            <div class="col-md-3">
                                <input type="date" class="form-control" name="fechafin" value="<?php echo !empty($fechafin) ? $fechafin: '';?>">
                            </div>
                            <div class="col-md-4">
                                <input type="submit" name="buscar" value="Buscar" class="btn btn-primary">
                                <a href="<?php echo base_url();?>reportes/ventas" class="btn btn-danger">Restablecer</a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Buscador 
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre...">
                    </div> 
                </div>-->
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover" id="example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre Cliente</th>
                                    <th>Tipo Comprobante</th>
                                    <th>Numero del Comprobante</th>
                                    <th>Fecha</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($ventas)): ?>

                                    <?php foreach($ventas as $venta):?>
                                        <tr>
                                            <td><?php echo $venta->id; ?></td>
                                            <td><?php echo $venta->nombres; ?></td>
                                            <td><?php echo $venta->tipocomprobante; ?></td>
                                            <td><?php echo $venta->num_documento; ?></td>
                                            <td><?php echo $venta->fecha; ?></td>
                                            
                                        </tr>
                                    <?php endforeach;?>

                                <?php endif;?>
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