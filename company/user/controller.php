<?php
require_once("../../include/initialize.php");
if (!isset($_SESSION['ADMIN_COMPANYID'])) {
	redirect(web_root . "admin/index.php");
}

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {

	case 'edit':
		doEdit();
		break;

	case 'photos':
		doupdateimage();
		break;
}


function doEdit()
{
	if (isset($_POST['save'])) {

		$user = new Company();

		$user->COMPANYNAME 		= $_POST['U_NAME'];
		$user->COMPANYADDRESS 		= $_POST['U_ADDRESS'];
		$user->COMPANYRUC 		= $_POST['U_RUC'];
		$user->COMPANYDEPARTAMENTO 		= $_POST['U_DEPARTAMENTO'];
		$user->COMPANYPROVINCIA 		= $_POST['U_PROVINCIA'];
		$user->COMPANYDISTRITO 		= $_POST['U_DISTRITO'];
		$user->COMPANYCONTACTNO 		= $_POST['U_CONTACTNO'];
		$user->COMPANYUSER			= $_POST['U_USERNAME'];
		$user->COMPANYPASS				= sha1($_POST['U_PASS']);
		$user->update($_POST['COMPANYID']);

		if (isset($_GET['view'])) {
			# code...
			message("Su perfil ha sido actualizado!", "success");
			redirect("index.php?view=view");
		} else {
			message("[" . $_POST['U_NAME'] . "] ha sido actualizado!", "success");
			redirect("index.php");
		}
	}
}




// actualizar foto de la compañia
function doupdateimage()
{

	$errofile = $_FILES['photo']['error'];
	$type = $_FILES['photo']['type'];
	$temp = $_FILES['photo']['tmp_name'];
	// $myfile = $_FILES['photo']['name'];
	$myfile = date("dmYhis") . "_" . $_SESSION['ADMIN_COMPANYID'] . "_" . basename($_FILES['photo']['name']);
	$location = $myfile;


	if ($errofile > 0) {
		message("No hay imagen seleccionada!", "error");
		redirect("index.php?view=view&id=" . $_GET['id']);
	} else {

		@$file = $_FILES['photo']['tmp_name'];
		@$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		@$image_name = addslashes($_FILES['photo']['name']);
		@$image_size = getimagesize($_FILES['photo']['tmp_name']);

		if ($image_size == FALSE) {
			message("El archivo no es una imagen!", "error");
			redirect("index.php?view=view&id=" . $_GET['id']);
		} else {
			$user = new Company();

			// ELIMINAR IMAGEN DE LA COMPAÑIA
			$logoCompany = $user->getPHOTOFROMSERVER($_SESSION['ADMIN_COMPANYID']);
			$file_path = path_to_delete . "uploads/images/companies/" . $logoCompany->COMPANYPHOTO;
			if (!file_exists($file_path)) {
				echo 'El archivo no existe';
			} else {
				if (unlink($file_path)) {
					// echo 'El archivo fue eliminado satisfactoriamente';
					echo '';
				} else {
					echo 'Hubo un problema eliminando el archivo';
				}
			}

			//uploading the file
			move_uploaded_file($temp, path_to_delete . "uploads/images/companies/" . $myfile);



			$user->COMPANYPHOTO 			= $location;
			$user->update($_SESSION['ADMIN_COMPANYID']);
			// redirect("index.php?view=view");
			redirect("../vacancy");
		}
	}
}
