<?php
require('clases/abm-usuarios.class.php');
require('clases/GSUsuario.class.php');
	
	$id=$_GET['id_usuario'];

	if($_POST)
	{
		if ($_POST['modificar'])
		{
			$nombre=trim($_POST['nombre_usuario']);
			$email=trim($_POST['mail_usuario']);
			$descripcion=trim($_POST['descripcion_usuario']);
			$password=trim($_POST['password_usuario']);
			$id=trim($_POST['id_usuario']);

			$todo_ok = true;

	        if (strlen($nombre) == 0) {
	            $mal_nombre = true;
	            $todo_ok = false;
	        }
	        if (strlen($email) == 0) {
	            $mal_email = true;
	            $todo_ok = false;
	        }
	        if (strlen($descripcion) == 0) {
	            $mal_descripcion = true;
	            $todo_ok = false;
	        }
	        if (strlen($password) == 0) {
	            $mal_password = true;
	            $todo_ok = false;
	        }

	        if ($todo_ok == true) {
				$gsusuario=new GSUsuario();
				$gsusuario->setNombre($nombre);
				$gsusuario->setMail($email);
				$gsusuario->setDescripcion($descripcion);
				$gsusuario->setPassword($password);

				$abmusuario=new ABMUsuario();
				$updateOK = $abmusuario->updateUsuario($gsusuario,$id);
			}
		}
	}else{#primer post
		$abmusuario = new ABMUsuario();
		$result = $abmusuario->getUsuarioById($id);	

		while ($fila = mysqli_fetch_array($result))
		{
			$nombre = trim($fila['nombre_usuario']);
			$email = trim($fila['mail_usuario']);
			$descripcion = trim($fila['descripcion_usuario']);
			$password = trim($fila['password_usuario']);
		}	
	}


	if (!isset($mal_nombre)) $mal_nombre = 0;
	if (!isset($mal_email)) $mal_email = 0;
	if (!isset($mal_descripcion)) $mal_descripcion = 0;
	if (!isset($mal_password)) $mal_password = 0;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Formulario de Edición de Usuario</title>
</head>
<body>
	<script>
		var updateOK = <?php echo $updateOK; ?>;
		if(updateOK==true)
		{
			alert("Usuario modificado correctamente.");
			window.location.href = 'abm-usuarios.php';
		}
	</script>

<form action="" method="post">

	<table border="1" >
		<thead>
			<tr>
     			<th colspan="2">Editar Usuario</th>
  			</tr>
		</thead>
		<tr>
			<th>Nombre:</th>
			<th><input type="text" id="nombre_usuario" name="nombre_usuario" tabindex="1" value="<?php echo $nombre; ?>">
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
			<th>E-mail:</th><th><input type="text" id="mail_usuario" name="mail_usuario" tabindex="2" value="<?php echo $email; ?>"></th>
		</tr>
			<?php 
                if($mal_email==true) { ?>	
                    <tr>
	                    <th><div class="alert alert-danger">
						  <strong>¡ATENCION!</strong> Este campo tiene que estar completo.
						</div></th>
						
					</tr>	
			<?php } ?>
		<tr>
			<th>Descripción:</th><th><input type="text" id="descripcion_usuario" name="descripcion_usuario" tabindex="3" value="<?php echo $descripcion; ?>"></th>
			<tr>
			<?php if($mal_descripcion==true) { ?>
            <th>
            	<div class="alert alert-danger">
					<strong>¡ATENCION!</strong> Este campo tiene que estar completo.
				</div>
			</th>
			</tr>	
			<?php } ?>
		</tr>
		<tr>
			<th>Password:</th><th><input type="password" id="password_usuario" name="password_usuario" tabindex="4" value="<?php echo $password; ?>"></th>
		</tr>
		<tr>
			<?php if($mal_password==true) { ?>
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
		<input type="hidden" name="id_usuario" value=<?php echo $id; ?> />
		<input type="hidden" name="acc" value="modificacion"/>
	</table>
</form>

</body>
</html>