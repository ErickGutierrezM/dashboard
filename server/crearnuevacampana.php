
<?php

session_start();
include('../secretInfo/conexion_BD.php');


$datos_cliente = $_POST['id_company'];
//$id_admin = $_SESSION['id_usuario'];
$id_admin = 1;

$selectedValue = explode(',', $datos_cliente);
$id_cliente = $selectedValue[0];
$empresa = $selectedValue[1];
$presu_general = $_POST['presu_general'];
$mes = $_POST['mes'];
$despues = $antes['admin_usuario']."; ".$_SESSION['id_cliente'];
date_default_timezone_set("America/Mexico_City");
$fecha = date('Y-m-d');


$repetido = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM campanas WHERE nom_empresa = '".$empresa."' AND id_admin = '".$id_admin."' LIMIT 1"));
if($repetido == 1)
{
  // header('Location: ../index.php?errorRepetido');
  echo "<script>window.location.href='../index.php?pagina=1&errorRepetido'</script>";
}

else if (mysqli_query($conexion, "INSERT INTO campanas (id_admin, id_cliente, nom_empresa, presu_general, mes, anio, admin_usuario, ultima_actualizacion_camp) VALUES ('".$id_admin."', '".$id_cliente."', '".$empresa."', '".$presu_general."', '".$mes."', YEAR(NOW()), ';".$id_admin.";', '".$fecha."')"))
{
  $antes = mysqli_fetch_array(mysqli_query($conexion, "SELECT admin_usuario FROM campanas WHERE id_cliente = '".$id_cliente."'"));
  $despues = $antes['admin_usuario'].";".$id_cliente.";";

  mysqli_query($conexion, "UPDATE campanas SET admin_usuario = '".$despues."' WHERE id_cliente = '".$id_cliente."'");
  $sql = mysqli_query($conexion, "SELECT id_campana FROM campanas WHERE id_admin = '".$id_admin."' AND nom_empresa = '".$empresa."'");
  $row = mysqli_fetch_array($sql);
  //header('Location: ../cliente.php?id='.$row['id_campana'].'&company='.$empresa);
  echo "<script>window.location.href='../index.php?pagina=1'</script>";
  exit;
}
else
{
  echo "Error";
}
?>
