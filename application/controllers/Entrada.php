<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controlador central de la aplicacion.
 */
class Entrada extends CI_Controller {
    /**
     * Esta funcion carga la vista principal y el helper url
     */
    public function index() {
        $this->load->helper('url');
        $this->load->view('Index');
        
        
    }
    /*
     * Controlador que invoca el formulario para importar Xml a nuestra base de datos
     */
    public function Importar(){
        
        $this->load->helper('url');
        $cuerpo = $this->load->view('FicheroImportarXml','', true);
        $this->load->view('Index', Array('cuerpo' => $cuerpo));
    }
    /**
     * Carga categorias y las muestra en el cuerpo de la vista
     * utilizando el modelo tienda.
     */
    public function Categorias() {
        
        $this->load->helper('url');
        $this->load->model('Model_tienda', "tienda");
        //llamamos a la funcion traer categorias para obtener todas las categorias de productos.0
        $categorias = $this->tienda->Traer_categorias();
        //Cargamos la vista en el cuerpo de la aplicacion.
        $cuerpo = $this->load->view('Categorias_view', Array('Categorias' => $categorias), true);
        
        $this->load->view('Index', Array('cuerpo' => $cuerpo));
        
    }
    /**
     * Cargamos los productos destacados y los mostramos en el cuerpo de la aplicacion.
     */
    
