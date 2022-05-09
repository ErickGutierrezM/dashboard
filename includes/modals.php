<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quieres salir?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <br><br><span class="text-danger">NOTA: El progreso que no hayas guardado se perderá.</span>
            </div>
            <div class="modal-footer">
                <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-radius btn-danger-light" href="auth/logout.php">Cerrar sesión</a>
            </div>
        </div>
    </div>
</div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- Crear registro campana-->
<script>
$("#presuGastadoAdd, #leadsAdd").keyup(function() {
    cxLeadAdd();
});

function cxLeadAdd() {

    var presuGastadoAdd = $('#presuGastadoAdd').val();
    var leadsAdd = $('#leadsAdd').val();

    var resultadoAdd = presuGastadoAdd / leadsAdd;

    if (resultadoAdd === Infinity || resultadoAdd === "" || isNaN(resultadoAdd)) {
        resultadoAdd = 0;
    }

    $("#costoXLeadAdd").val(resultadoAdd.toFixed(2));
}
</script>
<div class="modal fade" id="registrarAuto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar nueva campaña</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/insertar.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-sm-12 py-2 card-body">

                            <input type="hidden" name="id_campana" value="<?php echo $id_campana; ?>">
                            <input type="hidden" name="nom_empresa" value="<?php echo $nom_empresa; ?>">
                            <input type="hidden" name="mes_empresa" value="<?php echo $mes_actual; ?>">
                            <input type="hidden" name="anio_empresa" value="<?php echo $anio_actual; ?>">

                            <div class="form-group">
                                <label for="">Selecciona la plataforma</label>
                                <select class="form-control" name="plataformaAdd" id="plataformaAdd" required>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Twitter">Twitter</option>
                                    <option value="Google">Google</option>
                                    <option value="LinkedIn">LinkedIn</option>
                                    <option value="TikTok">TikTok</option>
                                    <option value="Youtube">Youtube</option>
                                    <option value="Spotify">Spotify</option>
                                    <option value="Waze">Waze</option>
                                    Linkedin
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el nombre de la campaña</label>
                                <input type="text" name="nomCampanaAdd" id="nomCampanaAdd" class="form-control"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el objetivo de la campaña</label>
                                <input type="text" name="objCampanaAdd" id="objCampanaAdd" class="form-control"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de inicio de campaña</label>
                                <input type="date" name="fechaAdd" id="fechaAdd" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de finalización de campaña</label>
                                <input type="date" name="fechaFinAdd" id="fechaFinAdd" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el budget</label>
                                <input type="text" name="presuInvertidoAdd" id="presuInvertidoAdd"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el presupuesto gastado</label>
                                <input type="text" name="presuGastadoAdd" id="presuGastadoAdd" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los leads</label>
                                <input type="text" name="leadsAdd" id="leadsAdd" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce las llamada</label>
                                <input type="text" name="llamadasAdd" id="llamadasAdd" class="form-control" />
                            </div>
                            <!-- Removido -->
                            <!-- <div class="form-group">
                                <label for="">Contactados</label>
                                <input type="text" name="contactadosAdd" id="contactadosAdd" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="">Agendados</label>
                                <input type="text" name="agendadosAdd" id="agendadosAdd" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="">Cita asistida</label>
                                <input type="text" name="citaAdd" id="citaAdd" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="">Demo</label>
                                <input type="text" name="demoAdd" id="demoAdd" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="">Online</label>
                                <input type="text" name="onlineAdd" id="onlineAdd" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="">Venta</label>
                                <input type="text" name="ventaAdd" id="ventaAdd" class="form-control"/>
                            </div> -->
                            <div class="form-group">
                                <label for="">Introduce el costo por lead</label>
                                <input type="text" name="costoXLeadAdd" id="costoXLeadAdd" class="form-control" value=""
                                    readonly />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce las clics</label>
                                <input type="text" name="conversionAdd" id="conversionAdd" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce las interacciones</label>
                                <input type="text" name="interaccionesAdd" id="interaccionesAdd" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el alcance</label>
                                <input type="text" name="alcanceAdd" id="alcanceAdd" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="insertdata" class="btn btn-radius btn-success-light">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Editar registro campana -->
<script>
$("#presuGastadoEdit, #leadsEdit").keyup(function() {
    cxLeadEdit();
});

