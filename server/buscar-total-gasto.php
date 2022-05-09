


<?php
	// ini_set(‘display_errors’,1);
	// error_reporting(E_ALL);
?>

<?php
	require '../secretInfo/conexion_BD.php';
	//$conn = new PDO("mysql:host=db5000973429.hosting-data.io; dbname=dbs846583", "dbu620410", "Galleta2020%");
	$conn = new PDO("mysql:host=db5000886678.hosting-data.io; dbname=dbs778238", "dbu591620", "Ga113Ta#772020");

	setlocale(LC_MONETARY, 'es_MX');


	$id_gasto = $_POST['idTotal'];
	$nom_empresa = $_POST['companyTotal'];
	$session = $_POST['sesionTotal'];
	$mes_actual = $_POST['mesactualTotal'];
	$anio_actual = $_POST['anioactualTotal'];

	$sql = "SELECT id, user, last_name, email, company, password, id_tipo FROM usuarios WHERE id = '$session'";
	$result = $conexion->query($sql);

	$rowUser = $result->fetch_assoc();

	$limit = '10';
	$page = 1;

	if($_POST['pageTotal'] > 1) {
		$start = (($_POST['pageTotal'] - 1) * $limit);
		$page = $_POST['pageTotal'];
	}
	else {
		$start = 0;
	}

	$conn->query("SET lc_time_names = 'es_ES'");	
	$query = "SELECT dia_gasto, facebook_gasto / leads_gasto_face as divFace, 
                                instagram_gasto / leads_gasto_insta as divInsta,
                                google_gasto / leads_gasto_goog as divGoog,
                                linkedin_gasto / leads_gasto_link as divLink,
                                waze_gasto / leads_gasto_waze as divWaze,
                                tiktok_gasto / leads_gasto_tik as divTik,
                                spotify_gasto / leads_gasto_spoti as divSpoti  FROM presupuesto_gastado WHERE empresa_gasto = '".$nom_empresa."' AND DATE_FORMAT(dia_gasto, '%M') = '".$mes_actual."' AND YEAR(dia_gasto) = '".$anio_actual."'";

	if($_POST['queryTotal'] != '') {
		$query .= 'AND empresa_gasto LIKE "'.str_replace(' ', '%', $_POST['query']).'%"';
	}

	$query .= 'ORDER BY id_gasto DESC ';

	$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

	$statement = $conn->prepare($query);
	$statement->execute();
	$total_data = $statement->rowCount();

	$statement = $conn->prepare($filter_query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_filter_data = $statement->rowCount();

	///////////////////////////////////////////////////

	if ($rowUser['id_tipo'] == "1"):

	$output = "
	<label>Total de registros: ".$total_data."</label>

		<table id='datatableid' class='text-center table table-hover table-bordered border-top-0 border-bottom-0'>
			<thead class='thead-dark'>
				<tr>
					<th scope='col' style='font-size:10px; display: none;'>Id</th>
					<th scope='col' style='font-size:10px; padding-left: 2.6rem; padding-right: 2.6rem;'>Dia</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Facebook</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Instagram</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Google</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>LinkedIn</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Waze</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>TikTok</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Spotify</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Media costo por leads</th>
				</tr>
			</thead>
			<tbody>";

	if($total_data > 0) {
		foreach($result as $row) {
            $totalGasto = ($row['divFace']+$row['divInsta']+$row['divGoog']+$row['divLink']+$row['divWaze']+$row['divTik']+$row['divSpoti'])/7;
			$output .= "
			<tr>
                <td style='display: none;'>".$row['id_gasto']."</td>
				<td>".date("j-M-Y", strtotime($row['dia_gasto']))."</td>
                <td>".money_format('%n', $row['divFace'])."</td> 
                <td>".money_format('%n', $row['divInsta'])."</td>
                <td>".money_format('%n', $row['divGoog'])."</td>
                <td>".money_format('%n', $row['divLink'])."</td>
                <td>".money_format('%n', $row['divWaze'])."</td>
                <td>".money_format('%n', $row['divTik'])."</td>
                <td>".money_format('%n', $row['divSpoti'])."</td>
                <td>".money_format('%n', $totalGasto)."</td>
			</tr>"; 
		}
		$output.="
		</tbody>
			<tfoot class='thead-dark'>
				<tr>
					<th scope='col' style='font-size:10px; display: none;'>Id</th>
					<th scope='col' style='font-size:10px; padding-left: 2.6rem; padding-right: 2.6rem;'>Dia</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Facebook</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Instagram</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Google</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>LinkedIn</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Waze</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>TikTok</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Spotify</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Media costo por leads</th>
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
					<th scope='col' style='font-size:10px; display: none;'>Id</th>
					<th scope='col' style='font-size:10px; padding-left: 2.6rem; padding-right: 2.6rem;'>Dia</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Facebook</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Instagram</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Google</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>LinkedIn</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Waze</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>TikTok</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Spotify</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Media costo por leads</th>
				</tr>
			</thead>
			<tbody>";

	if($total_data > 0) {
		foreach($result as $row) {
            $totalGasto = ($row['divFace']+$row['divInsta']+$row['divGoog']+$row['divLink']+$row['divWaze']+$row['divTik']+$row['divSpoti'])/7;
			$output .= "
			<tr>
				<td style='display: none;'>".$row['id_gasto']."</td>
				<td>".date("j-M-Y", strtotime($row['dia_gasto']))."</td>
				<td>".money_format('%n', $row['divFace'])."</td> 
                <td>".money_format('%n', $row['divInsta'])."</td>
                <td>".money_format('%n', $row['divGoog'])."</td>
                <td>".money_format('%n', $row['divLink'])."</td>
                <td>".money_format('%n', $row['divWaze'])."</td>
                <td>".money_format('%n', $row['divTik'])."</td>
                <td>".money_format('%n', $row['divSpoti'])."</td>
                <td>".money_format('%n', $totalGasto)."</td>
			</tr>"; 
		}
		$output.="
		</tbody>
			<tfoot class='thead-dark'>
				<tr>
					<th scope='col' style='font-size:10px; display: none;'>Id</th>
					<th scope='col' style='font-size:10px; padding-left: 2.6rem; padding-right: 2.6rem;'>Dia</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Facebook</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Instagram</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Google</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>LinkedIn</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Waze</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>TikTok</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Spotify</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Media costo por leads</th>
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

