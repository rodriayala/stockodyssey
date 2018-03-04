<?php
//error_reporting(0);
session_start();
include_once("funciones.php");

$Xusuario = trim($_SESSION['usuario']);

$apellidos		= trim($_GET['apellidos']);
$nombres		= trim($_GET['nombres']);
$comentarios	= trim($_GET['comentarios']);

$lugarcompra	= trim($_GET['lugarcompra']);
$estadocompra	= strtoupper(trim($_GET['estadocompra']));
$cobro			= trim($_GET['cobro']);
$entrega		= trim($_GET['entrega']);
$preciocarta	= trim($_GET['preciocarta']);
$id_stock		= trim($_GET['id_stock']);
$idcliente		= trim($_GET['idcliente']);	
					
$flagClientes = false;
$flagAccionStock = false;
$flagStockActual = false;
$todo_ok = true;


$sql = " UPDATE `clientes` SET `apellidos`= '$apellidos',`nombres`='$nombres',`comentarios`='$comentarios' WHERE `apellidos`= '$apellidos' and `nombres`='$nombres' ";
$db  = conectar();
$r = mysqli_query($db, $sql);
	
if($r == false)
{
	mysqli_close($db);
	$error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
	$flagClientes = true;
	$todo_ok = false;
}
	mysqli_close($db);

$sql2 = " INSERT INTO `accion_stock`( `id_stock`, `precio_accion`, `id_usuario_accion`, `id_cliente`, `estado_accion`) 
VALUES ('$id_stock','$preciocarta','$Xusuario','$idcliente','$estadocompra') ";
$db2  = conectar();

$r2 = mysqli_query($db2, $sql2);
	
if($r2 == false)
{
	mysqli_close($db2);
	$error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
	$flagAccionStock = true;
	$todo_ok = false;
}
	mysqli_close($db2);
	


$sql3 = " UPDATE `stock_actual` SET `estado_venta`='$estadocompra' WHERE id_stock = '$id_stock' ";
$db3  = conectar();

$r3 = mysqli_query($db3, $sql3);
	
if($r3 == false)
{
	mysqli_close($db3);
	$error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
	$flagStockActual = true;
	$todo_ok = false;
}
	mysqli_close($db3);
		

if($todo_ok == true)
{
	echo '<div id="mensajeventa"><div class="alert alert-success"><strong>¡FELICITACIONES POR LA VENTA!</strong></div>';
	
	if($flagClientes == true)
	{
		echo '<div class="alert alert-warning"><strong>Cuidado!</strong> Ocurrio un error al guardar los datos del cliente, puede que halla inconsistencias.</div>';
	}

	if($flagAccionStock == true)
	{
		echo '<div class="alert alert-warning"><strong>Cuidado!</strong> Ocurrio un error al guardar el stock, PUEDE SER QUE LA VENTA NO SE VEA REFLEJADA, avisale al administrador.</div>';
	}

	if($flagStockActual == true)
	{
		echo '<div class="alert alert-warning"><strong>Cuidado!</strong> Ocurrio un error al guardar el stock, PUEDE SER QUE LA VENTA NO SE VEA REFLEJADA ,avisale al administrador</div>';
	}		

	echo '</div>';
}else{
	echo '<div id="mensajeventa" class="alert alert-danger"><strong>¡ERROR!</strong> Ocurrio un problema durante la grabación, pruebe cargar nuevamente la venta.</div>';	
}//Fin todo ok

?>