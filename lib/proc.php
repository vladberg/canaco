
<?php
error_reporting(0);

include 'conexion.php';

$q='';

$w='';

$b='';

if($_POST){
$q=$_POST['q'];
$w=$_POST['w'];
$b=$_POST['b'];
}
if(!empty($q)){
$con=conexion();

$res=mysql_query("select id_rubro,rubro from cat_rubros where id_dependencia=".$q."",$con);

?>

<select id="cont2" onchange="load2(this.value)">
<option value="0">Selecciona una opción</option>
<?php while($fila=mysql_fetch_array($res)){ ?>
 <option value="<?php echo $fila[0]; ?>"><?php echo $fila[1]; ?></option>
<?php } ?>

</select>
<?php }

if(!empty($w)){
$con=conexion();

$res=mysql_query("select id_apoyo,desc_apoyo from cat_apoyos where id_rubro=".$w."",$con);

?>

<select id="conte" onchange="load3(this.value)">

<option value="0">Selecciona una opción</option>

<?php while($fila=mysql_fetch_array($res)){ ?>
 <option value="<?php echo $fila[0]; ?>"><?php echo $fila[1]; ?></option>
<?php 
} 

}
	
if(!empty($b)){

$con=conexion();

$res=mysql_query("select nombre,valor from cat_requisitos where fk_apoyo=".$b."",$con);
$cont=1;
 while($fila=mysql_fetch_array($res)){

 if ($fila[1]=='input'){?>
                  	<label><?php echo $fila[0];?></label><input type='text' name='requisito<?php echo $cont;?>'/><br/>
                  	<?php 
                  	$cont++;
                  }
                  if($fila[1]=='upload'){
                  	?>
                  	<label><?php echo $fila[0];?></label><input type='file' name='file<?php echo $cont;?>'/><br/>
                  	<?php
                  	$cont++;
                  }

                  if($fila[1]=='calendar'){
                  	?>
                  	<label><?php echo $fila[0];?></label><input type="text"  id="datepicker"><br/>  


<?php 
}
} 

	}
?> 

