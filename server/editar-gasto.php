<?php 
    session_start();
    require "../secretInfo/conexion_BD.php";
    include_once "../secretInfo/funciones.php";

    if (isset($_POST['updatedata_gasto_edit'])) {

        $idGastoEdit = $_POST['update_id_gasto_edit'];
        $idclienteGastoEdit = $_POST['id_gasto_edit'];
        $empresaGastoEdit = $_POST['nom_empre_gasto_edit'];
        $fechaGastoEdit = $_POST['fechaGastoEdit'];
        $presuGastoFaceEdit = str_replace("$", "", $_POST['presuGastoFaceEdit']);
        $presuGastoInstaEdit = str_replace("$", "",$_POST['presuGastoInstaEdit']);
        $presuGastoGoogEdit = str_replace("$", "",$_POST['presuGastoGoogEdit']);
        $presuGastoLinkEdit = str_replace("$", "",$_POST['presuGastoLinkEdit']);
        $presuGastoWazeEdit = str_replace("$", "",$_POST['presuGastoWazeEdit']);
        $presuGastoTikEdit = str_replace("$", "",$_POST['presuGastoTikEdit']);
        $presuGastoSpotiEdit = str_replace("$", "",$_POST['presuGastoSpotiEdit']);

        $leadsGastoFaceEdit = $_POST['leadsGastoFaceEdit'];
        $leadsGastoInstaEdit = $_POST['leadsGastoInstaEdit'];
        $leadsGastoGoogEdit = $_POST['leadsGastoGoogEdit'];
        $leadsGastoLinkEdit = $_POST['leadsGastoLinkEdit'];
        $leadsGastoWazeEdit = $_POST['leadsGastoWazeEdit'];
        $leadsGastoTikEdit = $_POST['leadsGastoTikEdit'];
        $leadsGastoSpotiEdit = $_POST['leadsGastoSpotiEdit'];

        date_default_timezone_set("America/Mexico_City");
        $fecha = date('Y-m-d H:i:s');
        $mesActualGastoEdit = $_POST['mes_gasto_edit'];
        $anioActualGastoEdit = $_POST['anio_gasto_edit'];

        $query = mysqli_query($conexion, "UPDATE presupuesto_gastado SET dia_gasto = '$fechaGastoEdit', facebook_gasto = '$presuGastoFaceEdit', instagram_gasto = '$presuGastoInstaEdit', google_gasto = '$presuGastoGoogEdit', linkedin_gasto = '$presuGastoLinkEdit', waze_gasto = '$presuGastoWazeEdit', tiktok_gasto = '$presuGastoTikEdit', spotify_gasto = '$presuGastoSpotiEdit', leads_gasto_face = '$leadsGastoFaceEdit', leads_gasto_insta = '$leadsGastoInstaEdit', leads_gasto_goog = '$leadsGastoGoogEdit', leads_gasto_link = '$leadsGastoLinkEdit', leads_gasto_waze = '$leadsGastoWazeEdit', leads_gasto_tik = '$leadsGastoTikEdit', leads_gasto_spoti = '$leadsGastoSpotiEdit', ultima_actualizacion_gasto = '$fecha' WHERE id_gasto = '$idGastoEdit' ");

        if ($query)
        {
            header('Location: ../cac.php?editado&id='.$idclienteGastoEdit.'&company='.$empresaGastoEdit.'&month='.$mesActualGastoEdit.'&year='.$anioActualGastoEdit);
            echo "OK";
        }
        else {
            echo "ERROR: ".mysqli_error($conexion);
        }

    }


?>