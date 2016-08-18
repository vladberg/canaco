<? 	include_once("lib/conexion.php");
	$link=conectarse(); 
	
		$ids=$_GET['id'];
		if($ids == 1){
			$ids2 = 0;
		}
		if($ids == 0){
			$ids2 = 1;
		}
		$tranx="update personalizacion set estatus = $ids2;";					
					$rtranx=mysql_query($tranx, $link);
					$idreg = mysql_insert_id($link);
					header("Location:filtro_personalizacion.php");
	
	?>