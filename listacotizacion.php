<?php
require_once("funciones.php");
error_reporting(0);
/*if (falta_logueo())
{ 
	header('location:index.php');
	exit();
}*/


$id 	= trim($_GET['id']);
$acc	= trim($_GET['acc']);

	if(($acc=="c")and(strlen($id)!=0)and(is_numeric($id)))
	{//si clono 

		$sql_cotizacion = "SELECT * FROM `cotizacion` WHERE `id_cotizacion` = $id";
		//echo $sql_cotizacion; // exit();
		$db_cotizacion  = conecto();
		 
		$r_cotizacion   = mysqli_query($db_cotizacion, $sql_cotizacion);
		
		if($r_cotizacion == false)
		{
			mysqli_close($db_cotizacion);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
		}
			mysqli_close($db_cotizacion);	
		/*Traigo los estado*/
	
		while ($arr = mysqli_fetch_array($r_cotizacion))		
		{
			$cot_numero = trim($arr['id_cotizacion']);
			$Xrazon_social= trim($arr['razon_social']);
			$XSELestado= trim($arr['estado']);	
			$Xfecha_recep=  trim($arr['fecha_recepcion']);
			$Xcontacto	= trim($arr['contacto']);
			$XSELusuarios	= trim($arr['vendedor']);
			$Xcot_referencia= 0;
			$Xvigencia	= trim($arr['vigencia']);	
			$Xemail	= trim($arr['email']);
			$XSELservicios= trim($arr['servicio']);
			$Xmercaderia= trim($arr['mercaderia']);
			$Xincoterm	 = trim($arr['incoterm']);
			$XSELpaisorigen	= trim($arr['id_pais_origen']);
			$Xcot_ciudad_origen	= trim($arr['ciudad_origen']);
			$Xcot_zip_origen	= trim($arr['cot_zip_origen']);
			$XSELpaisdestino	= trim($arr['id_pais_destino']);
			$Xcot_ciudad_destino= trim($arr['ciudad_destino']);
			$Xcot_zip_destino= trim($arr['cot_zip_destino']);
			
		}
		//CLONO LOS DATOS
			$sqla = "INSERT INTO cotizacion (`fecha_recepcion`, `fecha_alta`, `fecha_ultima_modificacion`, `vigencia`, `razon_social`, `contacto`, `email`, `servicio`, `mercaderia`, `estado`, `vendedor`, `incoterm`, `id_pais_origen`, `id_pais_destino`, `ciudad_origen`, `ciudad_destino`, `cot_zip_origen`, `cot_zip_destino`, cot_referencia) 
			VALUES ('$Xfecha_recep','$fechaalta','$fechaalta','$Xvigencia','$Xrazon_social','$Xcontacto','$Xemail','$XSELservicios','$Xmercaderia','$XSELestado','$XSELusuarios','$Xincoterm','$XSELpaisorigen','$XSELpaisdestino','$Xcot_ciudad_origen','$Xcot_ciudad_destino','$Xcot_zip_origen','$Xcot_zip_destino','$Xcot_referencia')";
			//echo $sqla;  exit();
			$dba  = conecto();
	 
			$ra   = mysqli_query($dba, $sqla);
			
			if($ra == false)
			{
				mysqli_close($dba);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			}
				$id_nueva_cotizacion = trim(mysqli_insert_id($dba));
				mysqli_close($dba);			
		//FIN INSERTO CLONO LOS DATOS
		
	/*Traigo los tablasFI*/
	$sql_tablasFI = "SELECT * FROM `cot_fleteinternacional` WHERE `id_cotizacion` =  '$id' ";
	//echo $sql_tablasFI; // exit();
	$db_tablasFI  = conecto();
	 
	$r_tablasFI   = mysqli_query($db_tablasFI, $sql_tablasFI);
	
	if($r_tablasFI == false)
	{
		mysqli_close($db_tablasFI);
		$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	}
		mysqli_close($db_tablasFI);	
		
	while ($arr_tablasFI = mysqli_fetch_array($r_tablasFI))		
	{
		$descripcion = trim($arr_tablasFI['descripcion']);
		$cantidad = trim($arr_tablasFI['cantidad']);
		$unidad = trim($arr_tablasFI['unidad']);
		$moneda = trim($arr_tablasFI['moneda']);
		$tarifa =trim($arr_tablasFI['tarifa']);
		$min =trim($arr_tablasFI['min']);
		
		$total =trim($arr_tablasFI['total']);
		$observaciomes =trim($arr_tablasFI['observaciomes']);
		$factor_multiplicador =trim($arr_tablasFI['factor_multiplicador']);
		$veintes =trim($arr_tablasFI['veintes']);
		$cuarentas =trim($arr_tablasFI['cuarentas']);
		$totalizar =trim($arr_tablasFI['totalizar']);	
		$tipo_serv =trim($arr_tablasFI['tipo_serv']);
		
		$embarque =trim($arr_tablasFI['embarque']);	
		$cantiveinte =trim($arr_tablasFI['cantiveinte']);
		$canticuarentas =trim($arr_tablasFI['canticuarentas']);
		//$total = $tarifa * $cantidad;
		
		$db_FI  = conecto();
		$sql_FI = " INSERT INTO `cot_fleteinternacional` ( id_cotizacion, `descripcion`, `cantidad`, `unidad`, `moneda`, `tarifa`, `min`, `total`, `factor_multiplicador`, `veintes`, `cuarentas`, `totalizar`, `tipo_serv`, embarque, cantiveinte, canticuarentas) VALUES ('$id_nueva_cotizacion','$descripcion','$cantidad','0','$moneda','$tarifa','$min','$total','0','$veintes','$cuarentas','$totalizar','$tipo_serv','$embarque', '$cantiveinte', '$canticuarentas') ";
		//echo $sql_FI; echo '<br>';#exit)();
		$r_FI   = mysqli_query($db_FI, $sql_FI);

		if ($r_FI == false)
		{
			mysqli_close($db_FI);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		 }
			mysqli_close($db_FI);	
	}
	/*Traigo los tablasFI*/		
	

	/*Traigo los tablasGDO*/
		$sql_tablasGDO = "SELECT * FROM `cot_gastosdeorigen` WHERE `id_cotizacion` =  '$id' ";
		//echo $sql_tablasGDO; // exit();
		$db_tablasGDO  = conecto();
		 
		$r_tablasGDO   = mysqli_query($db_tablasGDO, $sql_tablasGDO);
		
		if($r_tablasGDO == false)
		{
			mysqli_close($db_tablasGDO);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
		}
			mysqli_close($db_tablasGDO);
			
		while ($arr_tablasGDO = mysqli_fetch_array($r_tablasGDO))		
		{
			$descripcion = trim($arr_tablasGDO['descripcion']);
			$cantidad = trim($arr_tablasGDO['cantidad']);
			$unidad = trim($arr_tablasGDO['unidad']);
			$moneda = trim($arr_tablasGDO['moneda']);
			$tarifa =trim($arr_tablasGDO['tarifa']);
			$min =trim($arr_tablasGDO['min']);
			
			$total =trim($arr_tablasGDO['total']);
			$observaciomes =trim($arr_tablasGDO['observaciomes']);
			$factor_multiplicador =trim($arr_tablasGDO['factor_multiplicador']);
			$veintes =trim($arr_tablasGDO['veintes']);
			$cuarentas =trim($arr_tablasGDO['cuarentas']);
			$totalizar =trim($arr_tablasGDO['totalizar']);	
			$tipo_serv =trim($arr_tablasGDO['tipo_serv']);
			
			$embarque =trim($arr_tablasGDO['embarque']);
			$cantiveinte =trim($arr_tablasGDO['cantiveinte']);
			$canticuarentas =trim($arr_tablasGDO['canticuarentas']);	
	
			//$total = $tarifa * $cantidad;
			
			$db_GDO  = conecto();
			$sql_GDO = " INSERT INTO `cot_gastosdeorigen` ( id_cotizacion, `descripcion`, `cantidad`, `unidad`, `moneda`, `tarifa`, `min`, `total`, `factor_multiplicador`, `veintes`, `cuarentas`, `totalizar`, `tipo_serv`, embarque, cantiveinte, canticuarentas) VALUES ('$id_nueva_cotizacion','$descripcion','$cantidad','0','$moneda','$tarifa','$min','$total','0','$veintes','$cuarentas','$totalizar','$tipo_serv','$embarque', '$cantiveinte', '$canticuarentas') ";
			//echo $sql_GDO; echo '<br>';exit();
			$r_GDO   = mysqli_query($db_GDO, $sql_GDO);
	
			if ($r_GDO == false)
			{
				mysqli_close($db_GDO);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			 }
				mysqli_close($db_GDO);				
		}
		/*Traigo los tablasGDO*/		


		/*Traigo los tablasGED*/
		$sql_tablasGED = " SELECT * FROM `cot_gastosendestino` WHERE `id_cotizacion` =  '$id' ";
		//echo $sql_tablasGED; // exit();
		$db_tablasGED  = conecto();
		 
		$r_tablasGED   = mysqli_query($db_tablasGED, $sql_tablasGED);
		
		if($r_tablasGED == false)
		{
			mysqli_close($db_tablasGED);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
		}
			mysqli_close($db_tablasGED);	

	
		while ($arr_tablasGED = mysqli_fetch_array($r_tablasGED))		
		{
			$descripcion = trim($arr_tablasGED['descripcion']);
			$cantidad = trim($arr_tablasGED['cantidad']);
			$unidad = trim($arr_tablasGED['unidad']);
			$moneda = trim($arr_tablasGED['moneda']);
			$tarifa =trim($arr_tablasGED['tarifa']);
			$min =trim($arr_tablasGED['min']);
			
			$total =trim($arr_tablasGED['total']);
			$observaciomes =trim($arr_tablasGED['observaciomes']);
			$factor_multiplicador =trim($arr_tablasGED['factor_multiplicador']);
			$veintes =trim($arr_tablasGED['veintes']);
			$cuarentas =trim($arr_tablasGED['cuarentas']);
			$totalizar =trim($arr_tablasGED['totalizar']);	
			$tipo_serv =trim($arr_tablasGED['tipo_serv']);	
			
			$embarque =trim($arr_tablasGED['embarque']);
			$cantiveinte =trim($arr_tablasGED['cantiveinte']);
			$canticuarentas =trim($arr_tablasGED['canticuarentas']);	
			
	//		$total = $tarifa * $cantidad;
			
			$db_GDO  = conecto();
			$sql_GDO = " INSERT INTO `cot_gastosendestino` ( id_cotizacion, `descripcion`, `cantidad`, `unidad`, `moneda`, `tarifa`, `min`, `total`, `factor_multiplicador`, `veintes`, `cuarentas`, `totalizar`, `tipo_serv`, embarque, cantiveinte, canticuarentas) VALUES ('$id_nueva_cotizacion','$descripcion','$cantidad','0','$moneda','$tarifa','$min','$total','0','$veintes','$cuarentas','$totalizar','$tipo_serv', '$embarque', '$cantiveinte', '$canticuarentas') ";
			//echo $sql_FI; echo '<br>';#exit)();
			$r_GDO   = mysqli_query($db_GDO, $sql_GDO);
	
			if ($r_GDO == false)
			{
				mysqli_close($db_GDO);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			 }
				mysqli_close($db_GDO);				
		}
		/*Traigo los tablasGED*/


/*Traigo los tablasGDO*/		


		/*Traigo los tablasGED_det*/
		$sql_tablasGED_det = "SELECT * FROM `cot_gastosendestino_det` WHERE `id_cotizacion` =  '$id' ";
		//echo $sql_tablasGED; // exit();
		$db_tablasGED_det  = conecto();
		 
		$r_tablasGED_det   = mysqli_query($db_tablasGED_det, $sql_tablasGED_det);
		
		if($r_tablasGED_det == false)
		{
			mysqli_close($db_tablasGED_det);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
		}
			mysqli_close($db_tablasGED_det);	

	
		while ($arr_tablasGED_det = mysqli_fetch_array($r_tablasGED_det))		
		{
			$comentarios = trim($arr_tablasGED_det['comentarios']);
			$restolata = trim($arr_tablasGED_det['restolata']);
			$seguro = trim($arr_tablasGED_det['seguro']);
			$test = trim($arr_tablasGED_det['test']);
			$gastototal = trim($arr_tablasGED_det['gastototal']);
			$cotgastotalfi = trim($arr_tablasGED_det['cotgastotalfi']);
			$cotgastotalgd = trim($arr_tablasGED_det['cotgastotalgd']);


			
			$db_GED_det  = conecto();
			$sql_GED_det = " INSERT INTO `cot_gastosendestino_det`(`id_cotizacion`, `comentarios`, `restolata`, `seguro`, `test`, `gastototal`, `cotgastotalfi`, `cotgastotalgd`) VALUES ('$id_nueva_cotizacion','$comentarios','$restolata','seguro','$test','$gastototal','$cotgastotalfi','$cotgastotalgd') ";
			//echo $sql_GED_det; echo '<br>';#exit)();
			$r_GED_det   = mysqli_query($db_GED_det, $sql_GED_det);
	
			if ($r_GED_det == false)
			{
				mysqli_close($db_GED_det);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			 }
				mysqli_close($db_GED_det);				
		}
		/*Traigo los tablasGEDGED_det*/




		/*Traigo los cot_medidas*/
		$sql_cot_medidas = "SELECT * FROM `cot_medidas` WHERE `id_cotizacion` =  '$id' ";
		//echo $sql_cot_medidas; # exit();
		$db_cot_medidas  = conecto();
		 
		$r_cot_medidas   = mysqli_query($db_cot_medidas, $sql_cot_medidas);
		
		if($r_cot_medidas == false)
		{
			mysqli_close($db_cot_medidas);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
		}
			mysqli_close($db_cot_medidas);	

	
		while ($arr_cot_medidas = mysqli_fetch_array($r_cot_medidas))		
		{
			$comentarios = trim($arr_cot_medidas['comentarios']);
			$cot_peso = trim($arr_cot_medidas['cot_peso']);
			$cot_pesovol = trim($arr_cot_medidas['cot_pesovol']);
			$cot_dimensiones = trim($arr_cot_medidas['cot_dimensiones']);

			
			$db_cot_medidas2  = conecto();
			$sql_cot_medidas2 = " INSERT INTO `cot_medidas`( `id_cotizacion`, `comentarios`, `cot_peso`, `cot_pesovol`, `cot_dimensiones`) VALUES ('$id_nueva_cotizacion','$comentarios','$cot_peso','cot_pesovol','$cot_dimensiones')";
			//echo $sql_GED_det; echo '<br>';#exit)();
			$r_cot_medidas2   = mysqli_query($db_cot_medidas2, $sql_cot_medidas2);
	
			if ($r_cot_medidas2 == false)
			{
				mysqli_close($db_cot_medidas2);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			 }
				mysqli_close($db_cot_medidas2);				
		}
		/*Traigo los cot_medidas*/



		/*Traigo los cot_medidas_det*/
		$sql_cot_medidas_det = "SELECT * FROM `cot_medidas_det` WHERE `id_cotizacion` =  '$id' ";
		//echo $sql_cot_medidas;  exit();
		$db_cot_medidas_det  = conecto();
		 
		$r_cot_medidas_det   = mysqli_query($db_cot_medidas_det, $sql_cot_medidas_det);
		
		if($r_cot_medidas_det == false)
		{
			mysqli_close($db_cot_medidas_det);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
		}
			mysqli_close($db_cot_medidas_det);	

	
		while ($arr_cot_medidas_det = mysqli_fetch_array($r_cot_medidas_det))		
		{
			$cantidad = trim($arr_cot_medidas_det['cantidad']);
			$peso = trim($arr_cot_medidas_det['peso']);
			$largo_centimetros = trim($arr_cot_medidas_det['largo_centimetros']);
			$ancho_centimetros = trim($arr_cot_medidas_det['ancho_centimetros']);
			$alto = trim($arr_cot_medidas_det['alto']);
			$volumen = trim($arr_cot_medidas_det['volumen']);
			$peso_vol = trim($arr_cot_medidas_det['peso_vol']);

			$db_cot_medidas2  = conecto();
			$sql_cot_medidas2 = " INSERT INTO `cot_medidas_det`(`id_cotizacion`, `cantidad`, `peso`, `largo_centimetros`, `ancho_centimetros`, `alto`, `volumen`, peso_vol) VALUES ('$id_nueva_cotizacion','$cantidad','$peso','largo_centimetros','$ancho_centimetros','$alto','$volumen','$peso_vol') ";
			//echo $sql_cot_medidas2; echo '<br>'; exit();
			$r_cot_medidas2   = mysqli_query($db_cot_medidas2, $sql_cot_medidas2);
	
			if ($r_cot_medidas2 == false)
			{
				mysqli_close($db_cot_medidas2);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			 }
				mysqli_close($db_cot_medidas2);				
		}
		/*Traigo los cot_medidas*/
				
		header("location:modificocotizacion.php?id=$id_nueva_cotizacion&acc=c");
		die;

	}//FIN CLONACION TOTAL

