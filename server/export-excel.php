<?php  

    include ('../secretInfo/conexion_BD.php');	

    $companyReporteWhats = $_POST['companyexcelwhats'];
    $inicioFWhats = $_POST["fecha_inicio_whats"];
    $finalFWhats = $_POST["fecha_final_whats"];


    if ($_POST['action'] == 'generar_excel_whats') {

      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=ReporteGMKT-WhatsApp-'.$companyReporteWhats.'-del-'.$inicioFWhats.'-al-'.$finalFWhats.'.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('ID', 'Cliente', 'Nombre', 'WhatsApp', 'Correo', 'Interes','Fuente', 'Comentarios', 'Asesor', 'Fecha'));  
      $query = "SELECT * FROM whatsapp WHERE campana_empresa = '$companyReporteWhats' AND fecha >= '".$inicioFWhats."' AND fecha <= '".$finalFWhats."' ORDER BY id_whatsapp DESC";  
      $result = mysqli_query($conexion, $query);  
      while($rows = mysqli_fetch_assoc($result))  
      {  
        fputcsv($output, array(
          $rows['id_whatsapp'], 
          $rows['campana_empresa'],
          $rows['nombre'],
          $rows['telefono'],
          $rows['correo'],
          $rows['auto_interes'],
          $rows['origen'],
          $rows['comentarios'],
          $rows['asesor'],
          $rows['fecha']
        ));
      }  

      fclose($output);  
    }

    $companyReporteGasto = $_POST['companyexcelgasto'];
    $inicioFGasto = $_POST["fecha_inicio_gasto"];
    $finalFGasto = $_POST["fecha_final_gasto"];


    if ($_POST['action'] == 'generar_excel_gasto') {

      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=ReporteGMKT-Gasto-Diario-'.$companyReporteGasto.'-del-'.$inicioFGasto.'-al-'.$finalFGasto.'.csv');  
      $outputGasto = fopen("php://output", "w");  
      fputcsv($outputGasto, array('Dia', 'Facebook', 'Instagram', 'Google', 'LinkedIn', 'Waze', 'TikTok', 'Spotify', 'Leads Facebook', 'Leads Instagram', 'Leads Google', 'Leads LinkedIn', 'Navegaciones Waze', 'Leads TikTok', 'Leads Spotify'));  
      $queryGasto = "SELECT * FROM presupuesto_gastado WHERE empresa_gasto = '$companyReporteGasto' AND dia_gasto >= '".$inicioFGasto."' AND dia_gasto <= '".$finalFGasto."' ORDER BY id_gasto DESC";  
      $resultGasto = mysqli_query($conexion, $queryGasto);  
      while($rowsGasto = mysqli_fetch_assoc($resultGasto))  
      {  
        fputcsv($outputGasto, array(
          // $rowsGasto['id_gasto'], 
          // $rowsGasto['empresa_gasto'],
          $rowsGasto['dia_gasto'],
          $rowsGasto['facebook_gasto'],
          $rowsGasto['instagram_gasto'],
          $rowsGasto['google_gasto'],
          $rowsGasto['linkedin_gasto'],
          $rowsGasto['waze_gasto'],
          $rowsGasto['tiktok_gasto'],
          $rowsGasto['spotify_gasto'],
          $rowsGasto['leads_gasto_face'],
          $rowsGasto['leads_gasto_insta'],
          $rowsGasto['leads_gasto_goog'],
          $rowsGasto['leads_gasto_link'],
          $rowsGasto['leads_gasto_waze'],
          $rowsGasto['leads_gasto_tik'],
          $rowsGasto['leads_gasto_spoti']
        ));
      }  

      fclose($outputGasto);  
    }

    $companyReporteTotal = $_POST['companyexceltotal'];
    $inicioFTotal = $_POST["fecha_inicio_total"];
    $finalFTotal = $_POST["fecha_final_total"];


    if ($_POST['action'] == 'generar_excel_total') {

      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=ReporteGMKT-Total-Diario-'.$companyReporteTotal.'-del-'.$inicioFTotal.'-al-'.$finalFTotal.'.csv');  
      $outputTotal = fopen("php://output", "w");  
      fputcsv($outputTotal, array('Dia', 'Facebook', 'Instagram', 'Google', 'LinkedIn', 'Waze', 'TikTok', 'Spotify', 'Total'));  
      $queryTotal = "SELECT dia_gasto, facebook_gasto / leads_gasto_face as divFace, 
      instagram_gasto / leads_gasto_insta as divInsta,
      google_gasto / leads_gasto_goog as divGoog,
      linkedin_gasto / leads_gasto_link as divLink,
      waze_gasto / leads_gasto_waze as divWaze,
      tiktok_gasto / leads_gasto_tik as divTik,
      spotify_gasto / leads_gasto_spoti as divSpoti  FROM presupuesto_gastado WHERE empresa_gasto = '".$companyReporteTotal."' AND dia_gasto >= '".$inicioFTotal."' AND dia_gasto <= '".$finalFTotal."' ORDER BY id_gasto DESC";  
      
      $resultTotal = mysqli_query($conexion, $queryTotal);  
      while($rowsTotal = mysqli_fetch_assoc($resultTotal))  
      {  
        $totalGasto = ($rowsTotal['divFace']+$rowsTotal['divInsta']+$rowsTotal['divGoog']+$rowsTotal['divLink']+$rowsTotal['divWaze']+$rowsTotal['divTik']+$rowsTotal['divSpoti'])/7;

        fputcsv($outputTotal, array(
          // $rowsGasto['id_gasto'], 
          // $rowsGasto['empresa_gasto'],
          $rowsTotal['dia_gasto'],
          number_format($rowsTotal['divFace'], 2),
          number_format($rowsTotal['divInsta'], 2),
          number_format($rowsTotal['divGoog'], 2),
          number_format($rowsTotal['divLink'], 2),
          number_format($rowsTotal['divWaze'], 2),
          number_format($rowsTotal['divTik'], 2),
          number_format($rowsTotal['divSpoti'], 2),
          number_format($totalGasto, 2)
        ));
      }  

      fclose($outputTotal);  
    }
    

