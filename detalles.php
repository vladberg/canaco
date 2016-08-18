<?php 
error_reporting();
include_once("lib/template.php");
	

	$membership = new loginActions();

	$membership->confirm_Member2();

	

//	include_once("librerias/rutas.php");
$user=$_SESSION['admin_user'];

// Definimos nuestra zona horaria
date_default_timezone_set("America/Santiago");

// incluimos el archivo de funciones
include 'funciones.php';

// incluimos el archivo de configuracion
include 'config.php';

// Verificamos si se ha enviado el campo con name from
if (isset($_POST['from'])) 
{

    // Si se ha enviado verificamos que no vengan vacios
    if ($_POST['from']!="" AND $_POST['to']!="") 
    {

        // Recibimos el fecha de inicio y la fecha final desde el form

        $inicio = _formatear($_POST['from']);
        // y la formateamos con la funcion _formatear

        $final  = _formatear($_POST['to']);

        // Recibimos el fecha de inicio y la fecha final desde el form

        $inicio_normal = $_POST['from'];

        // y la formateamos con la funcion _formatear
        $final_normal  = $_POST['to'];

        // Recibimos los demas datos desde el form
        $titulo = evaluar($_POST['title']);

         // Recibimos los demas datos desde el form
        $titulo2 = evaluar($_POST['title2']);

        // y con la funcion evaluar
        $body   = evaluar($_POST['event']);

        // reemplazamos los caracteres no permitidos
        $clase  = evaluar($_POST['class']);

        //telfono

        $telefono= evaluar($_POST['telefono']);

        //email
        $email= evaluar($_POST['email']);

        $saldo= evaluar($_POST['saldo']);

        $anticipo= evaluar($_POST['anticipo']);

        $costo= evaluar($_POST['costo']);

        $montaje= evaluar($_POST['montaje']);
        $otro = evaluar($_POST['otro']);
        if($montaje == 'Otro'){
        	$montaje = $otro;
        }

        $montaje2= evaluar($_POST['montaje2']);

        $montaje2=implode(',',$_POST['montaje2']);

        $venta= evaluar($_POST['venta']);

        $vigilante = evaluar($_POST['vigilante']);



        // insertamos el evento
        $query="INSERT INTO eventos VALUES(null,'$titulo','$body','','$clase','$inicio','$final','$inicio_normal','$final_normal','$titulo2','$telefono','$email','$montaje','$montaje2','$costo','$anticipo','$saldo','$venta','$vigilante')";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query); 

        // Obtenemos el ultimo id insetado
        $im=$conexion->query("SELECT MAX(id) AS id FROM eventos");
        $row = $im->fetch_row();  
        $id = trim($row[0]);

        // para generar el link del evento
        $link = "descripcion_evento.php?id=$id";

        // y actualizamos su link
        $query="UPDATE eventos SET url = '$link' WHERE id = $id";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query); 

        // redireccionamos a nuestro calendario
        //header("Location:detalles.php?id=$clase"); 
    }
}
	cabezal(); ?>

<style>

.fila_par{

	background-color:#FFFFFF;

}

.fila_impar{

	background-color:#E5E5E5;

}

.new_row{

	background:#FFFFCC;

}

.tabla_encabezado {

	background-color:#D1D1D1;

	color:#000000;

	font-family:'Arial';

	font-size:11px;

	font-weight:bold;

}



#modTitle{

	font-family:Verdana, Arial, Helvetica, sans-serif; 

	font-weight:bold;

}





#msgContainer{

	padding-top:10px;

	padding-bottom:10px;

	text-align:center;

	font-family:Verdana, Arial, Helvetica, sans-serif;

	font-size:12px;

	width:100%;

}



#msgContainer a{

	text-decoration:none;

	color:#0066FF;

}




div.saved{

	background:#99FF99;

	border-top:1px solid #339900;

	border-bottom:1px solid #339900;

}



div.error{

	background:#FFCCCC;

	border-top:1px solid #FF3366;

	border-bottom:1px solid #FF3366;

}
.form-control{
	width:auto;
}




</style>

<link rel="stylesheet" type="text/css" href="css/rounded_borders.css">



