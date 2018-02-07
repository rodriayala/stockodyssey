<?php 

class GSstock
{

private $id_stock;
private $id_usuario_carga;
private $id_card;
private $fecha_alta;
private $precio_compra;
private $estado_carta;
private $estado_venta;

function setId_stock($id_stock) { $this->id_stock = $id_stock; }
function getId_stock() { return $this->id_stock; }
function setId_usuario_carga($id_usuario_carga) { $this->id_usuario_carga = $id_usuario_carga; }
function getId_usuario_carga() { return $this->id_usuario_carga; }
function setId_card($id_card) { $this->id_card = $id_card; }
function getId_card() { return $this->id_card; }
function setFecha_alta($fecha_alta) { $this->fecha_alta = $fecha_alta; }
function getFecha_alta() { return $this->fecha_alta; }
function setPrecio_compra($precio_compra) { $this->precio_compra = $precio_compra; }
function getPrecio_compra() { return $this->precio_compra; }
function setEstado_carta($estado_carta) { $this->estado_carta = $estado_carta; }
function getEstado_carta() { return $this->estado_carta; }
function setEstado_venta($estado_venta) { $this->estado_venta = $estado_venta; }
function getEstado_venta() { return $this->estado_venta; }
    
}