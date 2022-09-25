<?php
if (!isset($_SESSION['ADMIN_COMPANYID'])) {
	redirect(web_root . "company/index.php");
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Lista de Ofertas Laborales <a href="index.php?view=add" class="btn btn-primary btn-xs  "> <i class="fa fa-plus-circle fw-fa"></i> Añadir Vacante Laboral</a> </h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<form action="controller.php?action=delete" Method="POST">
	<div class="table-responsive">
		<table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size:12px" cellspacing="0">

			<thead>
				<tr>

					<!-- <th>No.</th> -->
					<!-- <th>Nombre de Compañía</th> -->
					<th>Título Trabajo</th>
					<th>Categoría</th>
					<th>Vacantes</th>
					<th>Salarios</th>
					<th>Duración del empleo</th>
					<th>Calificación/Experiencia Laboral</th>
					<th>Descripción del Trabajo</th>
					<th>Modalidad</th>
					<th width="10%" align="center">Acción</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// `COMPANYID`, `OCCUPATIONTITLE`, `REQ_NO_EMPLOYEES`, `SALARIES`, `DURATION_EMPLOYEMENT`, `QUALIFICATION_WORKEXPERIENCE`, `JOBDESCRIPTION`,  `SECTOR_VACANCY`, `JOBSTATUS`
				$mydb->setQuery("SELECT * FROM `tbljob` j, `tblcompany` c WHERE j.COMPANYID=c.COMPANYID AND c.COMPANYID ='" . $_SESSION['ADMIN_COMPANYID'] . "'");
				$cur = $mydb->loadResultList();
				foreach ($cur as $result) {
					echo '<tr>';
					// echo '<td width="5%" align="center"></td>';
					// echo '<td>
					//      <input type="checkbox" name="selector[]" id="selector[]" value="'.$result->CATEGORYID. '"/>
					// 		' . $result->CATEGORIES.'</a></td>';
					// echo '<td>' . $result->COMPANYNAME . '</td>';
					echo '<td>' . $result->OCCUPATIONTITLE . '</td>';
					echo '<td>' . $result->CATEGORY . '</td>';
					echo '<td>' . $result->REQ_NO_EMPLOYEES . '</td>';
					echo '<td>' . $result->SALARIES . '</td>';
					echo '<td>' . $result->DURATION_EMPLOYEMENT . '</td>';
					echo '<td>' . $result->QUALIFICATION_WORKEXPERIENCE . '</td>';
					echo '<td>' . $result->JOBDESCRIPTION . '</td>';
					echo '<td>' . $result->JOBTYPE . '</td>';
					echo '<td align="center"><a title="Edit" href="index.php?view=edit&id=' . $result->JOBID . '" class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></a>
				  		     <a title="Delete" href="controller.php?action=delete&id=' . $result->JOBID . '" class="btn btn-danger btn-xs  ">  <span class="fa  fa-trash-o fw-fa "></a></td>';
					// echo '<td></td>';
					echo '</tr>';
				}
				?>
			</tbody>

		</table>


</form>

<div class="table-responsive">