<?php 

/*
 * $Id: jFileBrowser, 2010.
 * @author Juaniquillo
 * @copyright Copyright � 2010, Victor Sanchez (Juaniquillo).
 * @email juaniquillo@gmail.com
 * @website http://juaniquillo.com
*/
include_once ("../../../librerias/conexion.php");
$sql_host = 'localhost';

/////informacion MySQL

$sql_db = "dgti";
$sql_user = "root";
$sql_password = "mysql";

//Funciones
include('funciones.inc.php');
//PHPPaging
include('PHPPaging.lib.php');


//Conexion
//$link = conectarse();
$conexion_gal = db_connect($sql_host, $sql_user, $sql_password) or die('No se puede conectar a la base de datos');
db_select_db($sql_db, $conexion_gal);

?>