<?php
require('funciones.php');

class ABMCarta {

    public function insertarCarta(GSCarta $gsc){
  
        $nombre=$gsu->getNombre();
        $edicion=$gsu->getEdicion();
        $url=$gsu->getUrl();  
        $precio=$gsu->getPrecio();

        $query = "INSERT INTO cards_scg (card_name, card_edition, card_url, card_price) VALUES ('$nombre', '$edicion', '$url','$precio')";
    
          $connection = conectar();
           
          $result = mysqli_query($connection,$query);
                

          if (!$result)
          {
            mysqli_close($connection);
            $error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
            $insertarOK = false;
          }else{
            $insertarOK = true;
          }

            mysqli_close($connection);
            return $insertarOK;
    }
    
    	
    public function deleteCarta($id)

    {
        $deleteOK = false;
        $connection = conectar();   
        $query = "DELETE FROM cards_scg WHERE id = '$id'";
        $result = mysqli_query($connection,$query);

      if (!$result)
      {
        mysqli_close($connection);
        $error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
      }
      else
      {
        $deleteOK = true;
      }
        mysqli_close($connection);
        return $deleteOK;

      
    }
	
    public function updateCarta(GSCarta $gsc, $id)

    {
        $updateOK = false;
        $connection = conectar();
        $nombre=$gsu->getNombre();
        $edicion=$gsu->getEdicion();
        $url=$gsu->getUrl();
        $precio=$gsu->getPrecio();


        $query = "UPDATE cards_scg SET "
                . "card_name = '$nombre', "
                . "card_edition = '$edicion', "
                . "card_url  = '$url', "
                . "card_price = '$precio' "
                . "WHERE id = '$id'";
         
        $result = mysqli_query($connection,$query);
              
      if (!$result)
          {
            mysqli_close($connection);
            $error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
            exit();
          }
          else
          {
            $updateOK = true;
          }

            mysqli_close($connection);
            return $updateOK;
    }
  
	
    public function getAllCartas()

    {

      $connection = conectar();

      $query = "SELECT * FROM cards_scg ORDER BY id ASC;";
      
      $result = mysqli_query($connection,$query);
      
      if (!$result){
        echo 'error select cards_scg'; 
        mysqli_close($connection);
        exit();
      }  
    
      mysqli_close($connection);
     
      return $result;
    }
	
    public function getCartaById($id)
    {
      $connection = conectar();
      $query = "SELECT * FROM cards_scg WHERE id = '$id'";
      $result = mysqli_query($connection,$query);
 
      if (!$result){
        echo 'error select cards_scg'; 
        mysqli_close($connection);
        exit();
      }  
      mysqli_close($connection);
      return $result; 
    }


    public function getCartaByNombre($nombre)
        {
      
      $connection = conectar();

      $query = "SELECT * FROM cards_scg 
                        WHERE LOWER (card_name) ='". strtolower($nombre)."'";

      $result = mysqli_query($connection,$query);
  
      if (!$result){
        echo 'error select cards_scg'; 
        mysqli_close($connection);
        exit();
      }  
    
      mysqli_close($connection);
      return $result; 
    }
}