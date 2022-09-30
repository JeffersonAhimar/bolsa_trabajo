<?php
require_once("../include/initialize.php");
if (!isset($_SESSION['APPLICANTID'])) {
	redirect(web_root . "index.php");
}

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {


}

