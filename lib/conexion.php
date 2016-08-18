<?
function conectarse()
{
 $db_host="localhost"; //Nombre del Host al que se conecta, habitualmente es el 'localhost'
 $db_nombre='canaco'; //Esta linea NO DEBE MODIFICARSE
 $db_user="root"; //Nombre del usuario con permisos para acceder
 $db_pass=""; //Contrase�a del usuario

 $link=mysql_connect($db_host,$db_user,$db_pass) or die ("Error Conectando a la base de datos");

  mysql_select_db($db_nombre,$link) or die ("Error Seleccionando la base de datos");
  
  mysql_query ("SET NAMES 'utf8'");

  return $link;
}

function conectarse_servicios()
{
  $db_host="localhost"; //Nombre del Host al que se conecta, habitualmente es el 'localhost'
 $db_nombre='canaco'; //Esta linea NO DEBE MODIFICARSE
 $db_user="root"; //Nombre del usuario con permisos para acceder
 $db_pass=""; //Contrase�a del usuario

 $link=mysql_connect($db_host,$db_user,$db_pass) or die ("Error Conectando a la base de datos");

  mysql_select_db($db_nombre,$link) or die ("Error Seleccionando la base de datos");
  
  mysql_query ("SET NAMES 'utf8'");

  return $link;
}
?>