<?php 
require_once("include/initialize.php"); 
$content='home.php';
$view = (isset($_GET['q']) && $_GET['q'] != '') ? $_GET['q'] : '';
switch ($view) { 
	case 'apply' :
        $title="Postular al Trabajo";	
		$content='applicationform.php';		
		break;
	case 'login' : 
        $title="Ingresar";	
		$content='login.php';		
		break;
	case 'company' :
        $title="Compañías";	
		$content='company.php';		
		break;
	case 'hiring' :
		$title = isset($_GET['search']) ? 'Ofertas Laborales '.$_GET['search'] :"Ofertas Laborales"; 
		$content='hirring.php';		
		break;		
	case 'category' :
        $title='Trabajos para '. $_GET['search'];	
		$content='category.php';		
		break;
	case 'viewjob' :
        $title="Detalles del Trabajo";	
		$content='viewjob.php';		
		break;
	case 'success' :
        $title="Correcto";	
		$content='success.php';		
		break;
	case 'register' :
        $title="Registrar Nuevo Usuario";	
		$content='register.php';		
		break;
	case 'Contact' :
        $title='Contacto';	
		$content='Contact.php';		
		break;	
	// case 'About' :
    //     $title='About Us';	
	// 	$content='About.php';		
	// 	break;	
	case 'advancesearch' :
        $title='Búsqueda Avanzada';	
		$content='advancesearch.php';		
		break;	

	case 'result' :
        $title='Resultados Búsqueda';	
		$content='advancesearchresult.php';		
		break;
	case 'search-company' :
        $title='Buscar por Compañía';	
		$content='searchbycompany.php';		
		break;	
	case 'search-function' :
        $title='Buscar por Función';	
		$content='searchbyfunction.php';		
		break;	
	// case 'search-jobtitle' :
    //     $title='Buscar por Título';	
	// 	$content='searchbytitle.php';		
	// 	break;						
	default :
	    $active_home='active';
	    $title="Inicio";	
		$content ='home.php';		
}
require_once("theme/templates.php");
?>