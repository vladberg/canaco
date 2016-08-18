
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

	if($_POST){

	

	$ruta_files='docs/';
	$target_path = "docs/";
    $target_path = $target_path . basename( $_FILES['filefoto']['name']); 

				
			


			
$target_path = "docs/";
$target_path = $target_path . basename( $_FILES['filefoto']['name']); 
if(move_uploaded_file($_FILES['filefoto']['tmp_name'], $target_path)) 
{ 
$estatus="OK";
}else{
$estatus="ERROR";
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

	var dt=$("#cbmes").val()+"/"+$("#cbdia").val()+"/"+$("#cbanio").val();

	if (isDate(dt)==false){

		msgError = msgError + "- Fecha no válida.\n";

	}

	if(msgError != ""){

		alert("Por favor, escriba información en los siguientes campos:\n"+msgError);

		return false;

	}

	$("#opc").val("SAVE");

	$("#form").submit();

}

function admRegistro(archivo) { 
   extensiones_permitidas = new Array(".pdf",".docx",".pptx",".ppsx",".xlsx",".doc",".ppt",".pps",".xlx",".jpg",".png",".gif");
   mierror = "";

	var msgError = "";

	

		if($("#filefoto").val() == ''){

			msgError = msgError + "- Archivo .\n";

		}
		

	
	
	

	/*if($("#piefoto").val() == ''){

		msgError = msgError + "- Pie de Foto.\n";

	}*/

	// para validar la fecha mm/dd/yyyy

	

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
            </ol>
           
          </div>
        </div>
        
            <div class="row" >
             <div class="col-lg-8">
            <div class="row">
  	          <div class="col-md-6"><h2>Subir Productos</h2></div>
              </div>
              <?php include_once("importar_precios.php");?>               
        </div>
        
        </div>
        <div class="row" >
             <div class="col-lg-8">
            <div class="row">
  	          <div class="col-md-6"><h2>Subir Archivo Precios</h2></div>
              </div>
              <?php include_once("importar.php");?>               
        </div>
        
        </div>
         <div class="row" >
             <div class="col-lg-8">
            <div class="row">
  	          <div class="col-md-6"><h2>Subir Archivo Imagenes</h2></div>
              </div>
              <?php include_once("importar_imagen.php");?>               
        </div>
        
        </div>
        </div>
              
    
<?php footer(); ?>
    