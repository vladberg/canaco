// JavaScript Document
function crearXMLHttpRequest() 
{
  var xmlHttp=null;
  if (window.ActiveXObject) 
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  else{ 
    if (window.XMLHttpRequest) 
      xmlHttp = new XMLHttpRequest();
  }
  return xmlHttp;
}


function guardar(){
  if(camposObligatorios()){
	  var transaction = Math.random();
	  var parametros = "trans=" + transaction;
	  parametros = parametros + "&dd=" + obtenerTramites();
	  parametros = parametros + "&aa=" + document.getElementById("categoria").value;
	  xmlRequest = crearXMLHttpRequest();
	  xmlRequest.onreadystatechange = guardandoDefinicionTramites;
	  xmlRequest.open('POST','guardar.tramites.php', true);
	  xmlRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	  xmlRequest.send(parametros);
  }
}

function guardandoDefinicionTramites(){
  if(xmlRequest.readyState == 4){
		var resultado = xmlRequest.responseText;
		//alert(resultado);
		var parametros = resultado.split("|");
		if(parametros[1] == "GUARDADO"){
			alert("La informaci\u00f3n se ha guardado satisfactoriamente.");
		}
		else{
			alert("Ocurrio un error al intentar guardar la información del Paquete.\nPor favor intente de nuevo");
		}
	} 
}

function obtenerTramites(){
	cont=0;
	total=0;
	cantidad="";
	for(k=0;k<document.getElementsByName('tramite').length;k++)
	{
		if(cont==0){
			if(document.getElementsByName('tramite')[k].checked){
				cantidad=cantidad+document.getElementsByName('tramite')[k].value;
				cont=1;
			}	
		}else{
			if(document.getElementsByName('tramite')[k].checked){
				cantidad=cantidad+"|"+document.getElementsByName('tramite')[k].value;
			}
		}
	}
	return cantidad;
}

function camposObligatorios(){
	for(k=0;k<document.getElementsByName('tramite').length;k++){
		if(document.getElementsByName('tramite')[k].checked){
				return true;	
		}
	}
	alert("No ha asignado tr\u00e1mites a la categor\u00eda");
	return false;
}


