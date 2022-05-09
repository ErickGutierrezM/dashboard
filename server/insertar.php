<?php 
    require "../secretInfo/conexion_BD.php";
    include_once "../secretInfo/funciones.php";
    

    if (isset($_POST['insertdata'])) {
        
        $idCampanaAdd = $_POST['id_campana'];
        $empresaCampanaAdd = $_POST['nom_empresa'];
        $objCampanaAdd = $_POST['objCampanaAdd'];
        $plataformaAdd = $_POST['plataformaAdd'];
        $nomCampanaAdd = $_POST['nomCampanaAdd'];
        $fechaAdd = $_POST['fechaAdd'];
        $fechaFinAdd = $_POST['fechaFinAdd'];
        $presuInvertidoAdd = $_POST['presuInvertidoAdd'];
        $presuGastadoAdd = $_POST['presuGastadoAdd'];
        $leadsAdd = $_POST['leadsAdd'];
        $llamadasAdd = $_POST['llamadasAdd'];
        // $contactadosAdd = $_POST['contactadosAdd'];
        // $agendadosAdd = $_POST['agendadosAdd'];
        // $citaAdd = $_POST['citaAdd'];
        // $demoAdd = $_POST['demoAdd'];
        // $onlineAdd = $_POST['onlineAdd'];
        // $ventaAdd = $_POST['ventaAdd'];
        $costoXLeadAdd = $_POST['costoXLeadAdd'];
        $conversionAdd = $_POST['conversionAdd'];
        $interaccionesAdd = $_POST['interaccionesAdd'];
        $alcanceAdd = $_POST['alcanceAdd'];
        date_default_timezone_set("America/Mexico_City");
        $fecha = date('Y-m-d H:i:s');
        $mesActualAdd = $_POST['mes_empresa'];
        $anioActualAdd = $_POST['anio_empresa'];

        // $mesActualAdd = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];

        // $query = mysqli_query($conexion, "INSERT INTO campana_redes (campana_id, campana_empresa, red_social, nombre_campana, objetivo, fecha_inicio, fecha_fin, presu_invertido, presu_gastado, leads, contactados, agendados, cita_asistida, demo, online, venta ,costo_x_lead, conversiones,interacciones, alcance, ultim_actualizacion, mes_actual) VALUES ('".$idCampanaAdd."', '".$empresaCampanaAdd."', '".$plataformaAdd."', '".$nomCampanaAdd."', '".$objCampanaAdd."' ,'".$fechaAdd."', '".$fechaFinAdd."', '".$presuInvertidoAdd."', '".$presuGastadoAdd."', '".$leadsAdd."', '".$contactadosAdd."', '".$agendadosAdd."', '".$citaAdd."', '".$demoAdd."', '".$onlineAdd."', '".$ventaAdd."' ,'".$costoXLeadAdd."', '".$conversionAdd."' ,'".$interaccionesAdd."', '".$alcanceAdd."', '".$fecha."', '".$mesActualAdd."')");

        $query = mysqli_query($conexion, "INSERT INTO campana_redes (campana_id, campana_empresa, red_social, nombre_campana, objetivo, fecha_inicio, fecha_fin, presu_invertido, presu_gastado, leads, llamadas, costo_x_lead, conversiones,interacciones, alcance, ultim_actualizacion, mes_actual) VALUES ('".$idCampanaAdd."', '".$empresaCampanaAdd."', '".$plataformaAdd."', '".$nomCampanaAdd."', '".$objCampanaAdd."' ,'".$fechaAdd."', '".$fechaFinAdd."', '".$presuInvertidoAdd."', '".$presuGastadoAdd."', '".$leadsAdd."','".$llamadasAdd."','".$costoXLeadAdd."', '".$conversionAdd."' ,'".$interaccionesAdd."', '".$alcanceAdd."', '".$fecha."', '".$mesActualAdd."')");

        if ($query)
        {
            header('Location: ../cliente.php?id='.$idCampanaAdd.'&company='.$empresaCampanaAdd.'&month='.$mesActualAdd.'&year='.$anioActualAdd);
            echo "OK";
        }
        else
        {
            echo "ERROR: ".mysqli_error($conexion);
        }
    }

?>