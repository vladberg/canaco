<?php 
error_reporting();
	require_once 'lib/login.action.php';

	$membership = new loginAction();

	$membership->confirm_Member();

	include_once("lib/template.php");

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
</script>
<script>
function fArchivoAgregado(tipo){
	if(tipo=='n'){
		alert("Se ha subido correctamente el archivo. Se recargará la lista de archivos generales.");
		$("#lyfgral").load("listado.archivos.php?t=tb&rnd="+Math.random());
	}
	else
		alert("Se ha subido correctamente el archivo.");
	GB_hide();
}
function fEliminarArchivo(xnombre){
	if (confirm("¿Está seguro de querer eliminar el archivo?"))
		$("#lyfgral").load("listado.archivos.php",{t:'del',nombre:xnombre,rnd:Math.random()});
}

</script>
<?	

   body();?>
   <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-10">
            <h1>Panel de Control <small>Administrador</small></h1>
            <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
              <li class="active"><i class="fa fa-download"></i> Archivos Generales</li>
            </ol>
            <div class="alert alert-success alert-dismissable"> 
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Bienvenido al administrador del Sitio <a class="alert-link" href="../index.php">DGTI</a> Aqui se podran administrar los contenidos de la seccion departamentos.
            </div>
          </div>
        </div>

<div id="toolsContainer">

		<div class="row">
          <div class="col-lg-10">
            <div class="row">
  	          <div class="col-md-6"><h1>Archivos Generales</h1></div>
              <div class="col-md-6" align="right"><h2><a href="admin.subir.archivo.php?t=n" class="btn btn-success">Agregar Archivo</a></h2></div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                  	
                    <th>Nombre del Archivo</th>
                    <th></th>
                    
                  </tr>
                </thead>
                <tbody>
                <?
				$dir = "docs/";
				$dh = opendir($dir);
				$icont=0;
				$class='success';
				while (($file = readdir($dh)) !== false) {
					$icont++; 
					if($class=='success'){
								$class='active';
								}else{
									$class='success';
								}
					$laclase=($icont%2==0?"fila_par":"fila_impar");
					if ($file!='.' && $file!='..' ){
					?>
					  <tr>
						<td class="<?php echo $class; ?>" valign="middle"><a href="docs/<? echo $file; ?>" target="_blank"><? echo $file; ?></a></td>
						<td class="<?php echo $class; ?>" valign="middle" align="center">
						<a href="eliminar_arc.php?id=<?php echo $file; ?>" onclick="return confirmar('¿Está seguro que desea eliminar el registro?')"><img src="img/delete.gif" border="0"  title="Eliminar Archivo" style="cursor:pointer;" /></a>
						</td>
					  </tr>
					<?  
					}							
				}
				closedir($dh);
				?>
                            
                </tbody>
              </table>
             
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