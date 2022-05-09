<?php 
	ob_start();
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

	$campana = mysqli_fetch_array(mysqli_query($conexion, "SELECT * FROM campanas WHERE id_campana = '".$_GET['id']."'"));

	$usuarios = explode(";", $campana['admin_usuario']);
	$usuario_campana = false;

	foreach ($usuarios as $usuario)
	{
		if ($usuario == $rowUser['id'])
		{
		$usuario_campana = true;
		}
	}

	// if ($usuario_campana == false)
	// {
	// 	header('Location: index.php');
	// }

//   if ($rowUser['id_tipo'] != "1") {
//     header('Location: index.php');
//   }

//   if (isset($_POST['id_campana'])) {
//     $id_campana_input = $_POST['id_campana'];
//   } else {
//     $id_campana_input = $_GET['id'];
//   }

//   $sql = mysqli_query($conexion, "SELECT * FROM campanas WHERE id_campana = '".$id_campana_input."'");
//   $micampana = mysqli_fetch_array($sql);

?>

<?php include "includes/head.php"  ?>

<style>
#search_box,
#search_boxWa {
    align-items: center;
    width: 100%;
}

@media screen and (min-width: 767px) {

    #search_box,
    #search_boxWa {
        width: 50%;
    }

}

@media screen and (min-width: 900px) {

    #search_box,
    #search_boxWa {
        width: 25%;
    }

}

#registrar {
    float: right;
}

/* .deletebtn {
			width: 7rem;
			margin-bottom: 0.5rem;
		}
		.editbtn {
			width: 7rem;
		} */
