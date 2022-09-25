
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
	global $mydb;
	if (isset($_POST['save'])) {
		// `COMPANYID`, `OCCUPATIONTITLE`, `REQ_NO_EMPLOYEES`, `SALARIES`, `DURATION_EMPLOYEMENT`, `QUALIFICATION_WORKEXPERIENCE`, `JOBDESCRIPTION`

		if ($_POST['COMPANYID'] == "None") {
			$messageStats = false;
			message("All field is required!", "error");
			redirect('index.php?view=add');
		} else {
			$sql = "SELECT * FROM tblcategory where CATEGORYID = {$_POST['CATEGORY']}";
			$mydb->setQuery($sql);
			$cat = $mydb->loadSingleResult();
			$_POST['CATEGORY'] = $cat->CATEGORY;
			$job = new Jobs();
			$job->COMPANYID							= $_POST['COMPANYID'];
			$job->CATEGORY							= $_POST['CATEGORY'];
			$job->OCCUPATIONTITLE					= $_POST['OCCUPATIONTITLE'];
			$job->REQ_NO_EMPLOYEES					= $_POST['REQ_NO_EMPLOYEES'];
			$job->SALARIES							= $_POST['SALARIES'];
			$job->DURATION_EMPLOYEMENT				= $_POST['DURATION_EMPLOYEMENT'];
			$job->QUALIFICATION_WORKEXPERIENCE		= $_POST['QUALIFICATION_WORKEXPERIENCE'];
			$job->JOBDESCRIPTION					= $_POST['JOBDESCRIPTION'];
			$job->JOBTYPE						= $_POST['JOBTYPE'];
			$job->DATEPOSTED						= date('Y-m-d H:i');
			$job->create();

			message("Nueva Vacante Laboral creada Correctamente!", "success");
			redirect("index.php");
		}
	}
}

function doEdit()
{
	global $mydb;
	if (isset($_POST['save'])) {
		if ($_POST['COMPANYID'] == "None") {
			$messageStats = false;
			message("All field is required!", "error");
			redirect('index.php?view=add');
		} else {
			$sql = "SELECT * FROM tblcategory where CATEGORYID = {$_POST['CATEGORY']}";
			$mydb->setQuery($sql);
			$cat = $mydb->loadSingleResult();
			$_POST['CATEGORY'] = $cat->CATEGORY;
			$job = new Jobs();
			$job->COMPANYID							= $_POST['COMPANYID'];
			$job->CATEGORY							= $_POST['CATEGORY'];
			$job->OCCUPATIONTITLE					= $_POST['OCCUPATIONTITLE'];
			$job->REQ_NO_EMPLOYEES					= $_POST['REQ_NO_EMPLOYEES'];
			$job->SALARIES							= $_POST['SALARIES'];
			$job->DURATION_EMPLOYEMENT				= $_POST['DURATION_EMPLOYEMENT'];
			$job->QUALIFICATION_WORKEXPERIENCE		= $_POST['QUALIFICATION_WORKEXPERIENCE'];
			$job->JOBDESCRIPTION					= $_POST['JOBDESCRIPTION'];
			$job->JOBTYPE						= $_POST['JOBTYPE'];
			$job->update($_POST['JOBID']);

			message("La Vacante Laboral ha sido actualizada!", "success");
			redirect("index.php");
		}
	}
}


function doDelete()
{

	$id = $_GET['id'];

	$job = new Jobs();
	$job->delete($id);

	message("La Vacante Laboral ha sido eliminada!", "info");
	redirect('index.php');
}
?>