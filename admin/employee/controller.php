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
	case 2:
		formExportData();
		break;
}




$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {


		// OPCIONAL
	case 'delete':
		doDelete();
		break;
}



// function doDelete()
// {
// 	$id = 	$_GET['id'];

// 	$emp = new Applicants();
// 	$emp->delete($id);
// 	$emp->deleteJobRegistrations($id);
// 	$emp->deleteFeedbacks($id);

// 	message("Usuario eliminado correctamente!", "success");
// 	redirect('index.php');
// }



function tablaByInstitution()
{
	global $mydb_mo;
	$mydb_mo->setQuery("SELECT * FROM mo_user WHERE INSTITUTION = '" . $_POST['mo_user_institution'] . "'	");
	$cur = $mydb_mo->loadResultList();
	$table = "";

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

	echo $table;
}


function formExportData()
{
	$form = '<form action="' . web_root . 'admin/employee/dataController.php" method="post" style="display: inline;">';
	$form .= '<button type="submit" id="export_data" name="exportarCSV" value="Export to excel" class="btn" style="padding: 0; background:none;">';
	$form .= '<img src="' . web_root . 'uploads/images/sql_csv.ico" alt="Exportar en CSV" style="width: 50px; height: 50px;">';
	$form .= '</button>';
	$form .= '<input type="hidden" name="instName" id="instName" value="' . $_POST['mo_user_institution'] . '">';
	$form .= '</form>';
	$form .= '';

	echo $form;
}