    public function Destacados(){
         
        $this->load->helper('url');
        $this->load->model('Model_tienda', "tienda");
        
        //Traemos los productos destacados 
        $destacados=$this->tienda->traer_destacados();
        
        $cuerpo = $this->load->view('Destacados_view', Array('destacados' => $destacados), true);
        
        $this->load->view('Index', Array('cuerpo' => $cuerpo));
        
    }
    /**
     * Cargamos los productos de una categoria en concreto y los cargamos en el cuerpo de la vista.
     * @param type $categoria id para obtener los productos de la categoria.
     */
    public function ver_categoria($categoria){
        
        $this->load->helper('url');
        $this->load->model('Model_tienda', "tienda");

        $productos=$this->tienda->traer_productos('Categoria_Codigo',$categoria);
        
        $cuerpo = $this->load->view('Productos_view', Array('productos' => $productos), true);
        
        $this->load->view('Index', Array('cuerpo' => $cuerpo));
    }
    /**
     * obtenemos los detalles de todos los datos de un producto y los mostramos en el cuerpo de la aplicacion.
     * @param type $id del producto para obtener todos sus datos.
     * Controlaños el añadir al carrito una vez mostrado el producto.
     */
    public function detalles_producto($id){
        $this->load->helper('url');
        $this->load->model('Model_tienda', "tienda");
        //si hay carrito lo añadimos si no lo mostramos.
        if(!$_POST){
            $detalles=$this->tienda->Traer_productos("Codigo",$id);
            $cuerpo = $this->load->view('Detallado_view', Array('detalles' => $detalles), true);
            $this->load->view('Index', Array('cuerpo' => $cuerpo));
        }
        else{
            
             $id_p=$this->input->post('id');
             $cant=$this->input->post('cantidad');
             $pre=$this->input->post('precio');
             
            
             if($cant<1){
                 
               $cuerpo = $this->load->view('Detallado_view', Array('detalles' => $detalles), true);
               $this->load->view('Index', Array('cuerpo' => $cuerpo));
               //Muestra Error cantidad superior a 1 y inferior a max_stock
                 
             }
             
             $producto=Array(
                 'id'=>$id_p,
                 'cantidad'=>$cant,
                 'precio'=>$pre
             );
             //añadimos al carrito  y mostramos el carrito.
             $this->AñadirCarrito($producto);
             $this->MostrarCarrito();
             
            
            
        }
        
    }
    /**
     * Añade un producto al carrito.
     * @param type $producto que añadimos al carrito (array)
     */
    public function AñadirCarrito($producto){
        
        $this->load->library('carrito');
        $this->carrito->add($producto);
        
    }
    /**
     * Muestra los productos del carrito
     */
    public function MostrarCarrito(){
        $this->load->helper('url');
        $this->load->library('carrito');
        $this->load->model('Model_tienda', "tienda");
        $numPro=$this->carrito->articulos_total();
        if($numPro>0){
        $productoFinal=Array();
        //traemos todos los productos del carrito
        $productos=$this->carrito->get_content();
        //recorremos los productos del carrito y los indexamos para pasarlos a la vista.
        foreach ($productos as $idx=>$producto){
            //Completamos todos los campos a sacar(Nombre,Categoria);
            
            $productos[$idx]['info']=$this->tienda->Un_producto($producto['id']);       
        }
        /*
        echo "<pre>";
        print_r($productos);
        echo "</pre>";
        */
        //metemos en la session los productos del carrito.
        $_SESSION['ElementosSeleccionados']=$productos;
        //pasamos el total que en principio sera 0
        $total=0;
        $cuerpo = $this->load->view('Mostrar_carrito', Array('productos' => $productos, 'total'=> $total), true);
        $this->load->view('Index', Array('cuerpo' => $cuerpo));
      
        
        }else{
        $cuerpo = $this->load->view('Mostrar_carrito_vacio',"", true);
        $this->load->view('Index', Array('cuerpo' => $cuerpo));
        }  
        
        
    }
    
        
    /**
     * Eliminamos un producto del carrito.
     * @param type $id para eliminar el producto del carrito
     */
    public function BorrarProductoCarrito($id){
         $this->load->helper('url');
         $this->load->library('carrito');
         
         $this->carrito->remove_producto($id);
         
        if($this->carrito->get_content()==NULL)
        {
            $this->carrito->destroy();
            redirect("","location",301);
        }else
        {
            redirect("/Entrada/MostrarCarrito","location",301);
        }
        
    }
    /**
     * eliminamos todos los elementos del carrito.
     */
    public function Vaciar_carrito(){
        $this->load->helper('url');
        $this->load->library('carrito');
        $this->carrito->destroy();
        redirect("","location",301);
  
    }
    /**
     * Ejecutamos al compra, si el usuario es correcto.
     */
    public function Comprar(){
        $this->load->helper('url');
        $this->load->library('carrito');
        
         if(!isset($_SESSION['usuario_correcto']) || $_SESSION['usuario_correcto']==FALSE){
             //activamos comprando para volver al sitio de compra una vez el usuario se haya registrado.
            $_SESSION['comprando']=true;
            redirect("/Login/verificar","location",301);
             
         }else
         {
             
             /*echo "<pre>";
             print_r($_SESSION['ElementosSeleccionados']);
             echo"</pre>";
             echo "<pre>";
             print_r($_SESSION['usuario']);
             echo"</pre>";
             */
              
            $cuerpo = $this->load->view('Resumen_pedido',Array('productos'=>$_SESSION['ElementosSeleccionados'],'usuario'=>$_SESSION['usuario'],'total'=>0), true);
            $this->load->view('Index', Array('cuerpo' => $cuerpo)); 
         }
        
    }
    /**
     * Finalizamos la compra, eliminamos la cantidad del stock de cada producto
     * Insertamos el pedido en la bd, y sus lineas de pedido.
     * Imprimimos el pdf y lo enviamos al correo.
     */
    public function Finalizar_compra(){
        
        $this->load->helper('url');
        $this->load->model('Model_tienda', "tienda");
        $this->load->library('carrito');
         
        
            $codigo=$this->tienda->ObtenerCodigo($_SESSION['usuario']['Nombre_usuario']);
//            print_r( $codigo);
        $datosPedido=Array('fecha'=>date('Y-m-d'),
                           'Estado'=>"NP",
                           'Compradores_Codigo'=>$codigo);
//         echo "<pre>";
//             print_r($datosPedido);
//         echo"</pre>";
         
        $this->tienda->NuevoPedido($datosPedido);
       
        $cod_pedido=$this->db->insert_id();
        
        foreach ($_SESSION['ElementosSeleccionados'] as $producto){
            
            $lineapedido=Array(
                    
                    'Productos_Codigo'=>$producto['id'],
                    'Cantidad'=>$producto['cantidad'],
                    'Importe'=>$producto['total'],
                    'Pedidos_codigo_pedido'=>$cod_pedido,
            );
            //Comprobamos que no se supere el stock
           $stock=$this->tienda->TraerStock($producto['id']);
          
          
           $nuevoStock=($stock->Stock)-($producto['cantidad']);
           if($nuevoStock>=0){
           $data = "stock='". $nuevoStock."'";
           $where = " Codigo ='".$producto['id'];
           $this->tienda->RestarStock($data,$where);
            /*
             echo "<pre>";
             print_r($lineapedido);
            echo"</pre>";
             */
             //insertamos la linea de pedido.
            $this->tienda->NuevaLineaPedido($lineapedido);
           }
           else
           {
               $SuperaSTOCK=true;
               
           }
            
            
            
        }
        if(!isset($SuperaSTOCK) || $SuperaSTOCK==false)
        {
            //Imprimimos el pedido en PDF;
            $_SESSION['Fin_Compra']=true;
            $this->ImprimirPedidoPDE($cod_pedido);
            $this->carrito->destroy();//limpiamos la session para nueva compra.
           //Envio de correo con pdf
            $this->EnviaCorreo($cod_pedido,$_SESSION['usuario']['Correo']);
             $_SESSION['comprando']=false;
            
        }else
        {
            $cuerpo= $this->load->view('Error_compra_Stock','', true);
            $this->load->view('Index', Array('cuerpo' => $cuerpo)); 
        }
        
    }
    /**
     * Consultamos los pedidos del usuario registrado.
     */
    public function Verpedidos(){
        $this->load->helper('url');
        $this->load->model('Model_tienda', "tienda");
        $codigo=$_SESSION['usuario']['Codigo'];
        $numeroPedidos=$this->tienda->ContarPedidos($codigo);
        $mispedidos=$this->tienda->Mispedidos($codigo);
          //indexamos los pedidos para mandarlos a la vista.
        foreach($mispedidos as $idx=>$pedido){
          
          $mispedidos[$idx]['lineas']=$this->tienda->TraerLineasPedido($mispedidos[$idx]['codigo_pedido']);
            
            
        }
//            echo "<pre>";
//             print_r($mispedidos);
//            echo"</pre>";
             
        $cuerpo= $this->load->view('Mostrar_mispedidos',Array('mispedidos'=>$mispedidos,'total'=> $total="","numeroPedido"=>$numeroPedidos), true);
        $this->load->view('Index', Array('cuerpo' => $cuerpo)); 
    }
    /**
     * Cancelamos el pedido siempre que no este ya enviado.
     * @param type $idpedido para poder cancelarlo siempre que sea NP
     */
    public function CancelarPedido($idpedido){
        $this->load->helper('url');
        $this->load->model('Model_tienda', "tienda");
       
        $this->tienda->AnularPedido($idpedido);
        
        $this->Verpedidos();
        
    }
    /**
     *  Imprimime pedidos en pdf
     * @param type $idpedido identificador del pedido para impresion
     */
    public function ImprimirPedidoPDE($idpedido){
        $this->load->library('Pdf');
        $this->load->model('Model_tienda', "tienda");
        
        $pedidoCompleto=$this->tienda->TraerUnpedido($idpedido);
        
        foreach($pedidoCompleto as $idx=>$pedido){
          
          $pedidoCompleto[$idx]['lineas']=$this->tienda->TraerLineasPedido($pedidoCompleto[$idx]['codigo_pedido']);
        }
//          echo "<pre>";
//           print_r($pedidoCompleto);
//          echo"</pre>";
        $this->pdf->ImprimirPdf($pedidoCompleto);
        
    }
    /**
     *  Enviamos por correo un pedido despues de haber realizado la compra.
     * @param type $codigopedido pedido que vamos a enviar por correo.
     * @param type $mail direccion de correo al cual enviamos el mail
     */
    public function EnviaCorreo($codigopedido,$mail)
	{
                $this->load->library('email');
		$this->email->from('aula4@iessansebastian.com', 'Datos del pedido Can and Cat');
		$this->email->to($mail); 
		//$this->email->cc('another@another-example.com'); 
		//$this->email->bcc('them@their-example.com'); 
		
		$this->email->subject('Datos del pedido');
		$this->email->attach('asset/pedidos/pedido_'.$codigopedido.".pdf");
		
		if ( $this->email->send() )
		{
			$cuerpo= $this->load->view('Compra_Realizada','', true);
                        $this->load->view('Index', Array('cuerpo' => $cuerpo));
		}
		else 
		{
			echo "</pre>\n\n**** Compra realizada , fallo al enviar correo ****</pre>\n";
		}
		
		echo $this->email->print_debugger();
                 //Mostramos compra realizada.
            
	}
}


