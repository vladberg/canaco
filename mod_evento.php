<?php 
error_reporting();
include_once("lib/template.php");
	

	$membership = new loginActions();

	$membership->confirm_Member2();
    // Definimos nuestra zona horaria
date_default_timezone_set("America/Santiago");

// incluimos el archivo de funciones
include 'funciones.php';

$idreg=$_GET['id'];
$link=conectarse();
if($_POST && !empty($_POST["opc"])){

        $opcion=$_POST["opc"];

    }

    else{

        $opcion=$_GET["opc"];

    }

if($opcion=='UPD'){

$query="SELECT * FROM eventos where id=$idreg;";
$resultado=mysql_query($query, $link);
        if(mysql_num_rows($resultado)>0){
            while($row=mysql_fetch_array($resultado)){

            $quien_solicita = $row['title']; 

            $solicitante =$row['solicitante'];

            $telefono = $row['telefono'];

            $email = $row['email'];

            $salon = $row['class'];

            $evento = $row['body'];

            $montaje = $row['montaje'];

            $apoyo = $row['apoyo'];

            $inicio_normal = $row['inicio_normal'];

            $final_normal = $row['final_normal'];

            $costo= $row['costo'];

            $anticipo = $row['anticipo'];

            $saldo = $row['saldo'];

            $nota = $row['nota'];

            $vigilante = $row['vigilante'];
        }
    }
}
if ($opcion=='SAVED'){

    

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

  $tranx="update eventos set title='$titulo',body='$body',class='$clase',start='$inicio',end='$final',inicio_normal='$inicio_normal',final_normal='$final_normal',solicitante='$titulo2',telefono='$telefono',email='$email',montaje='$montaje',apoyo='$montaje2',costo='$costo',anticipo='$anticipo',saldo='$saldo',nota='$venta',vigilante='$vigilante' where id=$idreg";
    $rtranx=mysql_query($tranx, $link);
    if(!$rtranx) 

                {

                    mysql_query("ROLLBACK");

                    $estatus="ERROR";

                }

                else{

                    mysql_query("COMMIT");

                    $estatus="OK";

                }
}
	
cabezal(); ?>
<? body();?>
<style>

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
</style>

      
      <div class="container"  style="padding-top: 97px;">
      <? if(isset($estatus) && $estatus == "OK"){ ?>

    <div id="msgContainer" class="saved">Se ha guardado correctamente la 

informaci&oacute;n. <a href="javascript:window.history.back();">Ver lista 

Actualizada.</a></div>

    <? }

       if(isset($estatus) && $estatus == "ERROR"){  ?>

    <div id="msgContainer" class="error">Ocurrio un error al intentar guardar la 

informacion. Por favor Intenta de Nuevo.</div>

    <? } ?>

    <? if(!isset($estatus)){ ?><div>&nbsp;</div><? } ?>
        <form action="" method="post">
        <input type="hidden" name="opc" value="SAVED">
        <table>
        <tr>
        <td><label for="title">QUIEN RESERVA:</label></td>
                    <td><input value="<?php echo $quien_solicita;?>" type="text" required autocomplete="off" name="title" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;"></td>
                    </tr>
                        <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
                    <tr>
                    <td><label for="title">SOLICITANTE:</label></td>
                    <td><input value="<?php echo $solicitante;?>" type="text" required autocomplete="off" name="title2" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;"></td></tr>
                        <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
                    <tr>
                     <td><label for="title">TELEFONO:</label></td>
                    <td><input value="<?php echo $telefono;?>" type="text" required autocomplete="off" name="telefono" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;"></td></tr>    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
                    <tr>
                     <td><label for="title">EMAIL:</label></td>
                    <td><input value="<?php echo $email;?>" type="text" required autocomplete="off" name="email" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;"></td></tr>    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
                    <tr>
                    <td><label for="tipo">SELECCIONA UN SALÓN:</label></td>
                    <td><select class="form-control" name="class" id="tipo" style="width: 500px;">
                        <option value="">Selecciona una opción</option>
                        <?php

    include_once("lib/conexion.php");

    $link=conectarse();

    
