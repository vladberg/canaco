<?php 

	session_start();

	include_once("lib/conexion.php");

	include_once('lib/login.action.php');

	

	$loginAction = new loginActions();

	

	// If the user clicks the "Log Out" link on the index page.

	if(isset($_POST['status2']) && $_POST['status2'] == 'loggedout') {

		$loginAction->log_User_Out();

	}



	require_once "recaptchalib.php";

  $secret = "6LenqSETAAAAAFy-q9somk5BaV9ndYvw9KP-NnTM";

 

// respuesta vacía

$response = null;

 

// comprueba la clave secreta

$reCaptcha = new ReCaptcha($secret);

if($_POST){



if ($_POST["g-recaptcha-response"]) {

$response = $reCaptcha->verifyResponse(

        $_SERVER["REMOTE_ADDR"],

        $_POST["g-recaptcha-response"]

    );

}

if ($response != null && $response->success) {



	// Did the user enter a password/username and click submit?

	if($_POST && !empty($_POST['nombre']) && !empty($_POST['psswd'])) {

		$response = $loginAction->validateUser($_POST['nombre'], $_POST['psswd']);

	}

	}else {

  $response= $recaptchaResponse->errorCodes = 'Activar CAPTCHA';

}

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

    <link rel="shortcut icon" href="img/icon.png">



    <title>Canaco</title>



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

background-color: #24396a;;

}
.col-xs-6 {
    width: 35%;
    margin-left: 100px
}
.img-responsive {
    display: block;
    max-width: 400px;
    height: auto;
}
/*.row {

margin-right: -500px;

margin-left: 350px;

}*/
body {

padding-top: 150px;

padding-bottom: 40px;

}
  </style><style type="text/css"></style></head>



  <body>



     

    <div class="container">
      <div class="row" style="background:#ffffff;margin-top: 60px;">
  <div class="col-xs-6" >
  <img class="img-responsive" src="img/logo.png" style="width:345px;margin-top:14px">

  </div>
  <div class="col-xs-6" >
    <form class="form-signin" role="form" name="frmregistro" id="frmregistro" method="post" action="">

      

      <?php if(isset($response)) echo "<div align='center'><span class='style1'>Error: " . $response . "</span></div>"; ?>

        <h2 class="form-signin-heading" align="center">Ingresar al Sistema</h2>

        <label><input size="35" name="nombre" type="text" id="nombre" class="form-control" placeholder="Usuario" required autofocus></label> 

        <label><input size="35" type="password" name="pass" id="pass" class="form-control" placeholder="Password" required> <input name="psswd" type="hidden" id="psswd"/>   </label> <br/>

        <div class="g-recaptcha" data-sitekey="6LenqSETAAAAAN7whY5e3MXzTO5wilHl4aSBAMKr"></div><br/>

          

        

        

        <button type="button" class="btn btn-lg btn-success btn-block" name="guardar" onclick="ingresar();" value="Ingresar">Ingresar</button>

        <input type="hidden" name="hcode" id="hcode" value="<? echo $id_participante; ?>" />

          <input type="hidden" name="hkey" id="hkey" value="<? echo $nombre; ?>" />

          

      </form>

      <br /><a href="calendario.php"><button class="btn btn-info" >Ver Calendario</button></a><br /><br />


      <script src='https://www.google.com/recaptcha/api.js'></script>

          <script type="text/javascript" src="js/ingresar.js"></script>
  </div>
</div>
    </div> <!-- /container -->

</body></html>