<?php 
require_once("../include/initialize.php");
 if(!isset($_SESSION['ADMIN_USERID'])){
    redirect(web_root."admin/login.php");
  }

$content='index.php';
$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
switch ($view) {

  default :
    $title="Inicio"; 
    $content ='index.php';    
    redirect('company');
}
require_once("theme/templates.php");
?>