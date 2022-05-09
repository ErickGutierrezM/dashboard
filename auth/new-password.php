<?php

    require '../secretInfo/conexion_BD.php';
    require '../secretInfo/funciones.php';

    session_start();

	if(!isset($_SESSION['email'])) {
        header('Location: login.php');
    }

    if(isset($_POST['change-password'])) {
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($conexion, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conexion, $_POST['cpassword']);

        if(isNullPass($password, $cpassword)) {
            $errors[] = "Debes llenar todos los campos!";
        }
        
        else {
            if(validaPassword($password, $cpassword)) {
                $code = '';
                $email = $_SESSION['email'];
                $encpass = password_hash($password, PASSWORD_BCRYPT);
                $update_pass = "UPDATE usuarios SET code = '".$code."', password = '".$encpass."' WHERE email = '".$email."'";
                $run_query = mysqli_query($conexion, $update_pass);
                if($run_query){
                    // $info = "Your password changed. Now you can login with your new password.";
                    // $_SESSION['info'] = $info;
                    unset($_SESSION['email']);
                    header('Location: login.php?changed');
                    exit;
                }
                else {
                    $errors[] = "No se pudo cambiar su contraseña!";
                }
            }
            else {
                $errors[] = "Las contraseñas no coinciden!";
            }
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
    <title>Cambia tu contraseña | GalletaMKT</title>

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

                        <!-- <span class="login100-form-title">
									Inicia sesion
								</span> -->
                        <h4 class="text-center">Cambia tu contraseña</h4>
                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" type="password" name="password" id="password"
                                placeholder="Crea tu nueva contraseña">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" type="password" name="cpassword" id="cpassword"
                                placeholder="Repite tu Contraseña">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn btn-primary" type="submit" name="change-password" id="change-password">Continuar</button>
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