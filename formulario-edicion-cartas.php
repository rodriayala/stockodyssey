<?php
require('clases/abm-cartas.class.php');
require('clases/GSCarta.class.php');

$id=$_GET['id'];

	if($_POST)
	{
		if ($_POST['modificar'])
		{
			$nombre=trim($_POST['card_name']);
			$edicion=trim($_POST['card_edition']);
			$url=trim($_POST['card_url']);
			$precio=trim($_POST['card_price']);
			$id=trim($_POST['id']);
			$todo_ok = true;
        if (strlen($nombre) == 0) {
            $mal_nombre = true;
            $todo_ok = false;
        }
        if (strlen($edicion) == 0) {
            $mal_edicion = true;
            $todo_ok = false;
        }
        if (strlen($url) == 0) {
            $mal_url = true;
            $todo_ok = false;
        }
        if (strlen($precio) == 0) {
            $mal_precio = true;
            $todo_ok = false;
        }
        if ($todo_ok == true) {
					$gscarta=new GSCarta();
					$gscarta->setNombre($nombre);
					$gscarta->setEdicion($edicion);
					$gscarta->setUrl($url);
					$gscarta->setPrecio($precio);
					$abmcarta=new ABMCarta();
					$updateOK = $abmcarta->updateCarta($gscarta,$id);

			}
		}
	}
	else
	{
		$abmcarta = new ABMCarta();
		$result = $abmcarta->getCartaById($id);	

		while ($fila = mysqli_fetch_array($result))
		{
			$nombre = trim($fila['card_name']);
			$edicion = trim($fila['card_edition']);
			$url = trim($fila['card_url']);
			$precio = trim($fila['card_price']);
		}	
	}

	if (!isset($mal_nombre)) $mal_nombre = 0;
	if (!isset($mal_edicion)) $mal_edicion = 0;
	if (!isset($mal_url)) $mal_url = 0;
	if (!isset($mal_precio)) $mal_precio = 0;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Formulario de Edición de Cartas</title>
	</head>
	<body>
		<script>
			var updateOK = <?php echo $updateOK; ?>;
			if(updateOK==true)
			{
				alert("Carta modificada correctamente.");
				window.location.href = 'listado-cartas.php';
			}
		</script>

		<form action="" method="post">
			<table border="1" >
				<thead>
					<tr>
					<th colspan="2">Editar Carta</th>
					</tr>
				</thead>
				<tr>
					<th>Nombre:</th>
					<th><input type="text" id="card_name" name="card_name" tabindex="1" value="<?php echo $nombre; ?>">
					</th>
				</tr>
				<?php 
					if($mal_nombre==true)
				{ ?>
				<tr>
					<th><div class="alert alert-danger">
					<strong>¡ATENCION!</strong> Este campo tiene que estar completo.
					</div></th>	
					<th></th>
				</tr>	
				<?php
				}
				?>		
				<tr>
					<th>Edición:</th><th><input type="text" id="card_edition" name="card_edition" tabindex="2" value="<?php echo $edicion; ?>"></th>
				</tr>
				<?php 
				if($mal_edicion==true) { ?>	
				<tr>
				<th><div class="alert alert-danger">
				<strong>¡ATENCION!</strong> Este campo tiene que estar completo.
				</div></th>

				</tr>	
				<?php } ?>
				<tr>
				<th>URL:</th><th><input type="text" id="card_url" name="card_url" tabindex="3" value="<?php echo $url; ?>"></th>
				<tr>
					<?php if($mal_url==true) { ?>
					<th>
					<div class="alert alert-danger">
					<strong>¡ATENCION!</strong> Este campo tiene que estar completo.
					</div>
					</th>
					</tr>	
					<?php } ?>
				</tr>
				<tr>
					<th>Precio:</th><th><input type="text" id="card_price" name="card_price" tabindex="4" value="<?php echo $precio; ?>"></th>
				</tr>
				<tr>
					<?php if($mal_precio==true) { ?>
					<th>
						<div class="alert alert-danger">
							<strong>¡ATENCION!</strong> Este campo tiene que estar completo.
						</div>
					</th>	
					<?php } ?>
				</tr>
				<tr>
					<th colspan="2"><input type="submit" name="modificar" id="modificar" value="modificar"></th>
				</tr>
				<input type="hidden" name="id" value=<?php echo $id; ?> />
			</table>
		</form>
	</body>
</html>