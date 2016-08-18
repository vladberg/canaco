<?
require_once("lib/excel/excel.php");  
require_once("lib/excel/excel-ext.php");
include_once("lib/conexion.php");
$link = conectarse();

$class=$_POST['class'];

$inicio=$_POST['inicio'];

$inicio = explode("-", $inicio ); 

$inicio = $inicio[2].'/'.$inicio[1].'/'.$inicio[0].'/'.' 00:00';

$fin=$_POST['fin'];

$fin = explode("-", $fin ); 

$fin= $fin[2].'/'.$fin[1].'/'.$fin[0].'/'.' 00:00';

$todo=$_GET['id'];

if($class!=''){

	$general=mysql_query("select * from eventos where class='$class'") or die("Problemas en el SELECT:".mysql_error());
	while($reg=mysql_fetch_assoc($general))

			{
			//Inicia llenado del arreglo solamente con los que tienen algun valor distinto a cero

					$datos = array(

						"Quien Solicita"=>$reg['title'],
						"Solicitante"=>$reg['solicitante'],
						"Telefono"=>$reg['telefono'],
						"Email"=>$reg['email'],
						"Evento"=>$reg['body'],
						"Salon"=>$reg['class'],
						"Fecha Inicio"=>$reg['inicio_normal'],
						"Fecha Fin"=>$reg['final_normal'],
						"Montaje"=>$reg['montaje'],
						"Material de Apoyo"=>$reg['apoyo'],
						"Costo"=>$reg['costo'],
						"Anticipo"=>$reg['anticipo'],
						"Saldo"=>$reg['saldo'],
						"Tipo de Comprobante"=>$reg['nota'],
						"Vigilante asignado"=>$reg['vigilante']					
					);

					$reporte[] = $datos;

				} 


}
if($inicio!= '' && $fin != ''){
	$general=mysql_query("select * from eventos where inicio_normal between '$inicio' and '$fin' order by inicio_normal asc;") or die("Problemas en el SELECT:".mysql_error());
	while($reg=mysql_fetch_assoc($general))

			{
			//Inicia llenado del arreglo solamente con los que tienen algun valor distinto a cero

					$datos = array(
"Quien Solicita"=>$reg['title'],
						"Solicitante"=>$reg['solicitante'],
						"Telefono"=>$reg['telefono'],
						"Email"=>$reg['email'],
						"Evento"=>$reg['body'],
						"Salon"=>$reg['class'],
						"Fecha Inicio"=>$reg['inicio_normal'],
						"Fecha Fin"=>$reg['final_normal'],
						"Montaje"=>$reg['montaje'],
						"Material de Apoyo"=>$reg['apoyo'],
						"Costo"=>$reg['costo'],
						"Anticipo"=>$reg['anticipo'],
						"Saldo"=>$reg['saldo'],
						"Tipo de Comprobante"=>$reg['nota'],
						"Vigilante asignado"=>$reg['vigilante']					
					);

					$reporte[] = $datos;

				} 

}

if($inicio!= '' && $fin != '' && $class != ''){
	$general=mysql_query("select * from eventos where class='$class' and inicio_normal between '$inicio' and '$fin' order by inicio_normal asc;") or die("Problemas en el SELECT:".mysql_error());
	while($reg=mysql_fetch_assoc($general))

			{
			//Inicia llenado del arreglo solamente con los que tienen algun valor distinto a cero

					$datos = array(

						"Quien Solicita"=>$reg['title'],
						"Solicitante"=>$reg['solicitante'],
						"Telefono"=>$reg['telefono'],
						"Email"=>$reg['email'],
						"Evento"=>$reg['body'],
						"Salon"=>$reg['class'],
						"Fecha Inicio"=>$reg['inicio_normal'],
						"Fecha Fin"=>$reg['final_normal'],
						"Montaje"=>$reg['montaje'],
						"Material de Apoyo"=>$reg['apoyo'],
						"Costo"=>$reg['costo'],
						"Anticipo"=>$reg['anticipo'],
						"Saldo"=>$reg['saldo'],
						"Tipo de Comprobante"=>$reg['nota'],
						"Vigilante asignado"=>$reg['vigilante']					
					);

					$reporte[] = $datos;

				} 

}
if ($class == "todos" && $inicio!= '' && $fin != '' ) {
	$general=mysql_query("select * from eventos where inicio_normal between '$inicio' and '$fin' order by inicio_normal asc;") or die("Problemas en el SELECT:".mysql_error());
	while($reg=mysql_fetch_assoc($general))

			{
			//Inicia llenado del arreglo solamente con los que tienen algun valor distinto a cero

					$datos = array(

						"Quien Solicita"=>$reg['title'],
						"Solicitante"=>$reg['solicitante'],
						"Telefono"=>$reg['telefono'],
						"Email"=>$reg['email'],
						"Evento"=>$reg['body'],
						"Salon"=>$reg['class'],
						"Fecha Inicio"=>$reg['inicio_normal'],
						"Fecha Fin"=>$reg['final_normal'],
						"Montaje"=>$reg['montaje'],
						"Material de Apoyo"=>$reg['apoyo'],
						"Costo"=>$reg['costo'],
						"Anticipo"=>$reg['anticipo'],
						"Saldo"=>$reg['saldo'],
						"Tipo de Comprobante"=>$reg['nota'],
						"Vigilante asignado"=>$reg['vigilante']					
					);

					$reporte[] = $datos;

				} 
}
if ($todo == 1) {
	$general=mysql_query("select * from eventos") or die("Problemas en el SELECT:".mysql_error());
	while($reg=mysql_fetch_assoc($general))

			{
			//Inicia llenado del arreglo solamente con los que tienen algun valor distinto a cero

					$datos = array(

						"Quien Solicita"=>$reg['title'],
						"Solicitante"=>$reg['solicitante'],
						"Telefono"=>$reg['telefono'],
						"Email"=>$reg['email'],
						"Evento"=>$reg['body'],
						"Salon"=>$reg['class'],
						"Fecha Inicio"=>$reg['inicio_normal'],
						"Fecha Fin"=>$reg['final_normal'],
						"Montaje"=>$reg['montaje'],
						"Material de Apoyo"=>$reg['apoyo'],
						"Costo"=>$reg['costo'],
						"Anticipo"=>$reg['anticipo'],
						"Saldo"=>$reg['saldo'],
						"Tipo de Comprobante"=>$reg['nota'],
						"Vigilante asignado"=>$reg['vigilante']					
					);

					$reporte[] = $datos;

				} 
}

createExcel("reporte.xls", $reporte );

	exit;