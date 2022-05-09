<?php 
    session_start();
    require "../secretInfo/conexion_BD.php";
    include_once "../secretInfo/funciones.php";
    
    $host_name = 'db5000886678.hosting-data.io';
    $database = 'dbs778238';
    $user_name = 'dbu591620';
    $password = 'Ga113Ta#772020';
    $conn = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);

    if (isset($_POST['updatedata'])) {

        // if($_FILES['file']['name'] != null)
        // {
        //     $imagenAdd = uploadImage();
        // }

        $idRegistroEdit = $_POST['update_id'];
        $idEmpresaEdit = $_POST['id_campana'];
        $empresaCampanaEdit = $_POST['nom_empresa'];
        $plataformaEdit = $_POST['plataformaEdit'];
        $nomCampanaEdit = $_POST['nomCampanaEdit'];
        $objCampanaEdit = $_POST['objCampanaEdit'];
        $fechaInicioEdit = $_POST['fechaInicioEdit'];
        $fechaFinEdit = $_POST['fechaFinEdit'];
        $presuInvertidoEdit = $_POST['presuInvertidoEdit'];
        $presuGastadoEdit = $_POST['presuGastadoEdit'];
        $leadsEdit = $_POST['leadsEdit'];
        $llamadasEdit = $_POST['llamadasEdit'];
        // Removido
        // $contactadosEdit = $_POST['contactadosEdit'];
        // $agendadosEdit = $_POST['agendadosEdit'];
        // $citaEdit = $_POST['citaEdit'];
        // $demoEdit = $_POST['demoEdit'];
        // $onlineEdit = $_POST['onlineEdit'];
        // $ventaEdit = $_POST['ventaEdit'];
        $costoXLeadEdit = $_POST['costoXLeadEdit'];
        $conversionesEdit = $_POST['conversionesEdit'];
        $interaccionesEdit = $_POST['interaccionesEdit'];
        $alcanceEdit = $_POST['alcanceEdit'];
        date_default_timezone_set("America/Mexico_City");
        $fechaEdit = date('Y-m-d H:i:s');
        // $mesActualEdit = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
        $mesActualEdit = $_POST['mes_empresa'];
        $anioEdit = $_POST['anio_empresa'];

        // $galeria1Edit = uploadGalleryOne();
        // $galeria2Edit = uploadGalleryTwo();
        // $galeria3Edit = uploadGalleryThree();
        // $galeria4Edit = uploadGalleryFour();
        // $galeria5Edit = uploadGalleryFive();

        $path = '../uploads/gallery_dash/';
        $path2 = '../uploads/gallery_dash/thumbs_dash/';
        $pathsegme = '../uploads/segmentacion/';
        $pathsegme2 = '../uploads/segmentacion/thumbs_segmentacion/';
        $pathtimeline = '../uploads/timeline/';
        $pathtimeline2 = '../uploads/timeline/thumbs_timeline/';

        $temptimeline = $_FILES['timeline']['tmp_name'];
        $timelineEdit = $_FILES['timeline']['name'];

        $timeline_query = mysqli_query($conexion, "SELECT * FROM campana_redes WHERE id_red = '".$idRegistroEdit."'");

        foreach ($timeline_query as $rows) {
            
            if ($timelineEdit == NULL) {

                $timeline_data = $rows['timeline'];
            }
            else {
                if ($pathtimeline.$rows['timeline']) {
                    unlink($pathtimeline);
                    unlink($pathtimeline2);

                    $timeline_data = $timelineEdit;
                }

            }
        }

        $tempsegme = $_FILES['segmentaciones']['tmp_name'];
        $segmeEdit = $_FILES['segmentaciones']['name'];

        $segme_query = mysqli_query($conexion, "SELECT * FROM campana_redes WHERE id_red = '".$idRegistroEdit."'");

        foreach ($segme_query as $rows) {
            
            if ($segmeEdit == NULL) {

                $segme_data = $rows['segmentacion'];
            }
            else {
                if ($pathsegme.$rows['segmentacion']) {
                    unlink($pathsegme);
                    unlink($pathsegme2);

                    $segme_data = $segmeEdit;
                }

            }
        }

        $temp = $_FILES['galleryOne']['tmp_name'];
        $temp2 = $_FILES['galleryTwo']['tmp_name'];
        $temp3 = $_FILES['galleryThree']['tmp_name'];
        $temp4 = $_FILES['galleryFour']['tmp_name'];
        $temp5 = $_FILES['galleryFive']['tmp_name'];

        $imageEdit = $_FILES['galleryOne']['name'];
        $imageEdit2 = $_FILES['galleryTwo']['name'];
        $imageEdit3 = $_FILES['galleryThree']['name'];
        $imageEdit4 = $_FILES['galleryFour']['name'];
        $imageEdit5 = $_FILES['galleryFive']['name'];

        $products_query = mysqli_query($conexion, "SELECT * FROM campana_redes WHERE id_red = '".$idRegistroEdit."'");

        foreach ($products_query as $rows) {
            
            if ($imageEdit == NULL || $imageEdit2 == NULL || $imageEdit3 == NULL || $imageEdit4 == NULL || $imageEdit5 == NULL) {

                $image_data = $rows['img_evidencia_1'];
                $image_data2 = $rows['img_evidencia_2'];
                $image_data3 = $rows['img_evidencia_3'];
                $image_data4 = $rows['img_evidencia_4'];
                $image_data5 = $rows['img_evidencia_5'];
            }
            else {
                if ($path.$rows['img_evidencia_1'] && $path2.$rows['img_evidencia_1'] || $path.$rows['img_evidencia_2'] && $path2.$rows['img_evidencia_2'] || $path.$rows['img_evidencia_3'] && $path2.$rows['img_evidencia_3'] || $path.$rows['img_evidencia_4'] && $path2.$rows['img_evidencia_4'] || $path.$rows['img_evidencia_5'] && $path2.$rows['img_evidencia_5']) {
                    unlink($path);
                    unlink($path2);

                    $image_data = $imageEdit;
                    $image_data2 = $imageEdit2;
                    $image_data3 = $imageEdit3;
                    $image_data4 = $imageEdit4;
                    $image_data5 = $imageEdit5;
                }

            }
        }

        // Removido
        // $query = mysqli_query($conexion, "UPDATE campana_redes SET red_social = '$plataformaEdit', nombre_campana = '$nomCampanaEdit', objetivo = '$objCampanaEdit', fecha_inicio = '$fechaInicioEdit', fecha_fin ='$fechaFinEdit', presu_invertido = '$presuInvertidoEdit', presu_gastado = '$presuGastadoEdit', leads = '$leadsEdit', contactados = '$contactadosEdit', agendados = '$agendadosEdit',
        // cita_asistida = '$citaEdit', demo = '$demoEdit', online = '$onlineEdit', venta = '$ventaEdit', costo_x_lead = '$costoXLeadEdit', conversiones = '$conversionesEdit' ,interacciones = '$interaccionesEdit', alcance = '$alcanceEdit', ultim_actualizacion = '$fechaEdit', timeline = '$timeline', segmentacion = '$segme_data', img_evidencia_1 = '$image_data', img_evidencia_2 = '$image_data2', img_evidencia_3 = '$image_data3', img_evidencia_4 = '$image_data4', img_evidencia_5 = '$image_data5' WHERE id_red = '$idRegistroEdit' ");
        
        $query = mysqli_query($conexion, "UPDATE campana_redes SET red_social = '$plataformaEdit', nombre_campana = '$nomCampanaEdit', objetivo = '$objCampanaEdit', fecha_inicio = '$fechaInicioEdit', fecha_fin ='$fechaFinEdit', presu_invertido = '$presuInvertidoEdit', presu_gastado = '$presuGastadoEdit', leads = '$leadsEdit', llamadas = '$llamadasEdit', costo_x_lead = '$costoXLeadEdit', 
        conversiones = '$conversionesEdit' ,interacciones = '$interaccionesEdit', alcance = '$alcanceEdit', ultim_actualizacion = '$fechaEdit', timeline = '$timeline_data', segmentacion = '$segme_data', img_evidencia_1 = '$image_data', img_evidencia_2 = '$image_data2', img_evidencia_3 = '$image_data3', img_evidencia_4 = '$image_data4', img_evidencia_5 = '$image_data5' WHERE id_red = '$idRegistroEdit' ");

        if ($query)
        {
            // echo "<script>window.location.href='../index.php?pagina=1'</script>";
            // exit;
            if ($timelineEdit == NULL) {

                header('Location: ../cliente.php?editado&id='.$idEmpresaEdit.'&company='.$empresaCampanaEdit.'&month='.$mesActualEdit.'&year='.$anioEdit);
                echo "OK";
            }
            else {
                move_uploaded_file($temptimeline, $pathtimeline.$timeline_data);
                copy($pathtimeline.$timeline_data, $pathtimeline2.$timeline_data);

                header('Location: ../cliente.php?editado&id='.$idEmpresaEdit.'&company='.$empresaCampanaEdit.'&month='.$mesActualEdit.'&year='.$anioEdit);
                echo "OK";
            }
            if ($segmeEdit == NULL) {

                header('Location: ../cliente.php?editado&id='.$idEmpresaEdit.'&company='.$empresaCampanaEdit.'&month='.$mesActualEdit.'&year='.$anioEdit);
                echo "OK";
            }
            else {
                move_uploaded_file($tempsegme, $pathsegme.$segme_data);
                copy($pathsegme.$segme_data, $pathsegme2.$segme_data);

                header('Location: ../cliente.php?editado&id='.$idEmpresaEdit.'&company='.$empresaCampanaEdit.'&month='.$mesActualEdit.'&year='.$anioEdit);
                echo "OK";
            }
            if ($imageEdit == NULL) {

                header('Location: ../cliente.php?editado&id='.$idEmpresaEdit.'&company='.$empresaCampanaEdit.'&month='.$mesActualEdit.'&year='.$anioEdit);
                echo "OK";
            }
            else {
                move_uploaded_file($temp, $path.$image_data);
                copy($path.$image_data, $path2.$image_data);

                header('Location: ../cliente.php?editado&id='.$idEmpresaEdit.'&company='.$empresaCampanaEdit.'&month='.$mesActualEdit.'&year='.$anioEdit);
                echo "OK";
            }
            if ($imageEdit2 == NULL) {

                header('Location: ../cliente.php?editado&id='.$idEmpresaEdit.'&company='.$empresaCampanaEdit.'&month='.$mesActualEdit.'&year='.$anioEdit);
                echo "OK";
            }
            else {
                move_uploaded_file($temp2, $path.$image_data2);
                copy($path.$image_data2, $path2.$image_data2);

                header('Location: ../cliente.php?editado&id='.$idEmpresaEdit.'&company='.$empresaCampanaEdit.'&month='.$mesActualEdit.'&year='.$anioEdit);
                echo "OK";
            }
            if ($imageEdit3 == NULL) {

                header('Location: ../cliente.php?editado&id='.$idEmpresaEdit.'&company='.$empresaCampanaEdit.'&month='.$mesActualEdit.'&year='.$anioEdit);
                echo "OK";
            }
            else {
                move_uploaded_file($temp3, $path.$image_data3);
                copy($path.$image_data3, $path2.$image_data3);

                header('Location: ../cliente.php?editado&id='.$idEmpresaEdit.'&company='.$empresaCampanaEdit.'&month='.$mesActualEdit.'&year='.$anioEdit);
                echo "OK";
            }
            if ($imageEdit4 == NULL) {

                header('Location: ../cliente.php?editado&id='.$idEmpresaEdit.'&company='.$empresaCampanaEdit.'&month='.$mesActualEdit.'&year='.$anioEdit);
                echo "OK";
            }
            else {
                move_uploaded_file($temp4, $path.$image_data4);
                copy($path.$image_data4, $path2.$image_data4);

                header('Location: ../cliente.php?editado&id='.$idEmpresaEdit.'&company='.$empresaCampanaEdit.'&month='.$mesActualEdit.'&year='.$anioEdit);
                echo "OK";
            }
            if ($imageEdit5 == NULL) {

                header('Location: ../cliente.php?editado&id='.$idEmpresaEdit.'&company='.$empresaCampanaEdit.'&month='.$mesActualEdit.'&year='.$anioEdit);
                echo "OK";
            }
            else {
                move_uploaded_file($temp5, $path.$image_data5);
                copy($path.$image_data5, $path2.$image_data5);

                header('Location: ../cliente.php?editado&id='.$idEmpresaEdit.'&company='.$empresaCampanaEdit.'&month='.$mesActualEdit.'&year='.$anioEdit);
                echo "OK";
            }
            
        }
        else {
            echo "ERROR: ".mysqli_error($conexion);
        }

    }


?>