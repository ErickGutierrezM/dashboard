<?php
	// Activar modal mantenimiento
	$mantenimiento = true;

	$host_name = 'db5000886678.hosting-data.io';
	$database = 'dbs778238';
	$user_name = 'dbu591620';
	$password = 'Ga113Ta#772020';
	$conexion = new mysqli($host_name, $user_name, $password, $database);

	$conexion->set_charset("utf8");

	if(mysqli_connect_errno())
	{
		echo 'Conexion Fallida: ', mysqli_connect_error();
		exit();
	}

?>