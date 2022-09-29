<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}

?>
<script src="<?php web_root . 'plugins/jQuery/jquery-3.6.1.min.js'; ?>"></script>

<script>
	var url = "controller.php";
	var type = "POST";

	function cambiaTabla() {
		var mo_user_institution = $("#mo_user_institution").val();
		$.ajax({
			type: type,
			url: url,
			data: {
				op: '1',
				mo_user_institution: mo_user_institution
			},
			success: function(result) {
				$("#tbody-dash-table").html(result);
			}
		});
	}
</script>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Lista de Usuarios del instituto:
			<select style="font-size: 15px;" onchange="cambiaTabla()" id="mo_user_institution">
				<?php
				$mydb_mo->setQuery("SELECT DISTINCT institution FROM mo_user");
				$cur = $mydb_mo->loadResultList();
				foreach ($cur as $result) {
					echo '<option value="' . $result->institution . '">' . $result->institution . '</option>';
				}
				?>
			</select>
		</h1>


	</div>
</div>

<div id="div-dash-table">
	<form class="wow fadeInDownaction" Method="POST">
		<table class="table table-striped  table-hover table-responsive" style="font-size:12px" cellspacing="0">
			<thead>
				<tr>
					<th width="5%">ID Usuario</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Dirección</th>
					<th width="5%">Teléfono</th>
					<th width="5%">Teléfono 2</th>
					<th>Username</th>
					<th>Email</th>
					<th>Institución</th>
				</tr>
			</thead>
			<tbody id="tbody-dash-table">
				<?php

				// $mydb_mo->setQuery("SELECT * FROM mo_user WHERE INSTITUTION = $institution_name	");
				// $cur = $mydb_mo->loadResultList();

				// foreach ($cur as $result) {
				// 	echo '<tr>';
				// 	echo '<td>' . $result->id . '</a></td>';
				// 	echo '<td>' . $result->firstname . '</td>';
				// 	echo '<td>' . $result->lastname . '</td>';
				// 	echo '<td>' . $result->address . '</td>';
				// 	echo '<td>' . $result->phone1 . '</td>';
				// 	echo '<td>' . $result->phone2 . '</td>';
				// 	echo '<td>' . $result->email . '</td>';
				// 	echo '<td>' . $result->institution . '</td>';
				// 	echo '</tr>';
				// }
				?>
			</tbody>
		</table>
	</form>
</div>