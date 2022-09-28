<?php
require_once 'config_keys.php';

// DEFINE SEGUIMIENTO_EGRESADOS DB
defined('server') ? null : define("server", MYSQL_HOST);
defined('user') ? null : define ("user", MYSQL_USER) ;
defined('pass') ? null : define("pass",MYSQL_PASSWORD);
defined('database_name') ? null : define("database_name", MYSQL_DATABASE) ;


// DEFINE MOODLE DB
defined('server_mo') ? null : define("server_mo", MYSQL_HOST_MO);
defined('user_mo') ? null : define ("user_mo", MYSQL_USER_MO) ;
defined('pass_mo') ? null : define("pass_mo",MYSQL_PASSWORD_MO);
defined('database_name_mo') ? null : define("database_name_mo", MYSQL_DATABASE_MO) ;



$this_file = str_replace('\\', '/', __File__) ;
$doc_root = $_SERVER['DOCUMENT_ROOT'];
// $path_delete = $_SERVER['DOCUMENT_ROOT'];

$web_root =  str_replace (array($doc_root, "include/config.php") , '' , $this_file);
$server_root = str_replace ('config/config.php' ,'', $this_file);
$path_to_delete = str_replace ('include/config.php','',$this_file);

define ('web_root' , $web_root);
define('server_root' , $server_root);
define('path_to_delete', $path_to_delete);