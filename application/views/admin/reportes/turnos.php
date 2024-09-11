
<!-- =============================================== -->
<div class="content" style="">
    <section class="content-header">
        <h1>
            Recordatorio
            <small>Tunos</small>
        </h1>
        <form class="form-horizontal col-md-10" id="turnos-form" style="margin-top: 2.5%">
    <div class="form-group">
        <div class="form-group">
            <label for="fecha" class="col-md-1 control-label" style="padding-left: 10px;">Fecha:</label>
            <div class="col-md-1" style="padding-right: 0;">
                <input type="date" class="fecha-form fecha form-control" name="fecha" id="fecha" style="height: 35px;">
            </div>
            <div class="col-md-1" style="margin-left: 10px; padding-left: 5px;">
                <button type="button" name="buscar" onclick="updateList()" class="btn btn-primary" style="padding-left: 5px; padding-right: 5px;">
                    Buscar
                </button>
            </div>
        </div>
    </div>
</form>

    </section>
    <!-- Main content -->
    <section class="content col-md-12">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row"></div>
                <br>
                <div class="row">
                    <div class="list-container" id="list-container"></div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
