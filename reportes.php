<?php
error_reporting(0);
include_once("lib/template.php");
cabezal();
?>
<?php body();?>
<style type="text/css">
	a{
    color: #ffffff;
    text-decoration: none;
}
a:hover, a:focus {
    color: #A1A5A9;
    text-decoration: underline;
}
</style>
<div id="page-wrapper">

        <div class="row">
          <div class="col-lg-10">
            <h2 style="color:#FE0000;padding-left: 150px">ADMINISTRADOR DE REPORTES</h2>
          </div>
        </div>


		<div class="row">
<?
							

										$arreglo = array('','#046ec8', '#24396a', '#366', '#24672b','#24396a','#2a627a');
										$color=$arreglo[$i];?>
									

									
		<div class="col-sm-10 col-md-10 col-lg-6 col-xs-12">
          <a href="detalles.php?id=<?php echo $row['nombre'];?>">
            <div class="panel" id="contenido" style="background: <?php echo $arreglo[2]; ?>;"> 
              <div class="panel-heading">
                <div class="row">
                  <div class="col-sm-8 col-md-8 col-lg-5 col-xs-10">
                    <h2 style="text-overflow: ellipsis;white-space: nowrap;">Reporte Personalizado</h2>
                  </div>
                  </a>
                </div>
              </div>
              
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-sm-8 col-md-8 col-lg-6 col-xs-10" style="font-color:#ffffff">
                     <form action="reporte_excel.php" method="post">
                     <table>
                     <tr>
                     	<td><label for="tipo">SELECCIONA UN SALÓN:</label></td>
                    <td><select class="form-control" name="class" id="tipo" style="width: 500px;">
                        <option value="">Selecciona una opción</option>
                        <option value="todos">Todos los salones</option>
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
                    </select></td>
                     </tr>
                     <tr>
       	<td><label>Fecha de Inicio</label></td>
       	<td><input type="date" class="form-control" name="inicio" step="1" min="01-01-2013" max="12-31-2013" ></td>
       </tr> <tr>
       	<td><label>Fecha Fin</label></td>
       	<td><input type="date" class="form-control" name="fin" step="1" min="01-01-2013" max="12-31-2013"></td>
       </tr>
       <tr>
       	<td><input type="submit" value="Consulta"></td>
       </tr>
       </table></form>
                    </div>
                    <div class="col-sm-8 col-md-8 col-lg-6 col-xs-10 text-right">
                    <a href="reporte_excel.php?id=1" style="color: #171212;"><button style="margin-right: 206px;margin-top: 15px;">Reporte Historico General</button></a>
                    </div>
                  </div>
                </div>
              
            </div>
           
          </div>
</div>

<?php footer();?>