<script language="javascript" src="js/get2post.js" type="text/javascript"></script>

<script language="javascript">
function fEliminarSeccion(idseccion){
	if (confirm("¿Está seguro de querer eliminar esta seccion?"))
		$(".InfoBarContent").load("eliminar_doc.php",{t:'del',ids:idseccion, prmsection:2 ,rnd:Math.random()});
}


function pregunta(){ 
    if (confirm('¿Está seguro de querer eliminar este proveedor?')){ 
       document.v.submit() 
    } 
} 
function confirmar ( mensaje ) { 
return confirm( mensaje ); 
} 
</script>
<?	

   body();?>
   <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-10">
          <?php
          $link=conectarse();
          $id=$_GET['id'];
							$query="SELECT * FROM salones where nombre='$id';";
							$resultado=mysql_query($query, $link);

							//echo $resultado;

							$i=0;
							$class='success';
						
							if(mysql_num_rows($resultado)>0){
								$numero=mysql_num_rows($resultado);

								while($row = mysql_fetch_array($resultado)){
									$i=$row['idsalon'];

										$arreglo = array('','#046ec8', '#24396a', '#366', '#24672b','#24396a','#2a627a');
										$color=$arreglo[$i];
										$nombre_salon=strtoupper($row['nombre']);
									}
								}
										?>
								
           <h2 style="color:#FE0000;padding-left: 150px">DETALLES <?php echo $nombre_salon;?></h2>
          </div>
        </div>



		<div class="row">
          <div class="col-lg-10">
            <div class="row">
  	          <div class="col-md-6"><h1>Historial de Reservaciones</h1></div>
              <div class="col-md-6" align="right"><button class="btn btn-info" data-toggle='modal' data-target='#add_evento'>Añadir Evento</button></div>
            </div>
           
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                  	<th>NUMERO</th>
                    <th>QUIEN RESERVA</th>
                    <th>QUIEN SOLICITA</th>
                    <th>EVENTO</th>
                    <th>FECHA INICIO</th>
                    <th>FECHA FIN</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?
							$link=conectarse_servicios();
							$id=$_GET['id'];
							echo $query="SELECT * FROM eventos where class='$id' order by inicio_normal asc;";
														

							$resultado=mysql_query($query, $link);
							//echo $resultado;

							$icont=0;
							$class='success';
							
									

							if(mysql_num_rows($resultado)>0){

								while($row = mysql_fetch_array($resultado)){ 

									$icont++;
									if($class=='success'){
								$class='active';
								}else{
									$class='success';
								}

									$laclase=($icont%2==0?"fila_par":"fila_impar");

									$imagen='no_publicado.gif';
									

									if($row['publicar']=='S'){

										$imagen='publicado.gif';

									}
									if($imagen=='no_publicado.gif'){
										$class='success';
									}

								?>
                  <tr class="<?php echo $class; ?>" id="row<? echo $icont; ?>">
                    <td><a data-toggle='modal' href="mod_evento?opc=UPD&id=<?php echo $row['id'];?>"><?php echo $icont;?></a></td>
                    <td><?php echo $row['title'];?></td>
                    <td><?php echo $row['solicitante'];?></td>
                    <td><?php echo $row['body'];?></td>
                    <td><?php echo $row['inicio_normal'];?></td>
                    <td><?php echo $row['final_normal'];?></td>
                    <td><a href="eliminar_evento.php?id=<?php echo $row['id']."&class=".$row['class']; ?>" onclick="return confirmar('¿Está seguro que desea eliminar el registro?')"><img src="img/delete.gif" border="0"  title="Eliminar Seccion"  style="cursor:pointer;"  /></a></td>
                    
                  </tr>
                  <? }

							}

							?>
                            
                </tbody>
              </table>
              <? if(mysql_num_rows($resultado) <= 0){?>
         <h1 style="text-align:center;" class="danger">No hay Reservaciones capturados por el momento</h1>
         <?php }?>
            </div>
          </div>
         </div>
        </div>
