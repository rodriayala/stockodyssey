<?php
//error_reporting(0);
include_once("funciones.php");

$Xnombrecarta	= trim($_POST['nombrecarta']);

$sql = "SELECT `card_name` FROM `cards_scg`
		WHERE LOWER (card_name) like '%$Xnombrecarta%'
        GROUP BY `card_name`
		order by card_name DESC";

#echo $sql;

$db = conectar();
$r = mysqli_query($db, $sql);
	
if($r == false)
{
	mysqli_close($db);
	$error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
}
	mysqli_close($db);

while ($res = mysqli_fetch_array($r))
{
	$Xcard_name	= trim($res['card_name']);
	//$Xcard_edition	= trim($res['id']);
	echo "<li id='lidisplay' onclick=\"fillCarta('$Xcard_name')\" >$Xcard_name</li>";
}
#style='position: absolute; left: 75px; top: 35px; z-index: 9999;'

?>