//Primer pasada
$TAMANO_PAGINA	= 20;
$pagina = $_GET['pagina'];

if (!$pagina)
{
$sqla = "select count(*) as canti from cotizacion order by id_cotizacion";
#echo $sqla; // exit();
$dba  = conecto();
 
$ra   = mysqli_query($dba, $sqla);

if($ra == false)
{
	mysqli_close($dba);
    $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
}
    mysqli_close($dba);

$arrx = mysqli_fetch_array($ra);
$cantidad = $arrx['canti'];
#echo 'canti:'.$cantidad;

$_SESSION['canti'] = $cantidad;
$inicio = 0;
$pagina = 1;
}else{
	$cantidad = $_SESSION['canti'];
	$inicio = ($pagina-1) * $TAMANO_PAGINA;
}
		
$total_paginas = ceil($cantidad/$TAMANO_PAGINA);
					 
if ($cantidad > 0)
{ 
	$sqlb = "select *, estados.descripcion AS desestado, servicios.descripcion AS desservicio, clientes.descripcion AS descricliente  
from cotizacion 
LEFT JOIN estados on cotizacion.estado = estados.id 
LEFT JOIN servicios ON cotizacion.servicio = servicios.id
left JOIN clientes ON clientes.id = cotizacion.razon_social
order by id_cotizacion DESC LIMIT $TAMANO_PAGINA OFFSET $inicio ";
	//echo $sqlb; // exit();
	$dbb  = conecto();
	 
	$rb   = mysqli_query($dbb, $sqlb);
	
	if($rb == false)
	{
		mysqli_close($dbb);
		$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	}
		mysqli_close($dbb);						
}



