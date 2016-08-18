<?php 
	session_start();
	include_once("lib/conexion.php");
	include_once('lib/login.action.php');
	
	$loginAction = new loginAction();
	
	// If the user clicks the "Log Out" link on the index page.
	if(isset($_POST['status']) && $_POST['status'] == 'loggedout') {
		$loginAction->log_User_Out();
	}
	
	// Did the user enter a password/username and click submit?
	if($_POST && !empty($_POST['nombre']) && !empty($_POST['psswd']) && !empty($_POST['user_code'])) {
		$response = $loginAction->validateUser($_POST['nombre'], $_POST['psswd'], $_POST['user_code']);
	}
?>
<!DOCTYPE html>
<!-- saved from url=(0040)http://getbootstrap.com/examples/signin/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/favicon.ico">

    <title>Sartory</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
     <script type="text/javascript" src="js/md5.js"></script>
		<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
		<script type="text/javascript" src="js/funciones.admin.js"></script>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style type="text/css">
  .avatar{
    width: 150px;
    margin: 10px auto 30px;
    border-radius: 100%;
    border: 2px solid #458F06;
    background-size: cover;
	
}
.col-lg-4 {
top: 100px;
float: none;
}
.row {
margin-right: -500px;
margin-left: 350px;
}
#wrapper {
padding-right: 225px;

}
.style1{
			color:#FF0000;
			font-weight:bold;
}

.style2 {
			color: #FFFFFF;
			font-weight: bold;
}
#tbCaptcha{
			border:1px solid #CCCCCC;
}
body {
padding-top: 150px;
padding-bottom: 40px;
background-color: #eee;
}
  </style><style type="text/css"></style></head>

  <body>

     <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          
           <a class="brand" href="#" align="center" data-toggle="collapse" data-target=".nav-collapse">
                  <img src="img/SARTORYlogo3.png" width="320px">
                  
          </a>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        
        <!-- /.navbar-collapse -->
      </nav>
    <div class="container">
    <div class="panel panel-success" style="border: 1px solid #458F06;">
    
      <form class="form-signin" role="form" name="frmregistro" id="frmregistro" method="post" action="">
      
      <?php if(isset($response)) echo "<div align='center'><span class='style1'>Error: " . $response . "</span></div>"; ?>
        <h2 class="form-signin-heading" align="center">Ingresar al Sistema</h2>
        <label><input size="35" name="nombre" type="text" id="nombre" class="form-control" placeholder="Usuario" required autofocus></label> 
        <label><input size="35" type="password" name="pass" id="pass" class="form-control" placeholder="Password" required> <input name="psswd" type="hidden" id="psswd"/>   </label>   
        <img src="lib/captcha/captcha_image.php" />
										  <label><input class="form-control requerido" placeholder="Codigo Captcha" name="user_code" type="text" id="user_code" size="11" maxlength="35" />
										</label>
        
        
        <button type="button" class="btn btn-lg btn-success btn-block" name="guardar" onclick="ingresar();" value="Ingresar">Ingresar</button>
        <input type="hidden" name="hcode" id="hcode" value="<? echo $id_participante; ?>" />
					<input type="hidden" name="hkey" id="hkey" value="<? echo $nombre; ?>" />
					
      </form>
      <br /><br /><br />
					<script type="text/javascript" src="js/ingresar.js"></script>

    </div>
 
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  

</body></html>