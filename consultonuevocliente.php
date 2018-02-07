<?php
//error_reporting(0);
include_once("funciones.php");

$Xidapellido = trim($_GET['idapellido']);

$sql = " SELECT * FROM `clientes` WHERE id_clientes = '$Xidapellido' limit 1";
//echo $sql;
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
	$Xapellidos		= trim($res['apellidos']);
	$Xnombres		= trim($res['nombres']);
	$Xcomentarios	= trim($res['comentarios']);

	echo '<div id="nuevocli" style="display:block">
          	<div class="form-group">
            	<label class="control-label col-md-2" for="example-firstname">Apellidos Cliente</label>
                	<div class="col-md-3">
                    	<input type="text" id="apellidos" name="apellidos" class="form-control" value="'.$Xapellidos.'">
                    </div>
             </div>
             <div class="form-group">
              	<label class="control-label col-md-2" for="example-lastname">Nombres Cliente</label>
                	<div class="col-md-3">
                    	<input type="text" id="nombres" name="nombres" class="form-control" value="'.$Xnombres.'">
                	</div>
             </div>
             <div class="form-group">
             	<label class="control-label col-md-2" for="example-address">Lugar Compra</label>
                	<div class="col-md-3">
                                        <select id="lugarcompra" name="lugarcompra" class="form-control">
                                          <option value="Facebook">Facebook</option>
                                          <option value="Mercado Libre">Mercado Libre</option>
                                          <option value="Carpeta">Carpeta</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="example-city">Estado</label>
                                    <div class="col-md-3">
                                        <select id="estadocompra" name="estadocompra" class="form-control">
                                          <option value="Reservado">Reservado</option>
                                          <option value="Comprado">Comprado</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2" for="example-city">Cobro</label>
                                    <div class="col-md-3">
                                        <select id="cobro" name="cobro" class="form-control">
                                          <option value="De Palabra">De Palabra</option>
                                          <option value="Reservado">Reservado</option>
                                          <option value="Pagado">Págado</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2" for="example-city">Entrega</label>
                                    <div class="col-md-3">
                                        <select id="entrega" name="entrega" class="form-control">
                                          <option value="No">No</option>
                                          <option value="Si">Si</option>
                                          <option value="Correo">En el Correo</option>
                                    </select>
                                    </div>
                                </div>
                                
              <div class="form-group">
              	<label class="control-label col-md-2" for="example-textarea-large">Comentarios</label>
                	<div class="col-md-10">
                    	<textarea id="comentarios" name="comentarios" class="form-control" rows="10">'.$Xcomentarios.'</textarea>
                    </div>
              </div>
                                                                                            
           </div>';
}

?>