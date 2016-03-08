<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/JSON_WebServer_Controller.php');

class Proveedor_productos extends JSON_WebServer_Controller{

   public function __construct() {
       parent::__construct();
       $this->load->model('Model_proveedor', 'tienda_pro');
        $this->RegisterFunction('Total()', 'total de productos que existen en la BD');
        $this->RegisterFunction('Lista(offset, limit)', 'lista de productos de nuestra tienda empieza en offset y acaba en limit');
   }
/**
 * lista de productos de nuestra tienda 
 * @param type $offset
 * @param type $limit
 * @return type
 */
    public function Lista($offset, $limit) {
        return $this->tienda_pro->Lista($offset, $limit);
    }
/**
 *  total de productos que existen en la BD
 * @return type
 */
    public function Total() {
        return $this->tienda_pro->Total();
    }

}
