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


			$gsusuario=new GSUsuario();
			$gsusuario->setNombre($nombre);
			$gsusuario->setMail($email);
			$gsusuario->setDescripcion($descripcion);
			$gsusuario->setPassword($password);

			$abmusuario=new ABMUsuario();
			$respuestaModificacion = $abmusuario->updateUsuario($gsusuario,$id);


			header("location: abm-usuarios.php");
			exit();
		}
	}
	$abmusuario = new ABMUsuario();
	$result = $abmusuario->getUsuarioById($id);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Formulario de Edición de Usuario</title>
</head>
<body>
	<script>
			if(respuestaModificacion==true)
		{
			alert("Usuario borrado correctamente.");
		}
	</script>

<form action="" method="post">

	<table border="1" >
		<thead>
			<tr>
     			<th colspan="2">Editar Usuario</th>
  			</tr>
		</thead>
		<?php 
			while ($fila = mysqli_fetch_array($result))
			{
		?>
		<tr>
			<th>Nombre:</th><th><input type="text" id="nombre_usuario" name="nombre_usuario" tabindex="1" value="<?php echo trim($fila['nombre_usuario']); ?>"></th>
		</tr>
		<tr>
			<th>E-mail:</th><th><input type="text" id="mail_usuario" name="mail_usuario" tabindex="2" value="<?php echo trim($fila['mail_usuario']); ?>"></th>
		</tr>
		<tr>
			<th>Descripción:</th><th><input type="text" id="descripcion_usuario" name="descripcion_usuario" tabindex="3" value="<?php echo trim($fila['descripcion_usuario']); ?>"></th>
		</tr>
		<tr>
			<th>Password:</th><th><input type="password" id="password_usuario" name="password_usuario" tabindex="4" value="<?php echo trim($fila['password_usuario']); ?>"></th>
		</tr>
		<tr>


			<th colspan="2"><input type="submit" name="modificar" id="modificar" value="modificar" onclick="usuarioModificado()"></th>

		</tr>
		<?php

			}

		?>
		<input type="hidden" name="id_usuario" value=<?php echo $id; ?> />
		<input type="hidden" name="acc" value="modificacion"/>


	</table>
</form>

</body>
</html>