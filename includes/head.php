<?php 

	$sqlSidebar = mysqli_query($conexion, "SELECT * FROM campanas WHERE admin_usuario LIKE '%;".$rowUser['id'].";%'");
	$rowSide = mysqli_fetch_array($sqlSidebar);

?>

<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Marketing Dashboard - GalletaMKT">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/favicon.png" />

    <!-- TITLE -->
    <title>Dashboard | GalletaMKT</title>

    <!-- BOOTSTRAP CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/skin-modes.css" rel="stylesheet" />
    <link href="assets/css/dark-style.css" rel="stylesheet" />

    <!-- SIDE-MENU CSS -->
    <link href="assets/css/closed-sidemenu.css" rel="stylesheet">

    <!--PERFECT SCROLL CSS-->
    <link href="assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

    <!-- CUSTOM SCROLL BAR CSS-->
    <link href="assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="assets/css/icons.css" rel="stylesheet" />

    <!-- SIDEBAR CSS -->
    <link href="assets/plugins/sidebar/sidebar.css" rel="stylesheet">

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="assets/colors/color1.css" />

    <!-- Lightbox.js -->
    <link href="assets/css/lightbox.css" rel="stylesheet">

    <!-- Datepicker bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
        rel="stylesheet" />

    <!-- Bootstrap-select -->
    <link href="assets/plugins/bootstrap-select/bootstrap-select.css" rel="stylesheet">

    <!-- Google charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <?php 
        include "graficas.php";
        include "includes/modal-ajax.php";
    ?>
</head>

<?php if ($rowUser['id_tipo'] == "2"): ?>
    <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5f9c53877f0a8e57c2d88754/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
    </script>

<?php else: ?>

<?php endif; ?>


<style>
body *::-webkit-scrollbar {
    width: 16px;
    height: 15px;
    transition: .3s background;
    /* width of the entire scrollbar */
}

body *::-webkit-scrollbar-track {
    background: #f1f1f1;
    /* color of the tracking area */
}

body *::-webkit-scrollbar-thumb {
    background-color: rgb(198 81 51 / 75%)    
    /* color of the scroll thumb */
    /* border-radius: 30px;
    border: 3px #f1f1f1; */
}

/* Works on Firefox */
* {
    scrollbar-width: auto;
    scrollbar-color: #c65133 #f1f1f1;
}

/* Works on Chrome, Edge, and Safari */
*::-webkit-scrollbar {
    width: 16px;
}

*::-webkit-scrollbar-track {
    background: #f1f1f1;
}

*::-webkit-scrollbar-thumb {
    background-color: rgb(198 81 51 / 75%)
    /* border-radius: 20px;
    border: 3px #f1f1f1; */
}
</style>

<style>

/* Reset styles bootstrap-select */
.bootstrap-select .dropdown-menu li a span.text {
    color: #000000;
}

.bootstrap-select .dropdown-toggle:focus,
.bootstrap-select>select.mobile-device:focus+.dropdown-toggle {
    outline: none !important;
    outline: none !important;
    outline-offset: unset !important;
}

.btn-light {
    color: #495057;
    background-color: #ffffff;
}

.btn-light:hover {
    color: #495057;
    background-color: #ffffff;
}

.btn-light:not(:disabled):not(.disabled):active,
.btn-light:not(:disabled):not(.disabled).active,
.show>.btn-light.dropdown-toggle {
    color: #495057;
    background-color: #ffffff;
}

.icon-addon .form-control,
.icon-addon .form-control {
    padding-left: 30px;
    float: left;
    font-weight: normal;
}

.icon-addon .glyphicon,
.icon-addon .glyphicon, 
.icon-addon .fas,
.icon-addon .fas {
    color: #8499c4;
    position: absolute;
    z-index: 2;
    left: 10px;
    font-size: 14px;
    width: 20px;
    margin-left: -2.5px;
    text-align: center;
    padding: 12px 0;
    top: 29.5px;
}

.icon-addon {
    position: relative;
    display: block;
}

.icon-addon:after,
.icon-addon:before {
    display: table;
    content: " ";
}

.icon-addon:after {
    clear: both;
}

.icon-addon .form-control:focus + .glyphicon,
.icon-addon:hover .glyphicon,
.icon-addon .form-control:focus + .fas,
.icon-addon:hover .fas {
    color: #c65133;
}

</style>