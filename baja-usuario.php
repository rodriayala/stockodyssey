<?php
require('clases/abm-usuarios.class.php');
require('clases/GSUsuario.class.php');

	$id=$_GET['id_usuario'];
	$nombre=$_POST['nombre_usuario'];
	$mail=$_POST['mail_usuario'];
	$descripcion=$_POST['descripcion_usuario'];
	$password=$_POST['password_usuario'];

		$abmusuario = new ABMUsuario();
		$deleteOK = $abmusuario->deleteUsuario($id);
		header("location: abm-usuarios.php?deleteOK=$deleteOK");
		exit();

 ?>