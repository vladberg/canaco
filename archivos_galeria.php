
<?php
error_reporting(0);

    require_once 'lib/login.action.php';

    $membership = new loginActions();

    $membership->confirm_Member2(); 

    include_once("lib/template.php");
    include_once("lib/files.admin.php");

  //include_once("lib/util.php");

    //include_once("lib/sql.injection.php");

    include_once("lib/sanitize/sanitize.php");
    $idreg=intval($_GET["id"]);
    
 
    $link=conectarse();

    


    if($_POST && !empty($_POST["opc"])){

        $opcion=$_POST["opc"];

    }

    else{

        $opcion=$_GET["opc"];

    }
    $user=$_SESSION['admin_user'];

        $idreg=intval($_GET["id"]);
        $publicar=1;

            /*if ($_POST["publicar"]=='on'){

                $publicar=1;

            }*/
if($_POST){
 $carpetaDestino="../galerias/";
 
    # si hay algun archivo que subir
    if($_FILES["archivo"]["name"][0])
    {
 
        //# recorremos todos los arhivos que se han subido
        for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)
        {
 
            //# si es un formato de imagen
            if($_FILES["archivo"]["type"][$i]=="image/jpeg" || $_FILES["archivo"]["type"][$i]=="image/pjpeg" || $_FILES["archivo"]["type"][$i]=="image/gif" || $_FILES["archivo"]["type"][$i]=="image/png")
            {
 
                # si exsite la carpeta o se ha creado
                if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
                {
                    $origen=$_FILES["archivo"]["tmp_name"][$i];
                    $destino=$carpetaDestino.$_FILES["archivo"]["name"][$i];
 
                    //# movemos el archivo
                    if(@move_uploaded_file($origen, $destino))
                    {
                        //echo "<br>".$_FILES["archivo"]["name"][$i]." movido correctamente";
                        $foto=$_FILES['archivo']['name'][$i];
                        $id=intval($_GET["id"]);

                    mysql_query("BEGIN");

                        $tranx="insert into archivos_galeria (id_galeria,archivo,estatus)  values($id, '$foto',$publicar);";

                        $rtranx=mysql_query($tranx, $link);

                        $idreg = mysql_insert_id($link);

                        if(!$rtranx) 

                    {

                        mysql_query("ROLLBACK");

                        //deleteFiles($ruta_files.$HTTP_POST_FILES["filefoto"]['name']);

                        $estatus="ERROR";

                    }

                    else{

                        mysql_query("COMMIT");

                        $estatus="OK";

                    }
                    $estatus="OK";
                        

                    
                    
                    }else{
                        $estatus="ERROR";
                        $error="<br>No se ha podido mover el archivo: ".$_FILES["archivo"]["name"][$i];
                    }
                }else{
                    $estatus="ERROR";
                    $error= "<br>No se ha podido crear la carpeta: up/".$user;
                }
            }else{
                $estatus="ERROR";
                $error="<br>".$_FILES["archivo"]["name"][$i]." - NO es imagen jpg";
            }
        }
    }else{
        $estatus="ERROR";
        $error="<br>No se ha subido ninguna imagen";
    }
}

cabezal(); ?>
<script language="javascript" src="js/datevalid.js" type="text/javascript"></script>

<script language="javascript" src="js/jquery-1.2.6.min.js" type="text/javascript"></script>

<script language="javascript">

function confirmar ( mensaje ) { 
return confirm( mensaje ); 
} 

function admRegistroupd() { 
   extensiones_permitidas = new Array(".pdf"); 
   mierror = "";

    var msgError = "";

    if($("#nombre").val() == ''){

        msgError = msgError + "- Titulo .\n";

    }

    if(msgError != ""){

        alert("Por favor, escriba información en los siguientes campos:\n"+msgError);

        return false;

    }

    $("#opc").val("SAVE");

    $("#form").submit();

}



function actualizarLista(){

    var array_data = new Array();

    array_data[0] = $("#idRow").val();

    array_data[1] = $("#id").val();

    array_data[2] = '<? echo $titulo; ?>';
    
    array_data[3] = '<? echo $departamento; ?>';

    array_data[4] = '<? if ($publicar=='S'){echo 'publicado.gif';} else{echo 'no_publicado.gif';} ?>';
    array_data[5] = 'delete.gif';

    parent.parent.refreshNoticia(array_data);

}

function ocultaMensaje(){

    try{

        //$('#msgContainer').css('display','none');

        $('#msgContainer').html('&nbsp;');

        $('#msgContainer').attr('className','');

    }

    catch(error){

    }

}

$(document).ready(function(){

    $('input[type="text"]').change(ocultaMensaje);

    $('select').change(ocultaMensaje);

    $('input[type="checkbox"]').click(ocultaMensaje);

});

</script>
<script type="text/javascript" src="lib/tiny_mce/tiny_mce_src.js"></script>



