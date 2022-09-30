<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Lista de las Compañías <a href="index.php?view=add" class="btn btn-primary btn-xs  "> <i class="fa fa-plus-circle fw-fa"></i> Añadir Compañía</a> </h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<form action="controller.php?action=delete" Method="POST">
	<div class="table-responsive">
		<table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size:12px" cellspacing="0">

			<thead>
				<tr>
					<!-- <th>No.</th> -->
					<th>Nombre</th>
					<th>Dirección</th>
					<th>RUC</th>
					<th>Nro. de Contacto</th>
					<th>Estado</th>
					<th>Nombre de Usuario</th>
					<th width="10%" align="center">Acción</th>
					<th>Departamento</th>
					<th>Provincia</th>
					<th>Distrito</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$mydb->setQuery("SELECT * FROM `tblcompany`");
				$cur = $mydb->loadResultList();
				foreach ($cur as $result) {
					echo '<tr>';
					echo '<td>' . $result->COMPANYNAME . '</td>';
					echo '<td>' . $result->COMPANYADDRESS . '</td>';
					echo '<td>' . $result->COMPANYRUC . '</td>';
					echo '<td>' . $result->COMPANYCONTACTNO . '</td>';


					if ($result->COMPANYSTATUS === 'deshabilitado') {
						echo '<td style="color:red; ">' . $result->COMPANYSTATUS . '</td>';
					} else {
						echo '<td style="color:green; ">' . $result->COMPANYSTATUS . '</td>';
					}
					echo '<td>' . $result->COMPANYUSER . '</td>';
					echo '<td align="center">
					
					<a title="Editar Estado" href="index.php?view=edit_status&id=' . $result->COMPANYID . '" class="btn btn-warning btn-xs  ">  <span class="fa fa-edit fw-fa"></a>
					<a title="Editar" href="index.php?view=edit&id=' . $result->COMPANYID . '" class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></a>
					
					<a title="Eliminar" href="controller.php?action=delete&id=' . $result->COMPANYID . '" class="btn btn-danger btn-xs  ">  <span class="fa  fa-trash-o fw-fa "></a>
					</td>';
					echo '<td>' . $result->COMPANYDEPARTAMENTO . '</td>';
					echo '<td>' . $result->COMPANYPROVINCIA . '</td>';
					echo '<td>' . $result->COMPANYDISTRITO . '</td>';
					echo '</tr>';
				}
				?>
			</tbody>

		</table>
		<div class="btn-group">
			<?php
			if ($_SESSION['ADMIN_ROLE'] == 'Administrador') {;
			} ?>
		</div>


</form>

<div class="table-responsive">