
<?php
require_once("../include/initialize.php");
// if (!isset($_SESSION['ADMIN_USERID'])) {
// 	redirect(web_root . "admin/index.php");
// }


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add':
		doRegister();
		break;
}

function doRegister()
{
	if (isset($_POST['save'])) {

		// `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`
		if ($_POST['COMPANYNAME'] == "" || $_POST['COMPANYADDRESS'] == "" || $_POST['COMPANYCONTACTNO'] == "") {
			$messageStats = false;
			message("All field is required!", "error");
			// redirect('index.php?view=add');
			redirect(web_root . "company/login.php");
		} else {
			$company = new Company();
			$company->COMPANYNAME		= $_POST['COMPANYNAME'];
			$company->COMPANYADDRESS	= $_POST['COMPANYADDRESS'];
			$company->COMPANYCONTACTNO	= $_POST['COMPANYCONTACTNO'];
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