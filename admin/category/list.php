<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Lista de Categorías <a href="index.php?view=add" class="btn btn-primary btn-xs  "> <i class="fa fa-plus-circle fw-fa"></i> Añadir Categoría</a> </h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<form action="controller.php?action=delete" Method="POST">
	<div class="table-responsive">
		<table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size:12px" cellspacing="0">

			<thead>
				<tr>
					<!-- <th>No.</th> -->
					<th>
						Categoría
					</th>
					<?php
					if ($_SESSION['ADMIN_ROLE'] == 'Administrador') {
						echo '<th width="10%">Acción</th>';
					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
				$mydb->setQuery("SELECT * FROM `tblcategory`");
				$cur = $mydb->loadResultList();

				foreach ($cur as $result) {
					echo '<tr>';

					echo '<td>' . $result->CATEGORY . '</td>';
					if ($_SESSION['ADMIN_ROLE'] == 'Administrador') {
						echo '<td align="center"><a title="Edit" href="index.php?view=edit&id=' . $result->CATEGORYID . '" class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></a>
				  		     <a title="Delete" href="controller.php?action=delete&id=' . $result->CATEGORYID . '" class="btn btn-danger btn-xs ">  <span class="fa  fa-trash-o fw-fa "></a></td>';
					}
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