
<?php

	require '../secretInfo/conexion_BD.php';
	require '../secretInfo/funciones.php';

	$errors = array();

	if(!empty ($_POST))
	{
		$nombre = $conexion->real_escape_string($_POST['nombre']);
		$apellido = $conexion->real_escape_string($_POST['apellido']);
		$email = $conexion->real_escape_string($_POST['email']);
		$nombre_empresa = $conexion->real_escape_string($_POST['nombre_empresa']);
		$password = $conexion->real_escape_string($_POST['password']);
		$r_password = $conexion->real_escape_string($_POST['r_password']);

		$activo = 1;
		//$tipo_usuario = $_POST['rol'];
		$tipo_usuario = 2;
		
		if(isNull($nombre, $apellido, $email, $nombre_empresa, $password, $r_password))
		{
			$errors[] = "Debe llenar todos los campos";
		}

		if(!isEmail($email))
		{
			$errors[] = "Dirección de correo inválida";
		}

		if(!validaPassword($password, $r_password))
		{
			$errors[] = "Las contraseñas no coinciden";
		}

		if(usuarioExiste($nombre_empresa))
		{
			$errors[] = "La empresa $nombre_empresa ya existe";
		}

		if(emailExiste($email))
		{
			$errors[] = " El email $email ya existe";
		}

		if(count($errors) == 0) {
			$pass_hash = hashPassword($password);
			//$token = generateToken();
			
			$registro = registraUsuario($nombre, $pass_hash, $apellido, $email, $nombre_empresa, $activo, $tipo_usuario);
			
			if($registro > 0) {
						// $url = 'http://'.$_SERVER["SERVER_NAME"].'/dashboard/auth/activar.php?id='.$registro.'&val='.$token;

						// $asunto = 'Activar Cuenta - GalletaMKT';
						// $cuerpo = "Hola $nombre $apellido <br/><br/> Gracias por registrarte a QuizGram. Para finalizar el proceso de registro, es necesario dar click en el siguiente enlace: <a href='$url'>Activar Cuenta</a>";

						// if(enviarEmail($email, $nombre, $asunto, $cuerpo)) {
						// 	header('Location: /quizgram/dashboard/auth/login.php?registro_ok'); // borrar quizgram en goddady
						// 	exit;
						// }
						// else {
						// 	$erros[] = "Error al enviar Email";
						// }
                        echo "<script>window.location.href='login.php?registro_ok';</script>";
                        exit;			
					}
			else
			{
				$errors[] = "Error al Registrar";
			}

		}

    }
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
	<!-- META DATA -->
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Panel de administracion">
	<meta name="author" content="Galleta Marketing Digital">
	<meta name="keywords" content="">

	<!-- FAVICON -->
	<link rel="shortcut icon" type="image/x-icon" href="../assets/favicon.png" />

	<!-- TITLE -->
	<title>Registro | GalletaMKT</title>

	<!-- BOOTSTRAP CSS -->
	<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

	<!-- STYLE CSS -->
	<link href="../assets/css/style.css" rel="stylesheet"/>
	<link href="../assets/css/skin-modes.css" rel="stylesheet"/>
	<link href="../assets/css/dark-style.css" rel="stylesheet"/>

	<!-- INTERNAL SINGLE-PAGE CSS -->
	<link href="../assets/plugins/single-page/css/main.css" rel="stylesheet" type="text/css">

	<!-- CUSTOM SCROLL BAR CSS-->
	<link href="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet"/>

	<!--- FONT-ICONS CSS -->
	<link href="../assets/css/icons.css" rel="stylesheet"/>

	<!-- COLOR SKIN CSS -->
	<link id="theme" rel="stylesheet" type="text/css" media="all" href="../assets/colors/color1.css" />

