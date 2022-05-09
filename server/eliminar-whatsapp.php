<?php 
    require "../secretInfo/conexion_BD.php";
    include_once "../secretInfo/funciones.php";

    if (isset($_POST['deletedata_whatsapp'])) {
        
        $idTelDelete = $_POST['delete_id_whatsapp'];
        $telCampanaDelete = $_POST['nom_empresa_whatsapp'];
        date_default_timezone_set("America/Mexico_City");
        // $mesActualDelete = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
        $mesActualDelete = $_POST['mes_empresa_whatsapp'];
        $anioActualDelete = $_POST['anio_empresa_whatsapp'];

            $query = mysqli_query($conexion, "DELETE FROM whatsapp WHERE id_whatsapp = '".$idTelDelete."'");

            if ($query)
            {
                header('Location: ../cliente.php?borrado&id='.$idTelDelete.'&company='.$telCampanaDelete.'&month='.$mesActualDelete.'&year='.$anioActualDelete);
                echo "OK";
            }
            else
            {
                echo "ERROR: ".mysqli_error($conexion);
            }
        
    }
?>