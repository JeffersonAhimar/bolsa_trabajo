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
				formExportData();
			}
		});
	}

	function formExportData() {
		var mo_user_institution = $("#mo_user_institution").val();
		$.ajax({
			type: type,
			url: url,
			data: {
				op: '2',
				mo_user_institution: mo_user_institution
			},
			success: function(result) {
				$("#form_export_data").html(result);
			}
		});
	}
</script>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Instituto:
			<select style="font-size: 15px;" onchange="cambiaTabla()" id="mo_user_institution">
				<option>--- Seleccione un Instituto ---</option>
				<?php
				$mydb_mo->setQuery("SELECT DISTINCT institution FROM mo_user ORDER BY institution ASC");
				$cur = $mydb_mo->loadResultList();
				foreach ($cur as $result) {
					if ($result->institution == "") {
						$lastInstitution = $result->institution;
					} else {
						echo '<option value="' . $result->institution . '">' . $result->institution . '</option>';
					}
				}
				echo '<option value="' . $lastInstitution . '">' . 'SIN INSTITUCION' . '</option>';
				?>
			</select>
			<div id="form_export_data" style="display: inline;">
				<form action="<?php echo web_root; ?>admin/employee/dataController.php" method="post" style="display: inline;">
					<button type="submit" id="export_data" name="exportarCSV" value="Export to excel" class="btn" style="padding: 0; background:none;">
						<img src="<?php echo web_root; ?>uploads/images/sql_csv.ico" alt="Exportar en CSV" style="width: 50px; height: 50px;">
					</button>
					<input type="hidden" name="instName" id="instName" value="">
				</form>
			</div>

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