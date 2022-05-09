


<?php
	// ini_set(‘display_errors’,1);
	// error_reporting(E_ALL);
?>

<?php
	require '../secretInfo/conexion_BD.php';
	//$conn = new PDO("mysql:host=db5000973429.hosting-data.io; dbname=dbs846583", "dbu620410", "Galleta2020%");
	$conn = new PDO("mysql:host=db5000886678.hosting-data.io; dbname=dbs778238", "dbu591620", "Ga113Ta#772020");

	setlocale(LC_MONETARY, 'es_MX');


	$id_gasto = $_POST['id_gasto'];
	$nom_empresa = $_POST['companyGasto'];
	$session = $_POST['sesionGasto'];
	$mes_actual = $_POST['mesactualGasto'];
	$anio_actual = $_POST['anioactualGasto'];

	$sql = "SELECT id, user, last_name, email, company, password, id_tipo FROM usuarios WHERE id = '$session'";
	$result = $conexion->query($sql);

	$rowUser = $result->fetch_assoc();

	$limit = '10';
	$page = 1;

	if($_POST['pageGasto'] > 1) {
		$start = (($_POST['pageGasto'] - 1) * $limit);
		$page = $_POST['pageGasto'];
	}
	else {
		$start = 0;
	}

	$conn->query("SET lc_time_names = 'es_ES'");	
	$query = "SELECT * FROM presupuesto_gastado WHERE empresa_gasto = '".$nom_empresa."' AND DATE_FORMAT(dia_gasto, '%M') = '".$mes_actual."' AND YEAR(dia_gasto) = '".$anio_actual."'";

	if($_POST['queryGasto'] != '') {
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
					<th scope='col' style='font-size:10px; padding-left: 2rem; padding-right: 2rem;'>Acciones</th>
					<th scope='col' style='font-size:10px; display: none;'>Id</th>
					<th scope='col' style='font-size:10px; padding-left: 2.6rem; padding-right: 2.6rem;'>Dia</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Facebook</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Instagram</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Google</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>LinkedIn</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Waze</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>TikTok</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Spotify</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Facebook</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Instagram</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Google</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads LinkedIn</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Navegaciones Waze</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads TikTok</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Spotify</th>
				</tr>
			</thead>
			<tbody>";

	if($total_data > 0) {
		foreach($result as $row) {
			
			$output .= "
			<tr>
				<td>
					<button class='deletebtnGasto btn btn-outline-danger' href='#'><i class='fas fa-trash-alt'></i></button>
					<button class='editbtnGasto btn btn-outline-info' href='#'><i class='fas fa-edit'></i></button>
				</td>
				<td style='display: none;'>".$row['id_gasto']."</td>
				<td>".$row['dia_gasto']."</td>
				<td>".money_format('%n', $row['facebook_gasto'])."</td> 
				<td>".money_format('%n', $row['instagram_gasto'])."</td>
				<td>".money_format('%n', $row['google_gasto'])."</td>
				<td>".money_format('%n', $row['linkedin_gasto'])."</td>
				<td>".money_format('%n', $row['waze_gasto'])."</td>
				<td>".money_format('%n', $row['tiktok_gasto'])."</td>
				<td>".money_format('%n', $row['spotify_gasto'])."</td>
				<td>".$row['leads_gasto_face']."</td>
				<td>".$row['leads_gasto_insta']."</td>
				<td>".$row['leads_gasto_goog']."</td>
				<td>".$row['leads_gasto_link']."</td>
				<td>".$row['leads_gasto_waze']."</td>
				<td>".$row['leads_gasto_tik']."</td>
				<td>".$row['leads_gasto_spoti']."</td>
			</tr>"; 
		}
		$output.="
		</tbody>
			<tfoot class='thead-dark'>
				<tr>
					<th scope='col' style='font-size:10px; padding-left: 2rem; padding-right: 2rem;'>Acciones</th>
					<th scope='col' style='font-size:10px; display: none;'>Id</th>
					<th scope='col' style='font-size:10px; padding-left: 2.6rem; padding-right: 2.6rem;'>Dia</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Facebook</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Instagram</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Google</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>LinkedIn</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Waze</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>TikTok</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Spotify</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Facebook</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Instagram</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Google</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads LinkedIn</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Navegaciones Waze</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads TikTok</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Spotify</th>
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
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Facebook</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Instagram</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Google</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads LinkedIn</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Navegaciones Waze</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads TikTok</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Spotify</th>
				</tr>
			</thead>
			<tbody>";

	if($total_data > 0) {
		foreach($result as $row) {
			
			$output .= "
			<tr>
				<td style='display: none;'>".$row['id_gasto']."</td>
				<td>".$row['dia_gasto']."</td>
				<td>".money_format('%n', $row['facebook_gasto'])."</td> 
				<td>".money_format('%n', $row['instagram_gasto'])."</td>
				<td>".money_format('%n', $row['google_gasto'])."</td>
				<td>".money_format('%n', $row['linkedin_gasto'])."</td>
				<td>".money_format('%n', $row['waze_gasto'])."</td>
				<td>".money_format('%n', $row['tiktok_gasto'])."</td>
				<td>".money_format('%n', $row['spotify_gasto'])."</td>
				<td>".$row['leads_gasto_face']."</td>
				<td>".$row['leads_gasto_insta']."</td>
				<td>".$row['leads_gasto_goog']."</td>
				<td>".$row['leads_gasto_link']."</td>
				<td>".$row['leads_gasto_waze']."</td>
				<td>".$row['leads_gasto_tik']."</td>
				<td>".$row['leads_gasto_spoti']."</td>
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
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Facebook</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Instagram</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Google</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads LinkedIn</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Navegaciones Waze</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads TikTok</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Leads Spotify</th>
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
		$(document).ready(function() {
			$('.editbtnGasto').on('click', function() {
				$('#editmodal-gasto').modal('show');
				$tr = $(this).closest('tr');

				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();

				console.log(data);
				
				$('#update_id_gasto_edit').val(data[1]);
				$('#fechaGastoEdit').val(data[2]);
				$('#presuGastoFaceEdit').val(data[3]);
				$('#presuGastoInstaEdit').val(data[4]);
				$('#presuGastoGoogEdit').val(data[5]);
				$('#presuGastoLinkEdit').val(data[6]);
				$('#presuGastoWazeEdit').val(data[7]);
				$('#presuGastoTikEdit').val(data[8]);
				$('#presuGastoSpotiEdit').val(data[9]);
				$('#leadsGastoFaceEdit').val(data[10]);
				$('#leadsGastoInstaEdit').val(data[11]);
				$('#leadsGastoGoogEdit').val(data[12]);
				$('#leadsGastoLinkEdit').val(data[13]);
				$('#leadsGastoWazeEdit').val(data[14]);
				$('#leadsGastoTikEdit').val(data[15]);
				$('#leadsGastoSpotiEdit').val(data[16]);
			});
		});


		$(document).ready(function() {
			$('.deletebtnGasto').on('click', function() {
				$('#deletemodal-gasto').modal('show');
				
				$tr = $(this).closest('tr');

				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();

				console.log(data);
				
				$('#delete_id_gasto').val(data[1]);

			});
		});
	</script>