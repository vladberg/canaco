<?php
include_once("lib/template.php");
cabezal();?>
<style>
#contenido {
   overflow:hidden;
    white-space:nowrap;
    text-overflow: ellipsis;
}
</style>
<?php body();?>
<div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Panel de Control <small>Administrador</small></h1>
            <br/>         
          </div>
        </div><!-- /.row -->
		
         <!--Contenido -->
        <div class="row">
          <div class="col-sm-10 col-md-10 col-lg-6 col-xs-12">
          <a href="filtro_articulos.php">
            <div class="panel panel-info" id="contenido">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-sm-8 col-md-8 col-lg-6 col-xs-10">
                    <i class="fa fa-bookmark fa-5x"> Artículos</i>
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
          <div class="col-sm-10 col-md-10 col-lg-6 col-xs-12">
          <a href="filtro_banners.php">
            <div class="panel panel-danger" id="contenido">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-sm-8 col-md-8 col-lg-6 col-xs-10">
                    <i class="fa fa-picture-o fa-5x"> Banners</i>
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
          <div class="col-sm-10 col-md-10 col-lg-6 col-xs-12">
          <a href="filtro_categorias.php">
            <div class="panel panel-info" id="contenido">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-sm-8 col-md-8 col-lg-6 col-xs-10">
                    <i class="fa fa-outdent fa-5x"> Categorías</i>
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
          <div class="col-sm-10 col-md-10 col-lg-6 col-xs-12">
          <a href="filtro_proveedores.php">
            <div class="panel panel-danger" id="contenido">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-sm-8 col-md-8 col-lg-6 col-xs-10">
                    <i class="fa fa-book fa-5x"> Proveedores</i>
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
          
<div class="col-sm-10 col-md-10 col-lg-6 col-xs-12">
          <a href="admin.subir.archivo.php">
            <div class="panel panel-info" id="contenido">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-sm-8 col-md-8 col-lg-6 col-xs-10">
                    <i class="fa fa-file-o fa-5x"> Subir archivos</i>
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

         </div>

<?php footer();?>