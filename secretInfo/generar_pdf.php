<?php  
 function fetch_data()  
 {   	
      require 'conexion_BD.php';
      $output = '';   
      $sql = "SELECT * FROM campana_redes WHERE campana_empresa = 'Ford Plasencia Guadalajara' AND mes_actual = 'Septiembre' ORDER BY id_red DESC";  
      $result = mysqli_query($conexion, $sql);  
      while($row = mysqli_fetch_array($result))  
      {       
      $output .= "<tr>  
                    <td>".$row['id_red']."</td>
                    <td>".$row['campana_empresa']."</td>
                    <td>".$row['red_social']."</td> 
                    <td>".$row['nombre_campana']."</td>
                    <td>".$row['objetivo']."</td>
                    <td>".$row['fecha_inicio']."</td>
                    <td>".$row['fecha_fin']."</td>
                    <td>".$row['presu_invertido']."</td>
                    <td>".$row['presu_gastado']."</td>
                    <td>".number_format($row['leads'])."</td>
                    <td>".$row['costo_x_lead']."</td>
                    <td>".$row['conversiones']."</td>
                    <td>".number_format($row['interacciones'])."</td>
                    <td>".number_format($row['alcance'])."</td>
                    <td>".$row['ultim_actualizacion']."</td> 
               </tr>  
                          ";  
      }  
      return $output;  
 }  
 if(isset($_POST["generate_pdf"]))  
 {  
      require_once('../TCPDF/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);
      $obj_pdf->SetAuthor('Nicola Galleta Marketing Digital');  
      $obj_pdf->SetTitle("Reporte Galleta Marketing Digital");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 5);  
      $obj_pdf->AddPage();  
      $content = ''; 
      $content .= '<style>'.file_get_contents(_BASE_PATH.'assets/plugins/bootstrap/css/bootstrap.min.css').'</style>'; 
      $content .= "  
      <h4 align='center'>Reporte Galleta Marketing</h4><br /> 
      <table border='1' cellspacing='0' cellpadding='3'>  
           <tr>  
               <th>Id</th>
               <th>Cliente</th>
               <th>Plataforma</th>
               <th>Nombre de la campaña</th>
               <th>Objetivo</th>
               <th>Fecha de inicio</th>
               <th>Fecha de finalización</th>
               <th>Budget</th>
               <th>Presupuesto gastado</th>
               <th>Leads</th>
               <th>Costo por lead</th>
               <th>Conversiones</th>
               <th>Interacciones</th>
               <th>Alcance</th>
               <th>Ultima actualización</th> 
           </tr>  
      ";  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('file.pdf', 'I');  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>SoftAOX | Generate HTML Table Data To PDF From MySQL Database Using TCPDF In PHP</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />            
      </head>  
      <body>  
           <br />
           <div class="container">  
                <h4 align="center">Reporte Galleta Marketing</h4><br />  
                <div class="table-responsive">  
                    <div class="col-md-12" align="right">
                     <form method="post">  
                          <input type="submit" name="generate_pdf" class="btn btn-success" value="Generate PDF" />  
                     </form>  
                     </div>
                     <br/>
                     <br/>
                     <table class="table table-bordered">  
                          <tr>  
                              <th>Id</th>
                              <th>Cliente</th>
                              <th>Plataforma</th>
                              <th>Nombre de la campaña</th>
                              <th>Objetivo</th>
                              <th>Fecha de inicio</th>
                              <th>Fecha de finalización</th>
                              <th>Budget</th>
                              <th>Presupuesto gastado</th>
                              <th>Leads</th>
                              <th>Costo por lead</th>
                              <th>Conversiones</th>
                              <th>Interacciones</th>
                              <th>Alcance</th>
                              <th>Ultima actualización</th> 
                          </tr>  
                     <?php  
                     echo fetch_data();  
                     ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
</html>