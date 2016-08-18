<?php
include_once("lib/conexion.php");
	$link=conectarse(); 
	
		$ids=$_GET['id'];
		$usuario=$_GET['us'];
		$fecha=$_GET['f'];
		$hora=$_GET['h'];
		$tranx="delete from cotizacion where idcotizacion='$ids'";					
					$rtranx=mysql_query($tranx, $link);
					$idreg = mysql_insert_id($link);
					header("Location:ver_cotizacion.php?id=$usuario&f=$fecha&h=$hora");
	
	?>