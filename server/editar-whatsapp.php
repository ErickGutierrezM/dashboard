<?php 
    session_start();
    require "../secretInfo/conexion_BD.php";
    include_once "../secretInfo/funciones.php";

    if (isset($_POST['updatedata_whatsapp'])) {

        $idWhatsappEdit = $_POST['update_id_whatsapp'];
        $empresaWhatsappEdit = $_POST['nom_empresa_whatsapp'];
        $nomWhatsappEdit = $_POST['nomWhatsappEdit'];
        $telWhatsappEdit = $_POST['telWhatsappEdit'];
        $correoWhatsappEdit = $_POST['correoWhatsappEdit'];
        $interesWhatsappEdit = $_POST['interesWhatsappEdit'];
        $fuenteWhatsappEdit = $_POST['fuenteWhatsappEdit'];
        $comentariosWhatsappEdit = $_POST['comentariosWhatsappEdit'];
        $asesorWhatsappEdit = $_POST['asesorWhatsappEdit'];
        $fechaEdit = $_POST['fechaEdit'];
        date_default_timezone_set("America/Mexico_City");
        // $mesActualEdit = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
        $mesActualEdit = $_POST['mes_empresa_whatsapp'];
        $anioActualEdit = $_POST['anio_empresa_whatsapp'];


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

        $query = mysqli_query($conexion, "UPDATE whatsapp SET nombre = '$nomWhatsappEdit', telefono = '$telWhatsappEdit', correo = '$correoWhatsappEdit', auto_interes = '$interesWhatsappEdit', origen = '$fuenteWhatsappEdit', comentarios = '$comentariosWhatsappEdit' ,asesor ='$asesorWhatsappEdit', fecha = '$fechaEdit' WHERE id_whatsapp = '$idWhatsappEdit' ");

        if ($query)
        {
            header('Location: ../cliente.php?editado&id='.$idWhatsappEdit.'&company='.$empresaWhatsappEdit.'&month='.$mesActualEdit.'&year='.$anioActualEdit);
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