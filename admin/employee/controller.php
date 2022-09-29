<?php
require_once("../../include/initialize.php");
require_once(LIB_PATH . DS . 'database_mo.php');


if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}

$op = $_POST['op'];
switch ($op) {
	case 1:
		tablaByInstitution();
		break;
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


	case 'addfiles':
		doAddFiles();
		break;

	case 'checkid':
		Check_StudentID();
		break;
}

function doInsert()
{
	global $mydb;
	if (isset($_POST['save'])) {


		if (
			$_POST['FNAME'] == "" or $_POST['LNAME'] == ""
			or $_POST['ADDRESS'] == ""
			or $_POST['TELNO'] == ""
		) {
			$messageStats = false;
			message("Todos los campos son requeridos!", "error");
			redirect('index.php?view=add');
		} else {

			$birthdate =  date_format(date_create($_POST['BIRTHDATE']), 'Y-m-d');

			$age = date_diff(date_create($birthdate), date_create('today'))->y;

			if ($age < 20) {
				message("Invalid age. 20 years old and above is allowed.", "error");
				redirect("index.php?view=add");
			} else {



				$sql = "SELECT * FROM tblemployees WHERE EMPLOYEEID='" . $_POST['EMPLOYEEID'] . "'";
				$mydb->setQuery($sql);
				$cur = $mydb->executeQuery();
				$maxrow = $mydb->num_rows($cur);


				// $res = mysqli_query($sql) or die(mysql_error());
				// $maxrow = mysql_num_rows($res);
				if ($maxrow > 0) {
					# code... 
					message("Employee ID already in use!", "error");
					redirect("index.php?view=add");
				} else {

					@$datehired = date_format(date_create($_POST['EMP_HIREDDATE']), 'Y-m-d');

					$emp = new Employee();
					$emp->EMPLOYEEID 		= $_POST['EMPLOYEEID'];
					$emp->FNAME				= $_POST['FNAME'];
					$emp->LNAME				= $_POST['LNAME'];
					$emp->ADDRESS			= $_POST['ADDRESS'];
					$emp->BIRTHDATE	 		= $birthdate;
					$emp->BIRTHPLACE		= $_POST['BIRTHPLACE'];
					$emp->AGE			    = $age;
					$emp->SEX 				= $_POST['optionsRadios'];
					$emp->TELNO				= $_POST['TELNO'];
					$emp->CIVILSTATUS		= $_POST['CIVILSTATUS'];
					$emp->POSITION			= trim($_POST['POSITION']);
					// $emp->DEPARTMENTID		= $_POST['DEPARTMENTID'];
					// $emp->DIVISIONID		= $_POST['DIVISIONID'];
					$emp->EMP_EMAILADDRESS	= $_POST['EMP_EMAILADDRESS'];
					$emp->EMPUSERNAME		= $_POST['EMPLOYEEID'];
					$emp->EMPPASSWORD		= sha1($_POST['EMPLOYEEID']);
					$emp->DATEHIRED			=  @$datehired;
					$emp->COMPANYID			= $_POST['COMPANYID'];
					$emp->create();



					$user = new User();
					$user->USERID 			= $_POST['EMPLOYEEID'];
					$user->FULLNAME 		= $_POST['FNAME'] . ' ' . $_POST['LNAME'];
					$user->USERNAME			= $_POST['LNAME'];
					$user->PASS				= sha1($_POST['EMPLOYEEID']);
					$user->ROLE				= 'Employee';
					$user->create();


					$autonum = new Autonumber();
					$autonum->auto_update('employeeid');

					message("New employee created successfully!", "success");
					redirect("index.php");
				}
			}
		}
	}
}

