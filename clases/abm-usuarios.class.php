<?php
require('funciones.php');

class ABMUsuario {

    public function insertarUsuario(GSUsuario $gsu){
  
        $nombre=$gsu->getNombre();
        $mail=$gsu->getMail();
        $descripcion=$gsu->getDescripcion();  
        $password=$gsu->getPassword();

        $query = "INSERT INTO usuarios (nombre_usuario, mail_usuario, descripcion_usuario,password_usuario) VALUES ('$nombre', '$mail', '$descripcion','$password')";
    
          $connection = conectar();
           
          $result = mysqli_query($connection,$query);
                

          if (!$result)
          {
            mysqli_close($connection);
            $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
            $respuesta = false;
          }else{
            $respuesta = true;
          }
            
          
            mysqli_close($connection);
            return $respuesta;
    }
    
    	
    public function deleteUsuario($id)

    {
        
        $connection = conectar();   
        
        $query = "DELETE FROM usuarios WHERE id_usuario = '$id'";

        $result = mysqli_query($connection,$query);

   
        if (!$result)
          {
            mysqli_close($connection);
            $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
            $respuesta = false;
          }else{
            $respuesta = true;
          }
            
          
            mysqli_close($connection);
            return $respuesta;
    }
	
    public function updateUsuario(GSUsuario $gsu, $id)

    {

        $connection = conectar();

        $nombre=$gsu->getNombre();
        $mail=$gsu->getMail();
        $descripcion=$gsu->getDescripcion();
        $password=$gsu->getPassword();


        $query = "UPDATE usuarios SET "
                . "nombre_usuario = '$nombre', "
                . "mail_usuario = '$mail', "
                . "descripcion_usuario  = '$descripcion', "
                . "password_usuario = '$password' "
                . "WHERE id_usuario = '$id'";
         
        $result = mysqli_query($connection,$query);
              
      if (!$result)
          {
            mysqli_close($connection);
            $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
            $respuesta = false;
          }else{
            $respuesta = true;
          }
            
          
            mysqli_close($connection);
            return $respuesta;
    }
  
	
    public function getAllUsuario()

    {

      $connection = conectar();

      $query = "SELECT * FROM usuarios ORDER BY id_usuario DESC;";
      
      $result = mysqli_query($connection,$query);
      
      if (!$result){
        echo 'error select usuarios'; 
        mysqli_close($connection);
        exit();
      }  
    
      mysqli_close($connection);
     
      return $result;
    }
	
    public function getUsuarioById($id)

    {
      
      $connection = conectar();

      $query = "SELECT * FROM usuarios 
                        WHERE id_usuario = '$id'";

      //  echo $query;


      $result = mysqli_query($connection,$query);

      
      if (!$result){
        echo 'error select usuarios'; 
        mysqli_close($connection);
        exit();
      }  
    
      mysqli_close($connection);
     
      return $result; 
    }
}