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
	if (isset($_POST['save'])) {


		if ($_POST['U_NAME'] == "" or $_POST['U_USERNAME'] == "" or $_POST['U_PASS'] == "") {
			$messageStats = false;
			message("Todos los campos son requeridos!", "error");
			redirect('index.php?view=add');
		} else {
			$user = new User();
			if ($user->usernameExists($_POST['U_USERNAME'])) {
				message("El nombre de usuario ya está en uso!", "error");
				redirect("index.php?view=view");
			} else {

				$user->USERID 			= $_POST['user_id'];
				$user->FULLNAME 		= $_POST['U_NAME'];
				$user->USERNAME			= $_POST['U_USERNAME'];
				$user->PASS				= sha1($_POST['U_PASS']);
				$user->ROLE				=  $_POST['U_ROLE'];
				$user->create();

				$autonum = new Autonumber();
				$autonum->auto_update('userid');

				message("La cuenta [" . $_POST['U_NAME'] . "] ha sido creada correctamente!", "success");
				redirect("index.php");
			}
		}
	}
}

function doEdit()
{
	if (isset($_POST['save'])) {
		$user = new User();
		// VERIFY IF THE NEW USER NAME EXISTS
		$state = false;
		$cur = $user->usernameEditExists($_POST['USERID']);
		foreach ($cur as $result) {
			if ($result->USERNAME == $_POST['U_USERNAME']) {
				$state = true;
			}
		}
		if ($state) {
			message("El nombre de usuario ya está en uso!", "error");
			redirect('index.php');
		} else {
			$user->FULLNAME 		= $_POST['U_NAME'];
			$user->USERNAME			= $_POST['U_USERNAME'];
			$user->PASS				= sha1($_POST['U_PASS']);
			$user->ROLE				= $_POST['U_ROLE'];
			$user->update($_POST['USERID']);

			if (isset($_GET['view'])) {
				# code...
				message("El perfil ha sido actualizado!", "success");
				redirect("index.php?view=view");
			} else {
				message("El perfil [" . $_POST['U_NAME'] . "] ha sido actualizado!", "success");
				redirect("index.php");
			}
		}
	}
}


function doDelete()
{
	$id = 	$_GET['id'];

	$user = new User();
	$user->delete($id);

	message("El usuario ha sido eliminado!", "info");
	redirect('index.php');
}
