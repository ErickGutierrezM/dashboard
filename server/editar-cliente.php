<?php 
    session_start();
    require "../secretInfo/conexion_BD.php";
    include_once "../secretInfo/funciones.php";

    if (isset($_POST['updatedata_cliente'])) {

        $update_id_cliente = $_POST['update_id_cliente'];
        //$empresaWhatsappEdit = $_POST['nom_empresa_whatsapp'];
        $mesClienteEdit = $_POST['mesClienteEdit'];
        $anioClienteEdit = $_POST['anioClienteEdit'];
        $presuClienteEdit = $_POST['presuClienteEdit'];
        date_default_timezone_set("America/Mexico_City");
        $fecha = date('Y-m-d');

        // $products_query = mysqli_query($conexion, "SELECT * FROM products WHERE id = '".$idCarEdit."'");

        // foreach ($products_query as $rows) {
            
        //     if ($imageEdit == NULL) {

        //         $image_data = $rows['image'];
        //     }
        //     else {
        //         if ($img_path = "../../../autodealgmkt/imagenes/products/".$rows['image']) {
        //             unlink($img_path);
        //             $image_data = $imageEdit;
        //         }
        //     }
        // }

        $query = mysqli_query($conexion, "UPDATE campanas SET presu_general = '$presuClienteEdit', mes = '$mesClienteEdit', anio = '$anioClienteEdit', ultima_actualizacion_camp = '$fecha' WHERE id_campana = '$update_id_cliente' ");

        if ($query)
        {
            header('Location: ../index.php?pagina=1');
            echo "OK";
            // if ($imageEdit == NULL) {

            //     header('Location: ../inventario.php');
            //     echo "OK";
            // }
            // else {
            //     move_uploaded_file($_FILES['imageEdit']['tmp_name'], "../../../autodealgmkt/imagenes/products/".$_FILES['imageEdit']['name']);
            //     header('Location: ../inventario.php');
            //     echo "OK";
            // }
            
        }
        else {
            echo "ERROR: ".mysqli_error($conexion);
        }

    }


?>