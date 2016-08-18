<?
/*
	Funciones para desinfectar.
	
	Para agregar más validaciones: 
		http://php.net/manual/es/filter.filters.validate.php
	Para agregar más filtros: 
		http://php.net/manual/es/filter.filters.flags.php 
		http://php.net/manual/es/filter.filters.sanitize.php
		
	Para cierta referencia extra:
		http://www.estrellateyarde.org/discover/manual-php-sanear-datos-de-usuario
		http://net.tutsplus.com/tutorials/php/sanitize-and-validate-data-with-php-filters/
		http://support.microsoft.com/kb/252985/es-mx
		http://www.bioinformatics.org/phplabware/internal_utilities/htmLawed/example_settings.htm
		http://net.tutsplus.com/tutorials/tools-and-tips/can-you-hack-your-own-site-a-look-at-some-essential-security-considerations/
*/


//Includes
include_once("htmLawed/htmLawed.php");
//--------

/*
  Sanitize function
  Devuelve la variable saneada
  $input: variable a sanear
  $type:  lo que queremos comprobar
*/
function Sanitize($input, $type) {
	$output = '';
	
	switch ($type) {
		
		/*
			Usando la librería htmLawed
			Prefijo: hl (HL)
		*/
		
		case 'hlSafest': //El más seguro. Permitiendo solo las etiquetas HTML 'seguras'
			$config = array('safe' => 1);
			$input  = html_entity_decode($input,ENT_QUOTES);
			$input  = fStriplashes($input);
			$output = htmLawed($input,$config);
		break;
		
		case 'hlSimplest': //El más simple. Permitiendo todas las etiquetas HTML válidas excepto esquemas como 'javascript'
			$input  = html_entity_decode($input,ENT_QUOTES);
			$input  = fStriplashes($input);
			$output = htmLawed($input);
		break;
		
		case 'hlSafeMix': //Permite solo HTML 'seguro' y los elementos 'a','em' y 'strong'
			$config = array('safe'=>1, 'elements'=>'a, em, strong');
			$input  = html_entity_decode($input,ENT_QUOTES);
			$input  = fStriplashes($input);
			$output = htmLawed($input, $config);
		break;
		
		//-----------------------------
		
		case 'str':
			$output = Filter($input,$type);
		break;
		
		case 'email':
			$output = Filter($input,$type);
		break;
		
		case 'sql': // escapar los caracteres que no son legales en SQL
			$output = mysql_escape($input);
		break;
		
		case 'sqls': // sanitiza como cadena y escapa los caracteres que no son legales en SQL
			$input  = Filter($input,'str');
			$output = mysql_escape($input);
		break;
		
		case 'no_html': // los datos van a una pagina web, escapar para HTML
			$output = htmlentities(trim($input), ENT_QUOTES);
		break;
		
		case 'shell_arg': // los datos van al shell, escapar para shell argument
			$output = escapeshellarg(trim($input));
		break;
		
		case 'shell_cmd': // los datos van al shell, escapar para shell command
			$output = escapeshellcmd(trim($input));
		break;
		
		case 'url': // los datos forman parte de una URL, escapar para URL
			// htmlentities() traduce a HTML el separador &
			$output = htmlentities(urlencode(trim($input)));
		break;
		
		case 'url2':
			$output = Filter($input,'url');
		break;
		
		case 'comment': // los datos solo pueden contener algunos tags HTML
			$output = strip_tags($input, '<b><i><img>');
		break;
	}
	
	return $output;
}

//Striplashes
function fStriplashes($cadena){
	if(get_magic_quotes_gpc() != 0) {
        $cadena = stripslashes($cadena);
    }
	return $cadena;
}

//Hacer segura una cadena
function mysql_escape($cadena) {
	// si magic_quotes_gpc esta activado primero aplicar stripslashes()
	// de lo contrario los datos seran escapados dos veces
    $cadena = fStriplashes($cadena);
	// requiere una conexion MySQL, de lo contrario dara error
    return mysql_real_escape_string($cadena);
}

//Devuelve variable sanitizada con el filtro del tipo
function Filter($input,$type){
	$output = '';
	
	switch($type){
		case 'str': //Elimina etiquetas, opcionalmente elimina o codifica caracteres especiales.
			$output = filter_var($input, FILTER_SANITIZE_STRING);
		break;
		
		case 'email': //Elimina todos los caracteres menos letras, dígitos y !#$%&'*+-/=?^_`{|}~@.[].
			$output = filter_var($input, FILTER_SANITIZE_EMAIL);
		break;
		
		case 'url': //Elimina todos los caracteres excepto letras, dígitos y $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
			$output = filter_var($input, FILTER_SANITIZE_URL);
		break;
	}
	return $output;
}

