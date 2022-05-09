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
                            <h1 class="page-title">Historico</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php?pagina=1">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Historico</li>
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
                        <div class="col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="error_msg"></div>
                                    <div id="line_chart" style="min-height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="error_msg-2"></div>
                                    <div id="line_chart-2" style="min-height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="error_msg-3"></div>
                                    <div id="line_chart-3" style="min-height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="error_msg-4"></div>
                                    <div id="line_chart-4" style="min-height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="error_msg-5"></div>
                                    <div id="line_chart-5" style="min-height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="error_msg-6"></div>
                                    <div id="line_chart-6" style="min-height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="error_msg-9"></div>
                                    <div id="line_chart-9" style="min-height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ROW-1 CLOSED -->

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


</body>