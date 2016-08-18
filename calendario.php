<?php


// Definimos nuestra zona horaria
date_default_timezone_set("America/Santiago");

// incluimos el archivo de funciones
include 'funciones.php';

// incluimos el archivo de configuracion
include 'config.php';
if($_POST){

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

         $telefono= evaluar($_POST['telefono']);

        //email
        $email= evaluar($_POST['email']);

     
        $montaje= evaluar($_POST['montaje']);
        $otro = evaluar($_POST['otro']);
        if($montaje == 'Otro'){
            $montaje = $otro;
        }

        $montaje2= evaluar($_POST['montaje2']);

        $montaje2=implode(',',$_POST['montaje2']);

        $venta= evaluar($_POST['venta']);

        $vigilante = evaluar($_POST['vigilante']);

        $personas=$_POST['personas'];
        $mesas=$_POST['mesas'];
        $sillas=$_POST['sillas'];



include_once('lib/PHPMailer/class.phpmailer.php');

include_once('lib/PHPMailer/class.smtp.php');

 

//Recibir todos los parámetros del formulario

$para1 = 'bergman.pereira.novelo@gmail.com';

$para = 'itzimna@hotmail.com';

$asunto = $_POST['asunto'];

$mensaje = '<label>Solicitante: </label>'.$titulo."<br/>";
$mensaje.= '<label>Empresa U Organización: </label>'.$titulo2."<br/>";
$mensaje.= '<label>Email Solicitante:</label>'.$email."<br/>";
$mensaje.= '<label>Telefono Solicitante:</label>'.$telefono."<br/>";
$mensaje.= '<label>Evento</label>'.$body."<br/>";
$mensaje.= '<label>Salon</label>'.$clase."<br/>";
$mensaje.= '<label>Tipo de montaje: </label>'.$montaje."<br/>";
$mensaje.= '<label>Apoyo: </label>'.$montaje2."<br/>";
$mensaje.= '<label>Fecha de solicitud: </label>'.$inicio_normal."<br/>";
$mensaje.= '<label>Fin del evento: </label>'.$final_normal."<br/>";
$mensaje.= '<label>Se requiere: </label>'.$venta."<br/>";
$mensaje.= '<label>Numero de personas: </label>'.$personas."<br/>";
$mensaje.= '<label>Numero de mesas: </label>'.$mesas."<br/>";
$mensaje.= '<label>Numero de sillas: </label>'.$sillas;

$archivo = $imagen;

 

//Este bloque es importante

$mail = new PHPMailer();

$mail->IsSMTP();

//$mail->SMTPAuth = true;

$mail->SMTPSecure = "tsl";

$mail->Host = "localhost";

$mail->Port = 25;

 

//Nuestra cuenta

//$mail->Username ='bergman.pereira.novelo@gmail.com';

//$mail->Password = 'vladberg01'; //Su password

 

//Agregar destinatario

$mail->SetFrom("noreply@sartory.mx", "CANACO - Solicitud de Salon");
$mail->AddAddress("bergman.pereira.novelo@gmail.com", "CANACO");
$mail->AddBCC("bergman.pereira.novelo@gmail.com","Contacto");


$mail->Subject = $asunto;

$mail->Body = $mensaje;

//Para adjuntar archivo

$mail->AddAttachment($archivo, $archivo);

$mail->MsgHTML($mensaje);

  

//Avisar si fue enviado o no y dirigir al index

if($mail->Send())

{

    echo'<script type="text/javascript">

            alert("Enviado Correctamente");            

         </script>';

}

else{

    echo'<script type="text/javascript">

            alert("NO ENVIADO, intentar de nuevo");

         </script>';

}



}
// Verificamos si se ha enviado el campo con name from

 ?>
 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CANACO - Administración</title>
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
        <link rel="shortcut icon" href="img/icon.png">  
  </head>
