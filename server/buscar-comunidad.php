<?php
require '../secretInfo/conexion_BD.php';
//$conn = new PDO("mysql:host=db5000973429.hosting-data.io; dbname=dbs846583", "dbu620410", "Galleta2020%");
$conn = new PDO("mysql:host=db5000886678.hosting-data.io; dbname=dbs778238", "dbu591620", "Ga113Ta#772020");


	$id_campana = $_POST['id_campanaCom'];
	$nom_empresa = $_POST['companyCom'];
	$session = $_POST['sesionCom'];
	$mes_actual = $_POST['mesactualCom'];
	$anio_actual = $_POST['anioactualCom'];


	$sql = "SELECT id, user, last_name, email, company, password, id_tipo FROM usuarios WHERE id = '$session'";
	$result = $conexion->query($sql);

	$rowUser = $result->fetch_assoc();

	$limit = '1';
	$page = 1;

	if($_POST['pageCom'] > 1) {
		$start = (($_POST['pageCom'] - 1) * $limit);
		$page = $_POST['pageCom'];
	}
	else {
		$start = 0;
	}

	$query = "SELECT * FROM comunidad WHERE nom_empresa_comu = '".$nom_empresa."' AND mes_comunidad = '".$mes_actual."' ";
	if($_POST['queryCom'] != '') {
        $query .= 'LIKE "%'.str_replace(' ', '%', $_POST['queryCom']).'%" OR datos_facebook LIKE "%'.str_replace(' ', '%', $_POST['queryCom']).'%" OR datos_spotify LIKE "%'.str_replace(' ', '%', $_POST['queryCom']).'%" OR datos_waze LIKE "%'.str_replace(' ', '%', $_POST['queryCom']).'%" ';
	}

	$query .= 'ORDER BY id_comunidad DESC ';

	$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

	$statement = $conn->prepare($query);
	$statement->execute();
	$total_data = $statement->rowCount();

	$statement = $conn->prepare($filter_query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_filter_data = $statement->rowCount();

	$output = "
	<table id='datatableid' class='text-center table table-hover table-bordered border-top-0 border-bottom-0'>
			<thead class='thead-dark'>
				<tr>
					<th scope='col' style='font-size:10px; padding-left: 2rem; padding-right: 2rem;'>Acciones</th>
					<th scope='col' style='font-size:10px;'>Id</th>
					<th scope='col' style='font-size:10px;'>Cliente</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Seguidores Facebook</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Seguidores Instagram</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Seguidores Twitter</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Seguidores Youtube</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Seguidores LinkEdin</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Seguidores Spotify</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Seguidores TikTok</th>
					<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Mes en curso</th>
				</tr>
			</thead>
		<tbody>";
		if($total_data > 0) {
			foreach($result as $row) {
				
				$output .= "
					<tr>
						<td>
							
							<button class='editbtnCom btn btn-outline-info' href='#'><i class='fas fa-edit'></i></button>
						</td>
						<td>".$row['id_comunidad']."</td>
						<td>".$row['nom_empresa_comu']."</td>
						<td>".$row['datos_facebook']."</td>
						<td>".$row['datos_intagram']."</td>
						<td>".$row['datos_twitter']."</td>
						<td>".$row['datos_youtube']."</td>
						<td>".$row['datos_linkedin']."</td>
						<td>".$row['datos_spotify']."</td>
						<td>".$row['datos_tiktok']."</td>
						<td>".$row['mes_comunidad']."</td>					
					</tr>";
			}
			$output.="
			</tbody>
				<tfoot class='thead-dark'>
					<tr>
						<th scope='col' style='font-size:10px; padding-left: 2rem; padding-right: 2rem;'>Acciones</th>
						<th scope='col' style='font-size:10px;'>Id</th>
						<th scope='col' style='font-size:10px;'>Cliente</th>
						<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Seguidores Facebook</th>
						<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Seguidores Instagram</th>
						<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Seguidores Twitter</th>
						<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Seguidores Youtube</th>
						<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Seguidores LinkEdin</th>
						<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Seguidores Spotify</th>
						<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Seguidores TikTok</th>
						<th scope='col' style='font-size:10px; padding-left: 1.6rem; padding-right: 1.6rem;'>Mes en curso</th>
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

<script>
		$(document).ready(function() {
			$('.editbtnCom').on('click', function() {
				$('#editarComunidad').modal('show');
				$tr = $(this).closest('tr');

				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();

				console.log(data);
				
				$('#id_campana_comunidad').val(data[1]);
				$('#facebookEdit').val(data[3]);
				$('#instagramEdit').val(data[4]);
				$('#twitterEdit').val(data[5]);
				$('#youtubeEdit').val(data[6]);
				$('#linkEdit').val(data[7]);
				$('#spotifyEdit').val(data[8]);
				$('#tiktokEdit').val(data[9]);
				
				
			});
		});
	</script>