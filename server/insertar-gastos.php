<?php 

    require "../secretInfo/conexion_BD.php";
    include_once "../secretInfo/funciones.php";
    

    if (isset($_POST['insertGasto'])) {
        
        $idCampanaGasto = $_POST['id_campana'];
        $empresaGasto = $_POST['nom_empresa'];

        $fechaGasto = $_POST['fechaGasto'];
        $presuGastoFace = $_POST['presuGastoFace'];
        $presuGastoInsta = $_POST['presuGastoInsta'];
        $presuGastoGoog = $_POST['presuGastoGoog'];
        $presuGastoLink = $_POST['presuGastoLink'];
        $presuGastoWaze = $_POST['presuGastoWaze'];
        $presuGastoTik = $_POST['presuGastoTik'];
        $presuGastoSpoti = $_POST['presuGastoSpoti'];

        $leadsGastoFace = $_POST['leadsGastoFace'];
        $leadsGastoInsta = $_POST['leadsGastoInsta'];
        $leadsGastoGoog = $_POST['leadsGastoGoog'];
        $leadsGastoLink = $_POST['leadsGastoLink'];
        $leadsGastoWaze = $_POST['leadsGastoWaze'];
        $leadsGastoTik = $_POST['leadsGastoTik'];
        $leadsGastoSpoti = $_POST['leadsGastoSpoti'];

        date_default_timezone_set("America/Mexico_City");
        $fecha = date('Y-m-d H:i:s');
        $mesActualGasto = $_POST['mes_empresa'];
        $anioActualGasto = $_POST['anio_empresa'];

        $query = mysqli_query($conexion, "INSERT INTO presupuesto_gastado (empresa_gasto, dia_gasto, facebook_gasto, instagram_gasto, google_gasto, linkedin_gasto, waze_gasto, tiktok_gasto, spotify_gasto, leads_gasto_face, leads_gasto_insta, leads_gasto_goog, leads_gasto_link, leads_gasto_waze, leads_gasto_tik, leads_gasto_spoti, fecha_creado_gasto, ultima_actualizacion_gasto) 
        VALUES ('".$empresaGasto."', '".$fechaGasto."', '". $presuGastoFace."', '".$presuGastoInsta."', '".$presuGastoGoog."', '".$presuGastoLink."', '".$presuGastoWaze."', '".$presuGastoTik."', '".$presuGastoSpoti."','".$leadsGastoFace."', '".$leadsGastoInsta."', '".$leadsGastoGoog."', '".$leadsGastoLink."', '".$leadsGastoWaze."', '".$leadsGastoTik."', '".$leadsGastoSpoti."', '".$fecha."', '".$fecha."')");

        if ($query)
        {
            header('Location: ../cac.php?id='.$idCampanaGasto.'&company='.$empresaGasto.'&month='.$mesActualGasto.'&year='.$anioActualGasto);
            echo "OK";
        }
        else
        {
            echo "ERROR: ".mysqli_error($conexion);
        }
    }

?>