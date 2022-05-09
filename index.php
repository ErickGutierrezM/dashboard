<?php 
	session_start();
	require 'secretInfo/conexion_BD.php';
	require 'secretInfo/funciones.php';

	if(!isset($_SESSION["id_usuario"]))
	{
		header("Location: auth/login.php");
	}

	$idUsuario = $_SESSION['id_usuario'];

	$sql = "SELECT id, user, last_name, email, company, password, id_tipo FROM usuarios WHERE id = '$idUsuario'";
	$result = $conexion->query($sql);

	$rowUser = $result->fetch_assoc();

	$conn = new PDO("mysql:host=db5000886678.hosting-data.io; dbname=dbs778238", "dbu591620", "Ga113Ta#772020");

	//la de prueba
	//$conn = new PDO("mysql:host=db5000973429.hosting-data.io; dbname=dbs846583", "dbu620410", "Galleta2020%");

	$sql = "SELECT * FROM campanas WHERE admin_usuario LIKE '%;".$rowUser['id'].";%' ORDER BY id_campana DESC";
	//$sql = "select title, description, transmission, image, mileage, price, updated_at, agencia from products inner join branches where branch_id = branch_id";
	$sentencia = $conn->prepare($sql);
	$sentencia->execute();

	$resultado = $sentencia->fetchAll();
	//var_dump ($resultado);
	$autos_x_pagina = 10;

	//contar articulos de bd
	$total = $sentencia->rowCount();
	//echo $total;
	$paginas = $total/10;
	$paginas = ceil($paginas);

//echo $paginas;

?>

<?php include "includes/head.php"  ?>

