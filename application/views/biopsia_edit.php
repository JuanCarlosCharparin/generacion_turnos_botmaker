<form id="editEstudioForm">

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="paciente" class="form-label">Paciente:</label>
            <?= $estudio['nombres'] ?> <?= $estudio['apellidos']  ?>
        </div>

        <div class="col-md-2">
            <label for="edad" class="form-label">Edad:</label>
            <?= $estudio['edad'] ?> años
        </div>

        <div class="col-md-4">
            <label for="dni" class="form-label">DNI:</label>
            <?= $estudio['documento'] ?>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="fecha_nacimiento" class="form-label">F. Nac:</label>
            <?= $estudio['fecha_nacimiento'] ?>
        </div>

        <div class="col-md-2">
            <label for="sexo" class="form-label">Sexo:</label>
            <?= $estudio['sexo'] ?>
        </div>

        <div class="col-md-4">
            <label for="obra_social" class="form-label">Obra Social:</label>
            <?= $estudio['obra_social'] ?>
        </div>
    </div>
    <p></p>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="n_servicio" class="form-label">Número de Servicio</label>
            <input type="text" class="form-control" id="n_servicio" name="n_servicio" value="<?= $estudio['n_servicio'] ?>" readonly>
        </div>
    </div>
    <p></p>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="prof_sol" class="form-label">Prof. Sol:</label>
            <select id="profesional_salutte_id" name="profesional_salutte_id" class="form-control">
                <option value="">Seleccione un profesional</option>
                <?php if (!empty($estudio['profesionales'])): ?>
                    <?php foreach ($estudio['profesionales'] as $profesional): ?>
                        <option value="<?php echo $profesional['nombres_profesional'] . ' ' . $profesional['apellidos_profesional']; ?>">
                            <?php echo $profesional['nombres_profesional'] . ' ' . $profesional['apellidos_profesional']; ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">No hay profesionales disponibles</option>
                <?php endif; ?>
            </select>
        </div>
        <p></p>
        <div class="col-md-6">
            <label for="servicio" class="form-label">Servicio:</label>
            <select id="servicio" name="servicio" class="form-control">
                <option value="">Seleccione un servicio</option>
                <?php if (!empty($estudio['servicio'])): ?>
                    <?php foreach ($estudio['servicio'] as $servicio): ?>
                        <option value="<?php echo $servicio['nombre']; ?>">
                            <?php echo $servicio['nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">No hay servicios disponibles</option>
                <?php endif; ?>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="tipo_estudio" class="form-label">Tipo de estudio:</label>
            <select id="tipo_estudio" name="tipo_estudio" class="form-control">
                <option value="Biopsia" <?= $estudio['tipo_estudio'] == 'Biopsia' ? 'selected' : '' ?>>Biopsia</option>
                <option value="Citologia" <?= $estudio['tipo_estudio'] == 'Citologia' ? 'selected' : '' ?>>Citologia</option>
            </select>
        </div>
    </div>
    <p></p>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="diagnostico" class="form-label">Diagnóstico:</label>
            <input type="text" class="form-control" id="diagnostico" name="diagnostico" value="<?= $estudio['diagnostico'] ?>">
        </div>
    </div>
    <p></p>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="fecha_carga" class="form-label">Fecha de carga:</label>
            <input type="text" class="form-control" id="fecha_carga" name="fecha_carga" value="<?= $estudio['fecha_carga'] ?>">
        </div>

        <div class="col-md-6">
            <label for="estado" class="form-label">Estado:</label>
            <input type="text" class="form-control" id="estado" name="estado" value="<?= $estudio['estado'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="macro">Macro:</label>
        <textarea id="macro" name="macro" class="form-control"><?= $estudio['macro'] ?? '' ?></textarea>
    </div>

</form>