</style>

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
                            <?php 
                                $companyGet = $_GET['company'];
                                $sql = mysqli_query($conexion, "SELECT * FROM campana_redes WHERE campana_empresa = '".$companyGet."'");
                                $nombre_emp = mysqli_fetch_array($sql);
                                            
                            ?>
                            <h1 class="page-title">Dashboard <?php echo $nombre_emp['campana_empresa']; ?></h1>
                            <h2 class="page-title">Mes corriente:<span style="font-weight: light;"> <?php echo $_GET['month']?> <?php echo $_GET['year']?></span></h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Marketing Dashboard</li>
                            </ol>
                            <div class="" style="position: absolute; right: 0; top:0">
                                <a class="btn btn-primary" style="cursor: pointer; margin-right: 1rem;"
                                    onclick="window.location='cac.php?id=<?php echo $_GET['id']; ?>&company=<?php echo $_GET['company']; ?>&month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>';"><span>Ver
                                        CAC</span></a>
                                <a class="btn btn-primary" style="cursor: pointer;"
                                    onclick="window.location='estadisticas.php?id=<?php echo $_GET['id']; ?>&company=<?php echo $_GET['company']; ?>&month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>';"><span>Ver
                                        Historico</span></a>
                            </div>

                        </div>

                        <!-- <div class="ml-auto pageheader-btn">
								<a href="#" class="btn btn-primary btn-icon text-white mr-2">
									<span>
										<i class="fe fe-shopping-cart"></i>
									</span> Add Order
								</a>
								<button id="registrar" class="btn btn-secondary btn-icon text-white" type="button" data-toggle="modal" data-target="#editMarketing"><span><i class="fe fe-plus"></i></span> Actualizar datos</button>
							</div> -->

                    </div>

                    <?php if ($rowUser['id_tipo'] == "2"): ?>

                    <!-- <object type="image/svg+xml" data="assets/images/banners/banner_galleta_junio.jpg" class="mb-5"> -->
                    <!-- Your fall back here -->
                    <img src="assets/images/banners/banner_galleta_junio.jpg" class="mb-5 mt-5 img-fluid" />
                    <!-- </object> -->
                    <?php else: ?>

                    <?php endif; ?>

                    <!-- <object type="image/svg+xml" data="assets/images/banners/banner_galleta.svg"></object> -->

                    <!-- ROW -->
                    <?php if ($rowUser['id_tipo'] <> "3"): ?>

                    <?php 
                        $mesGet = $_GET['month'];
                        $yearGet = $_GET['year'];
                        $companyGet = $_GET['company'];
                        $sql = mysqli_query($conexion, "SELECT * FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND mes_actual = '".$mesGet."' YEAR(fecha_inicio) = '".$yearGet."'");
                        $resultado = mysqli_fetch_array($sql);
                    ?>

                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-primary img-card box-primary-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql_whats = mysqli_query($conexion,"SELECT * FROM whatsapp WHERE campana_empresa = '".$companyGet."' AND mes_actual = '".$mesGet."' YEAR(fecha) = '".$yearGet."' ");
                                            $num_leads = mysqli_num_rows($sql_whats);

                                            $sql = mysqli_query($conexion, "SELECT SUM(leads) as total FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultados = mysqli_fetch_array($sql);
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php echo number_format($resultados['total'] + $num_leads); ?></h2>
                                            <p class="text-white mb-0">Leads </p>
                                        </div>
                                        <div class="ml-auto"> <i class="fa fa-send-o text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- COL END -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-secondary img-card box-secondary-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT * FROM campanas WHERE nom_empresa = '".$companyGet."'");
                                            $resultado_presu = mysqli_fetch_array($sql);
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                $<?php echo number_format($resultado_presu['presu_general'],2); ?></h2>
                                            <p class="text-white mb-0">Presupuesto del mes</p>
                                        </div>
                                        <div class="ml-auto"> <i class="fas fa-wallet text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- COL END -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card  bg-success img-card box-success-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(presu_invertido) as total FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_invertido = mysqli_fetch_array($sql);
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                $<?php echo number_format($resultado_invertido['total'],2); ?></h2>
                                            <p class="text-white mb-0">Budget</p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- COL END -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-info img-card box-info-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php
                                            $sql = mysqli_query($conexion, "SELECT SUM(presu_gastado) as total FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $total_gasto = mysqli_fetch_array($sql);
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                $<?php echo number_format($total_gasto['total'],2); ?></h2>
                                            <p class="text-white mb-0">Gastado</p>
                                        </div>
                                        <div class="ml-auto"> <i class="fa fa-cart-plus text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- COL END -->
                    </div>
                    <!-- ROW -->
                    <!-- ROW -->
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-primary img-card box-primary-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php
                                            $sql = "SELECT COUNT(*) nom_empresa FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'";
                                            $resultado = mysqli_query($conexion, $sql);
                                            $total = mysqli_fetch_assoc($resultado);
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font"><?php echo $total['nom_empresa']; ?></h2>
                                            <p class="text-white mb-0">Campañas</p>
                                        </div>

                                        <div class="ml-auto"> <i class="far fa-bell text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- COL END -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-secondary img-card box-secondary-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT * FROM campanas WHERE nom_empresa = '".$companyGet."'");
                                            $datos_disponible = mysqli_fetch_array($sql);
                                            $disponible_presu = $datos_disponible['presu_general'];
                                        ?>
                                        <?php
                                            $sql = mysqli_query($conexion, "SELECT '".$disponible_presu."' - SUM(presu_gastado) as total FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            //$sql = mysqli_query($conexion, "SELECT(presu_general - presu_gastado) as resta  FROM campana_redes WHERE campana_empresa = '".$presupuesto_total."'");
                                            $resultado_disponible = mysqli_fetch_array($sql);
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                $<?php echo number_format( $resultado_disponible['total'],2); ?></h2>
                                            <p class="text-white mb-0">Presupuesto disponible</p>
                                        </div>
                                        <div class="ml-auto"> <i class="fas fa-wallet text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- COL END -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card  bg-success img-card box-success-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php
                                            $sql = mysqli_query($conexion, "SELECT SUM(alcance) as total FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $total_alcance = mysqli_fetch_array($sql);			
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php echo number_format($total_alcance['total']); ?></h2>
                                            <p class="text-white mb-0">Alcance</p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-chart-line text-white fs-30 mr-2 mt-2"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- COL END -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-info img-card box-info-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php
                                            $sql = mysqli_query($conexion, "SELECT SUM(interacciones) as total FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $total_interaccion = mysqli_fetch_array($sql);	
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php echo number_format($total_interaccion['total']); ?></h2>
                                            <p class="text-white mb-0">Interacciones</p>
                                        </div>
                                        <div class="ml-auto"> <i class="fa fa-bar-chart text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- COL END -->
                    </div>
                    <!-- ROW -->
                    <!-- ROW-1 CLOSED -->
                    <?php endif; ?>

                    <!-- ROW-1 CLOSED -->

                    <!-- ROW-2 OPEN -->
                    <!-- <div class="row">
							<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
								<div class="card overflow-hidden">
									<div class="card-body">
										<h3 class="card-title">Lead Break Down(This month)</h3>
										<div class="row text-center mb-6">
											<div class="col dash-1">
												<p class="mb-1"><span class="dot-label bg-pink mr-2"></span>Trails</p>
												<h3 class="mb-0 number-font1 font-weight-semibold">17.89<span class="fs-16 ml-1">%</span></h3>
											</div>
											<div class="col dash-1">
												<p class="mb-1"><span class="dot-label bg-primary mr-2"></span>Non Trails</p>
												<h3 class="mb-0 number-font1 font-weight-semibold">48.65<span class="fs-16 ml-1">%</span></h3>
											</div>
										</div>
										<div class="chart-wrapper">
											<canvas id="pieChart" class=""></canvas>
										</div>
									</div>
								</div>
							</div> -->
                    <!-- COL END -->
                    <!-- <div class="col-lg-8 col-md-12 col-sm-12 col-xl-8">
								<div class="card overflow-hidden">
									<div class="card-header">
										<h3 class="card-title">Bounce Rate by Week </h3>
									</div>
									<div class="card-body">
										<div class="flot-wrapper">
											<div class="bounce-widget">
												<p class="mb-1">Bounce Rate</p>
												<h2 class="mb-1  number-font fs-30">55%</h2>
												<p class="text-muted  mb-0"><span class="text-muted fs-13 mr-2">(-0.9%)</span> than Last week</p>
											</div>
											<div class="h-300" id="flotChart08"></div>
										</div>
									</div>
								</div>
							</div> -->
                    <!-- COL END -->
                    <!-- </div> -->
                    <!-- ROW-2 CLOSED -->

                    <!-- ROW-3 OPEN -->
                    <!-- <div class="row">
							<div class="col-lg-4 col-md-4 col-sm-12 col-xl-4">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col">
												<h6 class="">New Sessions(Avg)</h6>
												<h3 class="mb-2 number-font">67.96%</h3>
												<p class="text-muted">
													<span class="text-muted"><i class="fa fa-chevron-circle-up text-muted ml-1"></i> 3%</span>
													last month
												</p>
												<div class="progress h-2">
													<div class="progress-bar bg-orange w-50" role="progressbar"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 col-xl-4">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col">
												<h6 class="">Time On site(Avg)</h6>
												<h3 class="mb-2 number-font">5m:45s</h3>
												<p class="text-muted">
													<span class="text-muted"><i class="fa fa-chevron-circle-down text-muted ml-1"></i> 0.15%</span>
													last month
												</p>
												<div class="progress h-2">
													<div class="progress-bar bg-secondary w-50" role="progressbar"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 col-xl-4">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col">
												<h6 class="">Page Views(Avg)</h6>
												<h3 class="mb-2 number-font">8.14</h3>
												<p class="text-muted">
													<span class="text-muted"><i class="fa fa-chevron-circle-down text-muted ml-1"></i> 0.15%</span>
													last month
												</p>
												<div class="progress h-2">
													<div class="progress-bar bg-secondary1 w-50" role="progressbar"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->
                    <!-- ROW-3 CLOSED -->

                    <!-- ROW-4 OPEN -->

                    <div class="row" id="buscar_campaña">

                        <div class="col-lg-12 col-sm-12 col-xl-12">
                            <?php if ($rowUser['id_tipo'] <> "3"): ?>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Campañas</h3>
                                </div>
                                <div class="card-body">
                                    <h2 class="text-center mb-3">Campañas registradas</h2>
                                    <form method="post" action="server/export-excel-pdf.php">
                                        <input type="hidden" name="companyexcel" value="<?php echo $_GET['company']?>">

                                        <div class="input-daterange">
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="text" placeholder="Fecha de inicio"
                                                    onfocus="(this.type='date')" name="fecha_inicio" id="fecha_inicio"
                                                    required>
                                                <?php echo $fecha_inicio_error; ?>
                                            </div>
                                            <div class="form-group col-md-6">

                                                <input class="form-control" type="text" placeholder="Fecha final"
                                                    onfocus="(this.type='date')" name="fecha_final" required>
                                                <?php echo $fecha_final_error; ?>
                                            </div>
                                        </div>

                                        <div class="form-group d-inline">
                                            <button type="submit" name="action" value="generar_pdf"
                                                class="btn btn-pill btn-danger-light ml-5"> <span
                                                    class="fas fa-file-pdf"></span> Generar reporte PDF</button>
                                            <button type="submit" name="action" value="generar_excel"
                                                class="btn btn-pill btn-success-light ml-5"> <span
                                                    class="fas fa-file-excel"></span> Generar reporte Excel</button>
                                        </div>

                                        <div>
                                            <?php if ($rowUser['id_tipo'] == "1"): ?>
                                            <div class="form-group">
                                                <button id="registrar" type="button"
                                                    class="btn btn-pill btn-info-light btn-md mb-2" data-toggle="modal"
                                                    data-target="#registrarAuto"><span
                                                        class='glyphicon glyphicon-plus'></span> Registrar
                                                    campaña</button>
                                            </div>
                                            <?php else: ?>

                                            <?php endif; ?>
                                            <div class="form-group mt-5">
                                                <label for="search_box">Realiza la busqueda por campañas <a
                                                        href="#buscar_campaña"><i id='popoverBusqueda'
                                                            class='fas fa-exclamation-circle'
                                                            style='color:#ff0000;'></i></a></label>
                                                <input class="form-control" type="text" id="search_box"
                                                    name="search_box" placeholder="Buscar...">
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-responsive" id="dynamic_content"></div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div><!-- COL END -->
                        <!-- ROW-4 OPEN -->
                        <!-- <div class="col-lg-4 col-md-12 col-xl-4">
								<div class="card overflow-hidden">
									<div class="card-header">
										<h3 class="card-title">Comunidad</h3>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-6">
												<div class="card shadow-none">
													<div class="card-body p-4">
														<div class="text-center">
															<i class="bx bxl-facebook fs-40 text-primary"></i>
															<h4 class="mt-3 mb-0 number-font fs-20">8,209</h4>
															<p class="text-muted mb-0">FaceBook</p>
														</div>
													</div>
												</div>
											</div>
											<div class="col-6">
												<div class="card shadow-none">
													<div class="card-body p-4">
														<div class="text-center">
															<i class="bx bxl-google-plus fs-40 text-danger"></i>
															<h4 class="mt-3 mb-0 number-font fs-20">7,210</h4>
															<p class="text-muted mb-0">Google</p>
														</div>
													</div>
												</div>
											</div>
											<div class="col-6">
												<div class="card shadow-none mb-lg-0">
													<div class="card-body p-4">
														<div class="text-center">
															<i class="bx bxl-youtube fs-40 text-orange"></i>
															<h4 class="mt-3 mb-0 number-font fs-20">6,234</h4>
															<p class="text-muted mb-0">Youtube</p>
														</div>
													</div>
												</div>
											</div>
											<div class="col-6">
												<div class="card shadow-none mb-0">
													<div class="card-body p-4">
														<div class="text-center">
															<i class="bx bxl-twitter fs-40 text-info"></i>
															<h4 class="mt-3 mb-0 number-font fs-20">4,567</h4>
															<p class="text-muted mb-0">Twitter</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> -->

                    </div>
                    <?php if ($rowUser['id_tipo'] <> "3"): ?>
                    <div class="card text-center" style="background: transparent; border-style: none;">
                        <div class="card-body" style="padding: 0;">
                            <h2 class="d-inline">Desglose de leads por canal</h2>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-lg-6 col-md-12 col-xl-3">
                            <div class="card">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="circle-icon text-center align-self-center"
                                            style="background-color:#1877f2; border-radius: 15px; box-shadow: 0 5px 10px #1877f270;">
                                            <!--<img src="../../assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">-->
                                            <i class="fab fa-facebook-f text-white"
                                                style="font-size: 3.5rem; margin: 0.5rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(leads) as total_f FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Facebook' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_facebook = mysqli_fetch_array($sql);
                                        ?>
                                        <div class="card-body p-4">
                                            <h2 class="mb-2 font-weight-normal mt-2">
                                                <?php echo number_format( $resultado_facebook['total_f']); ?></h2>
                                            <h5 class="font-weight-normal mb-0">Total Leads</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Costo Promedio por leads Facebook  -->
                            <div class="card img-card"
                                style="background-color:#1877f2; border-radius: 15px; box-shadow: 0 5px 10px #1877f270; border: none;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(presu_gastado) as total FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Facebook' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_gastado_face = mysqli_fetch_array($sql);
                                            $operacion_face = $resultado_gastado_face['total'] / $resultado_facebook['total_f'];
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php 
                                                    if (is_nan($operacion_face) || is_infinite($operacion_face)) {
                                                        $operacion_face = 0;
                                                    } 
                                                    else {
                                                        $operacion_face;
                                                    }
                                                ?>
                                                $<?php echo number_format($operacion_face,2); ?>
                                            </h2>
                                            <p class="text-white mb-0">Costo Promedio por leads
                                                <strong>Facebook</strong>
                                            </p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Costo Promedio por clics Facebook -->
                            <div class="card img-card"
                                style="background-color:#1877f2; border-radius: 15px; box-shadow: 0 5px 10px #1877f270; border: none;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(conversiones) as total_clic_f FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Facebook' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_clics_facebook = mysqli_fetch_array($sql);

                                            $operacion_clics_face = $resultado_gastado_face['total'] / $resultado_clics_facebook['total_clic_f'];
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php 
                                                    if (is_nan($operacion_clics_face) || is_infinite($operacion_clics_face)) {
                                                        $operacion_clics_face = 0;
                                                    } 
                                                    else {
                                                        $operacion_clics_face;
                                                    }
                                                ?>
                                                $<?php echo number_format($operacion_clics_face,2); ?>
                                            </h2>
                                            <p class="text-white mb-0">Costo Promedio por clics
                                                <strong>Facebook</strong>
                                            </p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-6 col-md-12 col-xl-3">
                            <div class="card">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card-img-absolute circle-icon align-items-center text-center"
                                            style="background: radial-gradient(circle at 25% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285aeb 90% ); border-radius: 15px; box-shadow: 0 5px 10px #d6249f70;">
                                            <!--<img src="../../assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">-->
                                            <i class="fab fa-instagram text-white"
                                                style="font-size: 3.5rem; margin: 0.5rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(leads) as total_i FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Instagram' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_instagram = mysqli_fetch_array($sql);
                                        ?>
                                        <div class="card-body p-4">
                                            <h2 class="mb-2 font-weight-normal mt-2">
                                                <?php echo number_format( $resultado_instagram['total_i']); ?></h2>
                                            <h5 class="font-weight-normal mb-0">Total Leads</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Costo Promedio por leads Instagram  -->
                            <div class="card img-card"
                                style="background: radial-gradient(circle at 0% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285aeb 90% ); border-radius: 15px; box-shadow: 0 5px 10px #d6249f70; border: none;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(presu_gastado) as total FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Instagram' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_gastado_insta = mysqli_fetch_array($sql);
                                            $operacion_insta = $resultado_gastado_insta['total'] / $resultado_instagram['total_i'];
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php 
                                                    if (is_nan($operacion_insta) || is_infinite($operacion_insta)) {
                                                        $operacion_insta = 0;
                                                    } 
                                                    else {
                                                        $operacion_insta;
                                                    }
                                                ?>
                                                $<?php echo number_format($operacion_insta,2); ?></h2>
                                            <p class="text-white mb-0">Costo Promedio por leads
                                                <strong>Instagram</strong>
                                            </p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Costo Promedio por clics Instagram -->
                            <div class="card img-card"
                                style="background: radial-gradient(circle at 0% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285aeb 90% ); border-radius: 15px; box-shadow: 0 5px 10px #d6249f70; border: none;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(conversiones) as total_clic_i FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Instagram' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_clics_instagram = mysqli_fetch_array($sql);

                                            $operacion_clics_inst = $resultado_gastado_insta['total'] / $resultado_clics_instagram['total_clic_i'];
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php 
                                                    if (is_nan($operacion_clics_inst) || is_infinite($operacion_clics_inst)) {
                                                        $operacion_clics_inst = 0;
                                                    } 
                                                    else {
                                                        $operacion_clics_inst;
                                                    }
                                                ?>
                                                $<?php echo number_format($operacion_clics_inst,2); ?>
                                            </h2>
                                            <p class="text-white mb-0">Costo Promedio por clics
                                                <strong>Instagram</strong>
                                            </p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-md-12 col-xl-3">
                            <div class="card">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card-img-absolute  circle-icon align-items-center text-center"
                                            style="background-color:#4285f4; border-radius: 15px; box-shadow: 0 5px 10px #4285f470;">
                                            <!--<img src="../../assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">-->
                                            <i class="fab fa-google text-white"
                                                style="font-size: 3.5rem; margin: 0.5rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(leads) as total_g FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Google' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_google = mysqli_fetch_array($sql);
                                        ?>
                                        <div class="card-body p-4">
                                            <h2 class="mb-2 font-weight-normal mt-2">
                                                <?php echo number_format( $resultado_google['total_g']); ?></h2>
                                            <h5 class="font-weight-normal mb-0">Total Leads</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Costo Promedio por leads Google  -->
                            <div class="card img-card"
                                style="background-color:#4285f4; border-radius: 15px; box-shadow: 0 5px 10px #4285f470; border: none;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(presu_gastado) as total FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Google' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_gastado_goog = mysqli_fetch_array($sql);
                                            $operacion_goog = $resultado_gastado_goog['total'] / $resultado_google['total_g'];
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php 
                                                    if (is_nan($operacion_goog) || is_infinite($operacion_goog)) {
                                                        $operacion_goog = 0;
                                                    } 
                                                    else {
                                                        $operacion_goog;
                                                    }
                                                ?>
                                                $<?php echo number_format($operacion_goog,2); ?></h2>
                                            <p class="text-white mb-0">Costo Promedio por leads <strong>Google</strong>
                                            </p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Costo Promedio por clics Google -->
                            <div class="card img-card"
                                style="background-color:#4285f4; border-radius: 15px; box-shadow: 0 5px 10px #4285f470; border: none;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(conversiones) as total_clic_g FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Google' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_clics_google = mysqli_fetch_array($sql);

                                            $operacion_clics_goog = $resultado_gastado_goog['total'] / $resultado_clics_google['total_clic_g'];
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php 
                                                    if (is_nan($operacion_clics_goog) || is_infinite($operacion_clics_goog)) {
                                                        $operacion_clics_goog = 0;
                                                    } 
                                                    else {
                                                        $operacion_clics_goog;
                                                    }
                                                ?>
                                                $<?php echo number_format($operacion_clics_goog,2); ?>
                                            </h2>
                                            <p class="text-white mb-0">Costo Promedio por clics <strong>Google</strong>
                                            </p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-md-12 col-xl-3">
                            <div class="card">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card-img-absolute circle-icon  align-items-center text-center"
                                            style="background-color:#0073b1; border-radius: 15px; box-shadow: 0 5px 10px #0073b170;">
                                            <!--<img src="../../assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">-->
                                            <i class="fab fa-linkedin-in text-white"
                                                style="font-size: 3.5rem; margin: 0.5rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(leads) as total_l FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'LinkedIn' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_link = mysqli_fetch_array($sql);
                                        ?>
                                        <div class="card-body p-4">
                                            <h2 class="mb-2 font-weight-normal mt-2">
                                                <?php echo number_format( $resultado_link['total_l']); ?></h2>
                                            <h5 class="font-weight-normal mb-0">Total Leads</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Costo Promedio por leads LinkedIn -->
                            <div class="card img-card"
                                style="background-color:#0073b1; border-radius: 15px; box-shadow: 0 5px 10px #0073b170; border: none;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(presu_gastado) as total FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'LinkedIn' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_gastado_link = mysqli_fetch_array($sql);
                                            $operacion_link = $resultado_gastado_link['total'] / $resultado_link['total_l'];
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php 
                                                    if (is_nan($operacion_link) || is_infinite($operacion_link)) {
                                                        $operacion_link = 0;
                                                    } 
                                                    else {
                                                        $operacion_link;
                                                    }
                                                ?>
                                                $<?php echo number_format($operacion_link,2); ?></h2>
                                            <p class="text-white mb-0">Costo Promedio por leads
                                                <strong>LinkedIn</strong>
                                            </p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Costo Promedio por clics Google -->
                            <div class="card img-card"
                                style="background-color:#0073b1; border-radius: 15px; box-shadow: 0 5px 10px #0073b170; border: none;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(conversiones) as total_clic_l FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'LinkedIn' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_clics_link = mysqli_fetch_array($sql);

                                            $operacion_clics_link = $resultado_gastado_link['total'] / $resultado_clics_link['total_clic_l'];
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php 
                                                    if (is_nan($operacion_clics_link) || is_infinite($operacion_clics_link)) {
                                                        $operacion_clics_link = 0;
                                                    } 
                                                    else {
                                                        $operacion_clics_link;
                                                    }
                                                ?>
                                                $<?php echo number_format($operacion_clics_link,2); ?>
                                            </h2>
                                            <p class="text-white mb-0">Costo Promedio por clics
                                                <strong>LinkedIn</strong>
                                            </p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-md-12 col-xl-3">
                            <div class="card">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card-img-absolute circle-icon  align-items-center text-center"
                                            style="background-color:#33ccff; border-radius: 15px; box-shadow: 0 5px 10px #33ccff70;">
                                            <!--<img src="../../assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">-->
                                            <i class="fab fa-waze text-white"
                                                style="font-size: 3.5rem; margin: 0.5rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(leads) as total_w FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Waze' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_waze = mysqli_fetch_array($sql);
                                        ?>
                                        <div class="card-body p-4">
                                            <h2 class="mb-2 font-weight-normal mt-2">
                                                <?php echo number_format( $resultado_waze['total_w']); ?></h2>
                                            <h5 class="font-weight-normal mb-0">Total navegaciones</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Costo Promedio por navegaciones Waze -->
                            <div class="card img-card"
                                style="background-color:#33ccff; border-radius: 15px; box-shadow: 0 5px 10px #33ccff70; border: none;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(presu_gastado) as total FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Waze' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_gastado_waze = mysqli_fetch_array($sql);
                                            $operacion_waze = $resultado_gastado_waze['total'] / $resultado_waze['total_w'];
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php 
                                                    if (is_nan($operacion_waze) || is_infinite($operacion_waze)) {
                                                        $operacion_waze = 0;
                                                    } 
                                                    else {
                                                        $operacion_waze;
                                                    }
                                                ?>
                                                $<?php echo number_format($operacion_waze,2); ?></h2>
                                            <p class="text-white mb-0">Costo Promedio por navegaciones
                                                <strong>Waze</strong>
                                            </p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Costo Promedio por clics Waze -->
                            <div class="card img-card"
                                style="background-color:#33ccff; border-radius: 15px; box-shadow: 0 5px 10px #33ccff70; border: none;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(conversiones) as total_clic_w FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Waze' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_clics_waze = mysqli_fetch_array($sql);

                                            $operacion_clics_waze = $resultado_gastado_waze['total'] / $resultado_clics_waze['total_clic_w'];
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php 
                                                    if (is_nan($operacion_clics_waze) || is_infinite($operacion_clics_waze)) {
                                                        $operacion_clics_waze = 0;
                                                    } 
                                                    else {
                                                        $operacion_clics_waze;
                                                    }
                                                ?>
                                                $<?php echo number_format($operacion_clics_waze,2); ?>
                                            </h2>
                                            <p class="text-white mb-0">Costo Promedio por clics <strong>Waze</strong>
                                            </p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-12 col-lg-6 col-md-12 col-xl-3">
                            <div class="card">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card-img-absolute circle-icon  align-items-center text-center"
                                            style="background-color:#000000; border-radius: 15px; box-shadow: 0 5px 10px #00000070;">
                                            <!--<img src="../../assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">-->
                                            <img src="https://1.bp.blogspot.com/-MM_cQuOL2H8/XyA_smVBKCI/AAAAAAAAL3M/Dw9Mr16NAmIASBRTU42DT5d2_yxiyzFGACPcBGAYYCw/s1827/TIK%2BTOK.png"
                                                style="width: 65%; margin: 0.6rem 0.5rem 0.5rem 0.5rem;">
                                            <!-- <i class="fab fa-waze text-white" style="font-size: 3.5rem; margin: 0.5rem;"></i> -->
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(leads) as total_t FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'TikTok' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_tik = mysqli_fetch_array($sql);
                                        ?>
                                        <div class="card-body p-4">
                                            <h2 class="mb-2 font-weight-normal mt-2">
                                                <?php echo number_format( $resultado_tik['total_t']); ?></h2>
                                            <h5 class="font-weight-normal mb-0">Total leads</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Costo Promedio por leads TikTok -->
                            <div class="card img-card"
                                style="background: radial-gradient(circle at 0% 0%, #69C9D0 0%, #000000 50%, #EE1D52 107% ); border-radius: 15px; box-shadow: 0 5px 10px #69C9D070; border: none;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(presu_gastado) as total FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'TikTok' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_gastado_tik = mysqli_fetch_array($sql);
                                            $operacion_tik = $resultado_gastado_tik['total'] / $resultado_tik['total_t'];
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php 
                                                    if (is_nan($operacion_tik) || is_infinite($operacion_tik)) {
                                                        $operacion_tik = 0;
                                                    } 
                                                    else {
                                                        $operacion_tik;
                                                    }
                                                ?>
                                                $<?php echo number_format($operacion_tik,2); ?></h2>
                                            <p class="text-white mb-0">Costo Promedio por leads <strong>TikTok</strong>
                                            </p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Costo Promedio por clics Waze -->
                            <div class="card img-card"
                                style="background: radial-gradient(circle at 0% 0%, #69C9D0 0%, #000000 50%, #EE1D52 107% ); border-radius: 15px; box-shadow: 0 5px 10px #69C9D070; border: none;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(conversiones) as total_clic_t FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'TikTok' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_clics_tik = mysqli_fetch_array($sql);

                                            $operacion_clics_tik = $resultado_gastado_tik['total'] / $resultado_clics_tik['total_clic_t'];
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php 
                                                    if (is_nan($operacion_clics_tik) || is_infinite($operacion_clics_tik)) {
                                                        $operacion_clics_tik = 0;
                                                    } 
                                                    else {
                                                        $operacion_clics_tik;
                                                    }
                                                ?>
                                                $<?php echo number_format($operacion_clics_tik,2); ?>
                                            </h2>
                                            <p class="text-white mb-0">Costo Promedio por clics <strong>TikTok</strong>
                                            </p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-6 col-md-12 col-xl-3">
                            <div class="card">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card-img-absolute circle-icon  align-items-center text-center"
                                            style="background-color:#1ED760; border-radius: 15px; box-shadow: 0 5px 10px #1ED76070;">
                                            <!--<img src="../../assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">-->
                                            <i class="fab fa-spotify fa-4x text-white"
                                                style="font-size: 3.5rem; margin: 0.5rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(leads) as total_s FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Spotify' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_spoti = mysqli_fetch_array($sql);
                                        ?>
                                        <div class="card-body p-4">
                                            <h2 class="mb-2 font-weight-normal mt-2">
                                                <?php echo number_format( $resultado_spoti['total_s']); ?></h2>
                                            <h5 class="font-weight-normal mb-0">Total leads</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Costo Promedio por leads Spotify -->
                            <div class="card img-card"
                                style="background-color:#1ED760; border-radius: 15px; box-shadow: 0 5px 10px #1ED76070; border: none;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(presu_gastado) as total FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Spotify' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_gastado_spotify = mysqli_fetch_array($sql);
                                            $operacion_spoti = $resultado_gastado_spotify['total'] / $resultado_spoti['total_s'];
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php 
                                                    if (is_nan($operacion_spoti) || is_infinite($operacion_spoti)) {
                                                        $operacion_spoti = 0;
                                                    } 
                                                    else {
                                                        $operacion_spoti;
                                                    }
                                                ?>
                                                $<?php echo number_format($operacion_spoti,2); ?></h2>
                                            <p class="text-white mb-0">Costo Promedio por leads <strong>Spotify</strong>
                                            </p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Costo Promedio por clics Waze -->
                            <div class="card img-card"
                                style="background-color:#1ED760; border-radius: 15px; box-shadow: 0 5px 10px #1ED76070; border: none;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <?php 
                                            $sql = mysqli_query($conexion, "SELECT SUM(conversiones) as total_clic_s FROM campana_redes WHERE campana_empresa = '".$companyGet."' AND red_social = 'Spotify' AND mes_actual = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                            $resultado_clics_spoti = mysqli_fetch_array($sql);

                                            $operacion_clics_spoti = $resultado_gastado_spotify['total'] / $resultado_clics_spoti['total_clic_s'];
                                        ?>
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">
                                                <?php 
                                                    if (is_nan($operacion_clics_spoti) || is_infinite($operacion_clics_spoti)) {
                                                        $operacion_clics_spoti = 0;
                                                    } 
                                                    else {
                                                        $operacion_clics_spoti;
                                                    }
                                                ?>
                                                $<?php echo number_format($operacion_clics_spoti,2); ?>
                                            </h2>
                                            <p class="text-white mb-0">Costo Promedio por clics <strong>Spotify</strong>
                                            </p>
                                        </div>
                                        <div class="ml-auto"> <i
                                                class="fas fa-money-bill-wave-alt text-white fs-30 mr-2 mt-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endif; ?>
                    <?php if ($rowUser['id_tipo'] == "1"): ?>
                    <div class="col-lg-12 col-sm-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Comunidad en redes sociales</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">

                                    <button class="btnComunInsert btn btn-pill btn-warning-light"
                                        style="float: right; margin-right: 11px;" data-toggle="modal"
                                        data-target="#registrarNuevaComunidad"><i class="fas fa-plus"></i>
                                        Insertar</button>

                                    <!-- <input class="form-control" type="text" id="search_box" name="search_box" placeholder="Buscar auto"> -->
                                </div>
                                <h2 class="text-center mb-3">Registro de seguidores</h2>
                                <div class="table-responsive" id="dynamic_content_comunidad"></div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>


                    <div class="card text-center" style="background: transparent; border-style: none;">
                        <div class="card-body" style="padding: 0;">
                            <h2 class="d-inline">Comunidad</h2>
                            <!--Botones de redes sociales-->

                        </div>
                    </div>

                    <div class="row mx-auto">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <?php 
										//$sql = mysqli_query($conexion, "SELECT * FROM comunidad WHERE nom_empresa_comu = '".$companyGet."' AND mes_comunidad = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
                                        $sql = mysqli_query($conexion, "SELECT SUM(datos_facebook) FROM comunidad WHERE nom_empresa_comu = '".$companyGet."' AND mes_comunidad = '".$mesGet."'");
										$result_f = mysqli_fetch_array($sql);
                                        // var_dump($result_f[0]);
									?>
                                    <i class="fab fa-facebook-f fa-4x"
                                        style="color: #1877f2; text-shadow: 0 5px 10px #1877f270;"></i>
                                    <h6 class="mt-4 mb-2">Facebook</h6>
                                    <h2 class="mb-2 number-font" id="facebook">
                                        <?php 
                                            echo number_format($result_f[0]);
                                        ?>
                                    </h2>
                                    <p class="text-muted d-none">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <?php 
										// $sql = mysqli_query($conexion, "SELECT * FROM comunidad WHERE nom_empresa_comu = '".$companyGet."' AND mes_comunidad = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
										// $result_ins = mysqli_fetch_array($sql);

                                        $sql = mysqli_query($conexion, "SELECT SUM(datos_intagram) FROM comunidad WHERE nom_empresa_comu = '".$companyGet."' AND mes_comunidad = '".$mesGet."'");
										$result_ins = mysqli_fetch_array($sql);

                                         //var_dump($result_ins[0]);
									?>
                                    <i class="fab fa-instagram fa-4x"
                                        style="background: radial-gradient(circle at 25% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285aeb 90% );-webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; text-shadow: 0 5px 10px #d6249f70;"></i>
                                    <h6 class="mt-4 mb-2">Instagram</h6>
                                    <h2 class="mb-2  number-font" id="instagram">
                                        <?php echo number_format($result_ins[0]);?></h2>
                                    <p class="text-muted d-none">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <?php 
										// $sql = mysqli_query($conexion, "SELECT * FROM comunidad WHERE nom_empresa_comu = '".$companyGet."' AND mes_comunidad = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
										// $result_t = mysqli_fetch_array($sql);
                                        $sql = mysqli_query($conexion, "SELECT SUM(datos_twitter) FROM comunidad WHERE nom_empresa_comu = '".$companyGet."' AND mes_comunidad = '".$mesGet."'");
										$result_t = mysqli_fetch_array($sql);

                                        //var_dump($result_t[0]);
									?>
                                    <i class="fab fa-twitter fa-4x"
                                        style="color: #71c9f8; text-shadow: 0 5px 10px #71c9f870;"></i>
                                    <h6 class="mt-4 mb-2">Twitter</h6>
                                    <h2 class="mb-2 number-font" id="twitter">
                                        <?php echo number_format($result_t[0]);?></h2>
                                    <p class="text-muted d-none">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card">
									<div class="card-body text-center">
									<?php 
									//	$sql = mysqli_query($conexion, "SELECT * FROM comunidad WHERE nom_empresa_comu = '".$companyGet."' AND mes_comunidad = '".$mesGet."'");
									//	$result_g = mysqli_fetch_array($sql);
									?>
										<i class="fab fa-google fa-4x" style="color: #fbbc05; text-shadow: 0 5px 10px #fbbc0570;"></i>
										<h6 class="mt-4 mb-2">Google</h6>
										<h2 class="mb-2  number-font" id="google"><?php// echo number_format($result_g['datos_google']);?></h2>
										<p class="text-muted d-none"></p>
									</div>
								</div>
							</div>-->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <?php 
										// $sql = mysqli_query($conexion, "SELECT * FROM comunidad WHERE nom_empresa_comu = '".$companyGet."' AND mes_comunidad = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
										// $result_y = mysqli_fetch_array($sql);
                                        $sql = mysqli_query($conexion, "SELECT SUM(datos_youtube) FROM comunidad WHERE nom_empresa_comu = '".$companyGet."' AND mes_comunidad = '".$mesGet."'");
										$result_y = mysqli_fetch_array($sql);
                                        //var_dump($result_y[0]);

									?>
                                    <i class="fab fa-youtube fa-4x"
                                        style="color: #ff0000; text-shadow: 0 5px 10px #ff000070;"></i>
                                    <h6 class="mt-4 mb-2">Youtube</h6>
                                    <h2 class="mb-2  number-font" id="youtube">
                                        <?php echo number_format($result_y[0]);?></h2>
                                    <p class="text-muted d-none">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <?php 
										// $sql = mysqli_query($conexion, "SELECT * FROM comunidad WHERE nom_empresa_comu = '".$companyGet."' AND mes_comunidad = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
										// $result_l = mysqli_fetch_array($sql);
                                        $sql = mysqli_query($conexion, "SELECT SUM(datos_linkedin) FROM comunidad WHERE nom_empresa_comu = '".$companyGet."' AND mes_comunidad = '".$mesGet."'");
										$result_l = mysqli_fetch_array($sql);
                                       // var_dump($result_l[0]);
                                        
									?>
                                    <i class="fab fa-linkedin fa-4x"
                                        style="color: #0073b1; text-shadow: 0 5px 10px #0073b170;"></i>
                                    <h6 class="mt-4 mb-2">LinkedIn</h6>
                                    <h2 class="mb-2  number-font" id="linkedin">
                                        <?php echo number_format($result_y[0]);?></h2>
                                    <p class="text-muted d-none">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <?php 
										// $sql = mysqli_query($conexion, "SELECT * FROM comunidad WHERE nom_empresa_comu = '".$companyGet."' AND mes_comunidad = '".$mesGet."' AND YEAR(fecha_inicio) = '".$yearGet."'");
										// $result_s = mysqli_fetch_array($sql);
                                        $sql = mysqli_query($conexion, "SELECT SUM(datos_spotify) FROM comunidad WHERE nom_empresa_comu = '".$companyGet."' AND mes_comunidad = '".$mesGet."'");
										$result_s = mysqli_fetch_array($sql);
									?>
                                    <i class="fab fa-spotify fa-4x"
                                        style="color: #1ED760; text-shadow: 0 5px 10px #1ED76070;"></i>
                                    <h6 class="mt-4 mb-2">Spotify</h6>
                                    <h2 class="mb-2  number-font" id="spotify">
                                        <?php echo number_format($result_s['0']);?></h2>
                                    <p class="text-muted d-none">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card">
									<div class="card-body text-center">
									<?php 
										$sql = mysqli_query($conexion, "SELECT * FROM comunidad WHERE nom_empresa_comu = '".$companyGet."' AND mes_comunidad = '".$mesGet."'");
										$result_w = mysqli_fetch_array($sql);
									?>
										<i class="fab fa-tiktok fa-4x " style="color: #010101; text-shadow: 0 -5px 10px rgba(105, 201, 208, 1), 0 8px 5px #EE1D52"></i>
										<h6 class="mt-4 mb-2">TikTok</h6>
										<h2 class="mb-2  number-font" id="waze"><?php echo number_format($result_w['datos_waze']);?></h2>
										<p class="text-muted d-none">Sed ut perspiciatis unde omnis accusantium doloremque</p>
									</div>
								</div>
							</div>
                    </div>

                    <div class="row">
                        <?php if ($rowUser['id_tipo'] == "1" || $rowUser['id_tipo'] == "2" || $rowUser['id_tipo'] == "3"): ?>

                        <div class="col-lg-12 col-sm-12 col-xl-12">
                            <div class="card" id="buscar_asesor">
                                <div class="card-header">
                                    <h3 class="card-title">Whatsapp</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="server/export-excel.php">
                                        <input type="hidden" name="companyexcelwhats"
                                            value="<?php echo $_GET['company']?>">

                                        <div class="input-daterange">
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="text" placeholder="Fecha de inicio"
                                                    onfocus="(this.type='date')" name="fecha_inicio"
                                                    id="fecha_inicio_whats" required>
                                                <?php echo $fecha_inicio_error; ?>
                                            </div>
                                            <div class="form-group col-md-6">

                                                <input class="form-control" type="text" placeholder="Fecha final"
                                                    onfocus="(this.type='date')" name="fecha_final_whats" required>
                                                <?php echo $fecha_final_error; ?>
                                            </div>
                                        </div>

                                        <button type="submit" name="action" value="generar_excel_whats"
                                            class="btn btn-pill btn-success-light ml-5"> <span
                                                class="fas fa-file-excel"></span> Generar reporte Excel</button>
                                        <?php if ($rowUser['id_tipo'] == "1"): ?>
                                        <button id="registrar" type="button"
                                            class="btn btn-pill btn-info-light btn-md mb-2" data-toggle="modal"
                                            data-target="#registrarTel"><span class='glyphicon glyphicon-plus'></span>
                                            Capturar</button>
                                        <?php else: ?>
                                        <?php endif; ?>
                                        <div class="mt-5">
                                            <label for="search_box">Realiza la busqueda de los leads <a
                                                    href="#buscar_asesor"><i id='popoverAsesor'
                                                        class='fas fa-exclamation-circle'
                                                        style='color:#ff0000;'></i></a></label>
                                            <input class="form-control mt-5" type="text" id="search_boxWa"
                                                name="search_boxWa" placeholder="Buscar...">
                                        </div>
                                    </form>
                                    <h2 class="text-center mb-3">Registro de leads por campañas WhatsApp</h2>
                                    <div class="table-responsive" id="dynamic_content_whatsapp"></div>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <?php endif; ?>

                        <!-- COL END -->
                        <!-- ROW-4 CLOSED -->

                        <!-- ROW-4 OPEN -->
                        <!-- <div class="row">
								<div class="col-lg-4 col-md-12 col-sm-12 col-xl-4">
									<div class="card">
										<div class="card-body">
											<h3 class="card-title">Followers by Gender</h3>
											<p class="text-muted mb-1">Total Followers</p>
											<h3 class="font-weight-semibold number-font mb-3">69,453</h3>
											<div class="progress grouped h-2">
												<div class="progress-bar w-25 bg-primary " role="progressbar"></div>
												<div class="progress-bar w-30 bg-danger" role="progressbar"></div>
											</div>
											<div class="row mt-3">
												<div class="col text-left">
													<p class=" number-font1 mb-0"><span class="dot-label bg-primary"></span>Males</p>
													<h5 class="mt-2 font-weight-semibold mb-0 number-font1">4,678</h5>
												</div>
												<div class="col text-left">
													<p class=" number-font1 mb-0"><span class="dot-label bg-danger"></span>Females</p>
													<h5 class="mt-2 font-weight-semibold mb-0 number-font1">2,784</h5>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-8 col-md-12 col-sm-12 col-xl-8">
									<div class="card">
										<div class="row">
											<div class="col-lg-7 border-right">
												<div class="card-body">
													<h3 class="card-title">Live Interactions</h3>
													<div class="d-flex">
														<p class="data-attributes mb-0 mr-4">
															<span data-peity='{ "fill": ["#447cec", "#e3e8f7"],   "innerRadius": 20, "radius": 24 }'>5/7</span>
														</p>
														<div>
															<p class="text-muted mb-1">Total Followers</p>
															<h3 class="font-weight-semibold number-font mb-2">69,453</h3>
														</div>
													</div>
													<div class="row mt-3 pt-3">
														<div class="col text-left">
															<p class=" mb-0">PageViews</p>
															<h5 class="mt-2 font-weight-semibold mb-0 number-font1">6,432</h5>
														</div>
														<div class="col text-left">
															<p class="  mb-0">VideoViews</p>
															<h5 class="mt-2 font-weight-semibold mb-0 number-font1">1,543</h5>
														</div>
														<div class="col text-left">
															<p class=" mb-0">E-mail Views</p>
															<h5 class="mt-2 font-weight-semibold mb-0 number-font1">3,643</h5>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-5">
												<div class="card-body">
													<h3 class="card-title">Live Campaigns</h3>
													<div class="d-flex">
														<p class="data-attributes mb-0 mr-4">
															<span data-peity='{ "fill": ["#1cc5ef", "#e3e8f7"],   "innerRadius": 20, "radius": 24 }'>3/7</span>
														</p>
														<div>
															<p class="text-muted mb-1">Total Completed</p>
															<h3 class="font-weight-semibold number-font mb-0">85%</h3>
														</div>
													</div>
													<div class="row mt-3 pt-3">
														<div class="col text-left">
															<p class=" mb-0">Expenditure</p>
															<h5 class="mt-2 font-weight-semibold mb-0 number-font1">$1,765</h5>
														</div>
														<div class="col text-left">
															<p class="  mb-0">Remaining</p>
															<h5 class="mt-2 font-weight-semibold mb-0 number-font1">$2,463</h5>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> -->
                        <!-- ROW-4 CLOSED -->
                    </div>
                    <!-- <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xl-12">
                            <?php if ($rowUser['id_tipo'] <> "3"): ?>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Presupuesto gastado por dÍa</h3>
                                </div>
                                <div class="card-body">
                                    <h2 class="text-center mb-3"></h2>
                                    <form method="post" action="server/export-excel.php">
                                        <input type="hidden" name="companyexcelgasto" value="<?php echo $_GET['company']?>">

                                        <div class="input-daterange">
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="text" placeholder="Fecha de inicio"
                                                    onfocus="(this.type='date')" name="fecha_inicio_gasto" id="fecha_inicio_gasto"
                                                    required>
                                                <?php echo $fecha_inicio_error; ?>
                                            </div>
                                            <div class="form-group col-md-6">

                                                <input class="form-control" type="text" placeholder="Fecha final"
                                                    onfocus="(this.type='date')" name="fecha_final_gasto" id="fecha_final_gasto" required>
                                                <?php echo $fecha_final_error; ?>
                                            </div>
                                        </div>

                                        <div class="form-group d-inline">
                                            <button type="submit" name="action" value="generar_excel_gasto"
                                                class="btn btn-pill btn-success-light ml-5"> <span
                                                    class="fas fa-file-excel"></span> Generar reporte Excel</button>
                                        </div>

                                        <div>
                                            <?php if ($rowUser['id_tipo'] == "1"): ?>
                                            <div class="form-group">
                                                <button id="registrar" type="button"
                                                    class="btn btn-pill btn-info-light btn-md mb-2" data-toggle="modal"
                                                    data-target="#registrarGasto"><span
                                                        class='glyphicon glyphicon-plus'></span> Registrar
                                                    gasto</button>
                                            </div>
                                            <?php else: ?>

                                            <?php endif; ?>
                                            <div class="form-group mt-5">
                                                <label for="search_box">Realiza la busqueda por campañas <a
                                                        href="#buscar_campaña"><i id='popoverBusqueda'
                                                            class='fas fa-exclamation-circle'
                                                            style='color:#ff0000;'></i></a></label>
                                                <input class="form-control" type="text" id="search_box"
                                                    name="search_box" placeholder="Buscar...">
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-responsive" id="dynamic_content_gastos"></div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div> -->

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

        <?php
            include "includes/footer.php"; 
            include "includes/modals.php";
		?>

        <?php if ($rowUser['id_tipo'] == "2"): ?>
        <!--POPUP-->
        <script>
        $(document).ready(function() {

            $('#popClientes').modal('show')
        });
        </script>

        <?php else: ?>

        <?php endif; ?>

        <!-- <?php 
            if ($mantenimiento == true) { 
        ?>
                <script>
                $(document).ready(function() {
        
                    $('#popMantenimiento').modal('show')
                });
                </script>
        <?php 
            }
        ?> -->

        <!-- <script src="js/app.js"></script> -->

        <!-- <h4>Busqueda</h1><p>Realiza la busqueda de tus campañas con los siguientes terminos: </p><ul><li>-Nuevos.</li><li>-Seminuevos.</li><li>-Servicio.</li><li>-Refacciones.</li><li>-Accesorios.</li><li>-Demo.</li>
					<li>-Seguros.</li></ul></h4><br> -->

        <script>
        var options = {
            content: '<h4>Busqueda</h1><p>Realiza la busqueda de tus campañas con los siguientes terminos: </p><ul><li>-Nuevos.</li><li>-Seminuevos.</li><li>-Servicio.</li><li>-Refacciones.</li><li>-Accesorios.</li><li>-Demo.</li><li>-Seguros.</li></ul></h4>',
            html: true,
            placement: 'right'
        };

        $('#popoverBusqueda').popover(options);

        /***** Dismiss all popovers by clicking outside  **************/

        $('html').on('click', function(e) {
            if (typeof $(e.target).data('original-title') == 'undefined') {
                $('[data-original-title]').popover('hide');
            }
        });
        </script>

        <script>
        var options = {
            content: '<h4>Busqueda</h4><p>Realiza la busqueda de tus leads de WhatsApp con el nombre del asesor.</p></h4>',
            html: true,
            placement: 'right'
        };

        $('#popoverAsesor').popover(options);

        /***** Dismiss all popovers by clicking outside  *****/

        $('html').on('click', function(e) {
            if (typeof $(e.target).data('original-title') == 'undefined') {
                $('[data-original-title]').popover('hide');
            }
        });
        </script>

        <script>
        var sesionstart = '<?php echo $idUsuario = $_SESSION['id_usuario']; ?>';
        var getid = '<?php echo $_GET['id']; ?>';
        var getcompany = '<?php echo $_GET['company']; ?>';
        var getmonth = '<?php echo $_GET['month']; ?>';
        var getyear = '<?php echo $_GET['year']; ?>';
        var datafacebook = '<?php echo $rowCumunidad['datos_facebook']?>';
        var dataInstagram = '<?php echo $rowCumunidad['datos_intagram']?>';
        var dataTwitter = '<?php echo $rowCumunidad['datos_twitter']?>';
        var dataGoogle = '<?php echo $rowCumunidad['datos_google']?>';
        var dataYoutube = '<?php echo $rowCumunidad['datos_youtube']?>';
        var dataLinkedin = '<?php echo $rowCumunidad['datos_linkedin']?>';
        var dataSpotify = '<?php echo $rowCumunidad['datos_spotify']?>';
        var dataWaze = '<?php echo $rowCumunidad['datos_waze']?>';
        // console.log(sesionstart);
        // console.log(getid);
        // console.log(getcompany);
        // console.log(getmonth);
        // console.log(datafacebook);

        $(document).ready(function() {

            load_data(1);

            function load_data(page, query = '') {
                $.ajax({
                    url: "server/buscar.php",
                    method: "POST",
                    data: {
                        page: page,
                        query: query,
                        id_campana: getid,
                        company: getcompany,
                        sesion: sesionstart,
                        mesactual: getmonth,
                        anioactual: getyear,
                        datosFacebook: datafacebook,
                        datosInstagram: dataInstagram,
                        datosTwitter: dataTwitter,
                        datosGoogle: dataGoogle,
                        datosYoutube: dataYoutube,
                        datosLinkedin: dataLinkedin,
                        datosSpotify: dataSpotify,
                        datosWaze: dataWaze
                    },
                    success: function(data) {
                        $('#dynamic_content').html(data);
                    }
                });
            }

            $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var query = $('#search_box').val();
                load_data(page, query);
            });

            $('#search_box').keyup(function() {
                var query = $('#search_box').val();
                load_data(1, query);
            });

        });
        </script>

        <script>
        var sesionstartWa = '<?php echo $idUsuario = $_SESSION['id_usuario']; ?>';
        var getidWa = '<?php echo $_GET['id']; ?>';
        var getcompanyWa = '<?php echo $_GET['company']; ?>';
        var getmonthWa = '<?php echo $_GET['month']; ?>';
        var getyearWa = '<?php echo $_GET['year']; ?>';

        $(document).ready(function() {

            load_data(1);

            function load_data(pageWa, queryWa = '') {
                $.ajax({
                    url: "server/buscar-whatsapp.php",
                    method: "POST",
                    data: {
                        pageWa: pageWa,
                        queryWa: queryWa,
                        id_campanaWa: getidWa,
                        companyWa: getcompanyWa,
                        sesionWa: sesionstartWa,
                        mesactualWa: getmonthWa,
                        anioactualWa: getyearWa
                    },
                    success: function(dataWa) {
                        $('#dynamic_content_whatsapp').html(dataWa);
                    }
                });
            }

            $(document).on('click', '.page-link', function() {
                var pageWa = $(this).data('page_number');
                var queryWa = $('#search_boxWa').val();
                load_data(pageWa, queryWa);
            });

            $('#search_boxWa').keyup(function() {
                var queryWa = $('#search_boxWa').val();
                load_data(1, queryWa);
            });

        });
        </script>

        <script>
        var sesionstartCom = '<?php echo $idUsuario = $_SESSION['id_usuario']; ?>';
        var getidCom = '<?php echo $_GET['id']; ?>';
        var getcompanyCom = '<?php echo $_GET['company']; ?>';
        var getmonthCom = '<?php echo $_GET['month']; ?>';
        var getyearCom = '<?php echo $_GET['year']; ?>';

        $(document).ready(function() {

            load_data(1);

            function load_data(pageCom, queryCom = '') {
                $.ajax({
                    url: "server/buscar-comunidad.php",
                    method: "POST",
                    data: {
                        pageCom: pageCom,
                        queryCom: queryCom,
                        id_campanaCom: getidCom,
                        companyCom: getcompanyCom,
                        sesionCom: sesionstartCom,
                        mesactualCom: getmonthCom,
                        anioactualCom: getyearCom
                    },
                    success: function(dataCom) {
                        $('#dynamic_content_comunidad').html(dataCom);
                    }
                });
            }

            $(document).on('click', '.page-link', function() {
                var pageCom = $(this).data('page_number');
                var queryCom = $('#search_box').val();
                load_data(pageCom, queryCom);
            });
        });
        </script>

        <!-- <script>
        var sesionstartGasto = '<?php echo $idUsuario = $_SESSION['id_usuario']; ?>';
        var getidGasto = '<?php echo $_GET['id']; ?>';
        var getcompanyGasto = '<?php echo $_GET['company']; ?>';
        var getmonthGasto = '<?php echo $_GET['month']; ?>';
        var getyearGasto = '<?php echo $_GET['year']; ?>';

        $(document).ready(function() {

            load_data(1);

            function load_data(pageGasto, queryGasto = '') {
                $.ajax({
                    url: "server/buscar-gastos.php",
                    method: "POST",
                    data: {
                        pageGasto: pageGasto,
                        queryGasto: queryGasto,
                        id_gasto: getidGasto,
                        companyGasto: getcompanyGasto,
                        sesionGasto: sesionstartGasto,
                        mesactualGasto: getmonthGasto,
                        anioactualGasto: getyearGasto
                    },
                    success: function(dataGasto) {
                        $('#dynamic_content_gastos').html(dataGasto);
                    }
                });
            }

            $(document).on('click', '.page-link', function() {
                var pageGasto = $(this).data('page_number');
                var queryGasto = $('#search_boxGasto').val();
                load_data(pageGasto, queryGasto);
            });

            $('#search_boxGasto').keyup(function() {
                var queryGasto = $('#search_boxGasto').val();
                load_data(1, queryGasto);
            });

        });
        </script> -->