<script type="text/javascript">



    tinyMCE.init({



        // General options



        elements : "txtcontenido",



        language : 'es',



        mode : "textareas",



        theme : "advanced",



        skin : "o2k7",



        skin_variant : "silver",



        plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",







        // Theme options



        theme_advanced_buttons1 : "formatselect,fontselect,fontsizeselect,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor",



        theme_advanced_buttons2 : "bold,italic,underline,strikethrough,|,cut,copy,paste,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,image,media,cleanup",



        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,advhr",



        //theme_advanced_buttons4 : "",



        theme_advanced_toolbar_location : "top",



        theme_advanced_toolbar_align : "left",



        theme_advanced_statusbar_location : "bottom",



        theme_advanced_resizing : false,







        // Example content CSS (should be your site CSS)



        content_css : "lib/tiny_mce/css/content.css",







        // Drop lists for link/image/media/template dialogs



        //template_external_list_url : "script/tiny_mce/lists/template_list.js",



        //external_link_list_url : "script/tiny_mce/lists/link_list.js",



        //external_image_list_url : "script/tiny_mce/lists/image_list.js",



        //media_external_list_url : "script/tiny_mce/lists/media_list.js",



        



        //template_external_list_url : "script/tiny_mce/lists/template_list.js",



        //external_link_list_url : "listado.archivos.php?t=jslink",



        //external_image_list_url : "listado.archivos.php?t=jsimg",



        //media_external_list_url : "listado.archivos.php?t=jsmedia",



        







        // Replace values for the template plugin



        template_replace_values : {



            username : "Some User",



            staffid : "991234"



        }



    });



</script>

<!--[if !IE]>-->  


<!--<![endif]-->

<!--[if IE]>

<link href="script/niceforms/niceforms-default-ie.css" type="text/css" rel="stylesheet" />

<![endif]-->
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
<?php body(); ?>

 <div id="page-wrapper" >

        <div class="row">
          <div class="col-lg-8">
            <h1>Panel de Control <small>Administrador</small></h1>
            <br/>
            
          </div>
        </div>
        
            <div class="row" >
             <div class="col-lg-8">
            <div class="row">
              <div class="col-md-6"><h2>Archivos Galeria</h2></div>
              </div>
              <form id="form" name="form" action="" method="post" enctype="multipart/form-data" class="niceform">

    <fieldset>

    <? if(isset($estatus) && $estatus == "OK" && $user!='admin'){ ?>

    <div id="msgContainer" class="saved">Se ha guardado correctamente la 

informaci&oacute;n. <a href="filtro_galerias2.php" onClick="actualizarLista();">Ver lista 

Actualizada.</a></div>

    <? }
    if(isset($estatus) && $estatus == "OK" && $user=='admin'){ ?>

    <div id="msgContainer" class="saved">Se ha guardado correctamente la 

informaci&oacute;n. <a href="filtro_galerias.php" onClick="actualizarLista();">Ver lista 

Actualizada.</a></div>

    <? }

       if(isset($estatus) && $estatus == "ERROR"){  ?>

    <div id="msgContainer" class="error"><?php echo $error;?></div>

    <? } ?>

    <? if(!isset($estatus)){ ?><div>&nbsp;</div><? } ?>

    <input type="hidden" id="id" name="id" value="<? echo $idreg; ?>" />

    <input type="hidden" id="idRow" name="idRow" value="<? echo $_GET["rowId"]; ?>" />

    <input type="hidden" id="opc" name="opc" value="" />
    
    </br>


    <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter" align="center">
        
            
        <tr>
            <td><label>Archivos: </label></td>
            <td><input class="form-control" type="file" name="archivo[]" multiple="multiple"></td>
        </tr>
        
        <!--<td><label>Publicar:</label></td>
            <td><input class="checkbox" name="publicar" id="publicar" type="checkbox" <? if ($publicar==1) { echo 'checked="checked"'; } ?>/></td>
        </tr>-->
        
        
        
    </table>
    </div>
   </fieldset>
                <?php if($opcion=="UPD"){?>
   
    <div class="modal-footer">
                    <a href="filtro_galerias.php" onclick="return confirmar('¿Est&aacute; seguro que desea salir,no se guardara el registro?')"><button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button></a>
                    <button type="sumbit" class="btn btn-primary" name="guardar" id="guardar" value="Guardar">Guardar</button>
                </div>
                <?php } ?>
                <?php if($opcion!="UPD" && $user=='admin'){?>
    <div class="modal-footer">
                    <a href="filtro_galerias.php" onclick="return confirmar('¿Est&aacute; seguro que desea salir,no se guardara el registro?')"><button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button></a>
                    <button type="submit" class="btn btn-primary" name="guardar" id="guardar" value="Guardar">Guardar</button>
                </div>
                <?php } ?>
                <?php if($opcion!="UPD" && $user!='admin'){?>
    <div class="modal-footer">
                    <a href="filtro_galerias2.php" onclick="return confirmar('¿Est&aacute; seguro que desea salir,no se guardara el registro?')"><button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button></a>
                    <button type="sumbit" class="btn btn-primary" name="guardar" id="guardar" value="Guardar" >Guardar</button>
                </div>
                <?php } ?>
    </form>

               
        </div>
        </div>
        </div>

             <div class="col-lg-8">
            <div class="row">
              <div class="col-md-6"><h2>Archivos Galeria</h2></div>
              </div>
              

 <div class="table-responsive">
 <div class="row">
             
        <?php
        $idreg=intval($_GET["id"]);

       $link=conectarse();

        $query="SELECT * FROM archivos_galeria where id_galeria='$idreg';";

        $resultado=mysql_query($query, $link);

        if(mysql_num_rows($resultado)>0){

         while($row = mysql_fetch_array($resultado)){ 

            $imagen=$row['archivo'];

            ?>
            
        
       
        <div class="col-sm-2"><img src="../galerias/<?php echo $imagen;?>" class="img-responsive" ></div>
       
        <?php
    }
    }
    ?>    
        </div>
    </div>
  


               
        </div>

              
    
<?php footer(); ?>
    