//     else if ($_POST['action'] == 'generar_pdf') {

//     require_once('../TCPDF/examples/tcpdf_include.php');
//     require_once('../TCPDF/tcpdf.php');  


//     function fetch_data()  
//     {  
//       require '../secretInfo/conexion_BD.php';	

//       $output = '';
//       $companyReporte = $_POST['companyexcel'];
//       $mesSelect = $_POST['mesReporte'];
//       $sql = "SELECT * FROM campana_redes WHERE campana_empresa = '$companyReporte' AND mes_actual = '$mesSelect' ORDER BY id_red DESC";  
//       $result = mysqli_query($conexion, $sql);  
//       while($row = mysqli_fetch_array($result))  
//       {   
        
//         $output .= 
//         "<tr>  
//               <td>".$row['id_red']."</td>
//               <td>".$row['red_social']."</td> 
//               <td>".$row['nombre_campana']."</td>
//               <td>".$row['objetivo']."</td>
//               <td>".$row['fecha_inicio']."</td>
//               <td>".$row['fecha_fin']."</td>
//               <td>".$row['presu_invertido']."</td>
//               <td>".$row['presu_gastado']."</td>
//               <td>".number_format($row['leads'])."</td>
//               <td>".$row['contactados']."</td>
//               <td>".$row['agendados']."</td>
//               <td>".$row['cita_asistida']."</td>
//               <td>".$row['demo']."</td>
//               <td>".$row['online']."</td>
//               <td>".$row['venta']."</td>
//               <td>".$row['costo_x_lead']."</td>
//               <td>".$row['conversiones']."</td>
//               <td>".number_format($row['interacciones'])."</td>
//               <td>".number_format($row['alcance'])."</td>
//           </tr>";  
//       }  
//       return $output; 
//     }

//     class MYPDF extends TCPDF {

//       //Page header
//       public function Header() {
//         // Logo
//         $image_file = K_PATH_IMAGES.'galleta-logo.png';
//         $this->Image($image_file, 5, 5, 40, '', 'PNG', '', 'C', false, 300, '', false, false, 0, false, false, false);
//         // Set font
//         $this->SetFont('helvetica', 'B', 16);
//         // Title
//         $this->Cell(0, 15, 'Reporte Galleta Marketing Digital', 0, false, 'C', 0, '', 0, false, 'M', 'M');
//       }

//       // Page footer
//       public function Footer() {
//         // Position at 15 mm from bottom
//         $this->SetY(-15);
//         // Set font
//         $this->SetFont('helvetica', 'I', 8);
//         // Page number
//         $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
//       }
//   }

//   // if(isset($_POST["generar_pdf"]))  
//   // {  
//       $obj_pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
//       $obj_pdf->SetCreator(PDF_CREATOR);  
//       $obj_pdf->SetTitle("Reporte Galleta Marketing Digital");  
//       $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
//       $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
//       $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
//       $obj_pdf->SetDefaultMonospacedFont('helvetica');  
//       $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
//       $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//       $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//       $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
//       $obj_pdf->setPrintHeader(true);  
//       $obj_pdf->setPrintFooter(true);  
//       $obj_pdf->SetAutoPageBreak(TRUE, 10);
//       $obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  
//       $obj_pdf->SetFont('helvetica', '', 5);  
//       $obj_pdf->AddPage();  
//       $content = '';  
//       $content .= '  
//       <style>

//       table {
//         border-collapse: collapse;
//       }
      
//       th {
//       background-color: #242E4C;
//       color: #ffffff;
//       }

//       td {
//         border: 1px solid #f7f7f7;
//       }
//     </style>

//     <h1 align="center">'.$mesSelect.' '.$companyReporte.'</h1>
//     <table align="center" cellspacing="0" cellpadding="2">  
//       <thead>
//         <tr>  
//           <th>Id</th>
//           <th>Plataforma</th>
//           <th>Nombre de la campaña</th>
//           <th>Objetivo</th>
//           <th>Fecha de inicio</th>
//           <th>Fecha de finalización</th>
//           <th>Budget</th>
//           <th>Presupuesto gastado</th>
//           <th>Leads</th>
//           <th>Contactados</th>
//           <th>Agendados</th>
//           <th>Cita asistida</th>
//           <th>Demo</th>
//           <th>Online</th>
//           <th>Venta</th>
//           <th>Costo por lead</th>
//           <th>Conversiones</th>
//           <th>Interacciones</th>
//           <th>Alcance</th>
//         </tr> 
//       </thead>  
//       ';  
//       $content .= fetch_data();  
//       $content .= '</table>';  
//       $obj_pdf->writeHTML($content);
//       ob_end_clean();   
//       $obj_pdf->Output('ReporteGMKT '.$companyReporte.'.pdf', 'I');   
//   // }
// }
	
?>