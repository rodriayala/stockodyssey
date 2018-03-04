<?php
//error_reporting(0);
include_once("funciones.php");
$Xnombrecarta	= trim($_GET['nombrecarta']);
/*$sql = "SELECT * FROM `cards_scg`
		WHERE LOWER (card_name) like '%$Xnombrecarta%'
		order by card_edition DESC";*/

$sql = " SELECT `card_name`,`card_edition`,estado_venta, id_stock FROM `cards_scg` 
INNER JOIN `stock_actual` ON cards_scg.id = stock_actual.id_card 
WHERE LOWER (card_name) like '%acc%' 
AND stock_actual.estado_venta LIKE 'DISPONIBLE' 
order by card_name DESC ";
echo $sql;
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
	echo '<option value="'.trim($res['id_stock']).'" '. $elegido.'>'.trim($res['card_edition']).'</option>'."\n";
}
?>