<?php

class Model_proveedor extends CI_Model {
    

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_tienda','tienda');
        $this->load->helper('url');
    }

    public function Lista($offset, $limit) {
        $TodosProductos = array();
        $productos=$this->tienda->Productos($offset, $limit);
        foreach($productos as $producto){
            $TodosProductos[$producto['Codigo']] = array(
                'nombre' => $producto['Nombre'],
                'descripcion' => $producto['Descripcion'],
                'precio' => $producto['Precio'],
                'img' => 'http://iessansebastian.com/alumnos/2daw1516/adrian/Tienda_online/'.$producto['Imagen_Producto'],
                'url' => site_url('/Tienda_online/index.php/Entrada/detalles_producto/' .$producto['Codigo'])
            );
        }
        
        return $TodosProductos;
    }

    public function Total() {
        return $this->tienda->Total_Productos();
    }

}
