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
            <h2 style="color:#FE0000;padding-left: 150px">ADMINISTRADOR DE SALONES</h2>
          </div>
        </div>


		<div class="row">
<?
							
							//$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                            //$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

							$link=conectarse();
							$query="SELECT * FROM salones order by orden asc;";
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
									

									
									if($class=='success'){
								$class='active';
								}else{
									$class='success';
								}

									$laclase=($icont%2==0?"fila_par":"fila_impar");

									$imagen='no_publicado.gif';
									

									if($row['estatus']==1){

										$imagen='publicado.gif';

									}
									if($imagen=='no_publicado.gif'){
										$class='danger';
									}

								?> 
								 
		<div class="col-sm-10 col-md-10 col-lg-6 col-xs-12">
          <a href="detalles.php?id=<?php echo $row['nombre'];?>">
            <div class="panel" id="contenido" style="background: <?php echo $color; ?>;">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-sm-8 col-md-8 col-lg-5 col-xs-10">
                    <h2 style="text-overflow: ellipsis;white-space: nowrap;"><?php echo $row['nombre'];?></h2>
                  </div>
                  
                </div>
              </div>
              
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-sm-8 col-md-8 col-lg-6 col-xs-10">
                      
                    </div>
                    <div class="col-sm-8 col-md-8 col-lg-6 col-xs-10 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              
            </div>
            </a>
          </div>
<? }

							}
						
							?>
</div>

<?php footer();?>