
<?php
require_once("../../include/initialize.php");
if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add':
		doInsert();
		break;

	case 'edit':
		doEdit();
		break;

	case 'delete':
		doDelete();
		break;
}

function doInsert()
{
	if (isset($_POST['save'])) {


		if ($_POST['CATEGORY'] == "") {
			$messageStats = false;
			message("Todos los campos son requeridos!", "error");
			redirect('index.php?view=add');
		} else {
			$category = new Category();
			$category->CATEGORY	= $_POST['CATEGORY'];
			$category->create();

			message("Nueva Categoría [" . $_POST['CATEGORY'] . "] creada correctamente!", "success");
			redirect("index.php");
		}
	}
}

function doEdit()
{
	if (isset($_POST['save'])) {

		$category = new Category();
		$category->CATEGORY	= $_POST['CATEGORY'];
		$category->update($_POST['CATEGORYID']);

		message("La Categoría [" . $_POST['CATEGORY'] . "] ha sido actualizada!", "success");
		redirect("index.php");
	}
}


function doDelete()
{

	$id = $_GET['id'];

	$category = new Category();
	$category->delete($id);

	message("La Categoría ha sido eliminada!", "info");
	redirect('index.php');
}
?>