function cxLeadEdit() {

    var presuGastadoEdit = $('#presuGastadoEdit').val();
    var leadsEdit = $('#leadsEdit').val();

    var resultadoEdit = presuGastadoEdit / leadsEdit;

    if (resultadoEdit === Infinity || resultadoEdit === "" || isNaN(resultadoEdit)) {
        resultadoEdit = 0;
    }

    $("#costoXLeadEdit").val(resultadoEdit.toFixed(2));
}
</script>
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edita el registro seleccionado</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/editar.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-sm-12 py-2 card-body">
                            <input type="hidden" name="update_id" id="update_id">
                            <input type="hidden" name="id_campana" value="<?php echo $id_campana; ?>">
                            <input type="hidden" name="nom_empresa" value="<?php echo $nom_empresa; ?>">
                            <input type="hidden" name="mes_empresa" value="<?php echo $mes_actual; ?>">
                            <input type="hidden" name="anio_empresa" value="<?php echo $anio_actual; ?>">

                            <?php if ($rowUser['id_tipo'] == "1"): ?>

                            <div class="form-group">
                                <label for="">Selecciona la plataforma</label>
                                <select class="form-control" name="plataformaEdit" id="plataformaEdit" required>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Twitter">Twitter</option>
                                    <option value="Google">Google</option>
                                    <option value="LinkedIn">LinkedIn</option>
                                    <option value="TikTok">TikTok</option>
                                    <option value="Youtube">Youtube</option>
                                    <option value="Spotify">Spotify</option>
                                    <option value="Waze">Waze</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el nombre de la campaña</label>
                                <input type="text" name="nomCampanaEdit" id="nomCampanaEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el objetivo de la campaña</label>
                                <input type="text" name="objCampanaEdit" id="objCampanaEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de inicio de campaña</label>
                                <input type="date" name="fechaInicioEdit" id="fechaInicioEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de finalización de campaña</label>
                                <input type="date" name="fechaFinEdit" id="fechaFinEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el budget</label>
                                <input type="text" name="presuInvertidoEdit" id="presuInvertidoEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el presupuesto gastado</label>
                                <input type="text" name="presuGastadoEdit" id="presuGastadoEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los leads</label>
                                <input type="text" name="leadsEdit" id="leadsEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce las llamadas</label>
                                <input type="text" name="llamadasEdit" id="llamadasEdit" class="form-control" />
                            </div>
                            <!-- Removido -->
                            <!-- <div class="form-group">
                                <label for="">Contactados</label>
                                <input type="text" name="contactadosEdit" id="contactadosEdit" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="">Agendados</label>
                                <input type="text" name="agendadosEdit" id="agendadosEdit" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="">Cita asistida</label>
                                <input type="text" name="citaEdit" id="citaEdit" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="">Demo</label>
                                <input type="text" name="demoEdit" id="demoEdit" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="">Online</label>
                                <input type="text" name="onlineEdit" id="onlineEdit" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="">Venta</label>
                                <input type="text" name="ventaEdit" id="ventaEdit" class="form-control"/>
                            </div> -->
                            <div class="form-group">
                                <label for="">Introduce el costo por lead</label>
                                <input type="text" name="costoXLeadEdit" id="costoXLeadEdit" class="form-control"
                                    value="" readonly />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce las clics</label>
                                <input type="text" name="conversionesEdit" id="conversionesEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce las interacciones</label>
                                <input type="text" name="interaccionesEdit" id="interaccionesEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el alcance</label>
                                <input type="text" name="alcanceEdit" id="alcanceEdit" class="form-control" />
                            </div>
                            <!-- <div class="form-group">
                                <label for="timeline">Selecciona la foto del timeline</label>
                                <input id="timeline" type="file" name="timeline" class="form-control" value="<?php //echo $row['timeline']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="segmentaciones">Selecciona la foto de la segmentación</label>
                                <input id="segmentaciones" type="file" name="segmentaciones" class="form-control" value="<?php //echo $row['interrupciones']; ?>"/>
                            </div> -->
                            <hr style="border-top: 1px solid rgb(171 177 184 / 50%);">
                            <div class="form-group">
                                <label for="galleryOne">Selecciona la primera foto de la galeria </label>
                                <input id="galleryOne" type="file" name="galleryOne" class="form-control"
                                    value="<?php echo $row['img_evidencia_1']; ?>" />
                                <!-- <img class ="" src="../uploads/gallery_dash/thumbs_dash/<?php //echo $row['img_evidencia_1']; ?> "> -->
                            </div>
                            <div class="form-group">
                                <label for="file">Selecciona la segunda foto de la galeria </label>
                                <input id="galleryTwo" type="file" name="galleryTwo" class="form-control"
                                    value="<?php echo $row['img_evidencia_2']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="file">Selecciona la tercera foto de la galeria </label>
                                <input id="galleryThree" type="file" name="galleryThree" class="form-control"
                                    value="<?php echo $row['img_evidencia_3']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="file">Selecciona la cuarta foto de la galeria </label>
                                <input id="galleryFour" type="file" name="galleryFour" class="form-control"
                                    value="<?php echo $row['img_evidencia_4']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="file">Selecciona la quinta foto de la galeria </label>
                                <input id="galleryFive" type="file" name="galleryFive" class="form-control"
                                    value="<?php echo $row['img_evidencia_5']; ?>" />
                            </div>
                            <?php else: ?>
                            <div class="form-group" style="display: none;">
                                <label for="">Selecciona la plataforma</label>
                                <select type="hidden" class="form-control" name="plataformaEdit" id="plataformaEdit"
                                    required>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Twitter">Twitter</option>
                                    <option value="Google">Google</option>
                                    <option value="LinkedIn">LinkedIn</option>
                                    <option value="TikTok">TikTok</option>
                                    <option value="Youtube">Youtube</option>
                                    <option value="Spotify">Spotify</option>
                                    <option value="Waze">Waze</option>
                                </select>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="">Introduce el nombre de la campaña</label>
                                <input type="hidden" name="nomCampanaEdit" id="nomCampanaEdit" class="form-control" />
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="">Introduce el objetivo de la campaña</label>
                                <input type="hidden" name="objCampanaEdit" id="objCampanaEdit" class="form-control" />
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="">Fecha de inicio de campaña</label>
                                <input type="date" name="fechaInicioEdit" id="fechaInicioEdit" class="form-control" />
                            </div>
                            <div type="hidden" class="form-group" style="display: none;">
                                <label for="">Fecha de finalización de campaña</label>
                                <input type="date" name="fechaFinEdit" id="fechaFinEdit" class="form-control" />
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="">Introduce el budget</label>
                                <input type="hidden" name="presuInvertidoEdit" id="presuInvertidoEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="">Introduce el presupuesto gastado</label>
                                <input type="hidden" name="presuGastadoEdit" id="presuGastadoEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="">Introduce los leads</label>
                                <input type="text" name="leadsEdit" id="leadsEdit" class="form-control" />
                            </div>
                            <!-- Removido -->
                            <!-- <div class="form-group">
                            <label for="">Contactados</label>
                            <input type="text" name="contactadosEdit" id="contactadosEdit" class="form-control"/>
                            </div>
                            <div class="form-group">
                            <label for="">Agendados</label>
                            <input type="text" name="agendadosEdit" id="agendadosEdit" class="form-control"/>
                            </div>
                            <div class="form-group">
                            <label for="">Cita asistida</label>
                            <input type="text" name="citaEdit" id="citaEdit" class="form-control"/>
                            </div>
                            <div class="form-group">
                            <label for="">Demo</label>
                            <input type="text" name="demoEdit" id="demoEdit" class="form-control"/>
                            </div>
                            <div class="form-group">
                            <label for="">Online</label>
                            <input type="text" name="onlineEdit" id="onlineEdit" class="form-control"/>
                            </div>
                            <div class="form-group">
                            <label for="">Venta</label>
                            <input type="text" name="ventaEdit" id="ventaEdit" class="form-control"/>
                            </div> -->
                            <div class="form-group" style="display: none;">
                                <label for="">Introduce el costo por lead</label>
                                <input type="text" name="costoXLeadEdit" id="costoXLeadEdit" class="form-control"
                                    value="" readonly />
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="">Introduce las conversiones</label>
                                <input type="hidden" name="conversionesEdit" id="conversionesEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="">Introduce las interacciones</label>
                                <input type="hidden" name="interaccionesEdit" id="interaccionesEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="">Introduce el alcance</label>
                                <input type="hidden" name="alcanceEdit" id="alcanceEdit" class="form-control" />
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="updatedata" class="btn btn-radius btn-success-light">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Borrar registro campana -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quieres borrar este registro?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/eliminar.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="delete_id">
                    <input type="hidden" name="id_campana" value="<?php echo $id_campana; ?>">
                    <input type="hidden" name="nom_empresa" value="<?php echo $nom_empresa; ?>">
                    <input type="hidden" name="mes_empresa" value="<?php echo $mes_actual; ?>">
                    <input type="hidden" name="anio_empresa" value="<?php echo $anio_actual; ?>">

                    <br><br><span class="text-danger">NOTA: Una vez borrado no es posible recuperlo.</span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="deletedata" class="btn btn-radius btn-danger-light">Borrar</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- Crear campaña Modal-->
