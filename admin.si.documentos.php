
<?php
error_reporting(0);

	require_once 'lib/login.action.php';

	$membership = new loginActions();

	$membership->confirm_Member2(); 

	include_once("lib/template.php");
	include_once("lib/files.admin.php");

  include_once("lib/util.php");

	include_once("lib/sql.injection.php");

	include_once("lib/sanitize/sanitize.php");
	
	$link=conectarse();

	

	

	$ruta_files='../docs/';

	

	if($_POST && !empty($_POST["opc"])){

		$opcion=$_POST["opc"];

	}

	else{

		$opcion=$_GET["opc"];

	}

	

	$titulo='';

	$descripcion='';

	$departamento='';

	$publicar='';

	$foto='';

	$dia=date("j");

	$mes=date("n");

	$anio=date("Y");

	$idreg=0;

	$usuario=Formatear($_SESSION['dgti_user']);

	if($opcion=='UPD'){

		$idreg=intval($_GET["id"]);

		$query="SELECT titulo,descripcion, archivo,publicar,departamento FROM documentos where id_documento='$idreg' limit 1";

		$resultado=mysql_query($query, $link);

		if(mysql_num_rows($resultado)>0){

			$row = mysql_fetch_row($resultado);

			$titulo = Sanitize($row[0], 'hlSafest'); 

			$descripcion = Sanitize($row[1], 'hlSafest'); 
			
			
			
			$foto = $row[2];
			
			$publicar = $row[3] ;
			
			$departamento = Sanitize($row[4], 'hlSafest') ;

			

		}

	}

	else{

		if($opcion=='SAVE'){

			$idreg=intval($_POST["id"]);

			$titulo = htmlentities(Formatear($_POST["titulo"])); 

			$descripcion = htmlentities($_POST["descripcion"]);
			
			$departamento = htmlentities(Formatear($_POST["departamento"]));

			

			$publicar='N';

			if ($_POST["publicar"]=='on'){

				$publicar='S';

			}
			
				
			


			$urlfile=$HTTP_POST_FILES["filefoto"];
			$target_path = "../docs/";
            $target_path = $target_path . basename( $_FILES['filefoto']['name']);

			if(!empty($_FILES['filefoto']['name'])){

				if(move_uploaded_file($_FILES['filefoto']['tmp_name'], $target_path)) {
				

					$foto=$_FILES['filefoto']['name'];

					mysql_query("BEGIN");

					if($idreg!=0){
						//echo $foto;

						 $tranx="update documentos 

									set titulo='$titulo',
									
									archivo='$foto',

										descripcion='$descripcion',

										publicar='$publicar',
										
										departamento = '$departamento',

										update_by='$usuario',

										update_date=Now() 

									where id_documento=$idreg";

									

						$ca = 'MODIFICAR NOTIFICACIÓN';

						$rtranx=mysql_query($tranx, $link);

					}

					else{

						$tranx="insert into documentos (titulo,descripcion,archivo,publicar,departamento, created_date,  created_by)

							  values('$titulo','$descripcion', '$foto','$publicar', '$departamento', Now(),'$usuario')";

						$rtranx=mysql_query($tranx, $link);

						$idreg = mysql_insert_id($link);
						

					}
					if(!$rtranx) 

					{

						mysql_query("ROLLBACK");

						//deleteFiles($ruta_files.$HTTP_POST_FILES["filefoto"]['name']);

						$estatus="ERROR";

					}

					else{

						mysql_query("COMMIT");

						$estatus="OK";

					}

				}

				else{

						$estatus="ERROR";

				}

			}

			else{

				mysql_query("BEGIN");

				if($idreg!=0){
					//echo $foto=$_POST["hiurl"];

					 $tranx="update documentos 

									set titulo='$titulo',

										descripcion='$descripcion',

										publicar='$publicar',
										
										departamento = '$departamento',

										update_by='$usuario',

										update_date=Now() 

									where id_documento=$idreg";

								

					$ca = 'MODIFICAR NOTIFiCACIÓN';

					$rtranx=mysql_query($tranx, $link);

					$foto=Formatear($_POST["hiurl"]);

					$error1 = mysql_error(); //Bitácora

					$query1 = $tranx; //Bitácora

				}else{

					$tranx="insert into documentos (titulo,descripcion,archivo,publicar,departamento, created_date,  created_by)

							  values('$titulo','$descripcion', '$foto','$publicar', '$departamento', Now(),'$usuario')";

						  

					$ca = 'ALTA DE NOTIFICACIÓN';	  

					$rtranx=mysql_query($tranx, $link);

					$idreg = mysql_insert_id($link);

				}

				

				if(!$rtranx) 

				{

					mysql_query("ROLLBACK");

					$estatus="ERROR";

				}

				else{

					mysql_query("COMMIT");

					$estatus="OK";

				}

			}

		}

	}

