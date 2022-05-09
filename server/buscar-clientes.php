
<?php

//$conn = new PDO("mysql:host=db5000973429.hosting-data.io; dbname=dbs846583", "dbu620410", "Galleta2020%");
	$host_name = 'db5000886678.hosting-data.io';
    $database = 'dbs778238';
    $user_name = 'dbu591620';
    $password = 'Ga113Ta#772020';
    $conn = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);

	$id_campana = $_POST['id_campana'];
	$nom_empresa = $_POST['company'];

	$limit = '10';
	$page = 1;

	if($_POST['page'] > 1) {
		$start = (($_POST['page'] - 1) * $limit);
		$page = $_POST['page'];
	}
	else {
		$start = 0;
	}

	$query = "SELECT * FROM whatsapp WHERE campana_empresa = '".$nom_empresa."' ";

	//WHERE title LIKE '%".$q."%' OR brand LIKE '%".$q."%' OR model LIKE '%".$q."%' OR version LIKE '%".$q."%' OR vin LIKE '%".$q."%'  ";

	if($_POST['query'] != '') {
		$query .= 'LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR nombre LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR telefono LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR auto_interes LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
	}

	$query .= 'ORDER BY id_whatsapp DESC ';

	$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

	$statement = $conn->prepare($query);
	$statement->execute();
	$total_data = $statement->rowCount();

	$statement = $conn->prepare($filter_query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_filter_data = $statement->rowCount();

	$output = "
	<label>Total de leads: ".$total_data."</label>
		<table id='datatableid' class='text-center table table-hover table-bordered border-top-0 border-bottom-0'>
			<thead class='thead-dark'>
				<tr>
					<th scope='col' style='padding-left: 2rem; padding-right: 2rem;'>Acciones</th>
					<th scope='col'>Id</th>
					<th scope='col'>Cliente</th>
					<th scope='col'>Nombre</th>
					<th scope='col' style='padding-left: 1.6rem; padding-right: 1.6rem;'>WhatsApp</th>
					<th scope='col' style='padding-left: 1.6rem; padding-right: 1.6rem;'>auto interes</th>
					<th scope='col' style='padding-left: 1.6rem; padding-right: 1.6rem;'>Asesor</th>
					<th scope='col' style='padding-left: 1.6rem; padding-right: 1.6rem;'>fecha</th>
				</tr>
			</thead>
			<tbody>";

	if($total_data > 0) {
		foreach($result as $row) {
			$output .= "
			<tr>
				<td>
					<button class='deletebtnW btn btn-danger' href='#'><span class='glyphicon glyphicon-trash'></span></button>
					<button class='editbtnW btn btn-info' href='#'><span class='glyphicon glyphicon-pencil'></span></button>
				</td>
				<td>".$row['id_whatsapp']."</td>
				<td>".$row['campana_empresa']."</td>
				<td>".$row['nombre']."</td> 
				<td>".$row['telefono']."</td>
				<td>".$row['auto_interes']."</td>
				<td>".$row['asesor']."</td>
				<td>".$row['fecha']."</td>
			</tr>";
		}
		$output.="
		</tbody>
			<tfoot class='thead-dark'>
				<tr>
					<th scope='col' style='padding-left: 2rem; padding-right: 2rem;'>Acciones</th>
					<th scope='col'>Id</th>
					<th scope='col'>Cliente</th>
					<th scope='col'>Nombre</th>
					<th scope='col' style='padding-left: 1.6rem; padding-right: 1.6rem;'>Whatsapp</th>
					<th scope='col' style='padding-left: 1.6rem; padding-right: 1.6rem;'>auto interes</th>
					<th scope='col' style='padding-left: 1.6rem; padding-right: 1.6rem;'>Asesor</th>
					<th scope='col' style='padding-left: 1.6rem; padding-right: 1.6rem;'>fecha</th>
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
	<ul class="pagination justify-content-center" style="margin-bottom:15px;">';

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
			$('.editbtnW').on('click', function() {
				$('#editmodal-whatsapp').modal('show');
				$tr = $(this).closest('tr');

				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();

				console.log(data);
				
				$('#update_id_whatsapp').val(data[1]);
				$('#nomWhatsappEdit').val(data[3]);
				$('#telWhatsappEdit').val(data[4]);
				$('#interesWhatsappEdit').val(data[5]);
				$('#asesorWhatsappEdit').val(data[6]);
				$('#fechaEdit').val(data[7]);
				
			});
		});


		$(document).ready(function() {
			$('.deletebtnW').on('click', function() {
				$('#deletemodal-whatsapp').modal('show');
				
				$tr = $(this).closest('tr');

				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();

				console.log(data);
				
				$('#delete_id_whatsapp').val(data[1]);

			});
		});
	</script>