<div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel" style="text-align: right;">Agregar nuevo evento</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post">

         <label for="title">QUIEN RESERVA:</label>
                    <input value="<?php echo $_GET['ids'];?>" type="text" required autocomplete="off" name="title" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;">

                    <br>
                    <label for="title">SOLICITANTE:</label>
                    <input type="text" required autocomplete="off" name="title2" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;">

                    <br>
                     <label for="title">TELEFONO:</label>
                    <input type="text" required autocomplete="off" name="telefono" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;">

                    <br>
                     <label for="title">EMAIL:</label>
                    <input type="text" required autocomplete="off" name="email" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;">

                    <br>
                    <label for="tipo">SELECCIONA UN SALÓN:</label>
                    <select class="form-control" name="class" id="tipo" style="width: 500px;">
                        <option value="">Selecciona una opción</option>
                        <?php

    include_once("lib/conexion.php");

    $link=conectarse();

    
$id=$_GET['id'];
    $query="SELECT idsalon,nombre FROM salones order by idsalon asc";

    

        $resultado=mysql_query($query, $link);



    while($row=mysql_fetch_array($resultado)){



      ?>

       <option  value="<? echo html_entity_decode($row[1], ENT_QUOTES); ?>" <?php if($id == $row[1]){ echo 'selected="selected"';} ?> ><?php echo html_entity_decode($row[1], ENT_QUOTES); ?></option>

         <?php } ?>
                    </select>

                    <br>


                   


                    <label for="body">EVENTO:</label>
                    <textarea id="body" name="event" required class="form-control" rows="3" style="width: 500px;"></textarea>
                    <br/>
                     <label for="title">TIPO DE MONTAJE:</label><br/>
                    <label class="radio-inline"><input type="radio" name="montaje" value="Herradura">Herradura</label>
                    <label class="radio-inline"><input type="radio" name="montaje" value="Auditorio">Auditorio</label>
                    <label class="radio-inline"><input type="radio" name="montaje" value="Escuela">Escuela</label>
                    <label class="radio-inline"><input type="radio" name="montaje" value="Otro">Otro:<input type="text" name="otro" ></label>

                    <br>
                    <label class="checkbox-inline"><input type="checkbox" name="montaje2[]" value="Coffe break">Coffe break</label>
                    <label class="checkbox-inline"><input type="checkbox" name="montaje2[]" value="Cañon">Cañon</label>
                    <label class="checkbox-inline"><input type="checkbox" name="montaje2[]" value="Pantalla">Pantalla</label>
                    <label class="checkbox-inline"><input type="checkbox" name="montaje2[]" value="Laptop">Laptop</label>
                    <label class="checkbox-inline"><input type="checkbox" name="montaje2[]" value="Sonido">Sonido</label>
                    <br/>
                    <br/>
                    <label for="from">FECHA Y HORA DE INICIO</label>
                    <div class='input-group date' id='from'>
                        <input type='text' id="from" name="from" class="form-control" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div>

                    <br>

                    <label for="to">FECHA Y HORA FINAL</label>
                    <div class='input-group date' id='to'>
                        <input type='text' name="to" id="to" class="form-control" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        
                    </div>
                    <br/>
                        <label for="title">COSTO:</label>
                    <input type="text" required autocomplete="off" name="costo" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;">

                    <br>
                     <label for="title">ANTICIPO:</label>
                    <input type="text" required autocomplete="off" name="anticipo" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;">

                    <br>
                    <label for="title">SALDO:</label>
                    <input type="text" required autocomplete="off" name="saldo" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;">

                    <br>
                    <label class="radio-inline"><input type="radio" name="venta" value="Factura">Factura</label>
                    <label class="radio-inline"><input type="radio" name="venta" value="Recibo">Recibo</label>
                    <br/>
                    <label for="title">VIGILANTE RESPONSABLE:</label>
                    <input type="text" required autocomplete="off" name="vigilante" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;">

                    <br>

    <script type="text/javascript">
        $(function () {
            $('#from').datetimepicker({
                language: 'es',
                minDate: new Date()
            });
            $('#to').datetimepicker({
                language: 'es',
                minDate: new Date()
            });

        });
    </script>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Agregar</button>
        </form>
    </div>
  </div>
</div>
</div>   

					
<?php footer(); ?>