//Devuelve TRUE/FALSE si la variable valida/no valida
function Validate($input,$type){
	$output = '';
	
	switch ($type) {
		case 'int': // comprueba si $input es integer
			if (is_int($input)) {
				$output = TRUE;
			} else {
				$output = FALSE;
			}
		break;
		
		case 'str': // comprueba si $input es string
			if (is_string($input)) {
				$output = TRUE;
			} else {
				$output = FALSE;
			}
		break;
		
		case 'digit': // comprueba si $input contiene solo numeros
			if (ctype_digit($input)) {
				$output = TRUE;
			} else {
				$output = FALSE;
			}
		break;
		
		case 'upper': // comprueba si $input contiene solo mayusculas
			if ($input == strtoupper($input)) {
				$output = TRUE;
			} else {
				$output = FALSE;
			}
		break;
		
		case 'lower': // comprueba si $input contiene solo minusculas
			if ($input == strtolower($input)) {
				$output = TRUE;
			} else {
				$output = FALSE;
			}
		break;
		
		case 'mobile': // comprueba si $input contiene 9 numeros
			if ((strlen($input) == 9) && (ctype_digit($input) == TRUE)) {
				$output = TRUE;
			} else {
				$output = FALSE;
			}
		break;
		
		case 'email': // comprueba si $input tiene formato de email
			$reg_exp = "/^[-\.0-9A-Z]+@([-0-9A-Z]+\.)+([0-9A-Z]){2,4}$/i";
			if (preg_match($reg_exp, $input)) {
				$output = TRUE;
			} else {
				$output = FALSE;
			}
		break;
		
		case 'email2': // comprueba si $input tiene formato de email
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				$output = TRUE;
			}
			else{
				$output = FALSE;
			}
		break;
		
		case 'url': // Valida si su valor es una URL (de acuerdo con » http://www.faqs.org/rfcs/rfc2396), opcionalmente con ciertos componentes. Nótese que esta función sólo buscará para ser validadas URLs ASCII. Los nombres de dominio internacionales (que contienen no-ASCII caracteres) fallarán en la validación.
			if(filter_var($email, FILTER_VALIDATE_URL)){
				$output = TRUE;
			}
			else{
				$output = FALSE;
			}
		break;
	}
	return $output;
}



function FormatSQL($miTexto) {
   $strTexto = strtolower($miTexto);
   //$strTexto = str_replace(";"," ",$strTexto);
   $strTexto = str_replace("\"","&quot;",$strTexto);
   $strTexto = str_replace("\u0093","&quot;",$strTexto);
   $strTexto = str_replace("\u0094","&quot;",$strTexto);
   $strTexto = str_replace("\u0027","&#39;",$strTexto);
   $strTexto = str_replace("\u0060","&#39;",$strTexto);
   $strTexto = str_replace("\u00b4","&#39;",$strTexto);
   $strTexto = str_replace("\u0091","&#39;",$strTexto);
   $strTexto = str_replace("\u0092","&#39;",$strTexto);
   $strTexto = str_replace("—","-",$strTexto);
   $strTexto = str_replace("create","",$strTexto);
   $strTexto = str_replace("insert","",$strTexto);
   $strTexto = str_replace("update","",$strTexto);
   $strTexto = str_replace("delete","",$strTexto);
   $strTexto = str_replace("drop","",$strTexto);
   $strTexto = str_replace("select","",$strTexto);
   $strTexto = str_replace("union","",$strTexto);
   $strTexto = str_replace("alter","",$strTexto);
   $strTexto = str_replace("grant","",$strTexto);
   $strTexto = str_replace("trunc","",$strTexto);
   $strTexto = str_replace("between","",$strTexto);
   $strTexto = str_replace("' or 1=1 or ''='","",$strTexto);
   $strTexto = str_replace("' or 1=1--","",$strTexto);
   $strTexto = str_replace("' or 1=1#","",$strTexto);
   $strTexto = str_replace("' or 1=1/*","",$strTexto);
   $strTexto = str_replace("') or '1'='1--","",$strTexto);
   $strTexto = str_replace("') or ('1'='1--","",$strTexto);
   $strTexto = str_replace("\" or 1=1--","",$strTexto);
   $strTexto = str_replace("or 1=1--","",$strTexto);
   return $strTexto;
}



function formatSTR($cadena) {
   $cadena = str_replace(";", ",", $cadena);
   $cadena = str_replace("\"", "&quot;", $cadena);
   $cadena = str_replace("“", "&quot;", $cadena);
   $cadena = str_replace("”", "&quot;", $cadena);
   $cadena = str_replace("'", "&#39;", $cadena);
   $cadena = str_replace("`", "&#39;", $cadena);
   $cadena = str_replace("´", "&#39;", $cadena);
   $cadena = str_replace("‘", "&#39;", $cadena);
   $cadena = str_replace("’", "&#39;", $cadena);
   return $cadena;
}
?>