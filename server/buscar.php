


<?php
	// ini_set(‘display_errors’,1);
	// error_reporting(E_ALL);
?>

<?php
	require '../secretInfo/conexion_BD.php';
	//$conn = new PDO("mysql:host=db5000973429.hosting-data.io; dbname=dbs846583", "dbu620410", "Galleta2020%");
$conn = new PDO("mysql:host=db5000886678.hosting-data.io; dbname=dbs778238", "dbu591620", "Ga113Ta#772020");


	$id_campana = $_POST['id_campana'];
	$nom_empresa = $_POST['company'];
	$session = $_POST['sesion'];
	$mes_actual = $_POST['mesactual'];
	$anio_actual = $_POST['anioactual'];

	$datafacebook = $_POST['datosFacebook'];
	$dataInstagram = $_POST['datosInstagram'];
	$dataTwitter = $_POST['datosTwitter'];
	$dataGoogle = $_POST['datosGoogle'];
	$dataYoutube = $_POST['datosYoutube'];
	$dataLinkedin = $_POST['datosLinkedin'];
	$dataSpotify = $_POST['datosSpotify'];
	$dataWaze = $_POST['datosWaze'];


	$sql = "SELECT id, user, last_name, email, company, password, id_tipo FROM usuarios WHERE id = '$session'";
	$result = $conexion->query($sql);

	$rowUser = $result->fetch_assoc();

	$limit = '10';
	$page = 1;

	if($_POST['page'] > 1) {
		$start = (($_POST['page'] - 1) * $limit);
		$page = $_POST['page'];
	}
	else {
		$start = 0;
	}

	$query = "SELECT * FROM campana_redes WHERE campana_empresa = '".$nom_empresa."' AND mes_actual = '".$mes_actual."' AND YEAR(fecha_inicio) = '".$anio_actual."'";

	//WHERE title LIKE '%".$q."%' OR brand LIKE '%".$q."%' OR model LIKE '%".$q."%' OR version LIKE '%".$q."%' OR vin LIKE '%".$q."%'  ";

	if($_POST['query'] != '') {
		$query .= 'AND nombre_campana LIKE "'.str_replace(' ', '%', $_POST['query']).'%"';
	}

	$query .= 'ORDER BY id_red DESC ';

	$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

	$statement = $conn->prepare($query);
	$statement->execute();
	$total_data = $statement->rowCount();

	$statement = $conn->prepare($filter_query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_filter_data = $statement->rowCount();

	///////////////////////////////////////////////////

	// Removido
	// <th scope='col' style='font-size:10px;'>Contactados</th>
	// <th scope='col' style='font-size:10px;'>Agendados</th>
	// <th scope='col' style='font-size:10px;'>Cita asistida</th>
	// <th scope='col' style='font-size:10px;'>Demo</th>
	// <th scope='col' style='font-size:10px;'>Online</th>
	// <th scope='col' style='font-size:10px;'>Venta</th>
	// <td>".$row['contactados']."</td>
	// <td>".$row['agendados']."</td>
	// <td>".$row['cita_asistida']."</td>
	// <td>".$row['demo']."</td>
	// <td>".$row['online']."</td>
	// <td>".$row['venta']."</td>

	if ($rowUser['id_tipo'] == "1"):

	$output = "
	<label>Total de registros: ".$total_data."</label>

		<table id='datatableid' class='text-center table table-hover table-bordered border-top-0 border-bottom-0'>
			<thead class='thead-dark'>
				<tr>
					<th scope='col' style='font-size:10px; padding-left: 2rem; padding-right: 2rem;'>Acciones</th>
					<th scope='col' style='font-size:10px;'>Id</th>
					<th scope='col' style='font-size:10px;'>Cliente</th>
					<th scope='col' style='font-size:10px;'>Plataforma</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Nombre de la campaña</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Objetivo</th>
					<th scope='col' style='font-size:10px; padding-left: 2rem; padding-right: 2rem;'>Fecha de inicio</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Fecha de finalización</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Budget</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Presupuesto gastado</th>
					<th scope='col' style='font-size:10px;'>Leads</th>
					<th scope='col' style='font-size:10px;'>Llamadas</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Costo por lead</th>
					<th scope='col' id='conversiones'style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Clics </th>
					<th scope='col' style='font-size:10px;'>Interacciones</th>
					<th scope='col' style='font-size:10px;'>Alcance</th>
					<th scope='col' style='font-size:10px;'>Ultima actualización</th>
					<th scope='col' id='imagenes' style='font-size:10px;'>Imagenes Evidencias  <a href='#dynamic_content'><i id='popoverImagen' class='fas fa-exclamation-circle' style='color:white;'></i></a </th>
				</tr>
			</thead>
			<tbody>";

	if($total_data > 0) {
		foreach($result as $row) {
			
			$output .= "
			<tr>
				<td>
					<button class='deletebtn btn btn-outline-danger' href='#'><i class='fas fa-trash-alt'></i></button>
					<button class='editbtn btn btn-outline-info' href='#'><i class='fas fa-edit'></i></button>
				</td>
				<td>".$row['id_red']."</td>
				<td>".$row['campana_empresa']."</td>
				<td>".$row['red_social']."</td> 
				<td>".$row['nombre_campana']."</td>
				<td>".$row['objetivo']."</td>
				<td>".$row['fecha_inicio']."</td>
				<td>".$row['fecha_fin']."</td>
				<td>".$row['presu_invertido']."</td>
				<td>".$row['presu_gastado']."</td>
				<td>".$row['leads']."</td>
				<td>".$row['llamadas']."</td>
				<td>".$row['costo_x_lead']."</td>
				<td>".$row['conversiones']."</td>
				<td>".$row['interacciones']."</td>
				<td>".$row['alcance']."</td>
				<td>".$row['ultim_actualizacion']."</td>
				<td>
					<div class='product-slider'>
						<div class='carousel slide' data-ride='carousel'>
							<div class='carousel-inner'>
								<div class='carousel-item active'>
									<a class='carousel-item active' href='../uploads/gallery_dash/".$row['img_evidencia_1']."' alt='img' data-lightbox='galeria' data-title='".$row['nombre_campana']."'>  <img class ='' src='../uploads/gallery_dash/thumbs_dash/".$row['img_evidencia_1']."'> </a>
								</div>
								<div class='carousel-item'>
									<a class='carousel-item' href='../uploads/gallery_dash/".$row['img_evidencia_2']."' alt='img' data-lightbox='galeria' data-title='".$row['nombre_campana']."'>  <img class ='' src='../uploads/gallery_dash/thumbs_dash/".$row['img_evidencia_2']."'> </a>
								</div>
								<div class='carousel-item'>
									<a class='carousel-item' href='../uploads/gallery_dash/".$row['img_evidencia_3']."' alt='img' data-lightbox='galeria' data-title='".$row['nombre_campana']."'>  <img class ='' src='../uploads/gallery_dash/thumbs_dash/".$row['img_evidencia_3']."'> </a>
								</div>
								<div class='carousel-item'>
									<a class='carousel-item' href='../uploads/gallery_dash/".$row['img_evidencia_4']."' alt='img' data-lightbox='galeria' data-title='".$row['nombre_campana']."'>  <img class ='' src='../uploads/gallery_dash/thumbs_dash/".$row['img_evidencia_4']."'> </a>
								</div>
								<div class='carousel-item'>
									<a class='carousel-item' href='../uploads/gallery_dash/".$row['img_evidencia_5']."' alt='img' data-lightbox='galeria' data-title='".$row['nombre_campana']."'>  <img class ='' src='../uploads/gallery_dash/thumbs_dash/".$row['img_evidencia_5']."'> </a>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>"; 
		}
		$output.="
		</tbody>
			<tfoot class='thead-dark'>
				<tr>
					<th scope='col' style='font-size:10px; padding-left: 2rem; padding-right: 2rem;'>Acciones</th>
					<th scope='col' style='font-size:10px;'>Id</th>
					<th scope='col' style='font-size:10px;'>Cliente</th>
					<th scope='col' style='font-size:10px;'>Plataforma</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Nombre de la campaña</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Objetivo</th>
					<th scope='col' style='font-size:10px; padding-left: 2rem; padding-right: 2rem;'>Fecha de inicio</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Fecha de finalización</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Budget</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Presupuesto gastado</th>
					<th scope='col' style='font-size:10px;'>Leads</th>
					<th scope='col' style='font-size:10px;'>Llamadas</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Costo por lead</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Clics</th>
					<th scope='col' style='font-size:10px;'>Interacciones</th>
					<th scope='col' style='font-size:10px;'>Alcance</th>
					<th scope='col' style='font-size:10px;'>Ultima actualización</th>
					<th scope='col' style='font-size:10px;'>Imagenes Evidencias</th>
				</tr>";
	}
	else {
		$output .= '
		<tr>
			<td colspan="2" align="center">No se encontraron registros</td>
		</tr>';
	}

	$output .= '
	</tfoot>
	</table>
	<br/>
	<div align="center">
	<ul class="pagination justify-content-center" style="margin-bottom: 15px;">';
	
	elseif ($rowUser['id_tipo'] == "2"):

		$output = "
	<label>Total de registros: ".$total_data."</label>

		<table id='datatableid' class='text-center table table-hover table-bordered border-top-0 border-bottom-0'>
			<thead class='thead-dark'>
				<tr>
					<th scope='col' style='font-size:10px;'>Id</th>
					<th scope='col' style='font-size:10px;'>Cliente</th>
					<th scope='col' style='font-size:10px;'>Plataforma</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Nombre de la campaña</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Objetivo</th>
					<th scope='col' style='font-size:10px; padding-left: 2rem; padding-right: 2rem;'>Fecha de inicio</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Fecha de finalización</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Budget</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Presupuesto gastado</th>
					<th scope='col' style='font-size:10px;'>Leads</th>
					<th scope='col' style='font-size:10px;'>Llamadas</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Costo por lead</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Clics</th>
					<th scope='col' style='font-size:10px;'>Interacciones</th>
					<th scope='col' style='font-size:10px;'>Alcance</th>
					<th scope='col' style='font-size:10px;'>Ultima actualización</th>
					<th scope='col' style='font-size:10px;'>Imagenes Evidencias  <a href='#dynamic_content'><i id='popoverImagen' class='fas fa-exclamation-circle' style='color:white;'></i></a> </th>
				</tr>
			</thead>
			<tbody>";

	if($total_data > 0) {
		foreach($result as $row) {
			
			$output .= "
			<tr>
				<td>".$row['id_red']."</td>
				<td>".$row['campana_empresa']."</td>
				<td>".$row['red_social']."</td> 
				<td>".$row['nombre_campana']."</td>
				<td>".$row['objetivo']."</td>
				<td>".$row['fecha_inicio']."</td>
				<td>".$row['fecha_fin']."</td>
				<td>".$row['presu_invertido']."</td>
				<td>".$row['presu_gastado']."</td>
				<td>".$row['leads']."</td>
				<td>".$row['llamadas']."</td>
				<td>".$row['costo_x_lead']."</td>
				<td>".$row['conversiones']."</td>
				<td>".number_format($row['interacciones'])."</td>
				<td>".number_format($row['alcance'])."</td>
				<td>".$row['ultim_actualizacion']."</td>
				<td>
					<div class='product-slider'>
						<div class='carousel slide' data-ride='carousel'>
							<div class='carousel-inner'>
								<div class='carousel-item active'>
									<a class='carousel-item active' href='../uploads/gallery_dash/".$row['img_evidencia_1']."' alt='img' data-lightbox='galeria' data-title='".$row['nombre_campana']."'>  <img class ='' src='../uploads/gallery_dash/thumbs_dash/".$row['img_evidencia_1']."'> </a>
								</div>
								<div class='carousel-item'>
									<a class='carousel-item' href='../uploads/gallery_dash/".$row['img_evidencia_2']."' alt='img' data-lightbox='galeria' data-title='".$row['nombre_campana']."'>  <img class ='' src='../uploads/gallery_dash/thumbs_dash/".$row['img_evidencia_2']."'> </a>
								</div>
								<div class='carousel-item'>
									<a class='carousel-item' href='../uploads/gallery_dash/".$row['img_evidencia_3']."' alt='img' data-lightbox='galeria' data-title='".$row['nombre_campana']."'>  <img class ='' src='../uploads/gallery_dash/thumbs_dash/".$row['img_evidencia_3']."'> </a>
								</div>
								<div class='carousel-item'>
									<a class='carousel-item' href='../uploads/gallery_dash/".$row['img_evidencia_4']."' alt='img' data-lightbox='galeria' data-title='".$row['nombre_campana']."'>  <img class ='' src='../uploads/gallery_dash/thumbs_dash/".$row['img_evidencia_4']."'> </a>
								</div>
								<div class='carousel-item'>
									<a class='carousel-item' href='../uploads/gallery_dash/".$row['img_evidencia_5']."' alt='img' data-lightbox='galeria' data-title='".$row['nombre_campana']."'>  <img class ='' src='../uploads/gallery_dash/thumbs_dash/".$row['img_evidencia_5']."'> </a>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>"; 
		}
		$output.="
		</tbody>
			<tfoot class='thead-dark'>
				<tr>
					<th scope='col' style='font-size:10px;'>Id</th>
					<th scope='col' style='font-size:10px;'>Cliente</th>
					<th scope='col' style='font-size:10px;'>Plataforma</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Nombre de la campaña</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Objetivo</th>
					<th scope='col' style='font-size:10px; padding-left: 2rem; padding-right: 2rem;'>Fecha de inicio</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Fecha de finalización</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Budget</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Presupuesto gastado</th>
					<th scope='col' style='font-size:10px;'>Leads</th>
					<th scope='col' style='font-size:10px;'>Llamadas</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Costo por lead</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Clics</th>
					<th scope='col' style='font-size:10px;'>Interacciones</th>
					<th scope='col' style='font-size:10px;'>Alcance</th>
					<th scope='col' style='font-size:10px;'>Ultima actualización</th>
					<th scope='col' style='font-size:10px;'>Imagenes Evidencias</th>
				</tr>";
	}
	else {
		$output .= '
		<tr>
			<td colspan="2" align="center">No se encontraron registros</td>
		</tr>';
	}

	$output .= '
	</tfoot>
	</table>
	<br/>
	<div align="center">
	<ul class="pagination justify-content-center" style="margin-bottom: 15px;">';
else:
	$output .= '<tr>
	<td colspan="2" align="center">ESTE ES EL USUARIO 3, el cual no debe ver nada de esto modificar en archivo cliente cuando ya se encuentre disponible</td>
	</tr>
		';
	endif;

	$total_links = ceil($total_data/$limit);
	$previous_link = '';
	$next_link = '';
	$page_link = '';

	//echo $total_links;

	if($total_links > 4) {
			if($page < 5) {
				for($count = 1; $count <= 5; $count++) {
					$page_array[] = $count;
				}
			$page_array[] = '...';
			$page_array[] = $total_links;
		}
		else {
			$end_limit = $total_links - 5;
			if($page > $end_limit) {
				$page_array[] = 1;
				$page_array[] = '...';
				for($count = $end_limit; $count <= $total_links; $count++) {
					$page_array[] = $count;
				}
			}
			else {
				$page_array[] = 1;
				$page_array[] = '...';
				for($count = $page - 1; $count <= $page + 1; $count++) {
					$page_array[] = $count;
				}
				$page_array[] = '...';
				$page_array[] = $total_links;
			}
		}
	}
	else {
		for($count = 1; $count <= $total_links; $count++) {
			$page_array[] = $count;
		}
	}

	for($count = 0; $count < count($page_array); $count++) {
		if($page == $page_array[$count]) {
				$page_link .= '
				<li class="page-item active">
				<a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
				</li>
				';

				$previous_id = $page_array[$count] - 1;
				if($previous_id > 0) {
					$previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">&laquo;</a></li>';
				}
				else {
					$previous_link = '
					<li class="page-item disabled">
						<a class="page-link" href="#">&laquo;</a>
					</li>';
				}
				$next_id = $page_array[$count] + 1;
			if($next_id >= $total_links) {
				$next_link = '
				<li class="page-item disabled">
					<a class="page-link" href="#">&raquo;</a>
				</li>';
			}
			else {
				$next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">&raquo;</a></li>';
			}
		}
		else {
			if($page_array[$count] == '...') {
				$page_link .= '
				<li class="page-item disabled">
					<a class="page-link" href="#">...</a>
				</li>';
			}
			else {
				$page_link .= '
				<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>';
			}
		}
	}

	$output .= $previous_link . $page_link . $next_link;
	$output .= '
	</ul>
	</div>';

	echo $output;

?>


<?php
	include "../includes/modals.php";
?>
<!-- Lightbox.js -->
<script src="../assets/js/lightbox.js"></script>

	<script>
		var options = {
			content: '<h4>Conversiones</h1><p>En esta columna podrás conocer las métricas de las siguientes acciones: </p><ul><li>-Personas dirigidas a tu whatsapp.</li><li>-Personas que iniciaron una conversación (Messenger).</li><li>-Personas que visitaron tu sitio web.</li></ul></h4><br><p>Para conocer que tipo de métrica se muestra en esta columna, revisa la columna “Objetivo de la campaña”.</p>',
			html: true,
			placement: 'bottom'
			};

			$('#popover').popover(options);

			/***** Dismiss all popovers by clicking outside  **************/

			$('html').on('click', function(e) {
				if (typeof $(e.target).data('original-title') == 'undefined') {
					$('[data-original-title]').popover('hide');
				}
			});
	</script>
	<script>
		var options = {
			content: '<h4>Imagenes de evidencias</h1><p>En esta columna podras ver las evidencias de tus campañas vigentes. </p><ul><li>-En el pie de foto podras ver el nombre de la campaña a la que pertenece la evidencia.</li><li>-Para ver la imagen siguiente da click en >, para regresar a la anterior en <, para regresar a tu panel da click en x .</li></ul>',
			html: true,
			placement: 'bottom'
			};

			$('#popoverImagen').popover(options);

			/***** Dismiss all popovers by clicking outside  **************/

			$('html').on('click', function(e) {
				if (typeof $(e.target).data('original-title') == 'undefined') {
					$('[data-original-title]').popover('hide');
				}
			});
	</script>
	<script>
		var options = {
			content: '<h4>Segmentación</h1><p>En esta columna podrás revisar la segmentación que se esta utilizando para la campaña en curso. </p><ul><li>-En el pie de foto podras ver el nombre de la campaña a la que pertenece la evidencia.</li><li>-Para ver la imagen siguiente da click en >, para regresar a la anterior en <, para regresar a tu panel da click en x .</li></ul>',
			html: true,
			placement: 'bottom'
			};

			$('#popoverSegmentación').popover(options);

			/***** Dismiss all popovers by clicking outside  **************/

			$('html').on('click', function(e) {
				if (typeof $(e.target).data('original-title') == 'undefined') {
					$('[data-original-title]').popover('hide');
				}
			});
	</script>
	<script>
		var options = {
			content: '<h4>Timeline</h1><p>En esta columna podrás revisar el Timeline que se esta utilizando para la campaña en curso. </p><ul><li>-En el pie de foto podras ver el nombre de la campaña a la que pertenece la evidencia.</li><li>-Para ver la imagen siguiente da click en >, para regresar a la anterior en <, para regresar a tu panel da click en x .</li></ul>',
			html: true,
			placement: 'bottom'
			};

			$('#popoverTimeline').popover(options);

			/***** Dismiss all popovers by clicking outside  **************/

			$('html').on('click', function(e) {
				if (typeof $(e.target).data('original-title') == 'undefined') {
					$('[data-original-title]').popover('hide');
				}
			});
	</script>

	<script>
		$(document).ready(function() {
			$('.editbtn').on('click', function() {
				$('#editmodal').modal('show');
				$tr = $(this).closest('tr');

				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();

				console.log(data);
				
				$('#update_id').val(data[1]);
				$('#plataformaEdit').val(data[3]);
				$('#nomCampanaEdit').val(data[4]);
				$('#objCampanaEdit').val(data[5]);
				$('#fechaInicioEdit').val(data[6]);
				$('#fechaFinEdit').val(data[7]);
				$('#presuInvertidoEdit').val(data[8]);
				$('#presuGastadoEdit').val(data[9]);
				$('#leadsEdit').val(data[10]);
				$('#llamadasEdit').val(data[11]);
				// Removido
				// $('#contactadosEdit').val(data[11]);
				// $('#agendadosEdit').val(data[12]);
				// $('#citaEdit').val(data[13]);
				// $('#demoEdit').val(data[14]);
				// $('#onlineEdit').val(data[15]);
				// $('#ventaEdit').val(data[16]);
				$('#costoXLeadEdit').val(data[12]);
				$('#conversionesEdit').val(data[13]);
				$('#interaccionesEdit').val(data[14]);
				$('#alcanceEdit').val(data[15]);
			});
		});


		$(document).ready(function() {
			$('.deletebtn').on('click', function() {
				$('#deletemodal').modal('show');
				
				$tr = $(this).closest('tr');

				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();

				console.log(data);
				
				$('#delete_id').val(data[1]);

			});
		});
	</script>