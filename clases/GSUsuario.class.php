<?php 

class GSUsuario
{

  	private $id;
    private $nombre;
    private $mail;
    private $descripcion;
    private $password;
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    
}

 ?>