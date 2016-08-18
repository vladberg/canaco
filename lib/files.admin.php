<? 	include_once("lib/swfheader.class.php");

	
	
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
				  strpos($tipo_archivo, "XLSX")   ||
				  strpos($tipo_archivo, "DOC")   ||
				  strpos($tipo_archivo, "DOCX")   ||
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
			$nombre_archivo=convertir_validos($nombre_archivo);
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

function tipoImg($imagen)
{
	$tipo_archivo = pathinfo($imagen);
	$tipo_archivo = "tipo:".$tipo_archivo['extension'];
	$tipo_archivo = strtoupper($tipo_archivo);
	if (!(strpos($tipo_archivo, "GIF")   || 
		  strpos($tipo_archivo, "JPEG")  ||
		  strpos($tipo_archivo, "JPG")   ||
		  strpos($tipo_archivo, "PNG")   ||
		  strpos($tipo_archivo, "BMP") 
		 )) {return false;}
	else{ return true;}
}

function uploadBanner($file,$width,$new_name=''){
   global $ruta_files;
   $nombre_archivo=$file['name'];
   if(!empty($new_name)) $nombre_archivo=$new_name;
   $nombre_archivo=convertir_validos($nombre_archivo);
   if($nombre_archivo!=""){
      $tipo_archivo=substr($nombre_archivo,strrpos($nombre_archivo,".")+1);
      $tipo_archivo=strtolower($tipo_archivo);
      $w=0;
      $h=0;
      if($tipo_archivo=='gif' || $tipo_archivo=='jpg') list($w,$h)=getimagesize($file['tmp_name']);
      else if($tipo_archivo=='swf'){
         $swf=new swfheader(false);
         $swf->loadswf($file['tmp_name']);
         $w=$swf->width;
         $h=$swf->height;
      }else return false;
      if($w>$width) return false;
      if(!move_uploaded_file($file['tmp_name'], $ruta_files.$nombre_archivo)){
         
		 return false;
      }
   }
   return true;
}
?>
