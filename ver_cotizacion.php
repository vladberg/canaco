<?php 
error_reporting();
include_once("lib/template.php");
	

	$membership = new loginActions();

	$membership->confirm_Member2();

//	include_once("librerias/rutas.php");

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

   body();?> <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-10">
            <h1>Panel de Control <small>Administrador</small></h1>
            <br/>
           
          </div>
        </div>



		<div class="row">
          <div class="col-lg-10">
            <div class="row">
												<hr>
												<h2 class="title-step" style="text-align: center;">Solicitud de Cotización</h2>
												<!--<div class="fb-comments" data-href="http://www.impressline.com.mx/detalle.php?id_categoria=1&id=5" data-num-posts="5" data-width="875"></div>-->
											<div class="table-responsive">
											
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Unidades</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Perzonalizado</th>
                    <th>Precio P/unit</th>
                    <th>Sub personalizado</th>
                    <th>TOTAL</th>
                    <th>Color</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?
							$link=conectarse_servicios();

							$usuario=$_GET['id'];
							$fecha=$_GET['f'];
                            $hora=$_GET['h'];
							$query="Select * from cotizacion where usuario='$usuario' and estatus=2 and fecha='$fecha' and hora='$hora';";
							$resultado=mysql_query($query, $link);
							//echo $resultado;

							$icont=0;
							$class='success';
						
							if(mysql_num_rows($resultado)>0){

								while($row = mysql_fetch_array($resultado)){ 
									$tipo=html_entity_decode($row['persona'], ENT_QUOTES);
									$idss=$row['id_articulo'];

									$icont++;
									if($class=='success'){
								$class='active';
								}else{
									$class='success';
								}

									$laclase=($icont%2==0?"fila_par":"fila_impar");

									$imagen='no_publicado.gif';
									

									if($row['estatus']==0){

										$imagen='publicado.gif';
										$tip="Capturado ";

									}
									if($row['estatus'] == 2){
										$imagen='publicado.gif';
										$tip='Enviado ';
									}

									if($row['estatus'] == 1){
										$imagen='publicado.gif';
										$tip="Pendiente Enviar ";
									}


									
									if($imagen=='no_publicado.gif'){
										$class='danger';

										
									}

								?>
                  <tr class="<?php echo $class; ?>" id="row<? echo $icont; ?>">
                  
                  <form method="post" action="agrega_pp.php">
                  <input type="hidden" name="id[]" value="<?php echo $row['idcotizacion'];?>">
                  <input type="hidden" name="usuario" value="<?php echo $usuario;?>">
                  <input type="hidden" name="fecha" value="<?php echo $fecha;?>">
                  <input type="hidden" name="hora" value="<?php echo $hora;?>">
                  
                  
                    <td><? echo html_entity_decode($row['codigo'], ENT_QUOTES); ?></td>
                    <td><u><a href="../detalle.php?id=<?php echo $row['id_articulo'];?>" target="_blank"><?php echo html_entity_decode($row['nombre'], ENT_QUOTES); ?></a></u></td>
                    <td><input type="text" style="width: 50px" name="unidad[]" value="<?php echo $row['unidad'];?>"></td>
											<td><input type="text" name="precio_unitario[]" value="<?php echo ROUND($row['precio_venta'],2);?>" style="width: 50px" /></td>
											<?php 
											$precio=ROUND($row['precio_venta'],2);
											$u=$row['unidad'];
											$sub=$precio*$u;

											?>
											<td>$ <?php echo $sub;?></td>
                                            <td><?php echo $tipo;?></td>
                                            <td><input type="text" name="precio_per[]" value="<?php echo $row['precio_persona'];?>" style="width: 45px"></td>
                                            <?php 
											$precio_per=$row['precio_persona'];
											$u=$row['unidad'];
											$sub2=$precio_per*$u;

											?>
                                            <td>$ <?php echo $sub2;?></td>
                                            <td><?php echo $total= $sub+$sub2;?></td>
											<td><?php echo $row['color'];?></td>
											<td><a href="eliminar_coti2.php?id=<?php echo $row['idcotizacion']; ?>&us=<?php echo $usuario;?>&f=<?php echo $fecha;?>&h=<?php echo $hora;?>" onclick="return confirmar('¿Está seguro que desea eliminar el registro?')"><img src="img/delete.gif" border="0"  title="Eliminar Seccion"  style="cursor:pointer;"  /></a></td>
											
											
                  </tr>
                  <? }

							}

							?>
                            <tr><td><button class="btn btn-flat" type="submit">Calcular</button></td></form>
                            <td><a href="../index.php?h=<?php echo $hora;?>&f=<?php echo $fecha;?>&us=<?php echo $usuario;?>"><button class="btn btn-flat" type="submit">Agregar Articulo</button></a></td>

                            </tr>
                </tbody>
              </table>
              <? if(mysql_num_rows($resultado) <= 0){?>
         <h1 style="text-align:center;" class="danger">No hay solicitudes de cotizacion por el momento</h1>
         <?php }?>
            </div>
													
													
                                                   
                                                    
													<a href="ver_reporte.php?us=<?php echo $usuario;?>&f=<?php echo $fecha;?>&h=<?php echo $hora;?>"><button class="btn btn-flat" type="submit">Personalizar Cotización</button>
												 
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