<div class="modal fade" id="crearCampanaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear campaña</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/crearnuevacampana.php" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-sm-12 py-2 card-body">
                            <div class="form-group">
                                <label for="id_company">Selecciona la empresa</label>
                                <select class="form-control selectpicker" id="id_company" name="id_company"
                                    data-live-search="true" required>
                                    <option value="" disabled selected>...</option>
                                    <?php
										$consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE company NOT LIKE 'Galleta Marketing Digital%'");
										while ($miempresa = mysqli_fetch_array($consulta)) {
									?>
                                    <option value="<?php echo $miempresa['id'].','.$miempresa['company'] ?>">
                                        <?php echo $miempresa['company']; ?></option>
                                    <?php
										}
									?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="presu_general">Presupuesto general</label>
                                <input type="text" name="presu_general" id="presu_general" class="form-control"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="mes">Selecciona el mes</label>
                                <select class="form-control selectpicker" name="mes" id="mes" required>
                                    <option value="" disabled selected>...</option>
                                    <option value="Enero">Enero</option>
                                    <option value="Febrero">Febrero</option>
                                    <option value="Marzo">Marzo</option>
                                    <option value="Abril">Abril</option>
                                    <option value="Mayo">Mayo</option>
                                    <option value="Junio">Junio</option>
                                    <option value="Julio">Julio</option>
                                    <option value="Agosto">Agosto</option>
                                    <option value="Septiembre">Septiembre</option>
                                    <option value="Octubre">Octubre</option>
                                    <option value="Noviembre">Noviembre</option>
                                    <option value="Diciembre">Diciembre</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-radius btn-primary-light">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- Crear registro whatsapp-->
