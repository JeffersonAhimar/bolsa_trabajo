<?php
require_once("include/initialize.php");

// require_once(LIB_PATH . DS . "applicant_mo.php");


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) {
	case 'submitapplication':
		doSubmitApplication();
		break;

	case 'login_mo':
		doLogin_mo();
		break;
}

function doSubmitApplication()
{
	global $mydb;
	$jobid  = $_GET['JOBID'];


	$autonum = new Autonumber();
	$applicantid = $autonum->set_autonumber('APPLICANT');
	$autonum = new Autonumber();
	$fileid = $autonum->set_autonumber('FILEID');

	@$picture = UploadFile($_SESSION['APPLICANTID']);
	@$location =  $picture;
	// @$picture = UploadImage();
	// @$location = "photos/". $picture ;


	if ($picture == "") {
		# code...
		redirect(web_root . "index.php?q=apply&job=" . $jobid . "&view=personalinfo");
	} else {

		if (isset($_SESSION['APPLICANTID'])) {

			$sql = "INSERT INTO `tblattachmentfile` (FILEID,`USERATTACHMENTID`, `FILE_NAME`, `FILE_LOCATION`, `JOBID`) 
				VALUES ('" . date('Y') . $fileid->AUTO . "','{$_SESSION['APPLICANTID']}','Resume','{$location}','{$jobid}')";
			$mydb->setQuery($sql);
			$res = $mydb->executeQuery();

			doUpdate($jobid, $fileid->AUTO);
		} else {

			$sql = "INSERT INTO `tblattachmentfile` (FILEID,`USERATTACHMENTID`, `FILE_NAME`, `FILE_LOCATION`, `JOBID`) 
				VALUES ('" . date('Y') . $fileid->AUTO . "','" . date('Y') . $applicantid->AUTO . "','Resume','{$location}','{$jobid}')";
			// echo $sql;exit;
			$mydb->setQuery($sql);
			$res = $mydb->executeQuery();

			doInsert($jobid, $fileid->AUTO);

			$autonum = new Autonumber();
			$autonum->auto_update('APPLICANT');
		}
	}

	$autonum = new Autonumber();
	$autonum->auto_update('FILEID');
}


function UploadFile($id)
{
	$target_dir = "uploads/documents/";
	$target_file = $target_dir . date("dmYhis") . $id . basename($_FILES["picture"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


	if (
		$imageFileType == "pdf"
	) {
		if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
			return  date("dmYhis") . $id . basename($_FILES["picture"]["name"]);
		} else {
			message("Error Subiendo Archivo", "error");
			// redirect(web_root."index.php?q=apply&job=".$jobid."&view=personalinfo");
			// exit;
		}
	} else {
		message("Formato de Archivo no Soportado", "error");
		// redirect(web_root."index.php?q=apply&job=".$jobid."&view=personalinfo");
		// exit;
	}
}

function doUpdate($jobid = 0, $fileid = 0)
{
	if (isset($_POST['submit'])) {
		global $mydb;

		$applicant = new Applicants_mo();
		$appl  = $applicant->single_applicant($_SESSION['APPLICANTID']);



		$sql = "SELECT * FROM `tblcompany` c,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID` AND JOBID = '{$jobid}'";
		$mydb->setQuery($sql);
		$result = $mydb->loadSingleResult();


		$jobreg = new JobRegistration();
		$jobreg->COMPANYID = $result->COMPANYID;
		$jobreg->JOBID     = $result->JOBID;
		$jobreg->APPLICANTID = $appl->id;
		$jobreg->APPLICANT   = $appl->firstname . ' ' . $appl->lastname;
		$jobreg->REGISTRATIONDATE = date('Y-m-d');
		$jobreg->FILEID = date('Y') . $fileid;
		$jobreg->REMARKS = 'Pendiente';
		$jobreg->DATETIMEAPPROVED = date('Y-m-d H:i');
		$jobreg->create();


		// message("Your application already submitted. Please wait for the company confirmation if your are qualified to this job.", "success");
		message("Tu postulación ha sido enviada con éxito. Espera a la confirmación de la compañía si estás calificado para el trabajo.", "success");
		redirect("index.php?q=success&job=" . $result->JOBID);
	}
}



function doLogin_mo()
{

	$uusername = trim($_POST['USERNAME']);
	$upass  = trim($_POST['PASS']);
	// $h_upass = sha1($upass);

	//it creates a new objects of member
	$applicant = new Applicants_mo();
	//make use of the static function, and we passed to parameters
	$res = $applicant->applicantAuthentication_mo($uusername, $upass);
	if ($res == true) {

		message("Te logueaste correctamente!", "success");

		redirect(web_root . "applicant/");
	} else {
		echo "Error al ingresar! Por favor contacta con el administrador";
	}
}


function UploadImage($jobid = 0)
{
	$target_dir = "applicant/photos/";
	$target_file = $target_dir . date("dmYhis") . basename($_FILES["picture"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


	if (
		$imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg"
		|| $imageFileType != "gif"
	) {
		if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
			return  date("dmYhis") . basename($_FILES["picture"]["name"]);
		} else {
			message("Error Uploading File", "error");
			// redirect(web_root."index.php?q=apply&job=".$jobid."&view=personalinfo");
			// exit;
		}
	} else {
		message("File Not Supported", "error");
		// redirect(web_root."index.php?q=apply&job=".$jobid."&view=personalinfo");
		// exit;
	}
}
