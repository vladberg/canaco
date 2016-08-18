<?php
error_reporting(0);
include_once("lib/conexion.php");
$link=conectarse(); 

$opcion1=$_POST['opcion1'];
$opcion2=$_POST['opcion2'];
$opcion3=$_POST['opcion3'];
if(!empty($opcion1)){
   $categoria=$_POST['categoria'];
   $cambio=implode(',',$_POST['seleccion']);
   $cambio;
   $tranx="update articulos set categoria=". $categoria." where id_articulo in(".$cambio.");";					
   $rtranx=mysql_query($tranx, $link);
$idreg = mysql_insert_id($link);
   header("Location:filtro_articulos.php"); 

}

if (!empty($opcion2)) {
	$proveedor=$_POST['proveedor']; 
	$cambio=implode(',',$_POST['seleccion']);
   $cambio;
   $tranx="update articulos set id_proveedor=". $proveedor." where id_articulo in(".$cambio.");";					
   $rtranx=mysql_query($tranx, $link);
	$idreg = mysql_insert_id($link);
	header("Location:filtro_articulos.php"); 
}

if(!empty($opcion3)){
   $estatus=$_POST['estatus'];
   $cambio=implode(',',$_POST['seleccion']);
   $cambio;
   $tranx="update articulos set estatus=". $estatus." where id_articulo in(".$cambio.");";					
	$rtranx=mysql_query($tranx, $link);
	$idreg = mysql_insert_id($link);
	header("Location:filtro_articulos.php"); 
} 

//header("Location:filtro_articulos.php");

?>