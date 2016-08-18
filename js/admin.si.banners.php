<?php 
include_once("librerias/conexion.php");
include_once("librerias/util.php");
include_once("librerias/sql.injection.php");
include_once("librerias/files.admin.php");
require_once 'librerias/login.action.php';
$membership = new loginAction();
$membership->confirm_Member();
$ruta_files='../banners/';
$link=conectarse('hacienda');
$opcion='';
$id_zona=0;
$idreg=0;
if($_POST && !empty($_POST["opc"])){
   $opcion=Formatear($_POST["opc"]);
   $id_zona=intval($_POST["id_zona"]);
   $idreg=intval($_POST["id"]);
}else{
   $opcion=Formatear($_GET["opc"]);
   $id_zona=intval($_GET["id_zona"]);
   $idreg=intval($_GET["id"]);
}
$query="select * from zonas where id_zona=".$id_zona;
$resultado=mysql_query($query, $link);
$nombre='';
$width=0;
if(mysql_num_rows($resultado)>0){
   $row = mysql_fetch_array($resultado);
   $nombre=html_entity_decode($row['nombre'], ENT_QUOTES);
   $width=$row['width'];
}
$html_archivo='';
$html_alt='';
$ext='';
$ext_alt='';
$archivo='';
$w=0;
$h=0;
$texto_alt='';
$imagen_alt='';
$url='';
$ventana=0;
$ancho=0;
$alto=0;
$statusbar=0;
$scrollbars=0;
$resize=0;
$dia_ini=date("j");
$mes_ini=date("n");
$anio_ini=date("Y");
$anio_hoy=$anio_ini;
$dia_fin=0;
$mes_fin=0;
$anio_fin=0;
$activo=0;
$mostrar_alt=false;
$rtranx=true;
if($opcion=='SAVE'){
   $texto_alt=htmlentities($_POST["texto_alt"], ENT_QUOTES);
   $url=htmlentities($_POST["url"], ENT_QUOTES);
   $ventana=intval($_POST["ventana"]);
   if($ventana==2){
      $ancho=intval($_POST["ancho"]);
      $alto=intval($_POST["alto"]);
      if($_POST["statusbar"]=='1') $statusbar=1;
      if($_POST["scrollbars"]=='1') $scrollbars=1;
      if($_POST["resize"]=='1') $resize=1;
   }
   $dia_ini=intval($_POST["dia_ini"]);
   $mes_ini=intval($_POST["mes_ini"]);
   $anio_ini=intval($_POST["anio_ini"]);
   $fecha_ini=$anio_ini."-".sprintf("%02s",$mes_ini)."-".sprintf("%02s",$dia_ini);
   $dia_fin=intval($_POST["dia_fin"]);
   $mes_fin=intval($_POST["mes_fin"]);
   $anio_fin=intval($_POST["anio_fin"]);
   if($anio_fin==0) $fecha_fin='2100-01-01';
   else $fecha_fin=$anio_fin."-".sprintf("%02s",$mes_fin)."-".sprintf("%02s",$dia_fin);
   $activo=0;
   if($_POST["activo"]=='1') $activo=1;
   $urlfile=$HTTP_POST_FILES["archivo"];
   if(!empty($HTTP_POST_FILES['archivo']['name'])){
      $ext=extension($HTTP_POST_FILES['archivo']['name']);
      if (uploadBanner($urlfile,$width)){
         $archivo=convertir_validos($HTTP_POST_FILES["archivo"]['name']);
      }else{
         $estatus="ERROR_TIPO";
         $rtranx=false;
      }
   }else{
      $archivo=Formatear($_POST["hiurl"]);
      $ext=extension($archivo);
   }
   if($ext=='swf'){
      $mostrar_alt=true; 
      $swf=new swfheader(false);
      $swf->loadswf($ruta_files.$archivo);
      $w=$swf->width;
      $h=$swf->height;
      $urlfile=$HTTP_POST_FILES["imagen_alt"];
      if(!empty($HTTP_POST_FILES['imagen_alt']['name'])){
         $ext_alt=extension($HTTP_POST_FILES['imagen_alt']['name']);
         if (uploadBanner($urlfile,$width)){
            $imagen_alt=convertir_validos($HTTP_POST_FILES["imagen_alt"]['name']);
         }else{
            $estatus="ERROR_TIPO";
            $rtranx=false;
         }
      }else{
         if($_POST["sinalt"]=='1') {
            $imagen_alt='';
            $ext_alt='';
         }else{
            $imagen_alt=Formatear($_POST["hiurl_alt"]);
            $ext_alt=extension($imagen_alt);
         }
      }
   }else list($w,$h)=getimagesize($ruta_files.$archivo);
   if($rtranx) {
      mysql_query("BEGIN");
      if($idreg!=0){
         $tranx="update banners set
            archivo='$archivo',
            w=$w,
            h=$h,
            texto_alt='$texto_alt',
            imagen_alt='$imagen_alt',
            url='$url',
            ventana=$ventana,
            ancho=$ancho,
            alto=$alto,
            statusbar=$statusbar,
            scrollbars=$scrollbars,
            resize=$resize,
            fecha_ini='$fecha_ini',
            fecha_fin='$fecha_fin',
            activo=$activo
            where id_banner=$idreg and id_zona=$id_zona";
         $rtranx=mysql_query($tranx, $link);
      }else{
         $query="select orden from banners where activo<>2 and id_zona=".$id_zona." order by orden desc limit 1";
         $resultado=mysql_query($query, $link);
         $orden=0;
         if(mysql_num_rows($resultado)>0){
            $row = mysql_fetch_array($resultado);
            $orden=$row['orden'];
         }
         $orden++;
         $tranx="insert into banners (id_zona,archivo,w,h,texto_alt,imagen_alt,url,ventana,ancho,alto,statusbar,scrollbars,resize,fecha_ini,fecha_fin,orden,activo)
            values($id_zona,'$archivo',$w,$h,'$texto_alt','$imagen_alt','$url',$ventana,$ancho,$alto,$statusbar,$scrollbars,$resize,'$fecha_ini','$fecha_fin',$orden,$activo)";
         $rtranx=mysql_query($tranx, $link);
         $idreg = mysql_insert_id($link);
      }
      if(!$rtranx) {
         mysql_query("ROLLBACK");
         //deleteFiles($ruta_files.$HTTP_POST_FILES["archivo"]['name']);
         //deleteFiles($ruta_files.$HTTP_POST_FILES["imagen_alt"]['name']);
         $estatus="ERROR";
      }else{
         mysql_query("COMMIT");
         $estatus="OK";
      }
   }
}else{
   if($opcion=='UPD'){
      $query="select archivo,w,h,texto_alt,imagen_alt,url,ventana,ancho,alto,statusbar,scrollbars,resize,activo,date_format(fecha_ini,'%d') as dia_ini,date_format(fecha_ini,'%c') as mes_ini,date_format(fecha_ini,'%Y') as anio_ini,date_format(fecha_fin,'%d') as dia_fin,date_format(fecha_fin,'%c') as mes_fin,date_format(fecha_fin,'%Y') as anio_fin from banners where activo<>2 and id_zona=".$id_zona." and id_banner=".$idreg;
      $resultado=mysql_query($query, $link);
      if(mysql_num_rows($resultado)>0){
         $row = mysql_fetch_array($resultado);
         $archivo=html_entity_decode($row['archivo'], ENT_QUOTES);
         $ext=extension($archivo);
         if($ext=='swf') $mostrar_alt=true;
         $w=$row['w'];
         $h=$row['h'];
         $texto_alt=html_entity_decode($row['texto_alt'], ENT_QUOTES);
         $imagen_alt==html_entity_decode($row['imagen_alt'], ENT_QUOTES);
         $ext_alt=extension($imagen_alt);
         $url=html_entity_decode($row['url'], ENT_QUOTES);
         $ventana=$row['ventana'];
         $ancho=$row['ancho'];
         $alto=$row['alto'];
         $statusbar=$row['statusbar'];
         $scrollbars=$row['scrollbars'];
         $resize=$row['resize'];
         $dia_ini=$row['dia_ini'];
         $mes_ini=$row['mes_ini'];
         $anio_ini=$row['anio_ini'];
         $dia_fin=$row['dia_fin'];
         $mes_fin=$row['mes_fin'];
         $anio_fin=$row['anio_fin'];
         //Si no se estableció fecha límite, fecha_fin='2100-01-01'
         if($anio_fin==2100){
            $dia_fin=0;
            $mes_fin=0;
            $anio_fin=0;
         }
         $activo=$row['activo'];
      }
   }
}
$colspan=false;
if($w>400) {
   $colspan=true;
   $w1=530;
   if($w>$w1) {
      $h1=intval($h*$w1/$w);
      $w=$w1;
      $h=$h1;
   }
}
if($rtranx) {
   if(!empty($archivo)){
      if ($ext=="jpg" || $ext=="gif") $html_archivo='<img src="'.$ruta_files.$archivo.'" width="'.$w.'" height="'.$h.'" alt="'.$texto_alt.'" title="'.$texto_alt.'" border="0" />';
      else $html_archivo='<script type="text/javascript">document.write(insertSWF("'.$ruta_files.$archivo.'", '.$w.', '.$h.', "'.$texto_alt.'"));</script>';
   }
   if(!empty($imagen_alt)){
      $html_alt='<img src="'.$ruta_files.$imagen_alt.'" width="'.$w.'" height="'.$h.'" alt="'.$texto_alt.'" title="'.$texto_alt.'" border="0">';
   }
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<script type="text/javascript" src="script/jquery-1.2.6.min.js"></script></script>
<script type="text/javascript" src="script/funciones.admin.js"></script></script>
<script type="text/javascript" src="script/popup.js"></script></script>
<link href="script/estilos_sitio.css" rel="stylesheet" type="text/css"> 

<script language="javascript">
function admRegistro(){
	var msgError = "";
	if($("#texto_alt").val()=='') msgError = msgError + "- Título.\n";
	if($("#archivo").val()==''){
      if($("#hiurl").val()=='') msgError = msgError + "- Archivo.\n";
	}else{
      if(!['gif','jpg','swf'].has(extension($("#archivo").val()))) msgError = msgError + "- El archivo debe tener formato GIF, JPG o SWF.\n";
   }
   if($("#imagen_alt").val()!='' && !['gif','jpg'].has(extension($("#imagen_alt").val()))) {
      msgError = msgError + "- La imagen alternativa debe tener formato GIF o JPG.\n";
      $("#td_imagen_alt").html('<input name="imagen_alt" id="imagen_alt" type="file" size="55" class="boton_file" />');
   }
   if($("#url").val()!=''){
      if(!$("#url").val().startsWith("http://") && !$("#url").val().startsWith("https://")) msgError = msgError + "- La liga debe comenzar con \"http:// o https://\".\n";
      else if(!url_valido($("#url").val())) msgError = msgError + "- La liga tiene caracteres no válidos.\n";
   }
   if ($("input[@name='ventana']:checked").val()=='2'){
      if($("#ancho").val()=='') msgError = msgError + "- Ancho de la ventana.\n";
      if(!esEntero($("#ancho").val())) msgError = msgError + "- El ancho de la ventana debe ser un número entero.\n";
      if($("#alto").val()=='') msgError = msgError + "- Alto de la ventana.\n";
      if(!esEntero($("#alto").val())) msgError = msgError + "- El alto de la ventana debe ser un número entero.\n";
   }
   var fecha_ini = new Date();
   var fecha_fin = new Date();
   if(!fecha_valida($("#dia_ini").val(), $("#mes_ini").val(), $("#anio_ini").val())) msgError = msgError + "- Fecha de publicación inválida.\n";
   else fecha_ini.setFullYear($("#anio_ini").val(),$("#mes_ini").val()-1,$("#dia_ini").val());
   if ($("#dia_fin").val()==0 && $("#mes_fin").val()==0 && $("#anio_fin").val()==0) fecha_fin.setFullYear(2100,0,1);
   else if(!fecha_valida($("#dia_fin").val(), $("#mes_fin").val(), $("#anio_fin").val())) msgError = msgError + "- Fecha límite inválida.\n";
   else fecha_fin.setFullYear($("#anio_fin").val(),$("#mes_fin").val()-1,$("#dia_fin").val());
   if(fecha_ini>fecha_fin) msgError = msgError + "- Fecha de publicación posterior a fecha límite.\n";
	if(msgError!=""){
		alert("Por favor, verifica la información en los siguientes campos:\n"+msgError);
		return false;
	}
	$("#opc").val("SAVE");
	$("#form").submit();
}
function check_alt(archivo) {
   var obj = document.getElementById("mostrar_alt");
   if (archivo!="") {
      var ext = extension(archivo);
      if (ext=="swf") obj.style.display = "table-row";
      else obj.style.display = "none";
   } else obj.style.display = "none";
}
</script>
<link href="script/niceforms/niceforms-default-ie.css" type="text/css" rel="stylesheet" />
<style>
#form fieldset.post_it {
    background: #FFFF99;
    border: 1px solid #FFCC33;
}
#msgContainer{
	padding-top:10px;
	padding-bottom:10px;
	text-align:center;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	width:100%;
}

