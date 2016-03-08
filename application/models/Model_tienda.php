<?php
/**
 * Modelo de nuestra tienda el cual interactuara con la base de datos
 * tienda_online , sera el encargado de todas las operaciones con ella.
 */
class model_tienda extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    /**
     * 
     * @return array de categorias, devuelve toda las categorias existentes
     */
    public function traer_categorias(){
                
        $query = $this->db->query('SELECT * FROM categorias WHERE oculto="F"');
        return $query->result();
        
    
    } 
    /**
     * 
     * @return array de productos destacados.
     */
    public function traer_destacados(){
        $query=$this->db->query('SELECT * FROM productos WHERE Destacado="S"');
        
        return $query->result();
    }
    /**
     * 
     * @param type $condicion de busqueda
     * @param type $categoria categoria de producto por donde buscar
     * @return array de productos de cada categoria.
     */
    public function traer_productos($condicion,$categoria){
        
        $query=$this->db->query('SELECT * FROM productos WHERE '. $condicion.'='.$categoria);
        
        return $query->result();
    }
    /**
     * 
     * @param type $id del producto
     * @return array con los datos del producto
     */
    public function Un_producto($id){
        
        $query=$this->db->query('SELECT * FROM productos WHERE Codigo='.$id);
        
        return $query->row();
    }
    /**
     * 
     * @param type $usuario login del usuario
     * @param type $pass contraseña del usuario
     * @return boolean si el usuario es correcto true
     */
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
    /**
     * 
     * @param type $login del usuario para la busqueda.
     * @return objeto usuario con todos los datos del usuario
     */
    public function traer_usuario($login){
      
         $query=$this->db->query("SELECT *  FROM compradores WHERE Nombre_usuario = '".$login."'");
         
          return $query->row();
        
    }
    /**
     * 
     * @param type $login busqueda por login
     * @return type devuelve 1 si el usuario es repedito 0 sino lo es
     */
    public function usuarioRepetido($login){
         $query=$this->db->query("SELECT count(*)as repetido  FROM compradores WHERE Nombre_usuario = '".$login."'");
         
         return $query->row()->repetido;
    }
    /**
     * 
     * @param type $login de usuario
     * @return type registro del codigo de usuario
     */
    public function ObtenerCodigo($login){
        $query=$this->db->query("SELECT Codigo as codigo  FROM compradores WHERE Nombre_usuario = '".$login."'");
         
         return $query->row()->codigo;
    }
    /**
     * Inserta el usuario
     * @param type $datos array con los datos de los usuarios
     */
    public function InsertUser($datos){
       
       $this->db->insert('compradores',$datos);
    }
    /**
     * modifica los campos del usuario.
     * @param type $id numerico para busqueda
     * @param type $datos de modificacion array
     */
    public function ModificarUser($id,$datos){
        $this->db->where('Nombre', $id);
        $this->db->update('compradores', $datos); 
    }
    /**
     * 
     * @param array $datos inserta los datos de un pedido
     */
    public function NuevoPedido($datos){
        
        $this->db->insert('pedidos',$datos);
    }
    /**
     * inserta una linea de pedido
     * @param array $datos de la nueva linea de pedido
     */
    public function NuevaLineaPedido($datos){
        
        $this->db->insert('lineas_de_pedido',$datos);
    }
    /**
     * Consulta a la base de datos, generica  
     * @param type $query consulta
     * @return type array con resultado
     */
    public function Extraer($query)
    {
         $query=$this->db->query($query);
         
          return $query->result_array();
    }
    /**
     * REstamos los productos comprados al stock del producto
     * @param array $data datos a actualizar
     * @param string $where donde actualizamos
     */
    public function RestarStock($data,$where){
       $q='UPDATE productos
                                SET '.$data.' WHERE '.$where."';";
       
        $this->db->query($q);
        
    }
    /**
     * Obtener el stock de un producto
     * @param type $id para obtener el stock de un producto
     * @return resultado numerico
     */
    public function TraerStock($id){
        
        $query=$this->db->query("SELECT Stock FROM productos WHERE Codigo = '".$id."'");
        return $query->row(); 
    }
    /**
     * Obtener los pedidos de un usuario
     * @param type $id del usuario
     * @return type array de pedidos
     */
    public function Mispedidos($id){
        
         $query=$this->db->query("SELECT * FROM pedidos WHERE Compradores_Codigo = '".$id."'");
        return $query->result_array(); 
    }
    /**
     *  devuelve todas las linea del pedido
     * @param type $idpedido codigo del pedido
     * @return type array de linea de pedido
     */
    public function TraerLineasPedido($idpedido){
        $query=$this->db->query("SELECT Nombre,Cantidad,Importe,Pedidos_codigo_pedido, Precio FROM lineas_de_pedido,productos WHERE lineas_de_pedido.Productos_Codigo=productos.Codigo AND Pedidos_codigo_pedido= '".$idpedido."'");
        return $query->result_array(); 
    }
    /**
     * Anula un pedido poniendo el campo estado a anulado
     * @param type $id identificador del pedido
     */
    public function AnularPedido($id){
        $q='UPDATE pedidos SET Estado="AN" WHERE codigo_pedido="'.$id.'";';
        $this->db->query($q);
    }
    /**
     *  devuelve un pedido
     * @param type $id identificador
     * @return type array del pedido
     */
    public function TraerUnpedido($id){
        $query=$this->db->query("SELECT * FROM pedidos WHERE codigo_pedido = '".$id."'");
        return $query->result_array(); 
    }
    /**
     * Devuelve el numero de pedidos de un usuario
     * @param type $id identificador
     * @return type numerico de pedido
     */
    public function ContarPedidos($id){
         $query=$this->db->query("SELECT count(*) as 'total' FROM pedidos WHERE Compradores_Codigo = '".$id."'");
        return $query->row()->total;
    }
    /**
     * añade nueva categoria
     * @param type $categoria datos de la categoria
     */
    public function AñadirCategoria($categoria){
        $this->db->insert('categorias',$categoria);
        return $this->db->insert_id();
    }
    /**
     * Añade un nuevo producto
     * @param type $producto datos del producto
     */
    public function AñadirProducto($producto){
        $this->db->insert('productos',$producto);
        
    }
    public function ObtenerSiguienteIdProducto(){
        $q=$this->db->query("SELECT COUNT(*)as total FROM productos");
        return $q->row()->total+1;
    }
}
   



