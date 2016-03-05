<?php

class model_tienda extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function traer_categorias(){
                
        $query = $this->db->query('SELECT * FROM categorias WHERE oculto="F"');
        return $query->result();
        
    
    } 
    public function traer_destacados(){
        $query=$this->db->query('SELECT * FROM productos WHERE Destacado="S"');
        
        return $query->result();
    }
    
    public function traer_productos($condicion,$categoria){
        
        $query=$this->db->query('SELECT * FROM productos WHERE '. $condicion.'='.$categoria);
        
        return $query->result();
    }
    public function Un_producto($id){
        
        $query=$this->db->query('SELECT * FROM productos WHERE Codigo='.$id);
        
        return $query->row();
    }
    
    public function Comprueba_usuario($usuario, $pass){
        
       
        $query=$this->db->query("SELECT count(*) as 'total' FROM compradores WHERE Nombre_usuario = '".$usuario."' AND Contrasena='".$pass."';");
        $a=$query->row();
        $a=(array)$a;
       
        if ($a['total'] == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    public function traer_usuario($login){
      
         $query=$this->db->query("SELECT *  FROM compradores WHERE Nombre_usuario = '".$login."'");
         
          return $query->row();
        
    }
    public function usuarioRepetido($login){
         $query=$this->db->query("SELECT count(*)as repetido  FROM compradores WHERE Nombre_usuario = '".$login."'");
         
         return $query->row()->repetido;
    }
    public function ObtenerCodigo($login){
        $query=$this->db->query("SELECT Codigo as codigo  FROM compradores WHERE Nombre_usuario = '".$login."'");
         
         return $query->row()->codigo;
    }
    
    public function InsertUser($datos){
       
       $this->db->insert('compradores',$datos);
    }
    public function ModificarUser($id,$datos){
        $this->db->where('Nombre', $id);
        $this->db->update('compradores', $datos); 
    }
    public function NuevoPedido($datos){
        
        $this->db->insert('pedidos',$datos);
    }
    public function NuevaLineaPedido($datos){
        
        $this->db->insert('lineas_de_pedido',$datos);
    }
    public function Extraer($query)
    {
         $query=$this->db->query($query);
         
          return $query->result_array();
    }
    public function RestarStock($data,$where){
       $q='UPDATE productos
                                SET '.$data.' WHERE '.$where."';";
       
        $this->db->query($q);
        
    }
    public function TraerStock($id){
        
        $query=$this->db->query("SELECT Stock FROM productos WHERE Codigo = '".$id."'");
        return $query->row(); 
    }
    public function Mispedidos($id){
        
         $query=$this->db->query("SELECT * FROM pedidos WHERE Compradores_Codigo = '".$id."'");
        return $query->result_array(); 
    }
    public function TraerLineasPedido($idpedido){
        $query=$this->db->query("SELECT Nombre,Cantidad,Importe,Pedidos_codigo_pedido, Precio FROM lineas_de_pedido,productos WHERE lineas_de_pedido.Productos_Codigo=productos.Codigo AND Pedidos_codigo_pedido= '".$idpedido."'");
        return $query->result_array(); 
    }
    public function AnularPedido($id){
        $q='UPDATE pedidos SET Estado="AN" WHERE codigo_pedido="'.$id.'";';
        $this->db->query($q);
    }
    public function TraerUnpedido($id){
        $query=$this->db->query("SELECT * FROM pedidos WHERE codigo_pedido = '".$id."'");
        return $query->result_array(); 
    }
    public function ContarPedidos($id){
         $query=$this->db->query("SELECT count(*) as 'total' FROM pedidos WHERE Compradores_Codigo = '".$id."'");
        return $query->row()->total;
    }
    public function AñadirCategoria($categoria){
        $this->db->insert($categoria);
    }
}
   