<div class="modal fade" id="registrarTel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar whatsapp</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/insertar-whatsapp.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-sm-12 py-2 card-body">

                            <input type="hidden" name="id_campana" value="<?php echo $id_campana; ?>">
                            <input type="hidden" name="nom_empresa" value="<?php echo $nom_empresa; ?>">
                            <input type="hidden" name="mes_empresa" value="<?php echo $mes_actual; ?>">
                            <input type="hidden" name="anio_empresa" value="<?php echo $anio_actual; ?>">

                            <div class="form-group">
                                <label for="">Nombre: </label>
                                <input type="text" name="nomWhatsappAdd" id="nomWhatsappAdd" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">WhatsApp: </label>
                                <input type="text" name="telWhatsappAdd" id="telWhatsappAdd" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Correo: </label>
                                <input type="email" name="correoWhatsappAdd" id="correoWhatsappAdd"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Interés: </label>
                                <input type="text" name="interesWhatsappAdd" id="interesWhatsappAdd"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Fuente: </label>
                                <select class="form-control" name="fuenteWhatsappAdd" id="fuenteWhatsappAdd">
                                <option disabled selected></option>
                                    <option>WhatsApp</option>
                                    <option>Inbox</option>
                                    <option>Formulario leads</option>
                                    <option>Re-Marketing</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Comentarios: </label>
                                <input type="text" name="comentariosWhatsappAdd" id="comentariosWhatsappAdd"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Asesor: </label>
                                <input type="text" name="asesorWhatsappAdd" id="asesorWhatsappAdd"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Fecha: </label>
                                <input type="date" name="fechaAdd" id="fechaAdd" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="insertdata_w"
                        class="btn btn-radius btn-success-light">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Borrar registro whatsapp -->
<div class="modal fade" id="deletemodal-whatsapp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quieres borrar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/eliminar-whatsapp.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="delete_id_whatsapp" id="delete_id_whatsapp">
                    <input type="hidden" name="nom_empresa_whatsapp" value="<?php echo $nom_empresa; ?>">
                    <input type="hidden" name="mes_empresa_whatsapp" value="<?php echo $mes_actual; ?>">
                    <input type="hidden" name="anio_empresa_whatsapp" value="<?php echo $anio_actual; ?>">

                    <br><br><span class="text-danger">NOTA: Una vez borrado no es posible recuperlo.</span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="deletedata_whatsapp"
                        class="btn btn-radius btn-danger-light">Borrar</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
