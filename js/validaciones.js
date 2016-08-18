// JavaScript Document


function admRegistro() { 
   

	var msgError = "";

	if($("#url").val() == ''){

		msgError = msgError + "- URL del Servidor.\n";

	}
	
	if($("#funcion").val() == ''){

		msgError = msgError + "- Función del Servido.\n";

	}
	
	if($("#ip").val() == ''){

		msgError = msgError + "- IP del Servido.\n";

	}
	
	if($("#dns1").val() == ''){

		msgError = msgError + "- DNS Primario del Servidor.\n";

	}
	
	if($("#dns2").val() == ''){

		msgError = msgError + "- DNS Secundario del Servidor.\n";

	}
	
	if($("#hd").val() == ''){

		msgError = msgError + "- Capacidad del Disco Duro del Servidor.\n";

	}
	
	if($("#hde").val() == ''){

		msgError = msgError + "- Espacio Disponible del Disco Duro del Servidor.\n";

	}
	
	if($("#ram").val() == ''){

		msgError = msgError + "- Total de Memoria RAM del Servidor.\n";

	}
	
if(msgError != ""){

		alert("Por favor, escriba información en los siguientes campos:\n"+msgError);

		return false;

	}

	$("#opc").val("SAVE");

	$("#form").submit();

}

function admRegistrofile(archivo) { 
   extensiones_permitidas = new Array(".pdf"); 
   mierror = "";

	var msgError = "";

	if($("#encabezado").val() == ''){

		msgError = msgError + "- Titulo de la Notificación.\n";

	}

	if($("#tipo").val() == ''){

		msgError = msgError + "- Tipo de notificación.\n";

	}


	if($("#hiurl").val() == ''){

		if($("#filefoto").val() == ''){

			msgError = msgError + "- Archivo de la Notificación.\n";

		}
		

	}
	
	

	/*if($("#piefoto").val() == ''){

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

	array_data[2] = '<? echo $encabezado; ?>';
	
	array_data[3] = '<? echo $tipo; ?>';

	array_data[4] = '<? echo $anio."-".$mes."-".$dia; ?>';

	array_data[5] = '<? if ($publicar=="S"){echo "publicado.gif";} else{echo "no_publicado.gif";} ?>';

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

