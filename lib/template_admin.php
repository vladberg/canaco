<?	

	include_once("librerias/conexion.php");

	require_once 'librerias/login.action.php';

	$membership = new loginAction();

	$membership->confirm_Member();
	

	

	function webCabezal($titulo){ 

		$titulo="Direcci&oacute;n General de Tecnologias de la Informaci&oacute;n :: Gobierno del Estado de Yucatán";

	?>

		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

		<html xmlns="http://www.w3.org/1999/xhtml">

		<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<title><? echo $titulo; ?></title>
<link href="script/estilos.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="script/funciones.admin.js"></script>

		<script type="text/javascript">var GB_ROOT_DIR = "script/greybox/";</script>

		<script type="text/javascript" src="script/greybox/AJS.js"></script>

		<script type="text/javascript" src="script/greybox/AJS_fx.js"></script>

		<script type="text/javascript" src="script/greybox/gb_scripts.js"></script>

		<link href="script/960/960.css" type="text/css" rel="stylesheet" media="all" />
        

		<link href="script/template.css" type="text/css" rel="stylesheet" media="all" />

		<link href="script/greybox/gb_styles.css" rel="stylesheet" type="text/css" />

      <link href="script/rounded_borders.css" rel="stylesheet" type="text/css"> 

		<link rel="stylesheet" type="text/css" href="script/style.css" />
        <link rel="stylesheet" type="text/css" href="script/style2.css" media="print" />
        

		<!--[if !IE]>-->  

		<link rel="stylesheet" type="text/css" href="script/general.css" />

		<style type="text/css">#banner{ background:url(imagen/cabezal.jpg) no-repeat; height:100px; width:960px; margin:0; }</style>
        <style type="text/css">
        #print{
	          display:none;
		}
		</style>


		<!--<![endif]-->

		<!--[if IE]>

		<link rel="stylesheet" type="text/css" href="script/general-ie.css" />

		<link rel="stylesheet" type="text/css" href="script/ie-sucks.css" />

		<style type="text/css">	

        	.fullspan {margin-left:auto;margin-right:auto;width:980px;}            

			#page_content {background-color:#FFFFFF;padding:7px 0px;}

			#banner{background:url(imagen/banner.jpg) no-repeat; height:104px; width:960px; margin:0;left:1px;}

		</style>

		<![endif]-->

<?	} ?>





<?	function webBody($menu_selected){ 	

		$link=conectarse('servidores'); 
		$permiso = $_GET['x'];?>

		</head>

		<body>

		<form action="#" method="post" id="frmgral" name="frmgral">

		<div id="page_content" class="fullspan">

			<div class="container_12 clearfix">

				<!--Banner -->

				<div id="banner" class="grid_12"></div>

				

				<!-- Menu Izquierdo-->

				<div class="grid_3" align="center">

					<div class="menu_izquierdo" style="padding:0;">

						<h4>Principal</h4>

						<ol>

							<li><a href="index.php">Inicio</a></li>

							<li><a href="#" onclick="document.frmlogout.submit();">Desconectarse</a></li>

						</ol>

						<br />

						<h4>Sección Informativa</h4>

						<ol>

                     <li><a href="filtro_direcciones.php">Direcciones</a></li>
                     <li><a href="filtro_departamentos.php">Departamentos</a></li>
                     <li><a href="filtro_servicios.php" >Servicios</a></li>
                     <li><a href="filtro_documentos.php">Documentos</a></li>
                     <li><a href="subir.archivos.php">Subir Archivos</a></li>
                     <li><a href="secciones.estaticas.php">Secciones Estáticas</a></li>
                     </ol>
					 

                     

						

						<br />

						

					</div>

				</div>

				<!-- Contenido de la Pagina -->

				<div class="grid_9">

<?	} ?>



