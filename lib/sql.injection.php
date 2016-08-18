<? function Formatear($miTexto) {
   $strTexto = $miTexto;
   $strTexto = str_ireplace("\"","&quot;",$strTexto);
   $strTexto = str_ireplace(chr("147"),"&quot;",$strTexto);
   $strTexto = str_ireplace(chr("148"),"&quot;",$strTexto);
   $strTexto = str_ireplace(chr("39"),"&#39;",$strTexto);
   $strTexto = str_ireplace(chr("96"),"&#39;",$strTexto);
   $strTexto = str_ireplace(chr("180"),"&#39;",$strTexto);
   $strTexto = str_ireplace(chr("145"),"&#39;",$strTexto);
   $strTexto = str_ireplace(chr("146"),"&#39;",$strTexto);
   $strTexto = str_ireplace(chr("151"),"-",$strTexto);
   $strTexto = str_ireplace("<","&lt;",$strTexto);
   $strTexto = str_ireplace("/>",">",$strTexto);
   $strTexto = str_ireplace(">","&gt;",$strTexto);
   $strTexto = str_ireplace("(","&#40;",$strTexto);
   $strTexto = str_ireplace(")","&#41;",$strTexto);
   $strTexto = str_ireplace("%","&#37;",$strTexto);
   $strTexto = str_ireplace("create ","",$strTexto);
   $strTexto = str_ireplace("insert ","",$strTexto);
   $strTexto = str_ireplace("update ","",$strTexto);
   $strTexto = str_ireplace("delete ","",$strTexto);
   $strTexto = str_ireplace("drop ","",$strTexto);
   $strTexto = str_ireplace("select ","",$strTexto);
   $strTexto = str_ireplace("union ","",$strTexto);
   $strTexto = str_ireplace("alter ","",$strTexto);
   $strTexto = str_ireplace("grant ","",$strTexto);
   $strTexto = str_ireplace("trunc ","",$strTexto);
   $strTexto = str_ireplace("between ","",$strTexto);
   $strTexto = str_ireplace("' or 1=1 or ''='","",$strTexto);
   $strTexto = str_ireplace("' or 1=1--","",$strTexto);
   $strTexto = str_ireplace("' or 1=1#","",$strTexto);
   $strTexto = str_ireplace("' or 1=1/*","",$strTexto);
   $strTexto = str_ireplace("') or '1'='1--","",$strTexto);
   $strTexto = str_ireplace("') or ('1'='1--","",$strTexto);
   $strTexto = str_ireplace("\" or 1=1--","",$strTexto);
   $strTexto = str_ireplace("or 1=1--","",$strTexto);
   return $strTexto;
}
?>