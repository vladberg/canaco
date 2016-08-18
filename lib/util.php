<?
//error_reporting(0);
$saladeprensa = array("servidor"=>"localhost", "baseDatos"=>"saladeprensa", "loginServidor"=>"saladeprensa", "passServidor"=>"prensa357");
$yucatanweb =   array("servidor"=>"localhost", "baseDatos"=>"yucatanweb", "loginServidor"=>"yucatan", "passServidor"=>"anonimo");
$strMeses = Array('null','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$strDias = Array('Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado');
class Conexion {
   var $servidor, $loginServidor, $passServidor, $baseDatos;
   function Conexion($ds){
      $this->servidor      = $ds["servidor"];
      $this->baseDatos     = $ds["baseDatos"];
      $this->loginServidor = $ds["loginServidor"];
      $this->passServidor  = $ds["passServidor"];
   }
   function ejecutarQuerySQL($sentencia){
      $conexion	= mysql_connect($this->servidor,$this->loginServidor,$this->passServidor) or die("Error en la conexión");
      $baseDatos	= mysql_select_db($this->baseDatos,$conexion) or die("No se encuentra la base de datos");
      $resultado	= mysql_query($sentencia) or die($sentencia); 
      $arregloRespuesta = null;
      while ($arreglo = mysql_fetch_array($resultado)){
         $arregloRespuesta[] = $arreglo;
      }
      return $arregloRespuesta;
      mysql_close($conexion);
   }
   function ejecutarComandoSQL($sentencia){
      $conexion	= mysql_connect($this->servidor,$this->loginServidor,$this->passServidor) or die("Error en la conexión 2");
      $baseDatos	= mysql_select_db($this->baseDatos,$conexion) or die("No se encuentra la base de Datos");
      $resultado	= mysql_query($sentencia) or die($sentencia); 
      mysql_close ($conexion);   
      return $resultado;
   }
}
function dame_nombre_mes($mes)
{  switch ($mes)
   {  case 1: $nombre_mes="Enero"; break;
      case 2: $nombre_mes="Febrero"; break;
      case 3: $nombre_mes="Marzo"; break;
      case 4: $nombre_mes="Abril"; break;
      case 5: $nombre_mes="Mayo";  break;
      case 6: $nombre_mes="Junio"; break;
      case 7: $nombre_mes="Julio"; break;
      case 8: $nombre_mes="Agosto"; break;
      case 9: $nombre_mes="Septiembre"; break;
      case 10:$nombre_mes="Octubre"; break;
      case 11:$nombre_mes="Noviembre"; break;
      case 12:$nombre_mes="Diciembre"; break;
    }
    return $nombre_mes;
}


function strFecha() {
   //Lunes 17 de Mayo de 2010
   global $strMeses;
   global $strDias;
   $iDia = date('w');
   $iMes = date('n');
   return $strDias[$iDia].' '.date('d').' de '.$strMeses[$iMes].' de '.date('Y');
}
function formatFecha($fecha) {
   global $strMeses;
   global $strDias;
   $partes = explode('-', $fecha);
   $fecha = @mktime(0,0,0,$partes[1],$partes[2], $partes[0]);
   $iDia = date('w',$fecha);
   $iMes = date('n',$fecha);
   return $strDias[$iDia].' '.date('d',$fecha).' de '.$strMeses[$iMes].' de '.date('Y', $fecha);
}
function emailValido($email, $multiple=false) {
   $emailExp = "/^[a-zA-Z0-9\-\.\_\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/";
   $arr_emails;
   if (!$multiple) $arr_emails = array($email);
   else $arr_emails = explode(",", $email);
   $c = count($arr_emails);
   for ($i=0; $i<$c; $i++) {
      $email = trim($arr_emails[$i]);
      if (!preg_match($emailExp, $email)) return false;
   }
   return true;
}
function EsEntero($texto) {
   $ok = true;
   for($i=0; $i<strlen($texto); $i++) {
      $c = ord($texto[$i]);
      if ($c<48 || $c>57) $ok = false;
   }
   return $ok;
}

function limpiar_buscador($texto) {
   //Solamente son válidos los caracteres: ' '(32 ó 160), 0-9(48-57), A-Z(65-90), a-z(97-122),
   //Á(193), É(201), Í(205), Ó(211), Ú(218), á(225), é(233), í(237), ó(243), ú(250), ñ(241), Ñ(209), ü(252), Ü(220)
   //Todos los demás caracteres los elimina
   $texto_valido = "";
   $texto = str_replace("%20"," ",$texto);
   for($i=0; $i<strlen($texto); $i++) {
      $c = ord($texto[$i]);
      if (($c>=48 && $c<=57) || ($c>=65 && $c<=90) || ($c>=97 && $c<=122) ||
      $c==32 || $c==160 || $c==193 || $c==201 || $c==205 || $c==209 || $c==211 || $c==218 ||
      $c==220 || $c==225 || $c==233 || $c==237 || $c==241 || $c==243 || $c==250 || $c==252) $texto_valido = $texto_valido . $texto[$i];
   }
   $texto_valido = trim($texto_valido);
   while (strpos($texto_valido, "  ")!==false) $texto_valido = str_replace("  "," ",$texto_valido);
   return $texto_valido;
}
function convertir_validos($texto) {
   //Caracteres válidos: .(46), 0-9(48-57), A-Z(65-90), _(95), a-z(97-122)
   $texto = str_replace("á","a",$texto);
   $texto = str_replace("é","e",$texto);
   $texto = str_replace("í","i",$texto);
   $texto = str_replace("ó","o",$texto);
   $texto = str_replace("ú","u",$texto);
   $texto = str_replace("Á","A",$texto);
   $texto = str_replace("É","E",$texto);
   $texto = str_replace("Í","I",$texto);
   $texto = str_replace("Ó","O",$texto);
   $texto = str_replace("Ú","U",$texto);
   $texto = str_replace("ñ","n",$texto);
   $texto = str_replace("Ñ","N",$texto);
   $texto = str_replace(" ","_",$texto);
   $texto_valido = "";
   for($i=0; $i<strlen($texto); $i++) {
      $c = ord($texto[$i]);
      if ($c==46 || ($c>=48 && $c<=57) || ($c>=65 && $c<=90) || $c==95 || ($c>=97 && $c<=122)) $texto_valido = $texto_valido . $texto[$i];
   }
   return $texto_valido;
}
function extension($archivo){
   $e=substr($archivo,strrpos($archivo,".")+1);
   $e=strtolower($e);
   if ($e=='jpeg') $e='jpg';
   return $e;
}

function generaPass(){
    //Se define una cadena de caractares. Te recomiendo que uses esta.
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    //Obtenemos la longitud de la cadena de caracteres
    $longitudCadena=strlen($cadena);
     
    //Se define la variable que va a contener la contraseña
    $pass = "";
    //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
    $longitudPass=10;
     
    //Creamos la contraseña
    for($i=1 ; $i<=$longitudPass ; $i++){
        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
        $pos=rand(0,$longitudCadena-1);
     
        //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
        $pass .= substr($cadena,$pos,1);
    }
    return $pass;
}
  function Formatear($cadena) {
   
   $cadena = str_replace("á", "&aacute;", $cadena);
   $cadena = str_replace("é", "&eacute;", $cadena);
   $cadena = str_replace("í", "&iacute;", $cadena);
   $cadena = str_replace("ó", "&oacute;", $cadena);
   $cadena = str_replace("ú", "&uacute;", $cadena);
   $cadena = str_replace("Á", "&Aacute;", $cadena);
   $cadena = str_replace("É", "&Eacute;", $cadena);
   $cadena = str_replace("Í", "&Iacute;", $cadena);
   $cadena = str_replace("Ó", "&Oacute;", $cadena);
   $cadena = str_replace("Ú", "&Uacute;", $cadena);
   $cadena = str_replace("Ñ", "&Ntilde;", $cadena);
   $cadena = str_replace("ñ", "&ntilde;", $cadena);
   $cadena = str_replace("Ú", " &Uuml;", $cadena);
   $cadena = str_replace("ú", "&uuml;", $cadena);
   return $cadena;
}
?>