#msgContainer a{
	text-decoration:none;
	color:#0066FF;
}

div.saved{
	background:#99FF99;
	border-top:1px solid #339900;
	border-bottom:1px solid #339900;
}
div.error{
	background:#FFCCCC;
	border-top:1px solid #FF3366;
	border-bottom:1px solid #FF3366;
}
</style>
</head>
<body>
<form id="form" name="form" action="" method="post" enctype="multipart/form-data" >
<? if(isset($estatus) && $estatus=="OK"){ ?>
	<div id="msgContainer" class="saved">Se ha guardado correctamente la informaci&oacute;n. <a href="#" onclick="parent.parent.refreshBanners(<?=$id_zona?>);">Ver lista Actualizada.</a></div>
<? } ?>
<? if(isset($estatus) && $estatus=="ERROR"){	?>
	<div id="msgContainer" class="error">Ocurrio un error al intentar guardar la informacion. Por favor Intenta de Nuevo.</div>
<? } ?>
<? if(isset($estatus) && $estatus=="ERROR_TIPO"){	?>
	<div id="msgContainer" class="error">El archivo debe tener formato JPG, GIF o SWF.<br>La imagen alternativa debe tener formato JPG o GIF.<br>Ancho máximo: <?=$width?> pixeles.</div>
<? } ?>
<? if(!isset($estatus)){?>
<fieldset class="post_it" style="text-align:center; margin-bottom:0">El archivo debe tener formato JPG, GIF o SWF.<br>La imagen alternativa debe tener formato JPG o GIF.<br>Ancho máximo: <?=$width?> pixeles.</fieldset>
<? } ?>
<fieldset>
<input type="hidden" id="id_zona" name="id_zona" value="<?=$id_zona?>" />
<input type="hidden" id="id" name="id" value="<?=$idreg?>" />
<input type="hidden" id="idRow" name="idRow" value="<?=Formatear($_GET["rowId"])?>" />
<input type="hidden" id="opc" name="opc" value="" />
<input type="hidden" name="id_nodoR" value="<? echo $nodo;?>">
<dl>
   <dt></dt>
   <dd><b><?=$nombre?></b> (<?=$width?> pixeles)</dd>
