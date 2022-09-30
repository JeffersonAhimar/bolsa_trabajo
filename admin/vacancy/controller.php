
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

		if ($_POST['COMPANYID'] == "None") {
			$messageStats = false;
			message("Todos los campos son requeridos!", "error");
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

			message("Nueva Oferta Laboral creada Correctamente!", "success");
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
			message("Todos los campos son requeridos!", "error");
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

			message("La Oferta Laboral ha sido actualizada!", "success");
			redirect("index.php");
		}
	}
}


function doDelete()
{
	$id = $_GET['id'];

	$job = new Jobs();

	// delete JOBREGISTRATION WHERE JOBID = ID
	$jrToDelete = $job->getJobRegistrations($id);

	// 
	$jrObj = new JobRegistration();

	// ELIMINAR TODAS LAS POSTULACIONES
	foreach ($jrToDelete as $result) {
		// $result->REGISTRATIONID
		// delete from webroot/uploads/documents ATTACHMENTFILE WHERE FILEID = JR.FILEID
		//BORRANDO EL ARCHIVO DEL SERVIDOR
		$fileAttachment = $jrObj->getFILEFROMSERVER($result->REGISTRATIONID);
		$file_path = path_to_delete . "uploads/documents/" . $fileAttachment->FILE_LOCATION;
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

		// delete from database ATTACHMENTFILE WHERE FILEID = JR.FILEID
		$jrObj->deleteAttachmentFile($result->REGISTRATIONID);

		// delete FEEDBACK WHERE REGISTRATIONID = ID
		$jrObj->deleteFeedback($result->REGISTRATIONID);

		// delete from TBLJOBREGISTRATION
		$jrObj->delete($result->REGISTRATIONID);
	}
	// JOBREGISTRATIONS ELIMINADOS

	$job->delete($id);

	message("La Oferta Laboral ha sido eliminada!", "info");
	redirect('index.php');
}
?>