<!-- Editar registro campana -->
<div class="modal fade" id="editmodal-whatsapp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar el registro seleccionado</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/editar-whatsapp.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-sm-12 py-2 card-body">
                            <input type="hidden" name="update_id_whatsapp" id="update_id_whatsapp">
                            <input type="hidden" name="id_campana_whatsapp" value="<?php echo $id_campana; ?>">
                            <input type="hidden" name="nom_empresa_whatsapp" value="<?php echo $nom_empresa; ?>">
                            <input type="hidden" name="mes_empresa_whatsapp" value="<?php echo $mes_actual; ?>">
                            <input type="hidden" name="anio_empresa_whatsapp" value="<?php echo $anio_actual; ?>">

                            <div class="form-group">
                                <label for="">Nombre: </label>
                                <input type="text" name="nomWhatsappEdit" id="nomWhatsappEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">WhatsApp: </label>
                                <input type="text" name="telWhatsappEdit" id="telWhatsappEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Correo: </label>
                                <input type="email" name="correoWhatsappEdit" id="correoWhatsappEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Interés: </label>
                                <input type="text" name="interesWhatsappEdit" id="interesWhatsappEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Fuente: </label>
                                <select class="form-control" name="fuenteWhatsappEdit" id="fuenteWhatsappEdit">
                                <option disabled selected></option>
                                    <option>WhatsApp</option>
                                    <option>Inbox</option>
                                    <option>Formulario leads</option>
                                    <option>Re-Marketing</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Comentarios: </label>
                                <input type="text" name="comentariosWhatsappEdit" id="comentariosWhatsappEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Asesor: </label>
                                <input type="text" name="asesorWhatsappEdit" id="asesorWhatsappEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Fecha: </label>
                                <input type="date" name="fechaEdit" id="fechaEdit" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="updatedata_whatsapp"
                        class="btn btn-radius btn-success-light">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!--POPUP Clientes-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="popClientes"
    style="margin-top: 8rem !important;">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            style="position:relative; cursor:pointer;"><span aria-hidden="true">&times;</span></button>
        <div class="modal-content">
            <img src="assets/images/popups/popup_galleta_junio.jpg" id="galletapop">
        </div>
    </div>
</div>
<!--POPUP Clientes-->

<!--POPUP Mantenimiento-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="popMantenimiento"
    style="margin-top: 8rem !important;">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            style="position:relative; cursor:pointer;"><span aria-hidden="true">&times;</span></button>
        <div class="modal-content">
            <img src="assets/images/popups/pop-up-mantenimiento.jpg" id="galletapop">
        </div>
    </div>
</div>
<!--POPUP Mantenimiento-->

<!-- Editar campaña Modal-->
<!-- <div class="modal fade" id="editarCampanaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">¿Qué campaña quieres editar?</h5>
		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">×</span>
		</button>
	  </div>
	  <form class="" action="editarcampana.php" method="post">
		<div class="modal-body">
		  <div class="row">
			<div class="col col-sm-12 py-2 card-body" style="padding: 0.5rem !important;">
			  <div class="form-group">
				<select class="form-control" id="exampleFormControlSelect1" name="id_campana">
				  <option disabled selected>Selecciona la campaña a editar</option>
				  <?php
				  //$consulta = mysqli_query($conexion, "SELECT * FROM campanas WHERE id_admin LIKE '%".$rowUser['id']."%'");
				  //while ($micampana = mysqli_fetch_array($consulta)) {
				  ?>
				  <option value="<?php //echo $micampana['id_campana']; ?>"><?php //echo $micampana['nom_empresa']; ?></option>
				  <?php
				  //}
				  ?>
				</select>
			  </div>
			</div>
		  </div>
		</div>
		<div class="modal-footer">
		  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
		  <button type="submit" class="btn btn-primary">Editar</button>
		</div>
	  </form>
	</div>
  </div>
</div> -->

<script type="text/javascript">
jQuery(document).ready(function($) {
    if (window.jQuery().datetimepicker) {
        $('#fechaAdd').datetimepicker({
            // Formats
            // follow MomentJS docs: https://momentjs.com/docs/#/displaying/format/
            format: 'DD-MM-YYYY hh:mm A',

            // Your Icons
            // as Bootstrap 4 is not using Glyphicons anymore
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });
    }
});
</script>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<!-- Borrar registro cliente -->
<div class="modal fade" id="deletemodalcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quieres borrar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/eliminar-cliente.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="delete_id_cliente" id="delete_id_cliente">
                    <br><br><span class="text-danger">NOTA: Una vez borrado no es posible recuperlo.</span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="deletedata_cliente"
                        class="btn btn-radius btn-danger-light">Borrar</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