</dl>
<dl>
   <dt><label for="texto_alt">* Título:</label></dt>
   <dd><textarea name="texto_alt" id="texto_alt" style="width:392px;height:60px;"><?=stripslashes(Formatear($texto_alt))?></textarea></dd>
</dl>
<dl>
   <dt><label for="archivo">* Archivo:</label><input type="hidden" id="hiurl" name="hiurl" value="<?=$archivo?>" /></dt>
   <dd><input name="archivo" id="archivo" type="file" size="55" class="boton_file" onChange="check_alt(this.value);" /></dd>
</dl>
<? if (!empty($archivo)){ ?>
<dl>
	<dt></dt>
   <? if($colspan){ ?>
   <dd><?=$html_archivo?></dd>
   <? }else{ ?>
   <dd><?=$html_archivo?></dd>
   <? } ?>
</dl>
<? } ?>
<dl id="mostrar_alt" <?if(!$mostrar_alt){?>style="display:none;"<?}?>>
   <dt><label for="imagen_alt">Imagen alternativa:</label><input type="hidden" id="hiurl_alt" name="hiurl_alt" value="<?=$imagen_alt?>" /></dt>
   <dd id="td_imagen_alt"><input name="imagen_alt" id="imagen_alt" type="file" size="55" class="boton_file" /></dd>
