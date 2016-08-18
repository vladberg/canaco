
<?php
error_reporting(0);

	require_once 'lib/login.action.php';

	$membership = new loginActions();

	$membership->confirm_Member2(); 

	include_once("lib/template.php");
	include_once("lib/files.admin.php");

  //include_once("lib/util.php");

	//include_once("lib/sql.injection.php");

	include_once("lib/sanitize/sanitize.php");
	
	$link=conectarse();

	

	

	$ruta_files='../patrocinadores/';

	

	if($_POST && !empty($_POST["opc"])){

		$opcion=$_POST["opc"];

	}

	else{

		$opcion=$_GET["opc"];

	}

	
$user=$_SESSION['admin_user'];
	$titulo='';

	$publicar='';

	$foto='';

	$dia=date("j");

	$mes=date("n");

	$anio=date("Y");

	$idreg=0;


	if($opcion=='UPD'){

		$idreg=intval($_GET["id"]);

		$query="SELECT categoria,imagen,estatus FROM categorias where id_categoria='$idreg' limit 1";

		$resultado=mysql_query($query, $link);

		if(mysql_num_rows($resultado)>0){

			$row = mysql_fetch_row($resultado);

			$titulo = Sanitize($row[0], 'hlSafest'); 

			$foto = $row[1];
			
			$publicar = $row[2] ;			

		}

	}

	else{

		if($opcion=='SAVE'){

			$idreg=intval($_POST["id"]);

			$titulo = htmlentities(Formatear($_POST["titulo"])); 

			$publicar=0;

			if ($_POST["publicar"]=='on'){

				$publicar=1;

			}
			
			$urlfile=$HTTP_POST_FILES["filefoto"];
			$target_path = "../patrocinadores/";
            $target_path = $target_path . basename( $_FILES['filefoto']['name']);

			if(!empty($_FILES['filefoto']['name'])){

				if(move_uploaded_file($_FILES['filefoto']['tmp_name'], $target_path)) {
				

					$foto=$_FILES['filefoto']['name'];

					mysql_query("BEGIN");

					if($idreg!=0){
						//echo $foto;

						 $tranx="update categorias set categoria='$titulo',imagen='$foto',estatus='$publicar'where id_categoria=$idreg";

						$ca = 'MODIFICAR NOTIFICACIÓN';

						$rtranx=mysql_query($tranx, $link);

					}

					else{

						$tranx="insert into categorias (categoria,imagen,estatus,fecha_creacion)  values('$titulo', '$foto',$publicar, CURDATE())";

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

					$tranx="update categorias set categoria='$titulo',estatus='$publicar'where id_categoria=$idreg";

								

					$ca = 'MODIFICAR NOTIFiCACIÓN';

					$rtranx=mysql_query($tranx, $link);

					$foto=Formatear($_POST["hiurl"]);

					$error1 = mysql_error(); //Bitácora

					$query1 = $tranx; //Bitácora

				}else{

					$tranx="insert into categorias (categoria,imagen,estatus,fecha_creacion)  values('$titulo', '$foto',$publicar, CURDATE())";

						  

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
   extensiones_permitidas = new Array(".jpg",".png"); 
   mierror = "";

	var msgError = "";

	if($("#titulo").val() == ''){

		msgError = msgError + "- Titulo .\n";

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
   extensiones_permitidas = new Array(".jpg",".png");
   mierror = "";

	var msgError = "";

	if($("#titulo").val() == ''){

		msgError = msgError + "- Titulo .\n";

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
           <br/>
          </div>
        </div>
        
            <div class="row" >
             <div class="col-lg-8">
            <div class="row">
  	          <div class="col-md-6"><h2>Nuevo Patrocinador</h2></div>
              </div>
              <form id="form" name="form" action="" method="post" enctype="multipart/form-data" class="niceform">

	<fieldset>

	<? if(isset($estatus) && $estatus == "OK" && $user!='admin'){ ?>

	<div id="msgContainer" class="saved">Se ha guardado correctamente la 

informaci&oacute;n. <a href="filtro_categorias2.php" onClick="actualizarLista();">Ver lista 

Actualizada.</a></div>

	<? }
	if(isset($estatus) && $estatus == "OK" && $user=='admin'){ ?>

	<div id="msgContainer" class="saved">Se ha guardado correctamente la 

informaci&oacute;n. <a href="filtro_categorias.php" onClick="actualizarLista();">Ver lista 

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
        	<td><label>Patrocinador</label></td>
            <td><input class="form-control" placeholder="Nombre del Documento" type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>"/></td>
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
         <td><label>Publicar:</label></td>
            <td><input class="checkbox" name="publicar" id="publicar" type="checkbox" <? if ($publicar==1) { echo 'checked="checked"'; } ?>/></td>
        </tr>
    </table>
    </div>
   </fieldset>
   <?php if($opcion=="UPD"){?>
   
    <div class="modal-footer">
                    <a href="filtro_categorias.php" onclick="return confirmar('¿Est&aacute; seguro que desea salir,no se guardara el registro?')"><button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button></a>
                    <button type="button" class="btn btn-primary" name="guardar" id="guardar" value="Guardar" onclick="admRegistroupd(this.form.filefoto.value);">Guardar</button>
                </div>
                <?php } ?>
                <?php if($opcion!="UPD" && $user=='admin'){?>
    <div class="modal-footer">
                    <a href="filtro_categorias.php" onclick="return confirmar('¿Est&aacute; seguro que desea salir,no se guardara el registro?')"><button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button></a>
                    <button type="button" class="btn btn-primary" name="guardar" id="guardar" value="Guardar" onclick="admRegistro(this.form.filefoto.value);">Guardar</button>
                </div>
                <?php } ?>
                <?php if($opcion!="UPD" && $user!='admin'){?>
    <div class="modal-footer">
                    <a href="filtro_categorias2.php" onclick="return confirmar('¿Est&aacute; seguro que desea salir,no se guardara el registro?')"><button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button></a>
                    <button type="button" class="btn btn-primary" name="guardar" id="guardar" value="Guardar" onclick="admRegistro(this.form.filefoto.value);">Guardar</button>
                </div>
                <?php } ?>
    </form>
    

               
        </div>
        </div>
        </div>
              
    
<?php footer(); ?>
    