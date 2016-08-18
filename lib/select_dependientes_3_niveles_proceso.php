<?php
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"select1"=>"cat_dependencias",
"select2"=>"cat_rubros",
"select3"=>"cat_apoyos"
);
$listadoSelects2=array(
"select1"=>"id_dependencia",
"select2"=>"id_dependencia",
"select3"=>"id_rubro"
);

$listadoSelects3=array(
"select1"=>"id_dependencia,dependencia",
"select2"=>"id_rubro,rubro",
"select3"=>"id_apoyo,desc_apoyo"
); 
function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return false;
}

$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["opcion"];

if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];
	$relacion=$listadoSelects2[$selectDestino];
	$consulta=$listadoSelects3[$selectDestino];
	include 'conexion.php';
	$opcionSeleccionada;
	$link=conectar();
	$consulta=mysql_query("SELECT $consulta FROM $tabla WHERE estatus=1 and $relacion=$opcionSeleccionada",$link) or die(mysql_error());
	desconectar();
	
	// Comienzo a imprimir el select
	echo "<select name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registro[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}			
	echo "</select>";
}
?>