<?php
//Función para conectarnos con la BBDD 
// Rellenamos todos los datos para conectarnos a la BBDD

require_once("../../include/initialize.php");
require_once(LIB_PATH . DS . 'database_mo.php');

//Nos conectamos a SQL

if (isset($_POST["instName"])) {
    $instName = $_POST["instName"];
}
global $mydb_mo;
$mydb_mo->setQuery("SELECT * FROM mo_user WHERE INSTITUTION = '" . $instName . "'	");
$cur = $mydb_mo->loadResultList();

// Creamos la consulta que va a compartir la visualización en PHP y en CSV



// $consulta = $con->query("SELECT * FROM $tblName order by id ASC ");

//Si hemos pulsado al botón de Exportar a Excel (CSV)...
if (isset($_POST["exportarCSV"])) {
    //El nombre del fichero tendrá el nombre de "usuarios_dia-mes-anio hora_minutos_segundos.csv"
    $ficheroExcel = $instName . "_usuarios " . date("d-m-Y H_i_s") . ".csv";

    //Indicamos que vamos a tratar con un fichero CSV
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=" . $ficheroExcel);

    // Vamos a mostrar en las celdas las columnas que queremos que aparezcan en la primera fila, separadas por ; 
    echo "id;nombres;apellidos;	dirección;tlf;tlf_2;username;email;institución\n";

    // Recorremos la consulta SQL y lo mostramos
    foreach ($cur as $result) {
        echo $result->id . ";";
        echo $result->firstname . ";";
        echo $result->lastname . ";";
        echo $result->address . ";";
        echo $result->phone1 . ";";
        echo $result->phone2 . ";";
        echo $result->username . ";";
        echo $result->email . ";";
        echo $result->institution . "\n";
    }
    //Para que se cree el Excel correctamente, hay que añadir la sentencia exit;
    exit;
}