?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>DHL QUOTATION</title>
   
  <link rel='stylesheet prefetch' href='css/bootstrap.min.css'>
  <link rel="stylesheet" href="css/style.css">
  



</head>

<body>

  <nav class="navbar navbar-default" style="background-color:#FFD100;">
  <a style="float: left;" href="principal.php"><img src="img/logo.png" width="327" height="58"  alt=""/></a>
  <div class="navbar-header">
    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

    
  </div>

  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a tabindex="0" href="listacotizacion.php">COTIZACIONES</a>
      </li>
      
      
      <li class="dropdown">
        <a tabindex="0" data-toggle="dropdown" aria-expanded="false">ALTAS<span class="caret"></span></a>

        <!-- role="menu": fix moved by arrows (Bootstrap dropdown) -->
        <ul class="dropdown-menu" role="menu">
        	<li><a tabindex="0" href="listados.php?descri=clientes">Clientes</a></li>
        	<li class="divider"></li>
       		<li><a tabindex="0" href="listados.php?descri=monedas">Monedas</a></li>
        	<li class="divider"></li>
          	<li><a tabindex="0" href="listados.php?descri=paises">Países</a></li>
            <li class="divider"></li>
            <li><a tabindex="0" href="listados.php?descri=unidades">Unidades</a></li>
            <li class="divider"></li>
            <li><a tabindex="0" href="listados.php?descri=tiposdegastos">Tipos de Gastos</a></li>
            <li class="divider"></li>
            <li><a tabindex="0" href="listados.php?descri=servicios">Servicios</a></li>
        </ul>
      </li>
    </ul>

    <!--<ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a tabindex="0" data-toggle="dropdown">Dropdown 3<span class="caret"></span></a>

        
        <ul class="dropdown-menu" role="menu">
          <li><a tabindex="0">Action</a></li>
          <li><a tabindex="0">Another action</a></li>
          <li><a tabindex="0">Something else here</a></li>
          <li class="divider"></li>
          <li><a tabindex="0">Separated link</a></li>
        </ul>
      </li>
    </ul>
    -->
  </div>
