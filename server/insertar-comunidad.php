<?php 
    require "../secretInfo/conexion_BD.php";
    include_once "../secretInfo/funciones.php";
    

    if (isset($_POST['insertComunidad'])) {
        
        $idComuAdd = $_POST['id_campana'];
        $empresaComuAdd = $_POST['nom_empresa'];
        $facebookAdd = $_POST['facebookAdd'];
        $instagramAdd = $_POST['instagramAdd'];
        $twitterAdd = $_POST['twitterAdd'];
       // $googleAdd = $_POST['googleAdd'];
        $youtubeAdd = $_POST['youtubeAdd'];
        $linkedAdd = $_POST['linkedAdd'];
        $spotifyAdd = $_POST['spotifyAdd'];
        $tiktokAdd = $_POST['tiktokAdd'];
        date_default_timezone_set("America/Mexico_City");
        // $mesActualAdd = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
        $mesActualAdd = $_POST['mes_empresa'];
        $anioActualAdd = $_POST['anio_empresa'];


       // $query = mysqli_query($conexion, "INSERT INTO comunidad (id_campana_comu, nom_empresa_comu, datos_facebook, datos_intagram, datos_twitter, datos_google, datos_youtube, datos_linkedin, datos_spotify, datos_waze ,mes_comunidad) 
       // VALUES ('".$idComuAdd."', '".$empresaComuAdd."', '".$facebookAdd."', '".$instagramAdd."', '".$twitterAdd."' , '".$googleAdd."', '".$youtubeAdd."' ,'".$linkedAdd."', '".$spotifyAdd."', '".$wazeAdd."', '".$mesActualAdd."')");

        $query = mysqli_query($conexion, "INSERT INTO comunidad (id_campana_comu, nom_empresa_comu, datos_facebook, datos_intagram, datos_twitter, datos_youtube, datos_linkedin, datos_spotify, datos_tiktok ,mes_comunidad) 
        VALUES ('".$idComuAdd."', '".$empresaComuAdd."', '".$facebookAdd."', '".$instagramAdd."', '".$twitterAdd."' , '".$youtubeAdd."' ,'".$linkedAdd."', '".$spotifyAdd."','".$tiktokAdd."', '".$mesActualAdd."')");

        if ($query)
        {
            header('Location: ../cliente.php?id='.$idComuAdd.'&company='.$empresaComuAdd.'&month='.$mesActualAdd.'&year='.$anioActualAdd);
            echo "OK";
        }
        else
        {
            echo "ERROR: ".mysqli_error($conexion);
        }
    }

?>