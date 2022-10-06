<?php
require_once("../include/initialize.php");
if (!isset($_SESSION['APPLICANTID'])) {
	# code...
	redirect(web_root . 'index.php');
}
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
switch ($view) {
	case 'appliedjobs':
		$title = "Perfil";
		$_SESSION['appliedjobs']	= 'active';
		$content = 'profile.php';
		break;

	case 'notification':
		$title = "Perfil";
		$_SESSION['notification']	= 'active';
		$content = 'profile.php';
		break;

	case 'accounts':
		$title = "Perfil";
		$_SESSION['accounts']	= 'active';
		$content = 'profile.php';
		break;

	case 'edit_profile':
		$title = "Editar Perfil";
		$content    = 'edit_profile.php';
		break;

	default:
		$title = "Perfil";
		$_SESSION['appliedjobs']	= 'active';
		$content = 'profile.php';
}
require_once("../theme/templates.php");
