<?php

    require '../secretInfo/conexion_BD.php';
    require '../secretInfo/funciones.php';

    session_start();

	if(!isset($_SESSION['email'])) {
        header('Location: login.php');
    }


    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        
        $code = $_SESSION['code'];

        $otp_code = mysqli_real_escape_string($conexion, $_POST['otp']);
        
        $check_code = "SELECT * FROM usuarios WHERE code = '".$otp_code."'";
        $code_res = mysqli_query($conexion, $check_code);

        if(mysqli_num_rows($code_res) > 0) {

            $fetch_data = mysqli_fetch_assoc($code_res);

            if ($code == $fetch_data['code'])
            {
                $email = $fetch_data['email'];
                $_SESSION['email'] = $email;

                $info = "Por favor crea una nueva contraseña.";
                $_SESSION['info'] = $info;
            
                header('location: new-password.php?email='.$email.'');
                exit();
            }
            else {
                $errors[] = "Ingresaste un código incorrecto!";
            }
        }
        else{
            $errors[] = "Hubo un error!";
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
    <title>Verificación de código | GalletaMKT</title>

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

            <?php if ($_SESSION['info'] != ''): ?>
            <div class="alert alert-success alert-dismissible fade show text-center mx-auto" role="alert"
                style="width:75%;">
                <!-- <strong>¡Genial!</strong> Para terminar el proceso de registro sigue las instrucciones que le hemos enviado a la direccion de correo electronico proporcionada. -->
                <?php echo $_SESSION['info']; ?>
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
                        <h4 class="text-center">Verificación de código</h4>

                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="number" name="otp" id="otp" placeholder=" ">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fas fa-shield-alt"></i>
                            </span>
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn btn-primary" type="submit" name="check-reset-otp" id="check-reset-otp">Continuar</button>
                        </div>
                        <div class="text-center pt-3">
                            <div class="text-primary text-center"><a href="forgot-password.php" class="text-primary"><i class="fas fa-long-arrow-alt-left"></i> Regresar</a></div>
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