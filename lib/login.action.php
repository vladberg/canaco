<?

error_reporting(0);

class loginActions{

	function validateUser($user, $pwd, $user_code){

		//include_once("lib/captcha/php-captcha.inc.php");

		include_once("lib/sql.injection.php"); 

		$error1='';

		$query1='';

		

		if ($user != '') {

			$link=conectarse_servicios('dgti');

			$user=Formatear($user);

			$pwd=Formatear($pwd);

			$busca = "select estatus,nombre,usuario,id,permiso from usuarios where usuario = '$user' and password = '$pwd'";

	

			$resultado=mysql_query($busca, $link);

			

			if(mysql_num_rows($resultado)>0)

			{

				$row = mysql_fetch_row($resultado);

				

			

				if($row[0] == 0)

					return "No tienes permiso para acceder al sistema.";

				$id_usuario = $row[3];
				
				$res="OK";

				if($user!=''){
    				session_start();
					    $_SESSION['status'] = 'authorized';
						$_SESSION['servicios_user']=$user;
						$_SESSION['permiso'] = $row[4];
					}


	

				if($res=="OK")

				{  

					$_SESSION['status2'] = 'authorized';

					$_SESSION['admin_user'] = $user;
					$_SESSION['permiso'] = $row[4];


		

					header("location: index.php");

				} else return "Ocurrio un error al ingresar al sistema";

			

			} else return "Usuario y Contrase�a Incorrectos";

						

						

		} else {

			return 'El codigo capturado no es correcto.';

		}

	}



	function log_User_Out() {

		if(isset($_SESSION['status2'])) {

			unset($_SESSION['status2']);

			

			if(isset($_COOKIE[session_name()])) 

				setcookie(session_name(), '', time() - 1000);

				session_id();

				session_destroy();

		}

		header("location: index.php");

	}

	

	function confirm_Member2() {

		session_id();

		session_start();

		if($_SESSION['status2'] !='authorized') header("location: user.login.php");

	}



}



?>