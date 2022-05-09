<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<div class="modal fade" id="registrarClienteModal" tabindex="-1" role="dialog" aria-labelledby="registrarClienteModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo cliente</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" class="" id="formRegistoClientes">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-sm-12 py-2 card-body">

                            <div class="form-group icon-addon">
                                <label for="nombre">Nombre</label>
                                <input class="form-control" type="text" name="nombreCliente" id="nombreCliente" placeholder="">
                                <i class="fas fa-user"></i>
                                <span id="nombreCliente_error" class="text-danger font-12px"></span>
                            </div>

                            <div class="form-group icon-addon">
                                <label for="apellido">Apellidos</label>
                                <input class="form-control" type="text" name="apellidoCliente" id="apellidoCliente" placeholder="">
                                <i class="fas fa-user"></i>
                                <span id="apellidoCliente_error" class="text-danger font-12px"></span>
                            </div>

                            <div class="form-group icon-addon">
                                <label for="email">Correo Electrónico</label>
                                <input class="form-control" type="email" name="emailCliente" id="emailCliente" placeholder="">
                                <i class="fas fa-envelope"></i>
                                <span id="emailCliente_error" class="text-danger font-12px"></span>
                            </div>

                            <div class="form-group icon-addon">
                                <label for="nombre_empresa">Nombre de la empresa</label>
                                <input class="form-control" type="text" name="empresaCliente" id="empresaCliente" placeholder="">
                                <i class="fas fa-briefcase"></i>
                                <span id="empresaCliente_error" class="text-danger font-12px"></span>
                            </div>

                            <div class="form-group icon-addon">
                                <label for="password">Contraseña</label>
                                <input class="form-control" type="password" name="passwordCliente" id="passwordCliente" placeholder="">
                                <i class="fas fa-lock"></i>
                                <span id="passwordCliente_error" class="text-danger font-12px"></span>
                            </div>

                            <div class="form-group icon-addon">
                                <label for="r_password">Repite tu Contraseña</label>
                                <input class="form-control" type="password" name="rPasswordCliente" id="rPasswordCliente" placeholder="">
                                <i class="fas fa-lock"></i>
                                <span id="rPasswordCliente_error" class="text-danger font-12px"></span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-radius btn-info-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="sendCliente" id="sendCliente" class="btn btn-radius btn-primary-light">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