function doEdit()
{
	if (isset($_POST['save'])) {

		if (
			$_POST['FNAME'] == "" or $_POST['LNAME'] == ""
			or $_POST['ADDRESS'] == ""
			or $_POST['TELNO'] == ""
		) {
			$messageStats = false;
			message("All fields are required!", "error");
			redirect('index.php?view=add');
		} else {

			$birthdate =  date_format(date_create($_POST['BIRTHDATE']), 'Y-m-d');

			$age = date_diff(date_create($birthdate), date_create('today'))->y;
			if ($age < 20) {
				message("Invalid age. 20 years old and above is allowed.", "error");
				redirect("index.php?view=edit&id=" . $_POST['EMPLOYEEID']);
			} else {

				@$datehired = date_format(date_create($_POST['EMP_HIREDDATE']), 'Y-m-d');

				$emp = new Employee();
				$emp->EMPLOYEEID 		= $_POST['EMPLOYEEID'];
				$emp->FNAME				= $_POST['FNAME'];
				$emp->LNAME				= $_POST['LNAME'];
				$emp->ADDRESS			= $_POST['ADDRESS'];
				$emp->BIRTHDATE	 		= $birthdate;
				$emp->BIRTHPLACE		= $_POST['BIRTHPLACE'];
				$emp->AGE			    = $age;
				$emp->SEX 				= $_POST['optionsRadios'];
				$emp->TELNO				= $_POST['TELNO'];
				$emp->CIVILSTATUS		= $_POST['CIVILSTATUS'];
				$emp->POSITION			= trim($_POST['POSITION']);
				// $emp->DEPARTMENTID		= $_POST['DEPARTMENTID'];
				// $emp->DIVISIONID		= $_POST['DIVISIONID'];
				$emp->EMP_EMAILADDRESS		= $_POST['EMP_EMAILADDRESS'];
				$emp->EMPUSERNAME		= $_POST['EMPLOYEEID'];
				$emp->EMPPASSWORD		= sha1($_POST['EMPLOYEEID']);
				$emp->DATEHIRED			=  @$datehired;
				$emp->COMPANYID			= $_POST['COMPANYID'];
				$emp->update($_POST['EMPLOYEEID']);


				$user = new User();
				$u_res = $user->single_user($_POST['EMPLOYEEID']);

				if (isset($u_res)) {
					# code...
					$user->FULLNAME 		= $_POST['FNAME'] . ' ' . $_POST['LNAME'];
					$user->USERNAME			= $_POST['LNAME'];
					$user->PASS				= sha1($_POST['EMPLOYEEID']);
					$user->update($_POST['EMPLOYEEID']);
				} else {
					$user = new User();
					$user->USERID 			= $_POST['EMPLOYEEID'];
					$user->FULLNAME 		= $_POST['FNAME'] . ' ' . $_POST['LNAME'];
					$user->USERNAME			= $_POST['LNAME'];
					$user->PASS				= sha1($_POST['EMPLOYEEID']);
					$user->ROLE				= 'Employee';
					$user->create();
				}


				message("Employee has been updated!", "success");
				// redirect("index.php?view=view&id=".$_POST['EMPLOYEEID']);
				redirect("index.php?view=edit&id=" . $_POST['EMPLOYEEID']);
			}
		}
	}
}
function doDelete()
{

	$id = 	$_GET['id'];

	$emp = new Applicants();
	$emp->delete($id);
	$emp->deleteJobRegistrations($id);
	$emp->deleteFeedbacks($id);


	// }
	message("Usuario eliminado correctamente!", "success");
	redirect('index.php');
	// }


}



function UploadImage()
{
	$target_dir = "../../employee/photos/";
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

function doupdateimage()
{

	$errofile = $_FILES['photo']['error'];
	$type = $_FILES['photo']['type'];
	$temp = $_FILES['photo']['tmp_name'];
	$myfile = $_FILES['photo']['name'];
	$location = "photo/" . $myfile;


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
			move_uploaded_file($temp, "photo/" . $myfile);



			$stud = new Student();
			$stud->StudPhoto	= $location;
			$stud->studupdate($_POST['StudentID']);
			redirect("index.php?view=view&id=" . $_POST['StudentID']);
		}
	}
}


function tablaByInstitution()
{
	global $mydb_mo;
	$mydb_mo->setQuery("SELECT * FROM mo_user WHERE INSTITUTION = '" . $_POST['mo_user_institution'] . "'	");
	$cur = $mydb_mo->loadResultList();
	$table = "";
	// $table .= '<form class="wow fadeInDownaction" action="controller.php?action=delete" Method="POST">';
	// $table .= '<table id="dash-table" class="table table-striped  table-hover table-responsive" style="font-size:12px" cellspacing="0">';
	// $table .= '<thead>';
	// $table .= '<tr>';
	// $table .= '<th width="5%">ID Usuario</th>';
	// $table .= '<th>Nombres</th>';
	// $table .= '<th>Apellidos</th>';
	// $table .= '<th>Dirección</th>';
	// $table .= '<th>Teléfono</th>';
	// $table .= '<th>Tlf. 2</th>';
	// $table .= '<th>Email</th>';
	// $table .= '<th>Institución</th>';
	// $table .= '</tr>';
	// $table .= '</thead>';
	// $table .= '<tbody>';
	foreach ($cur as $result) {
		$table .= '<tr>';
		$table .= '<td>' . $result->id . '</td>';
		$table .= '<td>' . $result->firstname . '</td>';
		$table .= '<td>' . $result->lastname . '</td>';
		$table .= '<td>' . $result->address . '</td>';
		$table .= '<td>' . $result->phone1 . '</td>';
		$table .= '<td>' . $result->phone2 . '</td>';
		$table .= '<td>' . $result->username . '</td>';
		$table .= '<td>' . $result->email . '</td>';
		$table .= '<td>' . $result->institution . '</td>';
		$table .= '</tr>';
	}
	// $table .= '</tbody>';
	// $table .= '</table>';
	// $table .= '</form>';
	echo $table;
}
