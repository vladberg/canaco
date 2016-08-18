<?php
session_start();
	include_once("lib/conexion.php");

	require_once('lib/login.action.php');

	$membership = new loginActions();
  
	$membership->confirm_Member2();

  $user = $_SESSION['admin_user'];


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

function cabezal() { ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CANACO - Administración</title>

    <!-- Bootstrap core CSS -->
   
    

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <style>
	.side-nav {
top: 50px;
}
#page-wrapper {
padding: 90px 25px;
}
	</style>
    
		<script type="text/javascript" src="js/funciones.admin.js"></script>

		<script type="text/javascript">var GB_ROOT_DIR = "lib/greybox/";</script>

		<script type="text/javascript" src="lib/greybox/AJS.js"></script>

		<script type="text/javascript" src="lib/greybox/AJS_fx.js"></script>

		<script type="text/javascript" src="lib/greybox/gb_scripts.js"></script>

		<link href="lib/960/960.css" type="text/css" rel="stylesheet" media="all" />
        

		

		<link href="lib/greybox/gb_styles.css" rel="stylesheet" type="text/css" />

      <link href="css/rounded_borders.css" rel="stylesheet" type="text/css"> 
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css1/calendar.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <script type="text/javascript" src="js1/es-ES.js"></script>
        <script src="js1/jquery.min.js"></script>
        <script src="js1/moment.js"></script>
        <script src="js1/bootstrap.min.js"></script>
        <script src="js1/bootstrap-datetimepicker.js"></script>
        <link rel="stylesheet" href="css1/bootstrap-datetimepicker.min.css" />
       <script src="js1/bootstrap-datetimepicker.es.js"></script>
       <script src="js1/underscore-min.js"></script>
    <script src="js1/calendar.js"></script>
		
        

		<!--[if !IE]>-->  

	<link rel="shortcut icon" href="img/icon.png">	
  </head>
<?php } ?>
<?php
function body(){ ?>
  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav" style="    margin-left: -227px;

">
            <li><a class="brand" href="../index.php" align="center" target="_blank" data-toggle="collapse" data-target=".nav-collapse">
                  <img src="img/logo_merimoto.png" >
                  
            </a></li>
            <li><a href="index.php"><i class="fa fa-calendar"></i> Calendario</a></li>
            <?php 
            if($_SESSION['permiso'] == 1){?>
            
           
            <li><a href="filtro_salones.php"><i class="fa fa-outdent"></i> Salones</a></li>
            <li><a href="reportes.php"><i class="fa fa-file-text-o"></i> Reportes</a></li>
            <li><a href="usuarios.php"><i class="fa fa-user"></i> Usuarios</a></li>
            
            <?php } 
            if($_SESSION['permiso'] == 2){?>
            <li><a href="filtro_salones.php"><i class="fa fa-outdent"></i> Salones</a></li>
            <li><a href="reportes.php"><i class="fa fa-file-text-o"></i> Reportes</a></li>
           
            <?php } ?>
            <li><a href="#" onclick="document.frmlogout.submit();"><i class="fa fa-power-off"></i> Log Out</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
           
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['admin_user'];?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                
                <li><a href="#" onclick="document.frmlogout.submit();"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <!-- /.row -->
<?php } ?>
        <!-- /.row 

        --> 
      
<?php
function footer(){ ?>
<!--Contenido -->
<form name="frmlogout" id="frmlogout" action="user.login.php" method="post"><input type="hidden" name="status2" id="status2" value="loggedout" /></form>

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
   
    <!-- Page Specific Plugins -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>

  </body> 
</html>
<?php } ?>