<? 	include_once("lib/conexion.php");
	$link=conectarse(); 
	
		$ids=$_GET['id'];
		$nombre=$_GET['class'];
		$tranx="delete from eventos where id=$ids";					
					$rtranx=mysql_query($tranx, $link);
					$idreg = mysql_insert_id($link);

					header("Location:detalles.php?id=$nombre");
	
	?>