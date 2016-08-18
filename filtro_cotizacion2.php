<?php 
error_reporting();
include_once("lib/template.php");
	

	$membership = new loginActions();

	$membership->confirm_Member2();

	

//	include_once("librerias/rutas.php");
if($_POST){
    $link=conectarse();
    echo $id=$_POST['hora'];
    $cliente=$_POST['cliente'];
    echo $tranx="update cotizacion set empresa='$cliente' where hora='$id'";
$rtranx=mysql_query($tranx, $link);    				
					if(!$rtranx){

						mysql_query("ROLLBACK");
						$estatus="ERROR"; }

					else{

						mysql_query("COMMIT");

						$estatus="OK";

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


<script language="javascript" src="js/jquery-1.2.6.min.js" type="text/javascript"></script>

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

//<![CDATA[
function marcar_desmarcar(){
var marca = document.getElementById('marcar');
var cb = document.getElementsByName('seleccion[]');
 
for (i=0; i<cb.length; i++){
if(marca.checked == true){
cb[i].checked = true
}else{
cb[i].checked = false;
}
}
 
}
//]]>
</script>
<?	

   body();?>
   <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-10">
            <h2 style="color:#FE0000;padding-left: 150px">ADMINISTRADOR DE COTIZACIONES</h2>
                      </div>
        </div>



		<div class="row">
          <div class="col-lg-10">
            <div class="row">
  	          
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                  	<th>Usuario</th>
                    <th>Fecha de Solicitud</th>
                    <th>Cotizado a:</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?
							$link=conectarse_servicios();
							$query="SELECT DISTINCT usuario,fecha,estatus,hora,empresa FROM cotizacion where estatus=2 order by fecha asc;";
														

							$resultado=mysql_query($query, $link);
							//echo $resultado;

							$icont=0;
							$class='success';
							
									

							if(mysql_num_rows($resultado)>0){

								while($row = mysql_fetch_array($resultado)){ 
                                    $cliente=$row['empresa'];

									$icont++;
									if($class=='success'){
								$class='active';
								}else{
									$class='success';
								}

									$laclase=($icont%2==0?"fila_par":"fila_impar");

									$imagen='no_publicado.gif';
									

									if($row[2]==2){

										$estatus='Cotización solicitada';

									}
									if($imagen=='no_publicado.gif'){
										$class='success';
									}

								?>
                  <tr class="<?php echo $class; ?>" id="row<? echo $icont; ?>"><td><a href="ver_cotizacion.php?id=<?php echo $row['usuario'];?>&f=<?php echo $row['fecha'];?>&h=<?php echo $row['hora'];?>"><?php echo $row['usuario'];?></a></td>
                    <td><?php echo $row['fecha'].' '.$row['hora'];?> </td>
                    <?php
                    $query2="SELECT empresa FROM registro where usuario='".$row['usuario']."' ";
    				$resultado2=mysql_query($query2, $link);
					while($row2 = mysql_fetch_array($resultado2)){ 
                    $cliente1=$row2[0]; } 
                    if($cliente1==''){
                    $cliente1 = $cliente;
                    
                    }
                    ?>
                    <form action="" method="post">
                    <input type="hidden" name="hora" value="<?php echo $row['hora']; ?>"/>
                    <td><input type="text" name="cliente" value="<?php echo $cliente; ?>" /></td>
                    <td><input type="submit" value="Guardar"/></td>
                    </form>
                  </tr>
                  <? }

							}

							?>
                            
                </tbody>
              </table>
              <? if(mysql_num_rows($resultado) <= 0){?>
         <h1 style="text-align:center;" class="danger">No hay Cotizaciones capturados por el momento</h1>
         <?php }?>
            </div>
            
          </div>

         </div>
        </div>
                   

					<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>

					<script type="text/javascript" src="js/jquery.flydom-3.1.1.js"></script>

					<script type="text/javascript">

						function refreshNoticia(array_data){

							if(array_data[0] == ""){

								var rows = $("#tbnotificaciones").children().find('tr');

								var numrows = rows.size();

								$("#tbnoticias").createAppend(

									'tr',{id:'row' + String(numrows)},[

										'td',{className:'new_row', align:'center', valign:'middle'},[

											'a',{href:'admin.si.departamentos.php?opc=UPD&id=' + String(array_data[1]) + '&rowId=row' + String(numrows), onclick: 'return GB_showCenter("Departamento - Editar", this.href, 550, 625);'},'<img src="imagen/editar.gif" border="0" />'

										],

													
										'td',{className:'new_row', align:'center'},array_data[2],

										'td',{className:'new_row', align:'center'},array_data[3],

										'td',{className:'new_row', align:'center'},array_data[4],
										'td',{className:'new_row', align:'center', valign:'middle'},'<img src="imagen/' + array_data[5] + '" border="0" />',
										'td',{className:'new_row', align:'center', valign:'middle'},'<img src="imagen/' + array_data[6] + '" border="0" />',
										
										

									]

								);

							}

							else{

								var row = $("#" + String(array_data[0])).children();

								row.get(0).innerHTML = '<a href="admin.si.departamentos.php?opc=UPD&id=' + String(array_data[1]) + '&rowId=' + array_data[0] + '" onclick="return GB_showCenter(\'Departamento - Detalle\', this.href, 550, 625);"><img src="imagen/editar.gif" border="0" /></a>';

								row.get(0).className = 'new_row';

								row.get(1).innerHTML = array_data[2];

								row.get(1).className = 'new_row';

								row.get(2).innerHTML = array_data[3];

								row.get(2).className = 'new_row';
								
								row.get(3).innerHTML = array_data[4];

								row.get(3).className = 'new_row';
								
								row.get(4).innerHTML = '<img src="imagen/'+array_data[5]+'" border="0" />';

								row.get(4).className = 'new_row';
								row.get(5).innerHTML = '<img src="imagen/'+array_data[6]+'" border="0" />';

								row.get(5).className = 'new_row';

							

							}

							GB_hide();

						}
						
						  

					</script>
<?php footer(); ?>