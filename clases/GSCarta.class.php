<?php 

class GSCarta
{

  	private $id;
    private $nombre;
    private $edicion;
    private $url;
    private $precio;
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEdicion() {
        return $this->edicion;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setEdicion($edicion) {
        $this->edicion = $edicion;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }
    
}