</dl>
<? if (!empty($imagen_alt)){ ?>
<dl>
   <? if($colspan){ ?>
   <dt><?=$html_alt?><br><input name="sinalt" id="sinalt" type="checkbox" value="1" />Sin imagen alternativa</dt>
   <? }else{ ?>
   <dd><?=$html_alt?><br><input name="sinalt" id="sinalt" type="checkbox" value="1" />Sin imagen alternativa</dd>
   <? } ?>
</dl>
<? } ?>
<dl>
   <dt><label for="url">Liga:</label></dt>
   <dd><table><tr><td ><input type="radio" onclick="document.form.liga.focus();liga_selected=0;" value="liga" name="op_liga"> URL: </td><td><input type="text" name="url" id="url" style="width:200px" maxlength="255" value="<?=stripslashes(Formatear($url))?>" /></td></tr>
   <tr><td><input type="radio" onclick="javascript:alert(2);" value="nodo" name="op_liga"> Nodo: </td><td>
   <input name="nodoR" type=text size=50 maxlength=255 class="idisabled" style="width:200px" disabled value="<? echo $str_nodoR;?>"><a href="javascript:seleccionar_nodo();"><img src="imagen/seleccionar.gif" alt="Seleccionar..." title="Seleccionar..." border=0 align="absmiddle"></a></td></tr></table></dd>
