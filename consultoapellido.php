<?php
//error_reporting(0);
include_once("funciones.php");

$Xape = trim($_GET['ape']);

$sql = " SELECT CONCAT(`apellidos`, ', ' ,`nombres`) as apeynom, id_clientes FROM `clientes` WHERE `apellidos` LIKE '%$Xape%' ";
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
	$Xid_clientes	= trim($res['id_clientes']);
	$Xapeynom	= trim($res['apeynom']);
	
	echo "<li id='lidisplayApellido' onclick=\"fillApellido('$Xapeynom','$Xid_clientes')\" >$Xapeynom</li>";
}

?>