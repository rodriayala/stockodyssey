<?php

class ABMstockcartas {

  public function insertarStock(GSstock $gsc){
  
    $id_usuario_carga = $gsc->getId_usuario_carga();
    $id_card = $gsc->getId_card();
    $fecha_alta = $gsc->getFecha_alta();  
    $precio_compra = $gsc->getPrecio_compra();
	$estado_carta = $gsc->getEstado_carta();
	$estado_venta = $gsc->getEstado_venta();
	
    $insertarOK = false;

    $query = "INSERT INTO `stock_actual`(`id_usuario_carga`, `id_card`, `fecha_alta`, `precio_compra`, `estado_carta`, `estado_venta`) 
	VALUES ('$id_usuario_carga','$id_card','$fecha_alta','$precio_compra','$estado_carta','$estado_venta')";
    $connection = conectar();
     
    $result = mysqli_query($connection,$query);

    if (!$result)
    {
      $error = "Error: (" . mysqli_errno($connection) . ") " . mysqli_error($connection).")";
      mysqli_close($connection);
      exit();
    }
    else
    {
      $insertarOK = true;
      mysqli_close($connection);
      return $insertarOK;
    }
  }
    
    	
  public function deleteStock($id)
  {
    $deleteOK = false;
    $connection = conectar();   
    $query = "DELETE FROM stock_actual WHERE id_stock = '$id'";
    $result = mysqli_query($connection,$query);

    if (!$result)
    {
      $error = "Error: (" . mysqli_errno($connection) . ") " . mysqli_error($connection).")";
      mysqli_close($connection);
      exit();
    }
    else
    {
      $deleteOK = true;
      mysqli_close($connection);
      return $deleteOK;
    }    
  }
	
  public function updateStock(GSstock $gsc, $id)
  {
	$id_usuario_carga = $gsc->getId_usuario_carga();
    $id_card = $gsc->getId_card();
    $fecha_alta = $gsc->getFecha_alta();  
    $precio_compra = $gsc->getPrecio_compra();
	$estado_carta = $gsc->getEstado_carta();
	$estado_venta = $gsc->getEstado_venta();  
	  
    $updateOK = false;
	
    $connection = conectar();

    $query = "UPDATE `stock_actual` SET `id_usuario_carga`= '$id_usuario_carga',`id_card`='$id_card',`fecha_alta`='$fecha_alta',`precio_compra`='$precio_compra',`estado_carta`='$estado_carta',`estado_venta`='$estado_venta' WHERE `id_stock` = '$id'";
    $result = mysqli_query($connection,$query);

    if (!$result)
    {
      $error = "Error: (" . mysqli_errno($connection) . ") " . mysqli_error($connection).")";
      mysqli_close($connection);
      exit();
    }
    else
    {
      $updateOK = true;
      mysqli_close($connection);
      return $updateOK;
    }
  }

  public function getAllStock()
  {
    $connection = conectar();
    $query = "SELECT * FROM stock_actual ORDER BY id_stock ASC;";
    $result = mysqli_query($connection,$query);

    if (!$result)
    {
      $error = "Error: (" . mysqli_errno($connection) . ") " . mysqli_error($connection).")";
      mysqli_close($connection);
      exit();
    }
    else
    {
      mysqli_close($connection);
      return $result;
    }
  }

  public function getStockById($id)
  {
    $connection = conectar();
    $query = "SELECT * FROM stock_actual WHERE id_stock = '$id'";
    $result = mysqli_query($connection,$query);

    if (!$result)
    {
      $error = "Error: (" . mysqli_errno($connection) . ") " . mysqli_error($connection).")";
      mysqli_close($connection);
      exit();
    }
    else
    {
      mysqli_close($connection);
      return $result;
    }
  }

  public function getStockByNombreCarta($nombre)
  {
    $connection = conectar();
    $query = "SELECT * FROM stock_actual
			  left join cards_scg on stock_actual.id_card = cards_scg.id 
			  WHERE LOWER (cards_scg.card_name) like '%". strtolower($nombre)."%' order by card_name limit 100";
    #echo $query;
	$result = mysqli_query($connection,$query);

    if (!$result)
    {
      $error = "Error: (" . mysqli_errno($connection) . ") " . mysqli_error($connection).")";
      mysqli_close($connection);
      exit();
    }
    else
    {
      mysqli_close($connection);
      return $result;
    }
  }
}

