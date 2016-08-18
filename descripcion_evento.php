<?php

    
    //incluimos nuestro archivo config
    include 'config.php'; 

    // Incluimos nuestro archivo de funciones
    include 'funciones.php';

    // Obtenemos el id del evento
    $id  = evaluar($_GET['id']);

    // y lo buscamos en la base de dato
    $bd  = $conexion->query("SELECT * FROM eventos WHERE id=$id");

    // Obtenemos los datos
    $row = $bd->fetch_assoc();

    // titulo 
    $titulo=$row['title'];

    // solicitante 
    $solicitante=$row['solicitante'];

    //SALON
    $salon=$row['class'];

    // cuerpo
    $evento=$row['body'];

    // Fecha inicio
    $inicio=$row['inicio_normal'];

    // Fecha Termino
    $final=$row['final_normal'];

// Eliminar evento
if (isset($_POST['eliminar_evento'])) 
{
    $id  = evaluar($_GET['id']);
    $sql = "DELETE FROM eventos WHERE id = $id";
    if ($conexion->query($sql)) 
    {
        echo "Evento eliminado";
    }
    else
    {
        echo "El evento no se pudo eliminar";
    }
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$titulo?></title>
</head>
<body>
	 <h3><label for="title">QUIEN RESERVA:</label> <?=$titulo?></h3>
	 <hr>
     <b><label for="title">SOLICITANTE: </label><?=$solicitante?></b><br/>
     <b><label for="title">SALÓN RESERVADO: </label><?=$salon?></b><br/>
     <b><label for="title">FECHA INICIO: </label></b> <?=$inicio?><br/>
     <b><label for="title">FECHA TERMINO: </label></b> <?=$final?><br/>
 	<p><label for="title"><STRONG>EVENTO: </STRONG></label><?=$evento?></p>
</body>
<form action="" method="post">
    <button type="submit" class="btn btn-danger" name="eliminar_evento">Eliminar</button>
</form>
</html>
