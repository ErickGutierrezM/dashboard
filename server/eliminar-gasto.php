<?php 
    require "../secretInfo/conexion_BD.php";
    include_once "../secretInfo/funciones.php";

    if (isset($_POST['deletedata_gasto'])) {
        
        $idGastoDelete = $_POST['delete_id_gasto'];
        $empreGastoDelete = $_POST['nom_empresa_gasto'];
        date_default_timezone_set("America/Mexico_City");
        // $mesActualDelete = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
        $mesGastoDelete = $_POST['mes_empresa_gasto'];
        $anioGastoDelete = $_POST['anio_empresa_gasto'];

            $query = mysqli_query($conexion, "DELETE FROM presupuesto_gastado WHERE id_gasto = '".$idGastoDelete."'");

            if ($query) {
                header('Location: ../cac.php?borrado&id='.$idGastoDelete.'&company='.$empreGastoDelete.'&month='.$mesGastoDelete.'&year='.$anioGastoDelete);
                echo "OK";
            }
            else {
                echo "ERROR: ".mysqli_error($conexion);
            }
        
    }
?>