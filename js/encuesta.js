// JavaScript Document
function agregar()
{
	num=$("#total_reg").val();
	num2=parseInt(num)+1;
	document.getElementById("total_reg").value=num2;
	
	var tabla='<div id="tabla'+num2+'" style="padding-top:3px;">'
			+'<dl>'
		 	+'<dt><input id="idrespuesta'+num2+'" name="idrespuesta'+num2+'" type="hidden" value="0">'
    	    +'<label for="respuesta'+num2+'">Respuesta '+num2+':</label></dt>'
            +'<dd>'
			+'<img src="script/niceforms/img/0.png" class="NFTextLeft"><div class="NFTextCenter"><input type="text" class="NFText" value="" style="width: 300px;" id="respuesta'+num2+'" name="respuesta'+num2+'"></div><img src="script/niceforms/img/0.png" class="NFTextRight">'	
            +'&nbsp;<a href="#" onclick=\'eliminar("tabla'+num2+'",0); return false;\'><img src=\'imagen/delete.gif\' style="border:none" alt="Eliminar" title="Eliminar"></a></dd></dl>'
	+'</div>'
	$('#nuevo').append(tabla);
}
function eliminar(id, idresp)
{
	aceptar=confirm("Esta seguro de querer eliminar esta respuesta?");
	if(aceptar){
		if(idresp!=0){
			$.ajax({
				type: "POST",
				url: "eliminar.php",
				data: "id="+idresp+"&opcion=RES",
				success: function(responseText){
					arrayResp=responseText.split("|");
					if(arrayResp[1]=="OK")
					{
						alert("La respuesta ha sido eliminada");
						$('#'+id).empty();
						$('#'+id).css("display","none");
					}else{
						alert("Ocurrio un error al eliminar esta respuesta\nPor favor intenta de nuevo");
					}
				}
			});
		}else{
			$('#'+id).empty();
			$('#'+id).css("display","none");
		}
	}
}
