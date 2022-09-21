<?php
require_once("../include/initialize.php");
if (!isset($_SESSION['APPLICANTID'])) {
	redirect(web_root . "index.php");
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

	case 'photos':
		doupdateimage();
		break;

	case 'edit_profile':
		doEdit_Profile();
		break;
}

function doEdit_Profile()
{

	$birthdate =  $_POST['U_year'] . '-' . $_POST['U_month'] . '-' . $_POST['U_day'];
	// echo $birthdate;
	// $age = date_diff(date_create($birthdate), date_create('today'))->y;
	// $birthdate =  date_format(date_create($_POST['BIRTHDATE']), 'Y-m-d');
	// $birthdate =  date_format(date_create($birthdate), 'Y-m-d');

	$age = date_diff(date_create($birthdate), date_create('today'))->y;
	if ($age < 20) {
		message("Invalid age. 20 years old and above is allowed.", "error");
		redirect("index.php?view=accounts");
	} else {
		$applicant = new Applicants();
		$applicant->FNAME = $_POST['U_FNAME'];
		$applicant->LNAME = $_POST['U_LNAME'];
		// $applicant->MNAME = $_POST['U_MNAME'];
		$applicant->ADDRESS = $_POST['U_ADDRESS'];
		$applicant->SEX = $_POST['U_SEX'];
		$applicant->CIVILSTATUS = $_POST['U_CIVILSTATUS'];
		$applicant->BIRTHDATE = $birthdate;
		$applicant->BIRTHPLACE = $_POST['U_BIRTHPLACE'];
		$applicant->AGE = $age;
		$applicant->USERNAME = $_POST['U_USERNAME'];
		$applicant->PASS = sha1($_POST['U_PASS']);
		$applicant->EMAILADDRESS = $_POST['U_EMAILADDRESS'];
		$applicant->CONTACTNO = $_POST['U_CONTACTNO'];
		$applicant->DEGREE = $_POST['U_DEGREE'];
		$applicant->update($_SESSION['APPLICANTID']);

		message("Cuenta actualizada!", "success");
		redirect("index.php?view=accounts");
	}
}

function doEdit()
{
	$birthdate =  date_format(date_create($_POST['BIRTHDATE']), 'Y-m-d');

	$age = date_diff(date_create($birthdate), date_create('today'))->y;
	if ($age < 20) {
		message("Invalid age. 20 years old and above is allowed.", "error");
		redirect("index.php?view=accounts");
	} else {
		$applicant = new Applicants();
		$applicant->FNAME = $_POST['FNAME'];
		$applicant->LNAME = $_POST['LNAME'];
		$applicant->MNAME = $_POST['MNAME'];
		$applicant->ADDRESS = $_POST['ADDRESS'];
		$applicant->SEX = $_POST['optionsRadios'];
		$applicant->CIVILSTATUS = $_POST['CIVILSTATUS'];
		$applicant->BIRTHDATE = $birthdate;
		$applicant->BIRTHPLACE = $_POST['BIRTHPLACE'];
		$applicant->AGE = $age;
		$applicant->EMAILADDRESS = $_POST['EMAILADDRESS'];
		$applicant->CONTACTNO = $_POST['TELNO'];
		$applicant->DEGREE = $_POST['DEGREE'];
		$applicant->update($_SESSION['APPLICANTID']);

		message("Cuenta actualizada!", "success");
		redirect("index.php?view=accounts");
	}
}

function doupdateimage()
{

	$errofile = $_FILES['photo']['error'];
	$type = $_FILES['photo']['type'];
	$temp = $_FILES['photo']['tmp_name'];
	$myfile = $_FILES['photo']['name'];
	$location = "photos/" . $myfile;


	if ($errofile > 0) {
		message("No Image Selected!", "error");
		redirect("index.php?view=view&id=" . $_GET['id']);
	} else {

		@$file = $_FILES['photo']['tmp_name'];
		@$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		@$image_name = addslashes($_FILES['photo']['name']);
		@$image_size = getimagesize($_FILES['photo']['tmp_name']);

		if ($image_size == FALSE) {
			message("Uploaded file is not an image!", "error");
			redirect("index.php?view=view&id=" . $_GET['id']);
		} else {
			//uploading the file
			move_uploaded_file($temp, "photos/" . $myfile);



			$applicant = new Applicants();
			$applicant->APPLICANTPHOTO 			= $location;
			$applicant->update($_SESSION['APPLICANTID']);
			redirect(web_root . "applicant/");
		}
	}
}



function doAddFiles()
{
	global $mydb;
	// `JOBID`, `FILE_NAME`, `FILE_LOCATION`, `USERATTACHMENTID`
	$picture = UploadImage();
	$location = "photos/" . $picture;

	$sql = "INSERT INTO `tblattachmentfile` (`JOBID`, `FILE_NAME`, `FILE_LOCATION`, `USERATTACHMENTID`) 
		VALUES ('" . $_SESSION['APPLICANTID'] . "','','Resume','{$location}','" . $_SESSION['APPLICANTID'] . "')";
	$mydb->setQuery($sql);
	$res = $mydb->executeQuery();

	message("File has been uploaded!", "success");
	redirect("index.php?tab=files");
}

function UploadImage()
{
	$target_dir = "photos/";
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
			echo "Error Uploading File";
			exit;
		}
	} else {
		echo "File Not Supported";
		exit;
	}
}
