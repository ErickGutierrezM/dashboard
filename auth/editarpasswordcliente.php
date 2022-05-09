

<?php

  session_start();

  include('../secretInfo/conexion_BD.php');
  include('../secretInfo/funciones.php');

  $id_cliente = $_POST['pass_id_cliente'];
  //echo $id_cliente;


	$password = $conexion->real_escape_string($_POST['password']);
	$r_password = $conexion->real_escape_string($_POST['r_password']);

  if(isNullPass($password, $r_password))
	{
    echo '<script>
    location.href = "../index.php?pagina=1&passVacia"
    </script>';
    
  }
  else
  {
  	if(validaPassword($password, $r_password))
  	{
      $pass_hash = hashPassword($password);
      
      $query = mysqli_query($conexion, "UPDATE usuarios SET password = '$pass_hash' WHERE id = '$id_cliente' ");

  		if($query)
  		{
        echo '<script>location.href = "../index.php?pagina=1&cambiosOk"</script>';
  		}
      else
      {
        echo '<script>location.href = "../index.php?pagina=1&error"</script>';
        echo "ERROR: ".mysqli_error($conexion);
  		}

  	}
    else
    {
      echo '<script>location.href = "../index.php?pagina=1&errorNoCoinciden"</script>';
  	}
  }


?>
