<?php
require_once("../include/initialize.php");
if (!isset($_SESSION['ADMIN_COMPANYID'])) {
  redirect(web_root . "company/login.php");
}

$content = 'home.php';
$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
switch ($view) {

  default:
    $title = "Index";
    $content = 'index.php';
    redirect('vacancy');
}
require_once("theme/templates.php");
