<?php
require_once("../../include/initialize.php");
if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {

	case 'delete':
		doDelete();
		break;

	case 'approve':
		doApproved();
		break;
}

function doDelete()
{
	$id = 	$_GET['id'];

	// $emp = new Employee();
	$emp = new JobRegistration();

	// delete from webroot/uploads/documents ATTACHMENTFILE WHERE FILEID = JR.FILEID
	//BORRANDO EL ARCHIVO DEL SERVIDOR
	$fileAttachment = $emp->getFILEFROMSERVER($id);
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
	$emp->deleteAttachmentFile($id);

	// delete FEEDBACK WHERE REGISTRATIONID = ID
	$emp->deleteFeedback($id);

	// delete from TBLJOBREGISTRATION
	$emp->delete($id);

	// }
	message("Postulación eliminada!", "success");
	redirect('index.php');
	// }
}
function doApproved()
{
	global $mydb;
	if (isset($_POST['submit'])) {
		# code...
		$id = $_POST['JOBREGID'];
		$applicantid = $_POST['APPLICANTID'];

		$remarks = $_POST['REMARKS'];
		$sql = "UPDATE `tbljobregistration` SET `REMARKS`='{$remarks}',PENDINGAPPLICATION=0,HVIEW=0,DATETIMEAPPROVED=NOW() WHERE `REGISTRATIONID`='{$id}'";
		$mydb->setQuery($sql);
		$cur = $mydb->executeQuery();

		if ($cur) {
			# code...
			$sql = "SELECT * FROM `tblfeedback` WHERE `REGISTRATIONID`='{$id}'";
			$mydb->setQuery($sql);
			$res = $mydb->loadSingleResult();
			if (isset($res)) {
				# code...
				$sql = "UPDATE `tblfeedback` SET `FEEDBACK`='{$remarks}' WHERE `REGISTRATIONID`='{$id}'";
				$mydb->setQuery($sql);
				$cur = $mydb->executeQuery();
			} else {
				$sql = "INSERT INTO `tblfeedback` (`APPLICANTID`, `REGISTRATIONID`,`FEEDBACK`) VALUES ('{$applicantid}','{$id}','{$remarks}')";
				$mydb->setQuery($sql);
				$cur = $mydb->executeQuery();
			}

			message("Se ha enviado el mensaje al postulante.", "success");
			redirect("index.php?view=view&id=" . $id);
		} else {
			message("cannot be sve.", "error");
			redirect("index.php?view=view&id=" . $id);
		}
	}
}
