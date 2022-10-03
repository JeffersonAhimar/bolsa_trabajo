
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

		if ($_POST['COMPANYNAME'] == "" || $_POST['COMPANYADDRESS'] == "" || $_POST['COMPANYCONTACTNO'] == "") {
			$messageStats = false;
			message("Todos los campos son requeridos!", "error");
			redirect('index.php?view=add');
		} else {
			$company = new Company();
			if ($company->usernameExists($_POST['COMPANYUSER'])) {
				message("El nombre de usuario ya está en uso!", "error");
				redirect('index.php?view=add');
			} else {
				$company->COMPANYNAME			= $_POST['COMPANYNAME'];
				$company->COMPANYADDRESS		= $_POST['COMPANYADDRESS'];
				$company->COMPANYRUC			= $_POST['COMPANYRUC'];
				$company->COMPANYCONTACTNO		= $_POST['COMPANYCONTACTNO'];
				$company->COMPANYSTATUS			= $_POST['COMPANYSTATUS'];
				$company->COMPANYUSER			= $_POST['COMPANYUSER'];
				$company->COMPANYPASS			= sha1($_POST['COMPANYPASS']);
				$company->COMPANYDEPARTAMENTO	= $_POST['COMPANYDEPARTAMENTO'];
				$company->COMPANYPROVINCIA		= $_POST['COMPANYPROVINCIA'];
				$company->COMPANYDISTRITO		= $_POST['COMPANYDISTRITO'];
				$company->create();
				message("Nueva compañía creada correctamente!", "success");
				redirect("index.php");
			}
		}
	}
}

function doEdit()
{
	if (isset($_POST['save'])) {
		$company = new Company();
		// VERIFY IF THE NEW USER NAME EXISTS
		$cur = $company->usernameEditExists($_POST['COMPANYID']);
		$state = false;
		foreach ($cur as $result) {
			if ($result->COMPANYUSER == $_POST['COMPANYUSER']) {
				$state = true;
			}
		}
		if ($state) {
			message("El nombre de usuario ya está en uso!", "error");
			redirect('index.php');
		} else {
			$company->COMPANYNAME			= $_POST['COMPANYNAME'];
			$company->COMPANYADDRESS		= $_POST['COMPANYADDRESS'];
			$company->COMPANYRUC			= $_POST['COMPANYRUC'];
			$company->COMPANYCONTACTNO		= $_POST['COMPANYCONTACTNO'];
			$company->COMPANYUSER			= $_POST['COMPANYUSER'];
			$company->COMPANYPASS			= sha1($_POST['COMPANYPASS']);
			$company->COMPANYDEPARTAMENTO	= $_POST['COMPANYDEPARTAMENTO'];
			$company->COMPANYPROVINCIA		= $_POST['COMPANYPROVINCIA'];
			$company->COMPANYDISTRITO		= $_POST['COMPANYDISTRITO'];
			$company->update($_POST['COMPANYID']);

			message("La compañía se ha actualizado!", "success");
			redirect("index.php");
		}
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

	// delete JOBS WHERE COMPANYID = ID
	$jobsToDelete = $company->getJobs($id);

	//
	$jobObj = new Jobs();
	$jrObj = new JobRegistration();

	// ELIMINAR TODOS LOS TRABAJOS DE LA COMPAÑIA
	foreach ($jobsToDelete as $item) {
		$jobId = $item->JOBID;

		// delete JOBREGISTRATION WHERE JOBID = ID
		$jrToDelete = $jobObj->getJobRegistrations($jobId);

		// ELIMINAR TODOS LAS POSTULACIONES DEL TRABAJO
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

		$jobObj->delete($jobId);
	}


	// ELIMINAR IMAGEN DE LA COMPAÑIA
	$logoCompany = $company->getPHOTOFROMSERVER($id);
	if ($logoCompany->COMPANYPHOTO == '') {
		echo '';
	} else {
		$file_path = path_to_delete . "uploads/images/companies/" . $logoCompany->COMPANYPHOTO;
		if (!file_exists($file_path)) {
			// echo 'El archivo no existe';
			echo '';
		} else {
			if (unlink($file_path)) {
				// echo 'El archivo fue eliminado satisfactoriamente';
				echo '';
			} else {
				echo 'Hubo un problema eliminando el archivo';
			}
		}
	}

	// BORRAR COMPAÑIA
	$company->delete($id);

	message("La compañía ha sido eliminada!", "info");
	redirect('index.php');
}
?>