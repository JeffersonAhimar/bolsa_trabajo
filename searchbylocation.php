<?php
if (!isset($_SESSION['APPLICANTID'])) {
	# code...
	redirect(web_root . 'index.php');
}
?>
<style type="text/css">
	#content {
		min-height: 500px;
	}

	#content .panel {
		padding: 10px;
	}

	.panel-body label {
		font-size: 20px;
	}

	.panel-body input {
		font-size: 15px;
	}

	.panel-body>.row {
		margin-bottom: 10px;
	}
</style>
<script src="<?php web_root . 'plugins/jQuery/jquery-3.6.1.min.js'; ?>"></script>

<script>
	var url = "process.php";
	var type = "POST";

	function searchByLocation_Departamento() {
		var idPais = $("#PAIS").val();
		$.ajax({
			type: type,
			url: url,
			data: {
				op: '4',
				idPais: idPais
			},
			success: function(result) {
				$("#DEPARTAMENTO").html(result);
				searchByLocation_Provincia();
				searchByLocation_Distrito();
			}
		});
	}

	function searchByLocation_Provincia() {
		var idDepartamento = $("#DEPARTAMENTO").val();
		$.ajax({
			type: type,
			url: url,
			data: {
				op: '5',
				idDepartamento: idDepartamento
			},
			success: function(result) {
				$("#PROVINCIA").html(result);
				searchByLocation_Distrito();
			}
		});
	}

	function searchByLocation_Distrito() {
		var idProvincia = $("#PROVINCIA").val();
		$.ajax({
			type: type,
			url: url,
			data: {
				op: '6',
				idProvincia: idProvincia
			},
			success: function(result) {
				$("#DISTRITO").html(result);
			}
		});
	}
</script>
<form action="index.php?q=result&searchfor=bylocation" method="POST">
	<section id="content">
		<div class="container content">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<div class="panel">
					<div class="panel-header"></div>
					<div class="panel-body">
						<!-- <div class="row">
							<div class="col-sm-12 search1">
								<label class="col-sm-3">BÚSQUEDA:</label>
								<div class="col-sm-9">
									<input class="form-control" type="" name="SEARCH" placeholder="">
								</div>
							</div>
						</div> -->
						<div class="row">
							<div class="col-sm-12 search1">
								<label class="col-sm-3">PAÍS:</label>
								<div class="col-sm-9">
									<select class="form-control" id="PAIS" name="PAIS" onchange="searchByLocation_Departamento()">
										<option value="">Todos</option>
										<?php
										$sql = "SELECT * FROM `tblpais`";
										$mydb->setQuery($sql);
										$res = $mydb->loadResultList();
										foreach ($res as $row) {
											echo '<option value=' . $row->idPais . '>' . $row->pais . '</option>';
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 search1">
								<label class="col-sm-3">DEPARTAMENTO:</label>
								<div class="col-sm-9">
									<select class="form-control" id="DEPARTAMENTO" name="DEPARTAMENTO" onchange="searchByLocation_Provincia()">
										<option value="">Todos</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 search1">
								<label class="col-sm-3">PROVINCIA:</label>
								<div class="col-sm-9">
									<select class="form-control" id="PROVINCIA" name="PROVINCIA" onchange="searchByLocation_Distrito()">
										<option value="">Todos</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 search1">
								<label class="col-sm-3">DISTRITO:</label>
								<div class="col-sm-9">
									<select class="form-control" id="DISTRITO" name="DISTRITO">
										<option value="">Todos</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 search1">
								<label class="col-sm-3"></label>
								<div class="col-sm-9">
									<input type="submit" name="submit" class="btn btn-success">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</section>
</form>