<!-- Editar registro campana -->
<div class="modal fade" id="editmodalcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar el registro seleccionado</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/editar-cliente.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-sm-12 py-2 card-body">
                            <input type="hidden" name="update_id_cliente" id="update_id_cliente">
                            <div class="form-group">
                                <label for="mesClienteEdit">Seleccionar el nuevo mes</label>
                                <select class="form-control selectpicker" name="mesClienteEdit" id="mesClienteEdit"
                                    required>
                                    <option value="" disabled selected>...</option>
                                    <option value="Enero">Enero</option>
                                    <option value="Febrero">Febrero</option>
                                    <option value="Marzo">Marzo</option>
                                    <option value="Abril">Abril</option>
                                    <option value="Mayo">Mayo</option>
                                    <option value="Junio">Junio</option>
                                    <option value="Julio">Julio</option>
                                    <option value="Agosto">Agosto</option>
                                    <option value="Septiembre">Septiembre</option>
                                    <option value="Octubre">Octubre</option>
                                    <option value="Noviembre">Noviembre</option>
                                    <option value="Diciembre">Diciembre</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="anioClienteEdit">Selecciona el nuevo año</label>
                                <select class="form-control" id="anioClienteEdit" name="anioClienteEdit" required>
                                    <option value="" selected disabled value>...</option>
                                    <?php
                                        $consultaAnio = mysqli_query($conexion, "SELECT DISTINCT YEAR(fecha_inicio) FROM campana_redes ORDER BY fecha_inicio DESC");
                                        
                                        while ($anios = mysqli_fetch_array($consultaAnio)) {
                                    ?>
                                    <option value="<?php echo $anios['YEAR(fecha_inicio)']; ?>">
                                        <?php echo $anios['YEAR(fecha_inicio)']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Nuevo presupuesto</label>
                                <input type="text" name="presuClienteEdit" id="presuClienteEdit" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="updatedata_cliente"
                        class="btn btn-radius btn-success-light">Guardar</button>
                </div>
            </form>
            <div class="modal-body">
                <button class="btn btn-radius btn-primary-light" type="button" data-toggle="collapse"
                    data-target="#CambiaPass" aria-expanded="false" aria-controls="collapseExample">Cambiar contraseña
                    del cliente</button>
                <div id="CambiaPass" class="collapse">
                    <form role="form" class="" action="../auth/editarpasswordcliente.php" method="post">
                        <?php echo '<input type="hidden" name="pass_id_cliente" id="pass_id_cliente">'; ?>
                        <div class="form-group">
                            <label class="" style="padding-top:15px;">Contraseña nueva</label>
                            <input class="form-control" type="password" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <label class="">Confirma tu contraseña</label>
                            <input class="form-control" type="password" name="r_password" id="r_password" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-radius btn-primary-light" value="Guardar contraseña">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!--REGISTRO DE ASESOR-->
<div class="modal fade" id="crearAsesorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar asesor</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/crearAsesor.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-sm-12 py-2 card-body">
                            <input type="hidden" name="nombre_empresa" value="<?php echo $rowUser['company']; ?>">
                            <input type="hidden" name="datos_empresa"
                                value="<?php echo $rowUser['id'].','.$rowUser['company'] ?>" readonly>
                            <div class="form-group">
                                <label for="">Nombre: </label>
                                <input type="text" name="nomAsesor" id="nomAsesor" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Apellido: </label>
                                <input type="text" name="apellidoAsesor" id="apellidoAsesor" class="form-control" />
                            </div>
                            <div class="form-group" data-validate="Valid email is required: ex@abc.xyz">
                                <label for="">Correo electrónico : </label>
                                <input type="email" name="emailAsesor" id="emailAsesor" class="form-control" />
                            </div>
                            <div class="form-group" data-validate="Password is required">
                                <label for="">Contraseña : </label>
                                <input class="form-control" type="password" name="password" id="password">
                            </div>
                            <div class="form-group" data-validate="Password is required">
                                <label for="">Repite la Contraseña : </label>
                                <input class="form-control" type="password" name="r_password" id="r_password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="crearAsesor" class="btn btn-radius btn-success-light">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<!-- Crear registro comunidad-->
<div class="modal fade" id="registrarNuevaComunidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar nueva comunidad</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/insertar-comunidad.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-sm-12 py-2 card-body">

                            <input type="hidden" name="id_campana" value="<?php echo $id_campana; ?>">
                            <input type="hidden" name="nom_empresa" value="<?php echo $nom_empresa; ?>">
                            <input type="hidden" name="mes_empresa" value="<?php echo $mes_actual; ?>">
                            <input type="hidden" name="anio_empresa" value="<?php echo $anio_actual; ?>">

                            <div class="form-group">
                                <label for="">Introduce los seguidores de Facebook</label>
                                <input type="text" name="facebookAdd" id="facebookAdd" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los seguidores de Instagram</label>
                                <input type="text" name="instagramAdd" id="instagramAdd" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los seguidores de Twitter</label>
                                <input type="text" name="twitterAdd" id="twitterAdd" class="form-control" />
                            </div>
                            <!-- <div class="form-group">
                                <label for="">Introduce los seguidores de Google</label>
                                <input type="text" name="googleAdd" id="objCampanaAdd" class="form-control"/>
                            </div>-->
                            <div class="form-group">
                                <label for="">Introduce los seguidores de Youtube</label>
                                <input type="text" name="youtubeAdd" id="youtubeAdd" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los seguidores de Linkedin</label>
                                <input type="text" name="linkedAdd" id="linkedAdd" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los seguidores de Spotify</label>
                                <input type="text" name="spotifyAdd" id="spotifyAdd" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los seguidores de Tik Tok</label>
                                <input type="text" name="tiktokAdd" id="tiktokAdd" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="insertComunidad"
                        class="btn btn-radius btn-success-light">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Editar registro comunidad -->
<div class="modal fade" id="editarComunidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edita el registro seleccionado</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/editar-comunidad.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-sm-12 py-2 card-body">

                            <input type="hidden" name="id_campana_comunidad" id="id_campana_comunidad">
                            <input type="hidden" name="nom_empresa_comunidad" value="<?php echo $nom_empresa; ?>">
                            <input type="hidden" name="anio_empresa" value="<?php echo $anio_actual; ?>">


                            <div class="form-group">
                                <label for="">Introduce los seguidores de Facebook</label>
                                <input type="text" name="facebookEdit" id="facebookEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los seguidores de Instagram</label>
                                <input type="text" name="instagramEdit" id="instagramEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los seguidores de Twitter</label>
                                <input type="text" name="twitterEdit" id="twitterEdit" class="form-control" />
                            </div>
                            <!--<div class="form-group">
                                <label for="">Introduce los seguidores de Google</label>
                                <input type="text" name="googleEdit" id="googleEdit" class="form-control" />
                            </div>-->
                            <div class="form-group">
                                <label for="">Introduce los seguidores de Youtube</label>
                                <input type="text" name="youtubeEdit" id="youtubeEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los seguidores de Linkedin</label>
                                <input type="text" name="linkEdit" id="linkEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los seguidores de Spotify</label>
                                <input type="text" name="spotifyEdit" id="spotifyEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los seguidores de TikTok</label>
                                <input type="text" name="tiktokEdit" id="tiktokEdit" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="updateComunidad"
                        class="btn btn-radius btn-success-light">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="registrarGasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar el presupuesto gastado por día</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/insertar-gastos.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-sm-12 py-2 card-body">

                            <input type="hidden" name="id_campana" value="<?php echo $id_campana; ?>">
                            <input type="hidden" name="nom_empresa" value="<?php echo $nom_empresa; ?>">
                            <input type="hidden" name="mes_empresa" value="<?php echo $mes_actual; ?>">
                            <input type="hidden" name="anio_empresa" value="<?php echo $anio_actual; ?>">

                            <div class="form-group">
                                <label for="">Introduce la fecha</label>
                                <input type="date" name="fechaGasto" id="fechaGasto" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el monto gastado de Facebook</label>
                                <input type="text" name="presuGastoFace" id="presuGastoFace" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el monto gastado de Instagram</label>
                                <input type="text" name="presuGastoInsta" id="presuGastoInsta" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el monto gastado de Google</label>
                                <input type="text" name="presuGastoGoog" id="presuGastoGoog" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el monto gastado de LinkedIn</label>
                                <input type="text" name="presuGastoLink" id="presuGastoLink" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el monto gastado de Waze</label>
                                <input type="text" name="presuGastoWaze" id="presuGastoWaze" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el monto gastado de TikTok</label>
                                <input type="text" name="presuGastoTik" id="presuGastoTik" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el monto gastado de Spotify</label>
                                <input type="text" name="presuGastoSpoti" id="presuGastoSpoti" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los leads de Facebook</label>
                                <input type="text" name="leadsGastoFace" id="leadsGastoFace" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los leads de Instagram</label>
                                <input type="text" name="leadsGastoInsta" id="leadsGastoInsta" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los leads de Google</label>
                                <input type="text" name="leadsGastoGoog" id="leadsGastoGoog" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los leads de LinkedIn</label>
                                <input type="text" name="leadsGastoLink" id="leadsGastoLink" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce las navegaciones de Waze</label>
                                <input type="text" name="leadsGastoWaze" id="leadsGastoWaze" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los leads de TikTok</label>
                                <input type="text" name="leadsGastoTik" id="leadsGastoTik" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce los leads de Spotify</label>
                                <input type="text" name="leadsGastoSpoti" id="leadsGastoSpoti" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="insertGasto" class="btn btn-radius btn-success-light">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Borrar registro whatsapp -->
<div class="modal fade" id="deletemodal-gasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quieres borrar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/eliminar-gasto.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="delete_id_gasto" id="delete_id_gasto">
                    <input type="hidden" name="nom_empresa_gasto" value="<?php echo $nom_empresa; ?>">
                    <input type="hidden" name="mes_empresa_gasto" value="<?php echo $mes_actual; ?>">
                    <input type="hidden" name="anio_empresa_gasto" value="<?php echo $anio_actual; ?>">

                    <br><br><span class="text-danger">NOTA: Una vez borrado no es posible recuperlo.</span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="deletedata_gasto"
                        class="btn btn-radius btn-danger-light">Borrar</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
<!-- Editar registro campana -->
<div class="modal fade" id="editmodal-gasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar presupuesto gastado por dÍa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="server/editar-gasto.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-sm-12 py-2 card-body">
                            <input type="hidden" name="update_id_gasto_edit" id="update_id_gasto_edit">
                            <input type="hidden" name="id_gasto_edit" value="<?php echo $id_campana; ?>">
                            <input type="hidden" name="nom_empre_gasto_edit" value="<?php echo $nom_empresa; ?>">
                            <input type="hidden" name="mes_gasto_edit" value="<?php echo $mes_actual; ?>">
                            <input type="hidden" name="anio_gasto_edit" value="<?php echo $anio_actual; ?>">

                            <div class="form-group">
                                <label for="">Introduce la nueva fecha</label>
                                <input type="date" name="fechaGastoEdit" id="fechaGastoEdit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el nuevo monto gastado de Facebook</label>
                                <input type="text" name="presuGastoFaceEdit" id="presuGastoFaceEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el nuevo monto gastado de Instagram</label>
                                <input type="text" name="presuGastoInstaEdit" id="presuGastoInstaEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el nuevo monto gastado de Google</label>
                                <input type="text" name="presuGastoGoogEdit" id="presuGastoGoogEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el nuevo monto gastado de LinkedIn</label>
                                <input type="text" name="presuGastoLinkEdit" id="presuGastoLinkEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el nuevo monto gastado de Waze</label>
                                <input type="text" name="presuGastoWazeEdit" id="presuGastoWazeEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el nuevo monto gastado de TikTok</label>
                                <input type="text" name="presuGastoTikEdit" id="presuGastoTikEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce el nuevo monto gastado de Spotify</label>
                                <input type="text" name="presuGastoSpotiEdit" id="presuGastoSpotiEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce la nueva cantidad de leads para Facebook</label>
                                <input type="text" name="leadsGastoFaceEdit" id="leadsGastoFaceEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce la nueva cantidad de leads para Instagram</label>
                                <input type="text" name="leadsGastoInstaEdit" id="leadsGastoInstaEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce la nueva cantidad de leads para Google</label>
                                <input type="text" name="leadsGastoGoogEdit" id="leadsGastoGoogEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce la nueva cantidad de leads para LinkedIn</label>
                                <input type="text" name="leadsGastoLinkEdit" id="leadsGastoLinkEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce la nueva cantidad de navegaciones para Waze</label>
                                <input type="text" name="leadsGastoWazeEdit" id="leadsGastoWazeEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce la nueva cantidad de leads para TikTok</label>
                                <input type="text" name="leadsGastoTikEdit" id="leadsGastoTikEdit"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Introduce la nueva cantidad de leads para Spotify</label>
                                <input type="text" name="leadsGastoSpotiEdit" id="leadsGastoSpotiEdit"
                                    class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="updatedata_gasto_edit"
                        class="btn btn-radius btn-success-light">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>