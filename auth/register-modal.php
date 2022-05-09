<?php

    require '../secretInfo/conexion_BD.php';
    require '../secretInfo/funciones.php';

    if(!empty ($_POST))
    {
        $nombreCliente = $conexion->real_escape_string($_POST['nombreCliente']);
        $apellidoCliente = $conexion->real_escape_string($_POST['apellidoCliente']);
        $emailCliente = $conexion->real_escape_string($_POST['emailCliente']);
        $empresaCliente = $conexion->real_escape_string($_POST['empresaCliente']);
        $passwordCliente = $conexion->real_escape_string($_POST['passwordCliente']);
        $rPasswordCliente = $conexion->real_escape_string($_POST['rPasswordCliente']);

        $activo = 1;
        $tipoUsuario = 2;

		$nombreCliente_error = '';
        $apellidoCliente_error = '';
		$emailCliente_error = '';
		$empresaCliente_error = '';
        $passwordCliente_error = '';
        $rPasswordCliente_error = '';

        if(!isEmail($emailCliente))
        {
            $emailCliente_error = "(Dirección de correo inválida)";
        }

        if(!validaPassword($passwordCliente, $rPasswordCliente))
        {
            $passwordCliente_error = "(Las contraseñas no coinciden)";
            $rPasswordCliente_error = "(Las contraseñas no coinciden)";
        }

        if(usuarioExisteModal($empresaCliente))
        {
            $empresaCliente_error = "(La empresa $empresaCliente ya existe)";
        }

        if(emailExiste($emailCliente))
        {
            $emailCliente_error = "(El email $email ya existe)";
        }

		if(empty($nombreCliente)) {
			$nombreCliente_error = '(El nombre es requerido)';
		}
		else {
			$nombreCliente = $nombreCliente;
		}

        if(empty($apellidoCliente)) {
			$apellidoCliente_error = '(El apellido es requerido)';
		}
		else {
			$apellidoCliente = $apellidoCliente;
		}

		if(empty($emailCliente)) {
			$emailCliente_error = '(El email es requerido)';
		}
        else {
            $emailCliente = $emailCliente;
        }
		
		if(empty($empresaCliente)) {
			$empresaCliente_error = '(La empresa es requerida)';
		}
		else {
			$empresaCliente = $empresaCliente;
		}

		if(empty($passwordCliente)) {
			$passwordCliente_error = '(La contraseña es requerida)';
		}
		else {
			$passwordCliente = $passwordCliente;
		}

        if(empty($rPasswordCliente)) {
			$rPasswordCliente_error = '(Por favor repite la contraseña)';
		}
		else {
			$rPasswordCliente = $rPasswordCliente;
		}

        if( $nombreCliente_error == '' && $apellidoCliente_error == '' && $emailCliente_error == '' && $empresaCliente_error == '' && $passwordCliente_error == '' && $rPasswordCliente_error == '') {

            $passHash = hashPassword($passwordCliente);
            
            $registro = registraUsuario($nombreCliente, $passHash, $apellidoCliente, $emailCliente, $empresaCliente, $activo, $tipoUsuario);
            
            if($registro > 0) {
                $data = array(
                'success' => true
                );			
            }
            else {
                $data = array(
                    'success' => false
                );
            }
        }
        else {
            $data = array(
                'nombreCliente_error' => $nombreCliente_error,
                'apellidoCliente_error'  => $apellidoCliente_error,
                'emailCliente_error' => $emailCliente_error,
                'empresaCliente_error' => $empresaCliente_error,
                'passwordCliente_error' => $passwordCliente_error,
                'rPasswordCliente_error'  => $rPasswordCliente_error
            );
        }
        echo json_encode($data);
    }
?>