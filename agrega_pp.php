<?php
include_once('lib/conexion.php');

$link=conectarse();
$usuario=$_POST['usuario'];
$fecha=$_POST['fecha'];
$hora=$_POST['hora'];
$precio_per=$_POST['precio_per'];
$id=$_POST['id'];
$unidad=$_POST['unidad'];
$precio=$_POST['precio_unitario'];
for ($i=0; $i<=count($precio_per); $i++) {
 $tranx[$i]="update cotizacion set precio_venta='".$precio[$i]."',unidad=".$unidad[$i].",precio_persona=".$precio_per[$i]." where idcotizacion=".$id[$i].";";					
$rtranx=mysql_query($tranx[$i], $link);
$idreg = mysql_insert_id($link);
}	
header("location:ver_cotizacion.php?id=$usuario&f=$fecha&h=$hora");
?>