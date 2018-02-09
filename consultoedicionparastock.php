<?php
//error_reporting(0);
include_once("funciones.php");
$Xnombrecarta	= trim($_GET['nombrecarta']);

$sql = " SELECT id, card_edition FROM `cards_scg` 
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
echo '<option value="default" >Seleccione una opcion </option>'."\n";
while ($res = mysqli_fetch_array($r))
{	
	echo '<option value="'.trim($res['id']).'" '. $elegido.'>'.trim($res['card_edition']).'</option>'."\n";
}
?>