<style type="text/css">
    .container {
    width: 900px !important;

}
.btn-warning {
    color: #fff;
    background-color: #0D6509;
    border-color: #0D6509;
}
.btn-warning:hover, .btn-warning:focus, .btn-warning:active, .btn-warning.active, .open .dropdown-toggle.btn-warning {
    color: #fff;
    background-color: #43A944;
    border-color: #43A944;
}
</style>
        <div class="container">

                <div class="row">
                        <div class="page-header" style="text-align: center;margin-top: 60px;"><h2></h2></div>
                                <div class="pull-left form-inline"><br>
                                        <div class="btn-group">
                                            <button class="btn btn-primary" data-calendar-nav="prev"><< Anterior</button>
                                            <button class="btn" data-calendar-nav="today">Hoy</button>
                                            <button class="btn btn-primary" data-calendar-nav="next">Siguiente >></button>
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn btn-warning" data-calendar-view="year">Año</button>
                                            <button class="btn btn-warning active" data-calendar-view="month">Mes</button>
                                            <button class="btn btn-warning" data-calendar-view="week">Semana</button>
                                            <button class="btn btn-warning" data-calendar-view="day">Dia</button>
                                        </div>

                                </div>
                                <div class="pull-right form-inline"><br>
                                        <button class="btn btn-info" data-toggle='modal' data-target='#add_evento'>SOLICITUD DE RESERVACIÓN</button>
                                    </div>
                                   

                </div><hr>

                <div class="row">
                        <div id="calendar"></div> <!-- Aqui se mostrara nuestro calendario -->
                        <br><br>
                </div>

                <!--ventana modal para el calendario-->
                <div class="modal fade" id="events-modal">
                    <div class="modal-dialog">
                            <div class="modal-content">
                                    <div class="modal-body" style="height: 400px">
                                        <p>One fine body&hellip;</p>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
        </div>

    
    <script type="text/javascript">
        (function($){
                //creamos la fecha actual
                var date = new Date();
                var yyyy = date.getFullYear().toString();
                var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
                var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

                //establecemos los valores del calendario
                var options = {

                    // definimos que los eventos se mostraran en ventana modal
                        modal: '#events-modal', 

                        // dentro de un iframe
                        modal_type:'iframe',    

                        //obtenemos los eventos de la base de datos
                        events_source: 'obtener_eventos.php', 

                        // mostramos el calendario en el mes
                        view: 'month',             

                        // y dia actual
                        day: yyyy+"-"+mm+"-"+dd,   


                        // definimos el idioma por defecto
                        language: 'es-ES', 

                        //Template de nuestro calendario
                        tmpl_path: 'tmpls1/', 
                        tmpl_cache: false,


                        // Hora de inicio
                        time_start: '08:00', 

                        // y Hora final de cada dia
                        time_end: '22:00',   

                        // intervalo de tiempo entre las hora, en este caso son 30 minutos
                        time_split: '30',    

                        // Definimos un ancho del 100% a nuestro calendario
                        width: '100%', 

                        onAfterEventsLoad: function(events)
                        {
                                if(!events)
                                {
                                        return;
                                }
                                var list = $('#eventlist');
                                list.html('');

                                $.each(events, function(key, val)
                                {
                                        $(document.createElement('li'))
                                                .html('<a href="' + val.url + '">' + val.title + '</a>')
                                                .appendTo(list);
                                });
                        },
                        onAfterViewLoad: function(view)
                        {
                                $('.page-header h2').text(this.getTitle());
                                $('.btn-group button').removeClass('active');
                                $('button[data-calendar-view="' + view + '"]').addClass('active');
                        },
                        classes: {
                                months: {
                                        general: 'label'
                                }
                        }
                };


                // id del div donde se mostrara el calendario
                var calendar = $('#calendar').calendar(options); 

                $('.btn-group button[data-calendar-nav]').each(function()
                {
                        var $this = $(this);
                        $this.click(function()
                        {
                                calendar.navigate($this.data('calendar-nav'));
                        });
                });

                $('.btn-group button[data-calendar-view]').each(function()
                {
                        var $this = $(this);
                        $this.click(function()
                        {
                                calendar.view($this.data('calendar-view'));
                        });
                });

                $('#first_day').change(function()
                {
                        var value = $(this).val();
                        value = value.length ? parseInt(value) : null;
                        calendar.setOptions({first_day: value});
                        calendar.view();
                });
        }(jQuery));
    </script>
    <div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel" style="text-align: right;">SOLICITUD DE RESERVACIÓN</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post">
         <label for="title">QUIEN RESERVA:</label>
                    <input type="text" required autocomplete="off" name="title" class="form-control" id="title" placeholder="Introduce un título">

                    <br>
                    <label for="title">EMPRESA U ORGANIZACIÓN:</label>
                    <input type="text" required autocomplete="off" name="title2" class="form-control" id="title" placeholder="Introduce un título">

                    <br>
                     <label for="title">TELEFONO:</label>
                    <input type="text" required autocomplete="off" name="telefono" class="form-control" id="title" placeholder="Introduce un título">

                    <br>
                     <label for="title">EMAIL:</label>
                    <input type="text" required autocomplete="off" name="email" class="form-control" id="title" placeholder="Introduce un título">

                    <br>
                    <label for="tipo">SELECCIONA UN SALÓN:</label>
                    <select class="form-control" name="class" id="tipo">
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


                   


                    <label for="body">TIPO DE EVENTO:</label>
                    <textarea id="body" name="event" required class="form-control" rows="3"></textarea>
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
                    <br>
                     <label for="title">NUMERO DE PERSONAS:</label>
                    <input type="text" required autocomplete="off" name="personas" class="form-control" id="title" placeholder="Introduce un título">
                    <br>
                     <label for="title">NUMERO DE MESAS:</label>
                    <input type="text" required autocomplete="off" name="mesas" class="form-control" id="title" placeholder="Introduce un título">
                    <br>
                     <label for="title">NUMERO DE SILLAS:</label>
                    <input type="text" required autocomplete="off" name="sillas" class="form-control" id="title" placeholder="Introduce un título">
                    <br/>
                    <BR/>

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
                    <label>SE REQUIERE:</label>
                    <label class="radio-inline"><input type="radio" name="venta" value="Factura">Factura</label>
                    <label class="radio-inline"><input type="radio" name="venta" value="Recibo">Recibo</label>
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
    </body>
</html>
