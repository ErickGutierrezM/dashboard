<?php 
    require "../secretInfo/conexion_BD.php";
    include_once "../secretInfo/functions.php";
    

    if (isset($_POST['crearAsesor'])) {
        
        $datos_usuario = $_POST['datos_empresa'];
        $id_admin = 2;

        $selectedValue = explode(',', $datos_usuario);
        $id_usuario = $selectedValue[0];
        $empresa = $selectedValue[1];

        $nombre = $conexion->real_escape_string($_POST['nomAsesor']);
        $apellido = $conexion->real_escape_string($_POST['apellidoAsesor']);
        $email = $conexion->real_escape_string($_POST['emailAsesor']);
        $nombre_empresa = $conexion->real_escape_string($_POST['nombre_empresa']);
        $password = $conexion->real_escape_string($_POST['password']);
        $r_password = $conexion->real_escape_string($_POST['r_password']);
        $usuario_emp = $conexion->real_escape_string($_POST['nombre_empresa']);
        $activo = 1;
        //$tipo_usuario = $_POST['rol'];
        $tipo_usuario = 3;
        $despues = $antes['admin_usuario']."; ".$result['id'];//$asesor
        $pass_hash = hashPassword($password);
        //$token = generateToken();
        
        $registro = registraUsuario($nombre, $pass_hash, $apellido, $email, $nombre_empresa, $activo, $tipo_usuario, $usuario_emp);
        $id_asesor = mysqli_query($conexion, "SELECT * FROM usuarios WHERE company = '".$nombre_empresa."' AND id_tipo = '".$tipo_usuario."' AND user = '".$nombre."' LIMIT 1");
        $result = mysqli_fetch_array($id_asesor);

        $repetido = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM campanas WHERE nom_empresa = '".$empresa."' AND id_admin = '".$id_admin."' LIMIT 1"));
            if($repetido == 1)
            {
            header('Location: ../index.php?pagina=1?errorRepetido');
            }
            else
            {
            $antes = mysqli_fetch_array(mysqli_query($conexion, "SELECT admin_usuario FROM campanas WHERE id_cliente = '".$id_usuario."'"));
            $despues = $antes['admin_usuario']."; ".$result['id'];

            mysqli_query($conexion, "UPDATE campanas SET admin_usuario = '".$despues."' WHERE id_cliente = '".$id_usuario."'");
           //$sql = mysqli_query($conexion, "SELECT id_campana FROM campanas WHERE id_admin = '".$id_admin."' AND nom_empresa = '".$empresa."'");
            //$row = mysqli_fetch_array($sql);
            //header('Location: ../cliente.php?id='.$row['id_campana'].'&company='.$empresa);
            echo "<script>window.location.href='../index.php?pagina=1'</script>";
            exit;
            }
                    
        }

?>