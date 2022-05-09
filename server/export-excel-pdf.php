<?php  

    include ('../secretInfo/conexion_BD.php');	

    $companyReporte = $_POST['companyexcel'];
    $inicioF = $_POST["fecha_inicio"];
    $finalF = $_POST["fecha_final"];


    if ($_POST['action'] == 'generar_excel') {

      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=ReporteGMKT-'.$companyReporte.'-del-'.$inicioF.'-al-'.$finalF.'.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('ID', 'Plataforma', 'Nombre de la campaña', 'Objetivo', 'Fecha de inicio', 'Fecha de finalizacion', 'Budget', 'Presupuesto gastado', 'Leads','Llamadas', 'Costo por lead', 'Clics', 'Interacciones', 'Alcance'));  
      $query = "SELECT * FROM campana_redes WHERE campana_empresa = '$companyReporte' AND fecha_inicio >= '".$inicioF."' AND fecha_inicio <= '".$finalF."' ORDER BY id_red DESC";  
      $result = mysqli_query($conexion, $query);  
      while($rows = mysqli_fetch_assoc($result))  
      {  
        fputcsv($output, array(
          $rows['id_red'], 
          $rows['red_social'],
          $rows['nombre_campana'],
          $rows['objetivo'],
          $rows['fecha_inicio'],
          $rows['fecha_fin'],
          $rows['presu_invertido'],
          $rows['presu_gastado'],
          $rows['leads'],
          $rows['llamadas'],
          $rows['costo_x_lead'],
          $rows['conversiones'],
          $rows['interacciones'],
          $rows['alcance']
        ));
      }  

      fclose($output);  
    }

    else if ($_POST['action'] == 'generar_pdf') {

    require_once('../TCPDF/examples/tcpdf_include.php');
    require_once('../TCPDF/tcpdf.php');  


    function fetch_data()  
    {  
      require '../secretInfo/conexion_BD.php';	

      $output = '';
      $companyReporte = $_POST['companyexcel'];
      $inicioF = $_POST["fecha_inicio"];
      $finalF = $_POST["fecha_final"];      
      $sql = "SELECT * FROM campana_redes WHERE campana_empresa = '$companyReporte' AND fecha_inicio >= '".$inicioF."' AND fecha_inicio <= '".$finalF."' ORDER BY id_red DESC";  
      $result = mysqli_query($conexion, $sql);  
      while($row = mysqli_fetch_array($result))  
      {   
        
        $output .= 
        "<tr>  
              <td>".$row['id_red']."</td>
              <td>".$row['red_social']."</td> 
              <td>".$row['nombre_campana']."</td>
              <td>".$row['objetivo']."</td>
              <td>".$row['fecha_inicio']."</td>
              <td>".$row['fecha_fin']."</td>
              <td>".$row['presu_invertido']."</td>
              <td>".$row['presu_gastado']."</td>
              <td>".number_format($row['leads'])."</td>
              <td>".number_format($row['llamadas'])."</td>
              <td>".$row['costo_x_lead']."</td>
              <td>".$row['conversiones']."</td>
              <td>".number_format($row['interacciones'])."</td>
              <td>".number_format($row['alcance'])."</td>
          </tr>";  
      }  
      return $output; 
    }

    class MYPDF extends TCPDF {

      //Page header
      public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'galleta-logo.png';
        $this->Image($image_file, 5, 5, 40, '', 'PNG', '', 'C', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 16);
        // Title
        $this->Cell(0, 15, 'Reporte Galleta Marketing Digital', 0, false, 'C', 0, '', 0, false, 'M', 'M');
      }

      // Page footer
      public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
      }
  }

  // if(isset($_POST["generar_pdf"]))  
  // {  
      $obj_pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Reporte Galleta Marketing Digital");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->setPrintHeader(true);  
      $obj_pdf->setPrintFooter(true);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);
      $obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  
      $obj_pdf->SetFont('helvetica', '', 5);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '  
      <style>

      table {
        border-collapse: collapse;
      }
      
      th {
      background-color: #242E4C;
      color: #ffffff;
      }

      td {
        border: 1px solid #f7f7f7;
      }
    </style>

    <h1 align="center">'.$inicioF.' al '.$finalF.' '.$companyReporte.'</h1>
    <table align="center" cellspacing="0" cellpadding="2">  
      <thead>
        <tr>  
          <th>Id</th>
          <th>Plataforma</th>
          <th>Nombre de la campaña</th>
          <th>Objetivo</th>
          <th>Fecha de inicio</th>
          <th>Fecha de finalización</th>
          <th>Budget</th>
          <th>Presupuesto gastado</th>
          <th>Leads</th>
          <th>Llamadas</th>
          <th>Costo por lead</th>
          <th>Clics</th>
          <th>Interacciones</th>
          <th>Alcance</th>
        </tr> 
      </thead>  
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);
      ob_end_clean();   
      $obj_pdf->Output('ReporteGMKT-'.$companyReporte.'-del-'.$inicioF.'-al-'.$finalF.'.pdf', 'I');   
  // }
}
	
?>