cabezal(); ?>
<script language="javascript" src="js/datevalid.js" type="text/javascript"></script>

<script language="javascript" src="js/jquery-1.2.6.min.js" type="text/javascript"></script>

<script language="javascript">

function confirmar ( mensaje ) { 
return confirm( mensaje ); 
} 

function admRegistroupd() { 
   extensiones_permitidas = new Array(".pdf"); 
   mierror = "";

	var msgError = "";

	if($("#titulo").val() == ''){

		msgError = msgError + "- Titulo .\n";

	}

	if($("#descripcion").val() == ''){

		msgError = msgError + "- Descripcion.\n";

	}
	
	if($("#departamento").val() == ''){

		msgError = msgError + "- Departamento.\n";

	}


	/*if($("#hiurl").val() == ''){

		if($("#filefoto").val() == ''){

			msgError = msgError + "- Archivo de la Notificación.\n";

		}
		

	}
	
	

	if($("#piefoto").val() == ''){

		msgError = msgError + "- Pie de Foto.\n";

	}*/

	// para validar la fecha mm/dd/yyyy

	/*var dt=$("#cbmes").val()+"/"+$("#cbdia").val()+"/"+$("#cbanio").val();

	if (isDate(dt)==false){

		msgError = msgError + "- Fecha no válida.\n";

	}*/

	if(msgError != ""){

		alert("Por favor, escriba información en los siguientes campos:\n"+msgError);

		return false;

	}

	$("#opc").val("SAVE");

	$("#form").submit();

}

function admRegistro(archivo) { 
   extensiones_permitidas = new Array(".pdf",".docx",".pptx",".ppsx",".xlsx",".doc",".ppt",".pps",".xlx");
   mierror = "";

	var msgError = "";

	if($("#titulo").val() == ''){

		msgError = msgError + "- Titulo .\n";

	}

	
	
	if($("#departamento").val() == ''){

		msgError = msgError + "- Departamento.\n";

	}

	if($("#hiurl").val() == ''){

		if($("#filefoto").val() == ''){

			msgError = msgError + "- Archivo .\n";

		}
		

	}
	
	

	/*if($("#piefoto").val() == ''){

		msgError = msgError + "- Pie de Foto.\n";

	}*/

	// para validar la fecha mm/dd/yyyy

	/*var dt=$("#cbmes").val()+"/"+$("#cbdia").val()+"/"+$("#cbanio").val();

	if (isDate(dt)==false){

		msgError = msgError + "- Fecha no válida.\n";

	}*/

	if(msgError != ""){

		alert("Por favor, escriba información en los siguientes campos:\n"+msgError);

		return false;

	}
	if (!archivo) { 
      //Si no tengo archivo, es que no se ha seleccionado un archivo en el formulario 
      	mierror = "No has seleccionado ningún archivo"; 
   }else{ 
      //recupero la extensión de este nombre de archivo 
      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
      //alert (extension); 
      //compruebo si la extensión está entre las permitidas 
      permitida = false; 
      for (var i = 0; i < extensiones_permitidas.length; i++) { 
         if (extensiones_permitidas[i] == extension) { 
         permitida = true; 
         break; 
         } 
      } 
      if (!permitida) { 
         mierror = "Comprueba la extension de los archivos a subir. \nSolo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(); 
      	}else{ 
         	 //submito! 
         alert ("Todo correcto...guardando  la informacion"); 
        $("#opc").val("SAVE");

	    $("#form").submit();
         return 1; 
      	} 
   } 
   //si estoy aqui es que no se ha podido submitir 
   alert (mierror); 
   return 0; 

	

}


