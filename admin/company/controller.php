
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


	case 'edit_status':
		doEdit_Status();
		break;


	case 'delete':
		doDelete();
		break;
}

function doInsert()
{
	if (isset($_POST['save'])) {

		// `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`
		if ($_POST['COMPANYNAME'] == "" || $_POST['COMPANYADDRESS'] == "" || $_POST['COMPANYCONTACTNO'] == "") {
			$messageStats = false;
			message("All field is required!", "error");
			redirect('index.php?view=add');
		} else {
			$company = new Company();
			$company->COMPANYNAME		= $_POST['COMPANYNAME'];
			$company->COMPANYADDRESS	= $_POST['COMPANYADDRESS'];
			$company->COMPANYRUC	= $_POST['COMPANYRUC'];
			$company->COMPANYCONTACTNO	= $_POST['COMPANYCONTACTNO'];
			$company->COMPANYSTATUS	= $_POST['COMPANYSTATUS'];
			$company->COMPANYUSER			= $_POST['COMPANYUSER'];
			$company->COMPANYPASS				= sha1($_POST['COMPANYPASS']);
			$company->create();

			message("Nueva compañía creada correctamente!", "success");
			redirect("index.php");
		}
	}
}

function doEdit()
{
	if (isset($_POST['save'])) {

		$company = new Company();
		$company->COMPANYNAME		= $_POST['COMPANYNAME'];
		$company->COMPANYADDRESS	= $_POST['COMPANYADDRESS'];
		$company->COMPANYRUC	= $_POST['COMPANYRUC'];
		$company->COMPANYCONTACTNO	= $_POST['COMPANYCONTACTNO'];
		$company->COMPANYUSER			= $_POST['COMPANYUSER'];
		$company->COMPANYPASS				= sha1($_POST['COMPANYPASS']);
		$company->COMPANYDEPARTAMENTO	= $_POST['COMPANYDEPARTAMENTO'];
		$company->COMPANYPROVINCIA	= $_POST['COMPANYPROVINCIA'];
		$company->COMPANYDISTRITO	= $_POST['COMPANYDISTRITO'];
		$company->update($_POST['COMPANYID']);

		message("La compañía se ha actualizado!", "success");
		redirect("index.php");
	}
}

function doEdit_Status()
{
	if (isset($_POST['save'])) {

		$company = new Company();
		$company->COMPANYSTATUS	= $_POST['COMPANYSTATUS'];
		$company->update($_POST['COMPANYID']);

		message("Estado Actualizado!", "success");
		redirect("index.php");
	}
}


function doDelete()
{

	$id = $_GET['id'];

	$company = new Company();
	$company->delete($id);

	message("La compañía ha sido eliminada!", "info");
	redirect('index.php');

}
?>