</head>

	<style>
		.btn-primary {
			background: #bb5236 !important;
		}
		.text-primary {
			color: #bb5236 !important;
		}
		.header-brand-img {
			height: 5rem !important;
			padding-bottom: 2rem;
		}
	</style>

	<body class="app sidebar-mini">
		<!-- BACKGROUND-IMAGE -->
		<div class="login-img">
			<!-- GLOABAL LOADER -->
			<div id="global-loader">
				<img src="../assets/images/loader.svg" class="loader-img" alt="Loader">
			</div>
			<!-- /GLOABAL LOADER -->
			<!-- PAGE -->
			<div class="page">
				<?php echo resultBlock($errors); ?>
				    <!-- CONTAINER OPEN -->
					<div class="container-login100">
						<div class="wrap-login100 p-6">
							<form class="login100-form validate-form" action="" method="post">
							<div class="col col-login mx-auto">
							<div class="text-center">
								<img src="../assets/images/brand/galleta-logo-2.svg" class="header-brand-img" alt="logo">
							</div>
						</div>
								<!-- <span class="login100-form-title">
									Registrate
								</span> -->
								<div class="wrap-input100 validate-input" >
									<input class="input100" type="text" name="nombre" placeholder="Nombre">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fas fa-user"></i>
									</span>
								</div>
								<div class="wrap-input100 validate-input">
									<input class="input100" type="text" name="apellido" placeholder="Apellidos">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fas fa-user"></i>
									</span>
								</div>
								<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
									<input class="input100" type="email" name="email" id="email" placeholder="Correo Electrónico">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fas fa-envelope"></i>									
									</span>
								</div>
								<div class="wrap-input100 validate-input">
									<input class="input100" type="text" name="nombre_empresa" id="nombre_empresa" placeholder="Nombre de la empresa">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fas fa-briefcase"></i>
									</span>
								</div>
								<div class="wrap-input100 validate-input" data-validate = "Password is required">
									<input class="input100" type="password" name="password" id="password" placeholder="Contraseña">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fas fa-lock"></i>									
									</span>
								</div>
								<div class="wrap-input100 validate-input" data-validate = "Password is required">
									<input class="input100" type="password" name="r_password" id="r_password" placeholder="Repite tu Contraseña">
									<span class="focus-input100"></span>
									<span class="symbol-input100">	
										<i class="fas fa-lock"></i>									
									</span>
								</div>
								<!-- <label class="custom-control custom-checkbox mt-4">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label">Aceptas los <a href="terms.html">terminos y condiciones</a></span>
								</label> -->
								<div class="container-login100-form-btn">
									<button class="login100-form-btn btn-primary" type="submit" name="submit" value="Registrarse">Registrar</button>
								</div>
								<div class="text-center pt-3">
									<p class="text-dark mb-0">¿Ya tienes una cuenta?<a href="login.php" class="text-primary ml-1">Iniciar Sesi&oacute;n</a></p>
								</div>
								<!-- <div class=" flex-c-m text-center mt-3">
								    <p>Or</p>
									<div class="social-icons">
										<ul>
											<li><a class="btn  btn-social btn-block btn-google"><i class="fa fa-google-plus"></i> Sign up with Google</a></li>
											<li><a class="btn  btn-social btn-block mt-2 btn-facebook"><i class="fa fa-facebook"></i> Sign in with Facebook</a></li>
										</ul>
									</div>
								</div> -->
							</form>
						</div>
					</div>
					<!-- CONTAINER CLOSED -->
			</div>
			<!-- END PAGE -->

		</div>
		<!-- BACKGROUND-IMAGE CLOSED -->

		<!-- FONTAWESOME -->
		<script src="https://kit.fontawesome.com/1d7dc8a672.js" crossorigin="anonymous"></script>
		<!-- JQUERY JS -->
		<script src="../assets/js/jquery-3.4.1.min.js"></script>

		<!-- BOOTSTRAP JS -->
		<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="../assets/plugins/bootstrap/js/popper.min.js"></script>

		<!-- CHART-CIRCLE JS -->
		<script src="../assets/js/circle-progress.min.js"></script>

		<!-- RATING STAR JS -->
		<script src="../assets/plugins/rating/jquery.rating-stars.js"></script>

		<!-- EVA-ICONS JS -->
		<script src="../assets/iconfonts/eva.min.js"></script>

		<!-- INPUT MASK JS -->
		<script src="../assets/plugins/input-mask/jquery.mask.min.js"></script>

		<!-- CUSTOM SCROLL BAR JS-->
		<script src="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

		<!-- CUSTOM JS-->
		<script src="../assets/js/custom.js"></script>

	</body>
</html>
