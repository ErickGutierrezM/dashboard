<?php 
    session_start();
    require "../secretInfo/conexion_BD.php";
    include_once "../secretInfo/funciones.php";

    if (isset($_POST['updateComunidad'])) {

        $idComunidadEdit = $_POST['id_campana_comunidad'];
        $empresaComunidadEdit = $_POST['nom_empresa_comunidad'];
        $facebookEdit = $_POST['facebookEdit'];
        $instagramEdit = $_POST['instagramEdit'];
        $twitterEdit = $_POST['twitterEdit'];
       // $googleEdit = $_POST['googleEdit'];
        $youtubeEdit = $_POST['youtubeEdit'];
        $linkEdit = $_POST['linkEdit'];
        $spotifyEdit = $_POST['spotifyEdit'];
        $tiktokEdit = $_POST['tiktokEdit'];
        date_default_timezone_set("America/Mexico_City");
        $mesActualEdit = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];

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

        //$query = mysqli_query($conexion, "UPDATE comunidad SET datos_facebook = '$facebookEdit', datos_intagram = '$instagramEdit', datos_twitter = '$twitterEdit', datos_google = '$googleEdit', datos_youtube = '$youtubeEdit' , datos_linkedin ='$linkEdit', datos_spotify = '$spotifyEdit', datos_waze = '$wazeEdit' WHERE id_comunidad = '$idComunidadEdit' ");
        $query = mysqli_query($conexion, "UPDATE comunidad SET datos_facebook = '$facebookEdit', datos_intagram = '$instagramEdit', datos_twitter = '$twitterEdit', datos_youtube = '$youtubeEdit' , datos_linkedin ='$linkEdit', datos_spotify = '$spotifyEdit', datos_tiktok ='$tiktokEdit' WHERE id_comunidad = '$idComunidadEdit' ");

        if ($query)
        {
            header('Location: ../cliente.php?editado&id='.$idComunidadEdit.'&company='.$empresaComunidadEdit.'&month='.$mesActualEdit);
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