</dl>
<dl>
   <dt><label for="ventana">Ventana:</label></dt>
   <dd><table border="0">
   <tr>
      <td valign="top" colspan="2"><input name="ventana" id="ventana0" type="radio" value="0" <? if($ventana==0){ echo 'checked="checked"'; } ?>> Actual</td>
   </tr>
   <tr>
      <td valign="top" colspan="2"><input name="ventana" id="ventana1" type="radio" value="1" <? if($ventana==1){ echo 'checked="checked"'; } ?>> Nueva</td>
   </tr>
   <tr >
      <td valign="top"><input name="ventana" id="ventana2" type="radio" value="2" <? if($ventana==2){ echo 'checked="checked"'; } ?>> Popup</td>
      <td valign="top"><br /><table>
        <tr><td>Ancho</td><td> <input type="text" name="ancho" id="ancho" size="3" maxlength="3" value="<?=($ancho==0)?'':$ancho;?>" onClick="document.form.ventana[2].checked=true;"></td>
        <td>Alto</td><td> <input type="text" name="alto" id="alto" size="3" maxlength="3" value="<?=($alto==0)?'':$alto;?>" onClick="document.form.ventana[2].checked=true;"></td></tr>
        <tr><td colspan="4">
         <input type="checkbox" name="statusbar" id="statusbar" <? if($statusbar==1){ echo 'checked="checked"'; } ?> onClick="document.form.ventana[2].checked=true;" value="1">Statusbar<br>
         <input type="checkbox" name="scrollbars" id="scrollbars" <? if($scrollbars==1){ echo 'checked="checked"'; } ?> onClick="document.form.ventana[2].checked=true;" value="1">Scrollbars<br>
         <input type="checkbox" name="resize" id="resize" value="1" <? if($resize==1){ echo 'checked="checked"'; } ?> onClick="document.form.ventana[2].checked=true;" value="1">Resize</td></tr></table></td>
   </tr>
   </table></dd>