function actualizarLista(){

	var array_data = new Array();

	array_data[0] = $("#idRow").val();

	array_data[1] = $("#id").val();

	array_data[2] = '<? echo $titulo; ?>';
	
	array_data[3] = '<? echo $departamento; ?>';

	array_data[4] = '<? if ($publicar=='S'){echo 'publicado.gif';} else{echo 'no_publicado.gif';} ?>';
	array_data[5] = 'delete.gif';

	parent.parent.refreshNoticia(array_data);

}

function ocultaMensaje(){

	try{

		//$('#msgContainer').css('display','none');

		$('#msgContainer').html('&nbsp;');

		$('#msgContainer').attr('className','');

	}

	catch(error){

	}

}

$(document).ready(function(){

	$('input[type="text"]').change(ocultaMensaje);

	$('select').change(ocultaMensaje);

	$('input[type="checkbox"]').click(ocultaMensaje);

});

</script>

<!--[if !IE]>-->  


<script type="text/javascript" src="lib/tiny_mce/tiny_mce_src.js"></script>

<script type="text/javascript">

	tinyMCE.init({

		// General options

		elements : "txtcontenido",

		language : 'es',

		mode : "textareas",

		theme : "advanced",

		skin : "o2k7",

		skin_variant : "silver",

		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",



		// Theme options

		theme_advanced_buttons1 : "formatselect,fontselect,fontsizeselect,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor",

		theme_advanced_buttons2 : "bold,italic,underline,strikethrough,|,cut,copy,paste,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,image,media,cleanup",

		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,advhr",

		//theme_advanced_buttons4 : "",

		theme_advanced_toolbar_location : "top",

		theme_advanced_toolbar_align : "left",

		theme_advanced_statusbar_location : "bottom",

		theme_advanced_resizing : false,



		// Example content CSS (should be your site CSS)

		content_css : "lib/tiny_mce/css/content.css",



		// Drop lists for link/image/media/template dialogs

		//template_external_list_url : "script/tiny_mce/lists/template_list.js",

		//external_link_list_url : "script/tiny_mce/lists/link_list.js",

		//external_image_list_url : "script/tiny_mce/lists/image_list.js",

		//media_external_list_url : "script/tiny_mce/lists/media_list.js",

		

		//template_external_list_url : "script/tiny_mce/lists/template_list.js",

		external_link_list_url : "listado.archivos.php?t=jslink",

		external_image_list_url : "listado.archivos.php?t=jsimg",

		media_external_list_url : "listado.archivos.php?t=jsmedia",

		



		// Replace values for the template plugin

		template_replace_values : {

			username : "Some User",

			staffid : "991234"

		}

	});

</script>
<!--<![endif]-->

<!--[if IE]>

<link href="script/niceforms/niceforms-default-ie.css" type="text/css" rel="stylesheet" />

