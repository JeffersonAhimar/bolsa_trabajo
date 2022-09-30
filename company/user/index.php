<?php
require_once("../../include/initialize.php");
if (!isset($_SESSION['ADMIN_COMPANYID'])) {
	redirect(web_root . "admin/index.php");
}

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$title = "Compañías";
$header = $view;
switch ($view) {

	case 'view':
		$content    = 'view.php';
		break;

	default:
		$content    = 'list.php';
}
require_once("../theme/templates.php");
