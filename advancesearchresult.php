<?php
$searchfor = (isset($_GET['searchfor']) && $_GET['searchfor'] != '') ? $_GET['searchfor'] : '';

?>
<style type="text/css">
	/*    --------------------------------------------------
	:: General
	-------------------------------------------------- */
	body {
		font-family: 'Open Sans', sans-serif;
		color: #353535;
	}

	.content {
		padding: 30px;
		min-height: 500px;
	}

	.content h1 {
		text-align: center;
	}

	.content .content-footer p {
		color: #6d6d6d;
		font-size: 12px;
		text-align: center;
	}

	.content .content-footer p a {
		color: inherit;
		font-weight: bold;
	}

	/*	--------------------------------------------------
	:: Table Filter
	-------------------------------------------------- */
	.panel {
		border: 1px solid #ddd;
		background-color: #fcfcfc;
	}

	.panel .btn-group {
		margin: 15px 0 30px;
	}

	.table-filter {
		background-color: #fff;
		border-bottom: 1px solid #eee;
	}

	.table-filter tbody tr:hover {
		cursor: pointer;
		background-color: #eee;
	}

	.table-filter tbody tr td {
		padding: 10px;
		vertical-align: middle;
		border-top-color: #eee;
	}

	.table-filter tbody tr.selected td {
		background-color: #eee;
	}

	.table-filter tr td:first-child {
		width: 38px;
	}

	.table-filter tr td:nth-child(2) {
		width: 35px;
	}

	.table-filter .star {
		color: #ccc;
		text-align: center;
		display: block;
	}

	.table-filter .star.star-checked {
		color: #F0AD4E;
	}

	.table-filter .star:hover {
		color: #ccc;
	}

	.table-filter .star.star-checked:hover {
		color: #F0AD4E;
	}

	.table-filter .media-photo {
		width: 35px;
	}

	.table-filter .media-body {
		display: block;
		/* Had to use this style to force the div to expand (wasn't necessary with my bootstrap version 3.3.6) */
	}

	.table-filter .media-meta {
		font-size: 11px;
		color: #999;
	}

	.table-filter .media .title {
		color: #2BBCDE;
		font-size: 14px;
		font-weight: bold;
		line-height: normal;
		margin: 0;
	}

	.table-filter .media .title span {
		font-size: .8em;
		margin-right: 20px;
	}

	.table-filter .media .title span.pagado {
		color: #5cb85c;
	}

	.table-filter .media .title span.pendiente {
		color: #f0ad4e;
	}

	.table-filter .media .title span.cancelado {
		color: #d9534f;
	}

	.table-filter .media .summary {
		font-size: 14px;
	}
