// JavaScript Document
function ingresar(){
	var msgError = "";
	var cadena="";
	if($("#nombre").val() == null || $("#nombre").val() == ""){
		msgError = msgError + "Proporciona tu nombre de Usuario.\n";
	}
	if($("#pass").val() == null || $("#pass").val() == ""){
		msgError = msgError + "Proporciona tu contrase�a.\n";
	}
	
	if(msgError != ""){
		alert(msgError);
		return false;
	}
	num_caracter=$("#pass").val().length;
	for(i=0; i<num_caracter;i++)
	{ cadena=cadena+"*";}
	password=$("#pass").val();
	$("#pass").val(cadena);
	password=hex_md5(password);
	$("#psswd").val(password);
	$("#frmregistro").submit();
}