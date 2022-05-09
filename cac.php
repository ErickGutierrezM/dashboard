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

.v-divider {
    margin-left: 5px;
    margin-right: 5px;
    width: 1px;
    height: 100%;
    border-left: 1px solid gray;
}
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
                            <h1 class="page-title">CAC</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php?pagina=1">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">CAC</li>
                            </ol>
                        </div>
                        <!-- <div class="ml-auto pageheader-btn">
						<a href="#" class="btn btn-primary btn-icon text-white mr-2">
							<span>
								<i class="fe fe-shopping-cart"></i>
							</span> Add Order
						</a>
						<a href="#" class="btn btn-secondary btn-icon text-white">
							<span>
								<i class="fe fe-plus"></i>
							</span> Add User
						</a>
					</div> -->
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- ROW-1 OPEN -->
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xl-12">
                            <?php if ($rowUser['id_tipo'] <> "3"): ?>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Presupuesto invertido por dÍa</h3>
                                </div>
                                <div class="card-body">
                                    <h2 class="text-center mb-3"></h2>
                                    <form method="post" action="server/export-excel.php">
                                        <input type="hidden" name="companyexcelgasto"
                                            value="<?php echo $_GET['company']?>">

                                        <div class="input-daterange">
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="text" placeholder="Fecha de inicio"
                                                    onfocus="(this.type='date')" name="fecha_inicio_gasto"
                                                    id="fecha_inicio_gasto" required>
                                                <?php echo $fecha_inicio_error; ?>
                                            </div>
                                            <div class="form-group col-md-6">

                                                <input class="form-control" type="text" placeholder="Fecha final"
                                                    onfocus="(this.type='date')" name="fecha_final_gasto"
                                                    id="fecha_final_gasto" required>
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
                                            <!-- <div class="form-group mt-5">
                                                <label for="search_box">Realiza la busqueda por campañas <a
                                                        href="#buscar_campaña"><i id='popoverBusqueda'
                                                            class='fas fa-exclamation-circle'
                                                            style='color:#ff0000;'></i></a></label>
                                                <input class="form-control" type="text" id="search_box"
                                                    name="search_box" placeholder="Buscar...">
                                            </div> -->
                                        </div>
                                    </form>
                                    <div class="table-responsive" id="dynamic_content_gastos"></div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- ROW-1 CLOSED -->
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="error_msg-7"></div>
                                    <div id="line_chart-7" style="min-height: 500px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xl-12">
                            <?php if ($rowUser['id_tipo'] <> "3"): ?>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Costo por lead diario</h3>
                                </div>
                                <div class="card-body">
                                    <h2 class="text-center mb-3"></h2>
                                    <form method="post" action="server/export-excel.php">
                                        <input type="hidden" name="companyexceltotal"
                                            value="<?php echo $_GET['company']?>">

                                        <div class="input-daterange">
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="text" placeholder="Fecha de inicio"
                                                    onfocus="(this.type='date')" name="fecha_inicio_total"
                                                    id="fecha_inicio_total" required>
                                                <?php echo $fecha_inicio_error; ?>
                                            </div>
                                            <div class="form-group col-md-6">

                                                <input class="form-control" type="text" placeholder="Fecha final"
                                                    onfocus="(this.type='date')" name="fecha_final_total"
                                                    id="fecha_final_total" required>
                                                <?php echo $fecha_final_error; ?>
                                            </div>
                                        </div>

                                        <div class="form-group d-inline">
                                            <button type="submit" name="action" value="generar_excel_total"
                                                class="btn btn-pill btn-success-light ml-5"> <span
                                                    class="fas fa-file-excel"></span> Generar reporte Excel</button>
                                        </div>

                                    </form>
                                    <div class="table-responsive" id="dynamic_content_total"></div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="error_msg-8"></div>
                                    <div id="line_chart-8" style="min-height: 500px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>


        <!-- FOOTER -->
        <?php
			include_once "includes/footer.php"; 
            include_once "includes/modals.php";
        ?>
        <!-- FOOTER CLOSED -->

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
    </div>

    <!--POPUP-->
    <!-- <?php if ($rowUser['id_tipo'] == "2"): ?>
    <script>
    $(document).ready(function() {

        $('#myModal').modal('show')
    });
    </script>

    <?php else: ?>

    <?php endif; ?> -->

    <script>
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
    </script>
    
    <script>
    var sesionstartTotal = '<?php echo $idUsuario = $_SESSION['id_usuario']; ?>';
    var getidTotal = '<?php echo $_GET['id']; ?>';
    var getcompanyTotal = '<?php echo $_GET['company']; ?>';
    var getmonthTotal = '<?php echo $_GET['month']; ?>';
    var getyearTotal = '<?php echo $_GET['year']; ?>';

    $(document).ready(function() {

        load_data(1);

        function load_data(pageTotal, queryTotal = '') {
            $.ajax({
                url: "server/buscar-total-gasto.php",
                method: "POST",
                data: {
                    pageTotal: pageTotal,
                    queryTotal: queryTotal,
                    idTotal: getidTotal,
                    companyTotal: getcompanyTotal,
                    sesionTotal: sesionstartTotal,
                    mesactualTotal: getmonthTotal,
                    anioactualTotal: getyearTotal
                },
                success: function(dataTotal) {
                    $('#dynamic_content_total').html(dataTotal);
                }
            });
        }

        $(document).on('click', '.page-link', function() {
            var pageTotal = $(this).data('page_number');
            var queryTotal = $('#search_boxTotal').val();
            load_data(pageTotal, queryTotal);
        });

        $('#search_boxTotal').keyup(function() {
            var queryTotal = $('#search_boxTotal').val();
            load_data(1, queryTotal);
        });

    });
    </script>


</body>