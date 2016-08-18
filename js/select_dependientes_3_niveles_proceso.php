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
"select3"=>"id_apoyo,desc_apoyo,id_rubro"
); 

$listadoSelects4=array(
"select1"=>"onChange='this.form.submit()'",
"select2"=>"onChange='this.form.submit()'",
"select3"=>"onChange='this.form.submit()'"
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
	echo $onchange=$listadoSelects4[$selectDestino];
	include_once ('../lib/conexion.php');
	$opcionSeleccionada;
	$link=conectarse_servicios();
	echo $consulta=mysql_query("SELECT $consulta FROM $tabla WHERE estatus=1 and $relacion=$opcionSeleccionada",$link) or die(mysql_error());
	desconectar();
	
	// Comienzo a imprimir el select
	echo "<form action='' method='post'><select name='".$selectDestino."' id='".$selectDestino."' onChange='this.form.submit()'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registro[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}			
	echo "</select></form>";
	echo '<h1>'.$registro[1].'</h1>'
	 
	  
}
?>