<?	function webFooter(){ 

		$section='';

		if($_POST && !empty($_POST['hisection'])){

			$section=$_POST['hisection'];

		}

?>



				</div>

				<!-- Footer -->

				
                <div class="grid_12 div_position" id="print" >	
                <div id="pie">
		<div id="footer" >
			<div class="col" style="width:62px;">
            	<img src="imagen/logo_gris.jpg" width="52" height="66" alt="Gobierno del Estado de Yucatán">
            </div>
			<div class="col" style="width:380px;"><b>Direcci&oacute;n General de Tecnologias de la Informaci&oacute;n</b>
				Av. Colon # 508-G x Av. Reforma
<br/> Col. Garc&iacute;a Gineres, C.P. 97000, M&eacute;rida, Yucat&aacute;n<br>
				
				Gobierno del Estado de Yucat&aacute;n 2012-2018, México
            </div>	
		</div>
	</div>
    <div id='inferior'></div>
</div>

			</div>

		</div>

		<!--[if !IE]>-->  

		<script type="text/javascript" src="script/shadedborder/shadedborder.js"></script>

		
		<script type="text/javascript">

			/*var border = RUZEE.ShadedBorder.create({ corner:5, shadow:25,  border:1 });

			border.render(document.getElementById('page_content'));*/

		</script>

		<!--<![endif]-->

		<!--[if IE]>

		<style>

			#page_content{border:2px solid #CCCCCC; };

		</style>

		<![endif]-->

		<input type="hidden" id="hisection" name="hisection" value="<? echo $section ?>" />

		<input type="hidden" id="prmsection" name="prmsection" value="" />

      <input type="hidden" id="id_seccion" name="id_seccion" value="" />

		</form>

		<form name="frmlogout" id="frmlogout" action="user.login.php" method="post"><input type="hidden" name="status" id="status" value="loggedout" /></form>

		</body>

		</html>

<?	} 

function extension($archivo){

   $e=substr($archivo,strrpos($archivo,".")+1);

   $e=strtolower($e);

   if ($e=='jpeg') $e='jpg';

   return $e;

}

function formatearHTML($str) {
   $str = str_ireplace("%","&#37;",$str);
   $str = str_ireplace("\\","",$str);
   $str = str_ireplace(chr("147"),"\"",$str); //“
   $str = str_ireplace(chr("148"),"\"",$str); //”
   $str = str_ireplace(chr("39"),"&#39;",$str);   //'
   $str = str_ireplace(chr("96"),"&#39;",$str);   //`
   $str = str_ireplace(chr("180"),"&#39;",$str);  //´
   $str = str_ireplace(chr("145"),"&#39;",$str);  //‘
   $str = str_ireplace(chr("146"),"&#39;",$str);  //’
   $str = str_ireplace(chr("151"),"-",$str);
	$str = str_ireplace("(","&#40;",$str);
   $str = str_ireplace(")","&#41;",$str);
   $str = str_ireplace("[","&#91;",$str);
   $str = str_ireplace("]","&#93;",$str);
   $str = str_ireplace("{","&#123;",$str);
   $str = str_ireplace("}","&#125;",$str);
	//$str = str_ireplace("http://","x68x74x74x70x3Ax2Fx2F",$str);
	$str = str_replace("\n", "", $str);
   $str = str_replace("\r", "", $str);
   $str = str_replace("\t", "", $str);
   $str = str_ireplace("create ","",$str);
   $str = str_ireplace("insert ","",$str);
   $str = str_ireplace("update ","",$str);
   $str = str_ireplace("delete ","",$str);
   $str = str_ireplace("drop ","",$str);
   $str = str_ireplace("select ","",$str);
   $str = str_ireplace("union ","",$str);
   $str = str_ireplace("alter ","",$str);
   $str = str_ireplace("grant ","",$str);
   $str = str_ireplace("trunc ","",$str);
   $str = str_ireplace("between ","",$str);
   $str = str_ireplace(" or ","",$str);
   return $str;

}

?>