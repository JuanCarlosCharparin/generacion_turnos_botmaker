<div class="table-responsive">

    <a href="#" class="btn btn-primary btn-flat" onclick="exportarDatos()"><span class="fa fa-plus">Exportar</span></a>
    <table class="table table-bordered btn-hover example1" id="example1">
        <thead>
            <tr>
                <th>FECHATURNO</th>
                <th>HORATURNO</th>
                <th>PACIENTETURNO</th>
                <th>WHATSAPP</th>
                <th>ESPECIALIDADTURNO</th>
                <th>PROFESIONALTURNO</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($turnos)): ?>
                <?php foreach ($turnos as $turno): ?>
                    <tr>
                        <td><?php echo $turno->FECHATURNO ?></td>
                        <td><?php echo $turno->HORATURNO ?></td>
                        <td><?php echo $turno->PACIENTETURNO ?></td>
                        <td><?php echo $turno->WHATSAPP ?></td>
                        <td><?php echo $turno->ESPECIALIDADTURNO ?></td>
                        <td><?php echo $turno->PROFESIONALTURNO ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Importar ESTO -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
        $('#example1').DataTable({});
    })
</script>