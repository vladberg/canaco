<?
	function uploadFiles($file){	
		global $ruta_files;
		$nombre_archivo = $file['name'];
		$ltranx = true;
		if($nombre_archivo != ""){
			//$tipo_archivo = $file['type'];
         	$tipo_archivo = pathinfo($file['name']);
			$tipo_archivo = "tipo:".$tipo_archivo['extension'];
			$tipo_archivo = strtoupper($tipo_archivo);
			$tamano_archivo = $file['size']; 
			if (!(strpos($tipo_archivo, "GIF")   || 
				  strpos($tipo_archivo, "JPEG")  ||
              	  strpos($tipo_archivo, "JPG")   ||
				  strpos($tipo_archivo, "RAR")   ||
				  strpos($tipo_archivo, "XLS")   ||
				  strpos($tipo_archivo, "DOC")   ||
				  strpos($tipo_archivo, "PDF")   ||
				  strpos($tipo_archivo, "PPT")   ||
				  strpos($tipo_archivo, "PNG")   ||
				  strpos($tipo_archivo, "BMP")   ||
				  strpos($tipo_archivo, "FLV")   ||
				  strpos($tipo_archivo, "ZIP")   ||
				  strpos($tipo_archivo, "FLASH") ||
				  strpos($tipo_archivo, "SWF")   ||
				  strpos($tipo_archivo, "PPS")  
				 )) {
				return false;
			}
			
			$ltranx = false;
			if (move_uploaded_file($file['tmp_name'], $ruta_files.$nombre_archivo)){
				$ltranx = true;
			}
		}
		return $ltranx;
	}

	function updateFiles($file, $document){
		global $ruta_files;
		$estado = true;
		if($photo != ""){
			$estado = deleteFiles($ruta_files.$document);
		}
		if($estado == true){
			$estado = uploadFiles($file);
			return $estado;
		}
		return $estado;
	}

	function deleteFiles($document){
		if($estado = file_exists($document)){
			$estado = unlink($document);
		}
		else{$estado=true;}

		return $estado;
	}

	function uploadFiles2($file,$new_name){	
		global $ruta_files;
		$nombre_archivo = $file['name'];
		$ltranx = true;
		if($nombre_archivo != ""){
			//$tipo_archivo = $file['type'];
         	$tipo_archivo = pathinfo($file['name']);
			$tipo_archivo = "tipo:".$tipo_archivo['extension'];
			$tipo_archivo = strtoupper($tipo_archivo);
			$tamano_archivo = $file['size']; 
			if (!(strpos($tipo_archivo, "GOF")   || 
				  strpos($tipo_archivo, "JPEG")  ||
              	  strpos($tipo_archivo, "JPG")   ||
				  strpos($tipo_archivo, "RAR")   ||
				  strpos($tipo_archivo, "XLS")   ||
				  strpos($tipo_archivo, "DOC")   ||
				  strpos($tipo_archivo, "PDF")   ||
				  strpos($tipo_archivo, "PPT")   ||
				  strpos($tipo_archivo, "PNG")   ||
				  strpos($tipo_archivo, "BMP")   ||
				  strpos($tipo_archivo, "ZIP")   ||
				  strpos($tipo_archivo, "FLV")   ||
				  strpos($tipo_archivo, "FLASH") ||
				  strpos($tipo_archivo, "SWF")   ||
				  strpos($tipo_archivo, "PPS")  
				 )) {
				return false;
			}
			
			$ltranx = false;
			if (move_uploaded_file($file['tmp_name'], $ruta_files.$new_name)){
				$ltranx = true;
			}
		}
		return $ltranx;
	}



?>
