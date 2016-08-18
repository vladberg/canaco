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
    if (confirm('¿Está seguro de querer eliminar este ddepartamento?')){ 
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
          <div class="col-lg-10" aling="center">
            <h2 style="color:#FE0000;padding-left: 150px">ADMINISTRADOR DE ARTICULOS PROMOCIONALES</h2>
            <br/>
          </div>
        </div>



		<div class="row">
          <div class="col-lg-10">
            <div class="row">
  	          <div class="col-md-6"></div>
  	          <?php
  	          $link=conectarse();
		
		$query="SELECT precio_publicado FROM articulos limit 1";
		
        $resultado=mysql_query($query, $link);

		while($row=mysql_fetch_array($resultado)){
			$visible=$row[0];

		}



  	          ?> 
  	          
              <div class="col-md-6" align="right"><h2><a href="admin.si.articulos.php?opc=ADD&id=0" class="btn btn-success">Agregar Articulo</a> <a href="precios.php?id=<?php echo $visible;?>" class="btn btn-success">Publicar | Despublicar Precios</a></h2></div>
            </div>
            <div class="table-responsive">
            <form action="" method="post"> 
             <h2>Buscador general</h2>
             <table class="table table-bordered table-hover table-striped tablesorter">
            	<tr>
             		<td>Codigo </td> <td><input type="text" name="codigo"></td>
             		<td>Nombre </td> <td><input type="text" name="palabra"></td>
            		<td>Categoria </td><td> <select class="form-control" name="categoria" id="categoria">
                                     <option value="">Seleccionar Categoria</option>
   		<?php
		$link=conectarse();
		
		$query="SELECT id_categoria,categoria FROM categorias where estatus = 1 order by categoria asc";
		
        $resultado=mysql_query($query, $link);

		while($row=mysql_fetch_array($resultado)){

			?>
	     <option  value="<? echo html_entity_decode($row[0], ENT_QUOTES); ?>" <?php if($categoria == $row[0]){ echo 'selected="selected"';} ?> ><?php echo html_entity_decode($row[1], ENT_QUOTES); ?></option>
         <?php } ?>
         </select></td>
         <td>Proveedor</td>
         <td> <select class="form-control" name="proveedor" id="categoria">
                                     <option value="">Seleccionar Proveedor</option>
   		<?php
		$link=conectarse();
		
		$query="SELECT id_proveedor,nombre FROM proveedores where estatus = 1 order by nombre asc";
		
        $resultado=mysql_query($query, $link);

		while($row=mysql_fetch_array($resultado)){

			?>
	     <option  value="<? echo html_entity_decode($row[0], ENT_QUOTES); ?>" <?php if($categoria == $row[0]){ echo 'selected="selected"';} ?> ><?php echo html_entity_decode($row[1], ENT_QUOTES); ?></option>
         <?php } ?>
         </select></td>
         <td><input type="submit" class="btn btn-primary" name="guardar" id="guardar" value="Buscar"></td>
            	</tr>
            </table>
            </form>
             <form action="actualizar_multiple.php" method="post">
             <h2>Cambios Selección multiple</h2>
              <table class="table table-bordered table-hover table-striped tablesorter">
            	<tr>
            		<td>Cambio de Categoria<input type="hidden" name="opcion1" value="1"> </td>
            		<td> <select class="form-control" name="categoria" id="categoria">
                                     <option value="">Seleccionar Categoria</option>
   		<?php
		$link=conectarse();
		
		$query="SELECT id_categoria,categoria FROM categorias where estatus = 1 order by categoria asc";
		
        $resultado=mysql_query($query, $link);

		while($row=mysql_fetch_array($resultado)){

			?>
	     <option  value="<? echo html_entity_decode($row[0], ENT_QUOTES); ?>" <?php if($categoria == $row[0]){ echo 'selected="selected"';} ?> ><?php echo html_entity_decode($row[1], ENT_QUOTES); ?></option>
         <?php } ?>
         </select></td>
         <td>Cambio de Proveedor<input type="hidden" name="opcion2" value="2"></td>
         <td> <select class="form-control" name="proveedor" id="categoria">
                                     <option value="">Seleccionar Proveedor</option>
   		<?php
		$link=conectarse();
		
		$query="SELECT id_proveedor,nombre FROM proveedores where estatus = 1 order by nombre asc";
		
        $resultado=mysql_query($query, $link);

		while($row=mysql_fetch_array($resultado)){

			?>
	     <option  value="<? echo html_entity_decode($row[0], ENT_QUOTES); ?>" <?php if($categoria == $row[0]){ echo 'selected="selected"';} ?> ><?php echo html_entity_decode($row[1], ENT_QUOTES); ?></option>
         <?php } ?>
         </select></td>
         <td>Cambio de Estatus<input type="hidden" name="opcion3" value="3"></td>
         <td><select class="form-control" name="estatus" id="categoria">
                                     <option value="">Seleccionar Estatus</option>
                                     <option value="1">Activo</option>
                                     <option value="0">Inactivo</option>
                                     </select></td>
         <td><input type="submit" class="btn btn-primary" name="guardar" id="guardar" value="Actualizar"></td>
            	</tr>
            </table>
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                  	<td><input type="checkbox" id="marcar" onclick="marcar_desmarcar();" value=""></td>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Proveedor</th>
                    <th>Precio de Venta</th>
                    <th>Ver Publicación</th>
                    <th>Precio visible</th>
                    <th>Estatus</th>
                  </tr>
                </thead>
                <tbody>
                <?
							$link=conectarse_servicios();
							$codigo=$_POST['codigo'];
							$categoria=$_POST['categoria'];
							$proveedor=$_POST['proveedor'];
							$palabra=$_POST['palabra'];
							$query="SELECT a.id_articulo,a.precio_publicado,a.codigo,a.precio_venta,a.estatus,a.categoria,a.nombre,p.id_proveedor,p.nombre as proveedor,c.id_categoria,c.categoria FROM articulos a, proveedores p,categorias c where a.id_proveedor = p.id_proveedor and a.categoria=c.id_categoria order by a.id_articulo Asc;";
							
							if($codigo != ''){
								$query="SELECT a.id_articulo,a.precio_publicado,a.codigo,a.precio_venta,a.estatus,a.categoria,a.nombre,p.id_proveedor,p.nombre as proveedor,c.id_categoria,c.categoria FROM articulos a, proveedores p,categorias c where a.codigo like '%$codigo%' and a.id_proveedor = p.id_proveedor and a.categoria=c.id_categoria order by a.id_articulo Asc;";
							
							}
								if($palabra != ''){
								$query="SELECT a.id_articulo,a.precio_publicado,a.codigo,a.precio_venta,a.estatus,a.categoria,a.nombre,p.id_proveedor,p.nombre as proveedor,c.id_categoria,c.categoria FROM articulos a, proveedores p,categorias c where a.nombre like '%$palabra%' and a.id_proveedor = p.id_proveedor and a.categoria=c.id_categoria order by a.id_articulo Asc;";
							
							}
							if($categoria != ''){
								$query="SELECT a.id_articulo,a.precio_publicado,a.codigo,a.precio_venta,a.estatus,a.categoria,a.nombre,p.id_proveedor,p.nombre as proveedor,c.id_categoria,c.categoria FROM articulos a, proveedores p,categorias c where a.categoria=$categoria and a.id_proveedor = p.id_proveedor and a.categoria=c.id_categoria order by a.id_articulo Asc;";
							
							}
							if($proveedor != ''){
								$query="SELECT a.id_articulo,a.precio_publicado,a.codigo,a.precio_venta,a.estatus,a.categoria,a.nombre,p.id_proveedor,p.nombre as proveedor,c.id_categoria,c.categoria FROM articulos a, proveedores p,categorias c where a.id_proveedor = $proveedor and a.id_proveedor = p.id_proveedor and a.categoria=c.id_categoria order by a.id_articulo Asc;";
							
							}
							if($proveedor != '' && $categoria != ''){
								$query="SELECT a.id_articulo,a.precio_publicado,a.codigo,a.precio_venta,a.estatus,a.categoria,a.nombre,p.id_proveedor,p.nombre as proveedor,c.id_categoria,c.categoria FROM articulos a, proveedores p,categorias c where a.id_proveedor = $proveedor and a.categoria=$categoria and a.id_proveedor = p.id_proveedor and a.categoria=c.id_categoria order by a.id_articulo Asc;";
							
							}
							if($categoria ='' && $proveedor='' && $codigo=''){
							$query="SELECT a.id_articulo,a.precio_publicado,a.codigo,a.precio_venta,a.estatus,a.categoria,a.nombre,p.id_proveedor,p.nombre as proveedor,c.id_categoria,c.categoria FROM articulos a, proveedores p,categorias c where a.id_proveedor = p.id_proveedor and a.categoria=c.id_categoria order by a.id_articulo Asc;";
						}

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
									$visible='no_publicado.gif';
									

									if($row['estatus']==1){

										$imagen='publicado.gif';

									}
										if($row['precio_publicado']==1){

										$visible='publicado.gif';

									}
									if($imagen=='no_publicado.gif'){
										$class='danger';
									}

								?>
                  <tr class="<?php echo $class; ?>" id="row<? echo $icont; ?>">

                  <td><input type="checkbox" name="seleccion[]" value="<?php echo $row['id_articulo']; ?>" requerit><?php echo $row['id_articulo']; ?></td>
                    <td><? echo html_entity_decode($row['codigo'], ENT_QUOTES); ?></td>
                    <td><? echo html_entity_decode($row['nombre'], ENT_QUOTES); ?></td>
                    <td><? echo html_entity_decode($row['categoria'], ENT_QUOTES); ?></td>
                    <td><? echo html_entity_decode($row['proveedor'], ENT_QUOTES); ?></td>
                    <td>$<? echo round($row['precio_venta'], 2); ?></td>
                    <td><a href="../detalle.php?id=<?php echo $row['id_articulo']; ?>" target="_blank">Ver Articulo</td>
                    <td><img src="img/<? echo $visible; ?>" border="0" /></td>
                    <td><img src="img/<? echo $imagen; ?>" border="0" /></td>
                    
                  </tr>
                  <? }

							}

							?>
                            
                </tbody>
              </table>
              <? if(mysql_num_rows($resultado) <= 0){?>
         <h1 style="text-align:center;" class="danger">No hay Artículos por el momento</h1>
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