</nav>

<div class="container">


<div class="table-responsive">
        <div class="panel panel-default">
          <div class="panel-heading" style="height: 52px;">
            COTIZACIONES
            <a href="altacotizacion.php"><button type="button" class="btn   btn-sm pull-right" data-toggle="modal" data-target="#myModal" >NUEVO</button></a>
          </div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Numero</th>
                  <th>Razon Social</th>
                  <th>Vigencia</th>
                  <th>Servicio</th>
                  <th>Ciudad Origen</th>
                  <th>Ciudad Destino</th>
                  <th>Estado</th>
                  <th>Accion</th>
                </tr>
              </thead>
          
          <tbody>
            <form role="form" name="listacotizacion" method="post" action="" id="listacotizacion">
            	<?php 	if ($cantidad > 0)
						{ 
							while ($arr = mysqli_fetch_array($rb))		
							{	 
 				?>
                <tr>
                  <th><?php echo $id_cotizacion = trim($arr['id_cotizacion']);?></th>
                  <th><?php echo $razon_social = utf8_encode($arr['descricliente']);?></th>
                  <th style="width:100px"><?php echo $vigencia = date("d-m-Y", strtotime(trim($arr['vigencia'])));?></th>
                  <th><?php echo $servicio = utf8_encode($arr['desservicio']);?></th>
                  <th><?php echo $servicio = utf8_encode($arr['ciudad_origen']);?></th>
                  <th><?php echo $servicio = utf8_encode($arr['ciudad_destino']);?></th>
                  <th><?php echo $estado = trim($arr['desestado']);?></th>
                 <th style="width:270px"><a href="modificocotizacion.php?id=<?php echo $arr['id_cotizacion']; ?>"><button type="button" class="btn btn-warning">MODIFICAR</button></a>
        			<a href="listacotizacion.php?acc=c&id=<?php echo $arr['id_cotizacion']; ?>"><button type="button" class="btn " id="BTNCLONAR" name="BTNCLONAR" >CLONAR</button></a>
       			  <a href="pdf/uno.php?id=<?php echo $arr['id_cotizacion']; ?>"><button type="button" class="btn btn-default" id="BTNgenpdf" name="BTNgenpdf"> PDF</button></a></th>
                </tr>
             	<?php 		}
						} ?>      
            </form>
          </tbody>
          </table>
        </div>


<div align="center"><?php 
if(($pagina - 1) > 0)
{
	echo " <a href='listacotizacion.php?pagina=".($pagina-1)."'>Anterior</a>"; 
}

for ($i=1;$i<=$total_paginas;$i++)
{
	if($pagina == $i)
	{
		echo "<b> ".$pagina."</b>";
	}else{
		echo " <a href=listacotizacion.php?pagina=$i>$i</a>";
	}
}

if(($pagina + 1) <= $total_paginas)
{
	echo " <a href='listacotizacion.php?pagina=".($pagina+1)."'>Siguiente</a>";
}
?></div>



</div>

  	<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
	<script src='http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js'></script>
    <script src="js/index.js"></script>
</body>
</html>