</dl>
<dl>
   <dt><label for="dia_ini">* Vigencia:</label></dt>
   <dd>Del:&nbsp;<select name="dia_ini" id="dia_ini" size="1">
      <option value="0">---D&iacute;a---</option>
	   <? for($i=1;$i<=31;$i++){ ?>
	  	<option value="<?=$i?>" <? if($dia_ini==$i){ echo 'selected'; } ?>><?=sprintf("%02s",$i)?></option>
	   <? } ?>
	   </select>
	   <select name="mes_ini" id="mes_ini" size="1">
      <option value="0">---Mes---</option>
	   <? for($i=1;$i<=12;$i++){ ?>
	  	<option value="<?=$i?>" <? if($mes_ini==$i){ echo 'selected'; } ?>><?=dame_nombre_mes($i)?></option>
	   <? } ?>
      </select>
	   <select name="anio_ini" id="anio_ini" size="1">
	   <option value="0">---A&ntilde;o---</option>
	   <?
      $primer_anio=$anio_hoy;
      if($anio_ini<$anio_hoy) $primer_anio=$anio_ini;
      for($i=$primer_anio;$i<=$anio_hoy+1;$i++){
      ?>
	  	<option value="<?=$i?>" <? if($anio_ini==$i){ echo 'selected'; } ?>><?=sprintf("%04s",$i)?></option>
	   <? } ?>
	</select><br>
	&nbsp;&nbsp;&nbsp;Al:&nbsp;
    <select name="dia_fin" id="dia_fin" size="1">
      <option value="0" <? if($dia_fin==0){ echo 'selected'; } ?>>---D&iacute;a---</option>
	   <? for($i=1;$i<=31;$i++){ ?>
	  	<option value="<?=$i?>" <? if($dia_fin==$i){ echo 'selected'; } ?>><?=sprintf("%02s",$i)?></option>
	   <? } ?>
	   </select>
	   <select name="mes_fin" id="mes_fin" size="1">
      <option value="0" <? if($mes_fin==0){ echo 'selected'; } ?>>---Mes---</option>
	   <? for($i=1;$i<=12;$i++){ ?>
	  	<option value="<?=$i?>" <? if($mes_fin==$i){ echo 'selected'; } ?>><?=dame_nombre_mes($i)?></option>
	   <? } ?>
      </select>
	   <select name="anio_fin" id="anio_fin" size="1">
	   <option value="0" <? if($anio_fin==0){ echo 'selected'; } ?>>---A&ntilde;o---</option>
	   <?
      $primer_anio=$anio_hoy;
      if ($anio_fin<$anio_hoy && $anio_fin!=0) $primer_anio=$anio_fin;
      for($i=$primer_anio;$i<=$anio_hoy+1;$i++){
      ?>
	  	<option value="<?=$i?>" <? if($anio_fin==$i){ echo 'selected'; } ?>><?=sprintf("%04s",$i)?></option>
	   <? } ?>
	</select></dd>
</dl>
<dl>
   <dt><label for="activo">Activo:</label></dt>
   <dd><input name="activo" id="activo" type="checkbox" value="1" <? if ($activo==1) { echo 'checked="checked"'; } ?> /></dd>
</dl>
</fieldset>
<fieldset class="action">
   <input name="guardar" type="button" id="guardar" value="Guardar" onclick="admRegistro();" class="boton" />
</fieldset>
</form>
<?
mysql_close($link);
?>
</body>
</html>
<script type="text/javascript">
var p = new winPopup('p',400,250,'');
p._iframe("../blank.htm");

function seleccionar_nodo() { 
   p._titulo("Seleccionar nodo");
   p._src("ver.seccion.estatica.php");
   p.show();
}

function set_nodo(cadena, id) {
   if (cadena!="") {
      document.form.op_liga[1].checked = true;
      document.form.nodoR.value = cadena;
      document.form.nodoR.title = cadena;
      document.form.id_nodoR.value = id;
      //padre_nodoR = padre;
      liga_selected = 1;
   } else document.form.op_liga[liga_selected].checked = true;
   p.hide();
}

function mostrar_restricciones() {
   p._titulo("Restricciones");
   p._src("restricciones.jsp");
   p.show();
}

function validar_nodo(forma) {
   var ok = true;
   _reset("_titulo");
   _reset("_liga");
   _reset("_archivo");
   _reset("_nodo");
   _reset("_ancho");
   _reset("_alto");
   if (forma.titulo.value=="") ok = error("_titulo", "Escribe el título");
   var op_liga = getRadioValue(forma.op_liga);
   if (op_liga=="liga" && forma.liga.value=="") ok = error("_liga", "Escribe el URL");
   if (op_liga=="archivo") {
      if (forma.archivo.value=="") ok = error("_archivo", "Selecciona el archivo");
      else {
         var ext = extension(forma.archivo.value);
         if(!["pdf","doc","xls","zip"].has(ext)) ok = error("_archivo", "Formato del archivo no permitido");
      }
   }
   if (op_liga=="nodo" && forma.nodoR.value=="") ok = error("_nodo", "Selecciona el nodo");
   if (getRadioValue(forma.ventana)=="2") {
		if (forma.ancho.value=="") ok = error("_ancho", "Escribe el ancho");
		else if (!esEntero(forma.ancho.value)) ok = error("_ancho", "El ancho no es válido");
      if (forma.alto.value=="") ok = error("_alto", "Escribe el alto");
		else if (!esEntero(forma.alto.value)) ok = error("_alto", "El alto no es válido");
	}
   if (ok) forma.submit();
}
</script>


