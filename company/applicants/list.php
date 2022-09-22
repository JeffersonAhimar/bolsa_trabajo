<?php
if (!isset($_SESSION['ADMIN_COMPANYID'])) {
	redirect(web_root . "admin/index.php");
}

?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Lista de Postulantes </h1>
	</div>
	<!-- /.col-lg-12 -->
</div>


<form class="wow fadeInDownaction" action="controller.php?action=delete" Method="POST">
	<table id="dash-table" class="table table-striped  table-hover table-responsive" style="font-size:12px" cellspacing="0">

		<thead>
			<tr>
				<th>Título Trabajo</th>
				<th>Postulante</th>
				<!-- <th>Compañía</th> -->
				<th>Fecha de postulación</th>
				<th>Observaciones</th>
				<th width="14%">Acción</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// $mydb->setQuery("SELECT * 
			// 			FROM  `tblusers` WHERE TYPE != 'Customer'");
			$mydb->setQuery("SELECT * FROM `tblcompany` c  , `tbljobregistration` j, `tbljob` j2, `tblapplicants` a WHERE c.`COMPANYID`=j.`COMPANYID` AND  j.`JOBID`=j2.`JOBID` AND j.`APPLICANTID`=a.`APPLICANTID` AND c.COMPANYID ='" . $_SESSION['ADMIN_COMPANYID'] . "'");
			$cur = $mydb->loadResultList();

			foreach ($cur as $result) {
				echo '<tr>';
				// echo '<td width="5%" align="center"></td>';
				echo '<td>' . $result->OCCUPATIONTITLE . '</a></td>';
				echo '<td>' . $result->APPLICANT . '</td>';
				// echo '<td>' . $result->COMPANYNAME . '</a></td>';
				echo '<td>' . $result->REGISTRATIONDATE . '</td>';
				echo '<td>' . $result->REMARKS . '</td>';
				echo '<td align="center" >    
					  		             <a title="View" href="index.php?view=view&id=' . $result->REGISTRATIONID . '"  class="btn btn-info btn-xs  ">
					  		             <span class="fa fa-info fw-fa"></span> Ver</a> 
					  		             <a title="Remove" href="controller.php?action=delete&id=' . $result->REGISTRATIONID . '"  class="btn btn-danger btn-xs  ">
					  		             <span class="fa fa-trash-o fw-fa"></span> Eliminar</a> 
					  					 </td>';
				echo '</tr>';
			}
			?>
		</tbody>

	</table>


</form>