<body class="app sidebar-mini">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">
            <?php include "includes/header.php" ?>

            <?php include "includes/sidebar.php" ?>

            <!--app-content open-->
            <div class="app-content">
                <div class="side-app">

                    <!-- PAGE-HEADER -->
                    <div class="page-header">
                        <div>
                            <h1 class="page-title">Campañas de Marketing</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                            </ol>
                        </div>
                    </div>
                    <!-- PAGE-HEADER END -->

                    <?php if (isset($_GET['passVacia'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                        <strong>¡Vaya!</strong> No se pudo guardar, por que dejaste los campos vacios.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                        <strong>¡Vaya!</strong> Hubo un error desconocido, intenta de nuevo.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['errorNoCoinciden'])): ?>
                    <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
                        <strong>Upss!</strong> Las contraseñas no coinciden, intenta de nuevo.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['cambiosOk'])): ?>
                    <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                        <strong>¡Genial!</strong> Se actualizo la contraseña correctamente.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="text-center table table-hover table-bordered border-top-0 border-bottom-0">
                            <thead class="thead-dark">
                                <tr>
                                    <!-- <th scope='col' style='width: 5%;'>Id</th> -->
                                    <th scope="col" style="width: 40%;">Acciones</th>
                                    <th scope="col" style="width: 30%;">Cliente</th>
                                    <!-- <th scope='col' style='width: 30%;'>Presupuesto</th> -->
                                    <th scope="col" style="width: 30%;">Mes y Año</th>
                                </tr>
                            </thead>

                            <?php
								
								$iniciar = ($_GET['pagina']-1)*$autos_x_pagina;
								//'%".$rowUser['id']."; %'
								// $campanas = mysqli_query($conexion, "SELECT * FROM campanas WHERE admin_usuario LIKE '%;".$rowUser['id'].";%' ORDER BY id_campana ASC LIMIT $iniciar, $autos_x_pagina ");

								$campanas = mysqli_query($conexion, "SELECT * FROM campanas WHERE admin_usuario LIKE '%;".$rowUser['id'].";%' ORDER BY ultima_actualizacion_camp DESC LIMIT $iniciar, $autos_x_pagina ");
								
								if (mysqli_num_rows($campanas) != 0) {
									foreach ($campanas as $rowCampa) {
							?>

                            <tr>
                                <td style="display:none;"><?php echo $rowCampa['id_campana']; ?></td>
                                <td>
                                    <?php if ($rowUser['id_tipo'] == "1"): ?>
                                    <button class='deletebtncliente btn btn-pill btn-danger-light' href='#'><i
                                            class="fas fa-trash-alt"></i> Eliminar</button>
                                    <button class='editbtncliente  btn btn-pill btn-success-light' href='#'><i
                                            class="fas fa-edit"></i> Editar</button>
                                    <?php else: ?>

                                    <?php endif; ?>
                                    <button class='btn btn-pill btn-info-light'
                                        onclick="window.location='cliente.php?id=<?php echo $rowCampa['id_campana']; ?>&company=<?php echo $rowCampa['nom_empresa']; ?>&month=<?php echo $rowCampa['mes']; ?>&year=<?php echo $rowCampa['anio']; ?>';"
                                        style="cursor:pointer"><i class="fas fa-folder-open"></i> Administrar</button>
                                </td>
                                <td><?php echo $rowCampa['nom_empresa']; ?></td>
                                <td style="display:none;"><?php echo $rowCampa['presu_general']; ?></td>
                                <td><?php echo $rowCampa['mes'].' '.$rowCampa['anio'];  ?></td>
                                <td style="display:none;"><?php echo $rowCampa['id_cliente']; ?></td>
                            </tr>


                            <?php
									}

								} 
								else {
							?>
                            <p class="col-sm-12 h5">¡Vaya! Aun no tienes campañas para mostrar.</p>
                            <?php
								}
								?>
                        </table>
                    </div>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>

        <!-- SIDE-BAR-SETTINGS -->
        <!-- <div class="sidebar sidebar-right sidebar-animate">
			   <div class="">
					<a href="#" class="sidebar-icon text-right float-right" data-toggle="sidebar-right" data-target=".sidebar-right"><i class="fe fe-x"></i></a>
				</div>
				<div class="p-3 border-bottom">
					<h5 class="border-bottom-0 mb-0">General Settings</h5>
				</div>
				<div class="p-4">
					<div class="switch-settings">
						<div class="d-flex mb-2">
							<span class="mr-auto fs-15">Notifications</span>
							<label class="custom-switch">
								<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
								<span class="custom-switch-indicator"></span>
							</label>
						</div>
						<div class="d-flex mb-2">
							<span class="mr-auto fs-15">Show your emails</span>
							<label class="custom-switch">
								<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
								<span class="custom-switch-indicator"></span>
							</label>
						</div>
						<div class="d-flex mb-2">
							<span class="mr-auto fs-15">Show Task statistics</span>
							<label class="custom-switch">
								<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
								<span class="custom-switch-indicator"></span>
							</label>
						</div>
						<div class="d-flex mb-2">
							<span class="mr-auto fs-15">Show recent activity</span>
							<label class="custom-switch">
								<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
								<span class="custom-switch-indicator"></span>
							</label>
						</div>
						<div class="d-flex mb-2">
							<span class="mr-auto fs-15">System Logs</span>
							<label class="custom-switch">
								<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
								<span class="custom-switch-indicator"></span>
							</label>
						</div>
						<div class="d-flex mb-2">
							<span class="mr-auto fs-15">Error Reporting</span>
							<label class="custom-switch">
								<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
								<span class="custom-switch-indicator"></span>
							</label>
						</div>
						<div class="d-flex mb-2">
							<span class="mr-auto fs-15">Show your status to all</span>
							<label class="custom-switch">
								<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
								<span class="custom-switch-indicator"></span>
							</label>
						</div>
						<div class="d-flex mb-2">
							<span class="mr-auto fs-15">Keep up to date</span>
							<label class="custom-switch">
								<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
								<span class="custom-switch-indicator"></span>
							</label>
						</div>
					</div>
				</div>
				<div class="p-3 border-bottom">
					<h5 class="border-bottom-0 mb-0">Overview</h5>
				</div>
				<div class="p-4">
					<div class="progress-wrapper">
						<div class="mb-3">
							<p class="mb-2">Achieves<span class="float-right text-muted font-weight-normal">80%</span></p>
							<div class="progress h-1">
								<div class="progress-bar bg-primary w-80 " role="progressbar"></div>
							</div>
						</div>
					</div>
					<div class="progress-wrapper pt-2">
						<div class="mb-3">
							<p class="mb-2">Projects<span class="float-right text-muted font-weight-normal">60%</span></p>
							<div class="progress h-1">
								<div class="progress-bar bg-secondary w-60 " role="progressbar"></div>
							</div>
						</div>
					</div>
					<div class="progress-wrapper pt-2">
						<div class="mb-3">
							<p class="mb-2">Earnings<span class="float-right text-muted font-weight-normal">50%</span></p>
							<div class="progress h-1">
								<div class="progress-bar bg-success w-50" role="progressbar"></div>
							</div>
						</div>
					</div>
					<div class="progress-wrapper pt-2">
						<div class="mb-3">
							<p class="mb-2">Balance<span class="float-right text-muted font-weight-normal">45%</span></p>
							<div class="progress h-1">
								<div class="progress-bar bg-warning w-45 " role="progressbar"></div>
							</div>
						</div>
					</div>
					<div class="progress-wrapper pt-2">
						<div class="mb-3">
							<p class="mb-2">Toatal Profits<span class="float-right text-muted font-weight-normal">75%</span></p>
							<div class="progress h-1">
								<div class="progress-bar bg-danger w-75" role="progressbar"></div>
							</div>
						</div>
					</div>
					<div class="progress-wrapper pt-2">
						<div class="mb-3">
							<p class="mb-2">Total Likes<span class="float-right text-muted font-weight-normal">70%</span></p>
							<div class="progress h-1">
								<div class="progress-bar bg-teal w-70" role="progressbar"></div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
        <!-- SIDE-BAR CLOSED -->
        <div class="mx-auto">
            <nav class="center-block text-center" style="padding-bottom:15px;">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo $_GET['pagina']<=1? 'disabled':'' ?>">
                        <a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina']-1 ?>" tabindex="-1">
                            Anterior
                        </a>
                    </li>
                    <?php for($i=0; $i<$paginas; $i++): ?>

                    <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : ''?>">
                        <a class="page-link" href="index.php?pagina=<?php echo $i + 1; ?>">
                            <?php echo $i + 1; ?>
                        </a>
                    </li>
                    <?php endfor ?>

                    <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled':'' ?>">
                        <a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina']+1 ?>">
                            Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>

		


        <?php 
			include "includes/footer.php";
			include "includes/modals.php"; 
		?>

        <script>
        $(document).ready(function() {
            $('.editbtncliente').on('click', function() {
                $('#editmodalcliente').modal('show');
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_id_cliente').val(data[0]);
                $('#presuClienteEdit').val(data[3]);
                $('#mesClienteEdit').val(data[4]);
                $('#pass_id_cliente').val(data[5]);
            });
        });


        $(document).ready(function() {
            $('.deletebtncliente').on('click', function() {
                $('#deletemodalcliente').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id_cliente').val(data[0]);

            });
        });
        </script>