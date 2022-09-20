<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}

?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Lista de Usuarios <a href="index.php?view=add" class="btn btn-primary btn-xs  "> <i class="fa fa-plus-circle fw-fa"></i> Añadir Nuevo Empleado</a> </h1>
	</div>
	<!-- /.col-lg-12 -->
</div>


<form class="wow fadeInDownaction" action="controller.php?action=delete" Method="POST">
	<table id="dash-table" class="table table-striped  table-hover table-responsive" style="font-size:12px" cellspacing="0">

		<thead>
			<tr>
				<th width="5%">ID Usuario</th>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Dirección</th>
				<th>Género</th>
				<th>Estado Civil</th>
				<th>Edad</th>
				<th>Correo Electrónico</th>
				<th>Nro. Contacto</th>
				<th width="14%">Acción</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$mydb->setQuery("SELECT * 
														FROM   `tblapplicants`");
			$cur = $mydb->loadResultList();

			foreach ($cur as $result) {
				echo '<tr>';
				echo '<td>' . $result->APPLICANTID . '</a></td>';
				echo '<td>' . $result->FNAME . ' ' . $result->MNAME . '</td>';
				echo '<td>' . $result->LNAME . '</td>';
				echo '<td>' . $result->ADDRESS . '</td>';
				echo '<td>' . $result->SEX . '</td>';
				echo '<td>' . $result->CIVILSTATUS . '</td>';
				echo '<td>' . $result->AGE . '</td>';
				echo '<td>' . $result->EMAILADDRESS . '</td>';
				echo '<td>' . $result->CONTACTNO . '</td>';
				echo '<td align="center" >    
					  		             <a title="Edit" href="index.php?view=edit&id=' . $result->APPLICANTID . '"  class="btn btn-info btn-xs  ">
					  		             <span class="fa fa-edit fw-fa"></span></a> 
					  		             <a title="Delete" href="controller.php?action=delete&id=' . $result->APPLICANTID . '"  class="btn btn-danger btn-xs  ">
					  		             <span class="fa fa-trash-o fw-fa"></span></a> 
					  					 </td>';
				echo '</tr>';
			}
			?>
		</tbody>

	</table>


</form>