</style>
<div class="container">
	<div class="row">

		<section class="content">

			<div class="col-md-12 ">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="pull-left">
							<div class="btn-group">
								<?php


								$search = isset($_POST['SEARCH']) ? ($_POST['SEARCH'] != '') ? $_POST['SEARCH'] : 'Todos' : 'Todos';
								$company = isset($_POST['COMPANY']) ? ($_POST['COMPANY'] != '') ? $_POST['COMPANY'] : 'Todos' : 'Todos';
								$category = isset($_POST['CATEGORY']) ? ($_POST['CATEGORY'] != '') ? $_POST['CATEGORY'] : 'Todos' : 'Todos';
								$pais = isset($_POST['PAIS']) ? ($_POST['PAIS'] != '') ? $_POST['PAIS'] : 'Todos' : 'Todos';
								$departamento = isset($_POST['DEPARTAMENTO']) ? ($_POST['DEPARTAMENTO'] != '') ? $_POST['DEPARTAMENTO'] : 'Todos' : 'Todos';
								$provincia = isset($_POST['PROVINCIA']) ? ($_POST['PROVINCIA'] != '') ? $_POST['PROVINCIA'] : 'Todos' : 'Todos';
								$distrito = isset($_POST['DISTRITO']) ? ($_POST['DISTRITO'] != '') ? $_POST['DISTRITO'] : 'Todos' : 'Todos';

								switch ($searchfor) {
									case 'bycompany':
										# code...
										echo 'Result : '  . $search . ' | Compañía : ' . $company;
										break;
									case 'advancesearch':
										# code... 
										echo 'Result : '  . $search . ' | Compañía : ' . $company . ' | Categoría : ' . $category;
										break;
									case 'byfunction':
										# code... 
										echo 'Result : '  . $search . ' | Categoría : ' . $category;
										break;

									case 'bylocation':
										# code... 
										# PAIS
										if ($pais != "Todos") {
											$sql = "SELECT * FROM tblpais WHERE idPais='" . $pais . "'";
											$mydb->setQuery($sql);
											$cur  = $mydb->loadSingleResult();
											$nom_pais = $cur->pais;
										} else {
											$nom_pais = "";
										}
										# DEPARTAMENTO
										if ($departamento != "Todos") {
											$sql = "SELECT * FROM tbldepartamentos WHERE idDepartamento='" . $departamento . "'";
											$mydb->setQuery($sql);
											$cur  = $mydb->loadSingleResult();
											$nom_departamento = $cur->departamento;
										} else {
											$nom_departamento = "";
										}
										# PROVINCIA
										if ($provincia != "Todos") {
											$sql = "SELECT * FROM tblprovincia WHERE idProvincia='" . $provincia . "'";
											$mydb->setQuery($sql);
											$cur  = $mydb->loadSingleResult();
											$nom_provincia = $cur->provincia;
										} else {
											$nom_provincia = "";
										}
										# DISTRITO
										if ($distrito != "Todos") {
											$sql = "SELECT * FROM tblDistrito WHERE idDistrito='" . $distrito . "'";
											$mydb->setQuery($sql);
											$cur  = $mydb->loadSingleResult();
											$nom_distrito = $cur->distrito;
										} else {
											$nom_distrito = "";
										}

										// echo 'Result : '  . $search . ' | Pais : ' . $pais . ' | Departamento : ' . $departamento . ' | Provincia : ' . $provincia . ' | Distrito : ' . $distrito;
										echo 'Result : '  . $search . ' | Pais : ' . $nom_pais . ' | Departamento : ' . $nom_departamento . ' | Provincia : ' . $nom_provincia . ' | Distrito : ' . $nom_distrito;
										break;

									case 'bytitle':
										# code... 
										echo 'Result : '  . $search;
										break;

									default:
										# code...
										break;
								}


								?>
							</div>
						</div>
						<div class="table-container">
							<table class="table table-filter">
								<tbody>
									<?php

									$search = isset($_POST['SEARCH']) ? $_POST['SEARCH'] : '';
									$company = isset($_POST['COMPANY']) ? $_POST['COMPANY'] : '';
									$category = isset($_POST['CATEGORY']) ? $_POST['CATEGORY'] : '';
									$pais = isset($_POST['PAIS']) ? $_POST['PAIS'] : '';
									$departamento = isset($_POST['DEPARTAMENTO']) ? $_POST['DEPARTAMENTO'] : '';
									$provincia = isset($_POST['PROVINCIA']) ? $_POST['PROVINCIA'] : '';
									$distrito = isset($_POST['DISTRITO']) ? $_POST['DISTRITO'] : '';

									// $sql = "SELECT * FROM `tbljob` j, `tblcompany` c WHERE j.`COMPANYID`=c.`COMPANYID` AND COMPANYNAME LIKE '%{$company}%' AND CATEGORY LIKE '%{$category}%' AND (`OCCUPATIONTITLE` LIKE '%{$search}%' OR `JOBDESCRIPTION` LIKE '%{$search}%' OR `QUALIFICATION_WORKEXPERIENCE` LIKE '%{$search}%')";
									$sql = "SELECT * FROM `tbljob` j, `tblcompany` c WHERE j.`COMPANYID`=c.`COMPANYID` AND `COMPANYNAME` LIKE '%{$company}%' AND `CATEGORY` LIKE '%{$category}%' AND `COMPANYPAIS` LIKE '%{$pais}%' AND `COMPANYDEPARTAMENTO` LIKE '%{$departamento}%' AND `COMPANYPROVINCIA` LIKE'%{$provincia}%' AND `COMPANYDISTRITO` LIKE'%{$distrito}%' AND (`OCCUPATIONTITLE` LIKE '%{$search}%' OR `JOBDESCRIPTION` LIKE '%{$search}%' OR `QUALIFICATION_WORKEXPERIENCE` LIKE '%{$search}%')";
									$mydb->setQuery($sql);
									$cur = $mydb->executeQuery();
									$maxrow = $mydb->num_rows($cur);

									if ($maxrow > 0) {
										# code... 
										$res = $mydb->loadResultList();
										foreach ($res as $row) {
									?>
											<tr>
												<td>
													<div class="media">
														<a href="#" class="pull-left">
															<?php
															if ($row->COMPANYPHOTO == '') {
																echo '<i class="icon-info-blocks fa fa-building-o" style="font-size: xxx-large;"></i>';
															} else {
																echo '<img src="' . web_root . 'uploads/images/companies/' . $row->COMPANYPHOTO . '" alt="" height="50px" >';
															}
															?>

														</a>
														<div class="media-body">
															<h4 class="title">
																<a href="index.php?q=viewjob&search=<?php echo $row->JOBID ?>">
																	<?php echo $row->OCCUPATIONTITLE; ?>
																</a>
																<span class="pull-right pagado">(Compañia <?php echo $row->COMPANYNAME ?>)</span>
															</h4>
															<p class="summary"><?php echo $row->JOBDESCRIPTION; ?></p>
														</div>
													</div>
												</td>
											</tr>
									<?php }
									} else {
										echo '<tr><td>Sin Resultados!</td></tr>';
									} ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>

	</div>
</div>