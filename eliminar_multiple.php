<? 	include_once("lib/conexion.php");
error_reporting(0);
	$link=conectarse(); 
	
		$cambio=implode(',',$_POST['seleccion']);
		$tranx="delete from articulos where id_articulo in(".$cambio.");";					
					$rtranx=mysql_query($tranx, $link);
					$idreg = mysql_insert_id($link);
					header("Location:filtro_eliminalizacion.php");
	
	?>