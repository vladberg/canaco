<? 
function deleteFiles($document){
		if($estado = file_exists($document)){
			$estado = unlink($document);
		}
		else{$estado=true;}

		return $estado;
	}
$ids=$_GET['id'];
deleteFiles('docs/'.$ids);

header("Location:subir.archivos.php");
	
	?>