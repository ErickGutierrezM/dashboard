<?php

    require '../secretInfo/conexion_BD.php';
    require '../secretInfo/funciones.php';

	session_start();

	if(isset($_SESSION["id_usuario"])) {
		header("Location: /index.php?pagina=1");
	}

	$errors = array();

	if(!empty($_POST))
	{
		$email = $conexion->real_escape_string($_POST['email']);

		if(!isEmail($email))
		{
			$errors[] = "Debes ingresar un correo electrónico válido!";
		}

		if(emailExiste($email))
		{
            $code = rand(999999, 111111);

            $insert_code = "UPDATE usuarios SET code = '".$code."' WHERE email = '".$email."'";
            $run_query =  mysqli_query($conexion, $insert_code);

            if($run_query) {
                $subject = "Codigo para restablecer contraseña Galleta MKT";
                $message = "Tu codigo es: $code";
                $sender = "From: noreply@galletamkt.com";

                if(mail($email, $subject, $message, $sender)) {
                    $info = "Hemos enviado un codigo para restablecer tu contraseña al correo electrónico propocionado - <strong>$email</strong>";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    $_SESSION['code'] = $code;

                    header('location: reset.php');
                    exit;
                }
                else{
                    $errors[] = "Error al enviar el código!";
                }
            }
            else {
                $errors[] = "Algo salió mal, intenta de nuevo!";
            }
		}
		else {
			$errors[] = "La dirección de correo electrónico no existe!";
		}
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-TileColor" content="#162946">
    <meta name="theme-color" content="#e67605">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/favicon.png" />

    <!-- TITLE -->
    <title>Olvido contraseña | GalletaMKT</title>

    <!-- BOOTSTRAP CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/skin-modes.css" rel="stylesheet" />
    <link href="../assets/css/dark-style.css" rel="stylesheet" />

    <!-- INTERNAL SINGLE-PAGE CSS -->
    <link href="../assets/plugins/single-page/css/main.css" rel="stylesheet" type="text/css">

    <!-- CUSTOM SCROLL BAR CSS-->
    <link href="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="../assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="../assets/colors/color1.css" />
    <script src="https://kit.fontawesome.com/1d7dc8a672.js" crossorigin="anonymous"></script>

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
            <!-- Mensajes-confirmacion -->
            <?php if (isset($_GET['restablecido_ok'])): ?>
            <div class="alert alert-success alert-dismissible fade show text-center mx-auto" role="alert"
                style="width:75%;">
                <strong>¡Genial!</strong> Se a restablecido con exito tu nueva contraseña, ya puedes seguir disfrutando
                de QuizGram.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>
            <?php echo resultBlock($errors); ?>
            <!-- CONTAINER OPEN -->
            <div class="container-login100">
                <div class="wrap-login100 p-6">
                    <div class="col col-login mx-auto">
                        <div class="text-center">
                            <img src="../assets/images/brand/galleta-logo-2.svg" class="header-brand-img" alt="">
                        </div>
                    </div>
                    <form class="login100-form validate-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <h4 class="text-center">Olvidaste tu contraseña</h4>
                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="email" name="email" placeholder="Introduce tu email" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
                                    <path
                                        d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
                                </svg>
                            </span>
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn btn-primary" type="submit">Continuar</button>
                        </div>
                        <div class="text-center pt-3">
                            <div class="text-primary text-center"><a href="login.php" class="text-primary"><i class="fas fa-long-arrow-alt-left"></i> Regresar</a></div>
                        </div>
                    </form>
                </div>
                <!-- <?php //echo resultBlock($errors); ?> -->
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="../assets/js/jquery-3.4.1.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>

    <!-- SPARKLINE JS -->
    <script src="../assets/js/jquery.sparkline.min.js"></script>

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