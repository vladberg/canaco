<?php
error_reporting(0);
include_once("lib/conexion.php");
$link=conectarse(); 

$opcion1=$_POST['opcion1'];
if(!empty($opcion1)){
   $categoria=implode(',',$_POST['tipo']);
   $cambio=implode(',',$_POST['seleccion']);
   $cambio;
   $tranx="update articulos set personalizado='". $categoria."' where id_articulo in(".$cambio.");";					
   $rtranx=mysql_query($tranx, $link);
$idreg = mysql_insert_id($link);
   header("Location:filtro_personalizacion.php"); 

}


//header("Location:filtro_articulos.php");

?>