$id=$_GET['id'];
    $query="SELECT idsalon,nombre FROM salones order by idsalon asc";

    

        $resultado=mysql_query($query, $link);



    while($row=mysql_fetch_array($resultado)){



      ?>

       <option  value="<? echo html_entity_decode($row[1], ENT_QUOTES); ?>" <?php if($salon == $row[1]){ echo 'selected="selected"';} ?> ><?php echo html_entity_decode($row[1], ENT_QUOTES); ?></option>

         <?php } ?>
                    </select></td></tr>    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
                    <tr>
                    <td><label for="body">EVENTO:</label></td>
                    <td><textarea id="body" name="event" required class="form-control" rows="3" style="width: 500px;"><?php echo $evento;?></textarea></td>
                    </tr>    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
                    <tr>
                     <td><label for="title">TIPO DE MONTAJE:</label></td>
                    <td>
                    <label class="radio-inline"><input type="radio" name="montaje" <?php if($montaje == 'Herradura') echo 'checked="checked"'; ?> value="Herradura">Herradura</label>
                    <label class="radio-inline"><input type="radio" name="montaje" <?php if($montaje == 'Auditorio') echo 'checked="checked"'; ?> value="Auditorio">Auditorio</label>
                    <label class="radio-inline"><input type="radio" name="montaje" <?php if($montaje == 'Escuela') echo 'checked="checked"'; ?> value="Escuela">Escuela</label>
                    <label class="radio-inline"><input type="radio" name="montaje" <?php if($montaje == 'Otro') echo 'checked="checked"'; ?> value="Otro">Otro:<input type="text" name="otro" ></label></td></tr>    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
                    <tr>
                    <td></td>
                    <?php
                    $apoyo = explode(",", $apoyo ); 
                    $i=0;
           ?>
                    <td><label class="checkbox-inline"><input type="checkbox" name="montaje2[]" <?php  $i=0;
           for ($i=0;$i<=count($apoyo);$i++) { if($apoyo[$i] == 'Coffe break') echo 'checked="checked"'; }?> value="Coffe break">Coffe break</label>
                    <label class="checkbox-inline"><input type="checkbox" name="montaje2[]" <?php  $i=0;
           for ($i=0;$i<=count($apoyo);$i++) {if($apoyo[$i] == 'Cañon') echo 'checked="checked"'; }?> value="Cañon">Cañon</label>
                    <label class="checkbox-inline"><input type="checkbox" name="montaje2[]" <?php  $i=0;
           for ($i=0;$i<=count($apoyo);$i++) {if($apoyo[$i] == 'Pantalla') echo 'checked="checked"'; }?> value="Pantalla">Pantalla</label>
                    <label class="checkbox-inline"><input type="checkbox" name="montaje2[]" <?php  $i=0;
           for ($i=0;$i<=count($apoyo);$i++) {if($apoyo[$i] == 'Laptop') echo 'checked="checked"'; }?> value="Laptop">Laptop</label>
                    <label class="checkbox-inline"><input type="checkbox" name="montaje2[]" <?php  $i=0;
           for ($i=0;$i<=count($apoyo);$i++) {if($apoyo[$i] == 'Sonido') echo 'checked="checked"'; }?> value="Sonido">Sonido</label></td></tr>    <tr>
                 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
                    <tr><td><label for="from">FECHA Y HORA DE INICIO</label></td>
                    <td><div class='input-group date' id='from' style="width:500px">
                        <input value="<?php echo $inicio_normal;?>" type='text' id="from" name="from" class="form-control" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div></td></tr>    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
                    <tr>
                    <td><label for="to">FECHA Y HORA FINAL</label></td>
                    <td><div class='input-group date' id='to' style="width:500px">
                        <input value="<?php echo $final_normal;?>" type='text' name="to" id="to" class="form-control" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        
                    </div></td></tr>    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
                    <tr>
                        <td><label for="title">COSTO:</label></td>
                    <td><input value="<?php echo $costo;?>" type="text" required autocomplete="off" name="costo" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;"></td></tr>    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>

                    <tr>
                     <td><label for="title">ANTICIPO:</label></td>
                    <td><input value="<?php echo $anticipo;?>" type="text" required autocomplete="off" name="anticipo" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;"></td></tr>    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>

                    <tr>
                    <td><label for="title">SALDO:</label></td>
                    <td><input value="<?php echo $saldo;?>" type="text" required autocomplete="off" name="saldo" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;"></td></tr>    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>

                    <tr>
                    <td><label for="title">TIPO DE RECIBO</label></td>
                    <td><label class="radio-inline"><input type="radio" name="venta" <?php if($nota == 'Factura') echo 'checked="checked"'; ?>  value="Factura">Factura</label><label class="radio-inline"><input type="radio" name="venta" <?php if($nota == 'Recibo') echo 'checked="checked"'; ?>  value="Recibo">Recibo</label></td>
                    </tr>    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
                    <tr>
                    <td><label for="title">VIGILANTE RESPONSABLE:</label></td>
                    <td><input value="<?php echo $vigilante;?>" type="text" required autocomplete="off" name="vigilante" class="form-control" id="title" placeholder="Introduce un título" style="width: 500px;"></td></tr>

                   

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
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
      <tr>
      <td><button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button></td>
      <td><button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Agregar</button></td></tr>
        </form>
 </table>
 </div>
<? footer();?>