<?php 
    require "../secretInfo/conexion_BD.php";
    include_once "../secretInfo/funciones.php";

    if (isset($_POST['deletedata'])) {
        
        $idCampanaDelete = $_POST['delete_id'];
        $idEmpresaDelete = $_POST['id_campana'];
        $empresaCampanaDelete = $_POST['nom_empresa'];
        // $mesActualDelete = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
        $mesActualDelete = $_POST['mes_empresa'];
        $anioActualDelete = $_POST['anio_empresa'];


        // $check_query = mysqli_query($conexion, "SELECT * FROM products WHERE id = '".$idCarDelete."'");

        // foreach ($check_query as $rows) {
            
        //     if ($img_path = "../../../autodealgmkt/imagenes/products/".$rows['image'] ) {

        //         $gallery1_path = "../../../autodealgmkt/imagenes/galeria/thumbs/".$rows['foto_1'];
        //         $gallery2_path = "../../../autodealgmkt/imagenes/galeria/thumbs/".$rows['foto_2'];
        //         $gallery3_path = "../../../autodealgmkt/imagenes/galeria/thumbs/".$rows['foto_3'];
        //         $gallery4_path = "../../../autodealgmkt/imagenes/galeria/thumbs/".$rows['foto_4'];
        //         $gallery5_path = "../../../autodealgmkt/imagenes/galeria/thumbs/".$rows['foto_5'];
        //         $thumbs1_path = "../../../autodealgmkt/imagenes/galeria/".$rows['foto_1'];
        //         $thumbs2_path = "../../../autodealgmkt/imagenes/galeria/".$rows['foto_2'];
        //         $thumbs3_path = "../../../autodealgmkt/imagenes/galeria/".$rows['foto_3'];
        //         $thumbs4_path = "../../../autodealgmkt/imagenes/galeria/".$rows['foto_4'];
        //         $thumbs5_path = "../../../autodealgmkt/imagenes/galeria/".$rows['foto_5'];

                $query = mysqli_query($conexion, "DELETE FROM campana_redes WHERE id_red = '".$idCampanaDelete."'");

                if ($query)
                {
                    // unlink($img_path);
                    // unlink($gallery1_path);
                    // unlink($gallery2_path);
                    // unlink($gallery3_path);
                    // unlink($gallery4_path);
                    // unlink($gallery5_path);
                    // unlink($thumbs1_path);
                    // unlink($thumbs2_path);
                    // unlink($thumbs3_path);
                    // unlink($thumbs4_path);
                    // unlink($thumbs5_path);

                    header('Location: ../cliente.php?borrado&id='.$idEmpresaDelete.'&company='.$empresaCampanaDelete.'&month='.$mesActualDelete.'&year='.$anioActualDelete);
                    echo "OK";
                }
                else
                {
                    echo "ERROR: ".mysqli_error($conexion);
                }
        //     }
        // }

        
    }
?>