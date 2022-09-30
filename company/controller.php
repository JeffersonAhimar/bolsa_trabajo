
<?php
require_once("../include/initialize.php");


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add':
		doRegister();
		break;
}

function doRegister()
{
	if (isset($_POST['save'])) {

		if ($_POST['COMPANYNAME'] == "" || $_POST['COMPANYADDRESS'] == "" || $_POST['COMPANYCONTACTNO'] == "") {
			$messageStats = false;
			message("Todos los campos son requeridos!", "error");
			// redirect('index.php?view=add');
			redirect(web_root . "company/login.php");
		} else {
			$company = new Company();
			$company->COMPANYNAME		= $_POST['COMPANYNAME'];
			$company->COMPANYADDRESS	= $_POST['COMPANYADDRESS'];
			$company->COMPANYRUC	= $_POST['COMPANYRUC'];
			$company->COMPANYCONTACTNO	= $_POST['COMPANYCONTACTNO'];
			$company->COMPANYDEPARTAMENTO	= $_POST['COMPANYDEPARTAMENTO'];
			$company->COMPANYPROVINCIA	= $_POST['COMPANYPROVINCIA'];
			$company->COMPANYDISTRITO	= $_POST['COMPANYDISTRITO'];
			$company->COMPANYSTATUS	= 'disabled';
			$company->COMPANYUSER			= $_POST['COMPANYUSER'];
			$company->COMPANYPASS				= sha1($_POST['COMPANYPASS']);
			$company->create();

			message("Espere a que el admin habilite su cuenta!", "success");
			// redirect("login.php");
			redirect(web_root . "company/login.php");
		}
	}
}


?>