<![endif]-->
<style>

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
<?php body(); ?>

 <div id="page-wrapper" >

        <div class="row">
          <div class="col-lg-8">
            <h1>Panel de Control <small>Administrador</small></h1>
            <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
              <li class="active"><i class="fa fa-file-o"></i> Documentos</li>
            </ol>
            <div class="alert alert-success alert-dismissable"> 
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Bienvenido al administrador del Sitio <a class="alert-link" href="../index.php">DGTI</a> Aqui se podran admnistrar los contenidos de la seccion departamentos.
            </div>
          </div>
        </div>
        
            <div class="row" >
             <div class="col-lg-8">
            <div class="row">
  	          <div class="col-md-6"><h2>Nuevo Documento</h2></div>
              </div>
              <form id="form" name="form" action="" method="post" enctype="multipart/form-data" class="niceform">

	<fieldset>

	<? if(isset($estatus) && $estatus == "OK"){ ?>

	<div id="msgContainer" class="saved">Se ha guardado correctamente la 

informaci&oacute;n. <a href="filtro_documentos.php" onClick="actualizarLista();">Ver lista 

Actualizada.</a></div>

	<? }

	   if(isset($estatus) && $estatus == "ERROR"){	?>

	<div id="msgContainer" class="error">Ocurrio un error al intentar guardar la 

informacion. Por favor Intenta de Nuevo.</div>

	<? } ?>

	<? if(!isset($estatus)){ ?><div>&nbsp;</div><? } ?>

	<input type="hidden" id="id" name="id" value="<? echo $idreg; ?>" />

	<input type="hidden" id="idRow" name="idRow" value="<? echo $_GET["rowId"]; ?>" />

	<input type="hidden" id="opc" name="opc" value="" />
    
    </br>


    <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter" align="center">
    	
        	
        <tr>
        	<td><label>Documento</label></td>
            <td><input class="form-control" placeholder="Nombre del Documento" type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>"/></td>
        </tr>
        <tr>
        	<td><label>Descripcion</label></td>
            <td><textarea class="form-control" rows="3" id="descripcion" name="descripcion" /><?php echo html_entity_decode($descripcion, ENT_QUOTES); ?></textarea></td>
        </tr>
        <tr>
        	<td><label>Archivo Relacionado</label></td>
            
            <td>
           <input class="form-control" name="filefoto" id="filefoto" type="file" size="55" /></dd>

	  <? if (!empty($foto)){ ?>

		  <br /> Archivo Anexo: <img src="img/script.png" border="0" /> <? echo $foto ?> [<a href="<? echo $ruta_files.$foto ?>" target="_blank">Ver archivo</a>]

	  <? } ?>


	  <input type="hidden" id="hiurl" name="hiurl" value="<? echo $foto ?>"  /></td>
        </tr>
       
        <tr>
        	<td><label>Departamento:</label></td>
            <td><select class="form-control" name="departamento" id="departamento">
                                     <option value="">Seleccionar Departamento</option>
   		<?php
		include_once("lib/conexion.php");
		$link=conectarse();
		
		$query="SELECT id_departamento,descripcion FROM departamentos ";
		
        $resultado=mysql_query($query, $link);
			
	

		while($row=mysql_fetch_array($resultado)){

			?>
	     <option  value="<? echo html_entity_decode($row[1], ENT_QUOTES); ?>" <?php if($direccion == $row[1]){ echo 'selected="selected"';} ?> ><?php echo html_entity_decode($row[1], ENT_QUOTES); ?></option>
         <?php } ?>
         </select>
         </td>
         </tr>
         <tr>
         <td><label>Publicar:</label></td>
            <td><input class="checkbox" name="publicar" id="publicar" type="checkbox" <? if ($publicar=="S") { echo 'checked="checked"'; } ?>/></td>
        </tr>
    </table>
    </div>
   </fieldset>
   <?php if($opcion=="UPD"){?>
   
    <div class="modal-footer">
                    <a href="filtro_documentos.php" onclick="return confirmar('¿Est&aacute; seguro que desea salir,no se guardara el registro?')"><button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button></a>
                    <button type="button" class="btn btn-primary" name="guardar" id="guardar" value="Guardar" onclick="admRegistroupd(this.form.filefoto.value);">Guardar</button>
                </div>
                <?php } ?>
                <?php if($opcion!="UPD"){?>
    <div class="modal-footer">
                    <a href="filtro_documentos.php" onclick="return confirmar('¿Est&aacute; seguro que desea salir,no se guardara el registro?')"><button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button></a>
                    <button type="button" class="btn btn-primary" name="guardar" id="guardar" value="Guardar" onclick="admRegistro(this.form.filefoto.value);">Guardar</button>
                </div>
                <?php } ?>
    </form>
    
<script language="javascript">

$("#departamento").val("<? echo $departamento; ?>");

</script>
               
        </div>
        </div>
        </div>
              
    
<?php footer(); ?>
    