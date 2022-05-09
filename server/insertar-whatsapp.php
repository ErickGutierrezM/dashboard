<?php 
    require "../secretInfo/conexion_BD.php";
    include_once "../secretInfo/funciones.php";

    use PHPMailer\PHPMailer\PHPMailer;
				
	require_once '../PHPMailer/src/PHPMailer.php';
	require_once '../PHPMailer/src/SMTP.php';
	require_once '../PHPMailer/src/Exception.php';
    

    if (isset($_POST['insertdata_w'])) {
        
        $idCampanaAdd = $_POST['id_campana'];
        $empresaCampanaAdd = $_POST['nom_empresa'];
        $nomWhatsappAdd = $_POST['nomWhatsappAdd'];
        $telWhatsappAdd = $_POST['telWhatsappAdd'];
        $correoWhatsappAdd = $_POST['correoWhatsappAdd'];
        $interesWhatsappAdd = $_POST['interesWhatsappAdd'];
        $fuenteWhatsappAdd = $_POST['fuenteWhatsappAdd'];
        $comentariosWhatsappAdd = $_POST['comentariosWhatsappAdd'];
        $asesorWhatsappAdd = $_POST['asesorWhatsappAdd'];
        $fechaAdd = $_POST['fechaAdd'];
        date_default_timezone_set("America/Mexico_City");
        // $mesActualAdd = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
        $mesActualAdd = $_POST['mes_empresa'];
        $anioActualAdd = $_POST['anio_empresa'];

        $query = mysqli_query($conexion, "INSERT INTO whatsapp (campana_id, campana_empresa, nombre, telefono, correo, auto_interes, origen ,comentarios, asesor, fecha, mes_actual) VALUES ('".$idCampanaAdd."', '".$empresaCampanaAdd."', '". $nomWhatsappAdd."', '".$telWhatsappAdd."', '".$correoWhatsappAdd."' , '".$interesWhatsappAdd."', '".$fuenteWhatsappAdd."' ,'".$comentariosWhatsappAdd."' ,'".$asesorWhatsappAdd."', '".$fechaAdd."', '".$mesActualAdd."')");

        if ($query)
        {
            if ($empresaCampanaAdd === 'Ford Plasencia Santa Anita') {

                $correoUno = 'gerenciadigital@fordplasencia.com';
                $correoDos = 'lmartinez@fordplasencia.com';
                $correoTres = 'albertob@fordplasencia.com';
                $correoCuatro = 'vdieguez@fordplasencia.com';
                $correoCinco = 'imojica@galletamkt.com';
                $correoSeis = 'aramirez1@fordplasencia.com';

                $arrayAddresses = ''.$correoUno.','.''.$correoDos.','.''.$correoTres.','.''.$correoCuatro.', '.$correoCinco.', '.$correoSeis.'';

                date_default_timezone_set("America/Mexico_City");
                $fecha = date('d/m/Y');
                $hora = date('H:i');

                $mail = new PHPMailer(true);		
                $mail->isSMTP();
                $mail->isMail();
                $mail->SMTPDebug = 0;		
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Host = 'smtp.ionos.mx';
                $mail->Port = '587';
                
                $mail->Username = 'noreply@galletamkt.com';
                $mail->Password = '';

                $mail->setFrom('noreply@galletamkt.com', 'GalletaMKT Leads Whatsapp: '.$interesWhatsappAdd.'');

                $addresses = explode(',', $arrayAddresses);
				foreach ($addresses as $address) {
					$mail->AddAddress($address, $nombre);
				}

                $mail->WordWrap = 50;
                $mail->IsHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Lead: '.$interesWhatsappAdd.'';
                $mail->Body = '
                <h3 align="center">Detalles del solicitante</h3>
                <table border="1" width="100%" cellpadding="5" cellspacing="5">
                    <tr>
                        <td width="30%">Nombre</td>
                        <td width="70%">'.$nomWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Whatsapp</td>
                        <td width="70%">'.$telWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Correo</td>
                        <td width="70%">'.$correoWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Interes</td>
                        <td width="70%">'.$interesWhatsappAdd.'</td>
                    </tr>
                    <tr>
                    <td width="30%">Fuente</td>
                    <td width="70%">'.$fuenteWhatsappAdd.'</td>
                </tr>
                    <tr>
                        <td width="30%">Comentarios</td>
                        <td width="70%">'.$comentariosWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Asesor</td>
                        <td width="70%">'.$asesorWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Fecha</td>
                        <td width="70%">'.$fechaAdd.'</td>
                    </tr>
                </table>
                ';
                $mail->send();
            }elseif($empresaCampanaAdd === 'Ford Plasencia Guadalajara'){
                
                $correoUno = 'vdieguez@fordplasencia.com';

                $correoDos = 'imojica@galletamkt.com';

                $arrayAddresses = ''.$correoUno.','.''.$correoDos.'';

                date_default_timezone_set("America/Mexico_City");
                $fecha = date('d/m/Y');
                $hora = date('H:i');

                $mail = new PHPMailer(true);		
                $mail->isSMTP();
                $mail->isMail();
                $mail->SMTPDebug = 0;		
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Host = 'smtp.ionos.mx';
                $mail->Port = '587';
                
                $mail->Username = 'noreply@galletamkt.com';
                $mail->Password = '';

                $mail->setFrom('noreply@galletamkt.com', 'GalletaMKT Leads Whatsapp: '.$interesWhatsappAdd.'');

                $addresses = explode(',', $arrayAddresses);
				foreach ($addresses as $address) {
					$mail->AddAddress($address, $nombre);
				}

                $mail->WordWrap = 50;
                $mail->IsHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Lead: '.$interesWhatsappAdd.'';
                $mail->Body = '
                <h3 align="center">Detalles del solicitante</h3>
                <table border="1" width="100%" cellpadding="5" cellspacing="5">
                    <tr>
                        <td width="30%">Nombre</td>
                        <td width="70%">'.$nomWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Whatsapp</td>
                        <td width="70%">'.$telWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Correo</td>
                        <td width="70%">'.$correoWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Interes</td>
                        <td width="70%">'.$interesWhatsappAdd.'</td>
                    </tr>
                    <tr>
                    <td width="30%">Fuente</td>
                    <td width="70%">'.$fuenteWhatsappAdd.'</td>
                </tr>
                    <tr>
                        <td width="30%">Comentarios</td>
                        <td width="70%">'.$comentariosWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Asesor</td>
                        <td width="70%">'.$asesorWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Fecha</td>
                        <td width="70%">'.$fechaAdd.'</td>
                    </tr>
                </table>
                ';
                $mail->send();
            }elseif($empresaCampanaAdd === 'Ford Plasencia Vallarta'){

                $correoUno = 'vdieguez@fordplasencia.com';
                $correoDos = 'imojica@galletamkt.com';
                $arrayAddresses = ''.$correoUno.','.''.$correoDos.'';

                date_default_timezone_set("America/Mexico_City");
                $fecha = date('d/m/Y');
                $hora = date('H:i');

                $mail = new PHPMailer(true);		
                $mail->isSMTP();
                $mail->isMail();
                $mail->SMTPDebug = 0;		
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Host = 'smtp.ionos.mx';
                $mail->Port = '587';
                
                $mail->Username = 'noreply@galletamkt.com';
                $mail->Password = '';

                $mail->setFrom('noreply@galletamkt.com', 'GalletaMKT Leads Whatsapp: '.$interesWhatsappAdd.'');

                $addresses = explode(',', $arrayAddresses);
				foreach ($addresses as $address) {
					$mail->AddAddress($address, $nombre);
				}

                $mail->WordWrap = 50;
                $mail->IsHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Lead: '.$interesWhatsappAdd.'';
                $mail->Body = '
                <h3 align="center">Detalles del solicitante</h3>
                <table border="1" width="100%" cellpadding="5" cellspacing="5">
                    <tr>
                        <td width="30%">Nombre</td>
                        <td width="70%">'.$nomWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Whatsapp</td>
                        <td width="70%">'.$telWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Correo</td>
                        <td width="70%">'.$correoWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Interes</td>
                        <td width="70%">'.$interesWhatsappAdd.'</td>
                    </tr>
                    <tr>
                    <td width="30%">Fuente</td>
                    <td width="70%">'.$fuenteWhatsappAdd.'</td>
                </tr>
                    <tr>
                        <td width="30%">Comentarios</td>
                        <td width="70%">'.$comentariosWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Asesor</td>
                        <td width="70%">'.$asesorWhatsappAdd.'</td>
                    </tr>
                    <tr>
                        <td width="30%">Fecha</td>
                        <td width="70%">'.$fechaAdd.'</td>
                    </tr>
                </table>
                ';
                $mail->send();
            }
            header('Location: ../cliente.php?id='.$idCampanaAdd.'&company='.$empresaCampanaAdd.'&month='.$mesActualAdd.'&year='.$anioActualAdd);
            echo "OK";
        }
        else
        {
            echo "ERROR: ".mysqli_error($conexion);
        }
    }

?>