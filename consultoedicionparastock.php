<?php
//error_reporting(0);
include_once("funciones.php");
$Xnombrecarta	= trim($_GET['nombrecarta']);

$sql = " SELECT id, card_edition, image_edition FROM `cards_scg` 
WHERE LOWER (card_name) like '%$Xnombrecarta%'  
order by card_edition DESC ";
#echo $sql;
$db  = conectar();
$r = mysqli_query($db, $sql);
	
if($r == false)
{
	mysqli_close($db);
	$error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
}
	mysqli_close($db);
$elegido = "";
//echo '<option value="default" >Seleccione una opcion </option>'."\n";
//echo '<span class="dtitulo" id="seleccionEdicion" ><span class="ddlabel" >SELECCIONE</span></span>
//        	<div id="flechaDesplegable" onClick="muestroEdicionFlecha()"></div>
                                     
     # echo '<div id="desplegableChild" class="desplegableChild" style="display:none;">
       echo '<ul>
        	<li class="dlabel" onClick="opcionEdicion(\'000\');" id="desp000"><span>SELECCIONE UNA OPCION</span></li>';   
                           
							   
while ($res = mysqli_fetch_array($r))
{	
	echo '<li class="dlabel" onClick="opcionEdicion(\''.trim($res['id']).'\');" id="desp'.trim($res['id']).'"><img src="img/mtgicons/'.trim($res['image_edition']).'" width="42px"><span>'.trim($res['card_edition']).'</span></li>';
}
echo '</ul></div> ';
?>