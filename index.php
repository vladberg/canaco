<?php
error_reporting(0);
include_once("lib/template.php");
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

        
        // y la formateamos con la funcion _formatear

        $final  = _formatear($_POST['to']);

        // Recibimos el fecha de inicio y la fecha final desde el form

        $inicio_normal = $_POST['from'];
        $arr = explode('-', $inicio_normal);

        $inicio_normal = $arr[2].'/'.$arr[1].'/'.$arr[0];

        $hora=$_POST['hora'];

        $inicio_normal= $inicio_normal." ".$hora;

        $inicio = _formatear($inicio_normal);

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
        header("Location:index.php"); 
    }
}
cabezal();
 ?>

<?php body();?>

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
                                        <button class="btn btn-info" data-toggle='modal' data-target='#add_evento'>Añadir Evento</button>
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
        <h4 class="modal-title" id="myModalLabel" style="text-align: right;">Agregar nuevo evento</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post">
         <label for="title">QUIEN RESERVA:</label>
                    <input type="text" required autocomplete="off" name="title" class="form-control" id="title" placeholder="Introduce un título">

                    <br>
                    <label for="title">SOLICITANTE:</label>
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


                   


                    <label for="body">EVENTO:</label>
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
                    <br/>
                    <label for="from">FECHA Y HORA DE INICIO</label>
                    <?php 
            ini_set('date.timezone','America/Mexico_City'); 
            $hora=date("g:i:s A"); 
            ?>
                    <div class='input-group date' id='from'>
                        <input type="date" class="form-control" name="from" step="1" min="01-01-2013" max="12-31-2013" value="<?php echo date("Y-m-d");?>">
                        <input type="time" class="form-control" name="hora" value="00:00:00" max="22:30:00" min="10:00:00" step="1">
                    </div>

                    <br>

                    <label for="to">FECHA Y HORA FINAL</label>
                    <div class='input-group date' id='to'>
                        <input type='text' name="to" id="to" class="form-control" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        
                    </div>
                    <br/>
                        <label for="title">COSTO:</label>
                    <input type="text" required autocomplete="off" name="costo" class="form-control" id="title" placeholder="Introduce un título">

                    <br>
                     <label for="title">ANTICIPO:</label>
                    <input type="text" required autocomplete="off" name="anticipo" class="form-control" id="title" placeholder="Introduce un título">

                    <br>
                    <label for="title">SALDO:</label>
                    <input type="text" required autocomplete="off" name="saldo" class="form-control" id="title" placeholder="Introduce un título">

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
<?php footer();?>
