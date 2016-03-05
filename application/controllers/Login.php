
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        
        $this->load->helper('url');
        $cuerpo=$this->load->view('Identificar_view','',true);
        $this->load->view('Index', Array('cuerpo' => $cuerpo));
    }
    public function verificar(){
        
            $this->load->helper('url');
            $this->load->library('form_validation');      
            $this->load->model('Model_tienda', "tienda");
         
            //reglas
            $this->form_validation->set_rules('login','Nombre_usuario', 'required');
            $this->form_validation->set_rules('Passw', 'Password', 'required');
        
         if ($this->form_validation->run() == FALSE)
                {
                   
                    
                    $cuerpo=$this->load->view('Identificar_view','',true);
                    $this->load->view('Index', Array('cuerpo' => $cuerpo));
                }
                else
                {
                    

                    $login=$this->input->post('login');
                    $password=$this->input->post('Passw');
                   
                    
                    //comprobamos si en nuestra base de datos hay algun usuario con este nombre 
                    $Usuario=$this->tienda->Comprueba_usuario($login,$password);
                    // si el usuario es correcto , metemos los datos en la sesion.
                    if($Usuario==true){
                        
                        $datosUser=$this->tienda->traer_usuario($login);
                        $User = get_object_vars($datosUser);
                        $_SESSION['usuario']=$User;
                        //Este sera el interruptor con el cual controlaremos que los usuarios estan dentro.
                        $_SESSION['usuario_correcto']=true;
                        
                        if(!isset($_SESSION['comprando'])||$_SESSION['comprando']=="" ){
                            $cuerpo=$this->load->view('Bienvenido_view','',true);
                            $this->load->view('Index', Array('cuerpo' => $cuerpo));
                        }else
                        {
                            redirect("Entrada/Comprar");
                            exit;
                        }
                        
                    }else
                    {
                        
                    $cuerpo=$this->load->view('Error_acceso_view','',true);
                    $this->load->view('Index', Array('cuerpo' => $cuerpo)); 
                    }
                       

                    
                
                }
     
  
    }

    public function RecogerDatosUser(){
        
         $this->load->helper('url');
         $this->load->library('form_validation');      
         $this->load->model('Model_tienda', "tienda");//modelo de la aplicacion.
            echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";
            //Reglas
                $this->form_validation->set_rules('user','user', 'required');
                if(!isset($_SESSION['modificando'])|| $_SESSION['modificando']==false){
                    $this->form_validation->set_rules('contrasena', 'contrasena', 'required');
                }
                $this->form_validation->set_rules('email', 'email', 'required');
                $this->form_validation->set_rules('DNI', 'DNI', 'required');
                $this->form_validation->set_rules('nombre', 'nombre', 'required');
                $this->form_validation->set_rules('direccion', 'direccion', 'required');
                $this->form_validation->set_rules('CP', 'CP', 'required');
                $this->form_validation->set_rules('provincia','provincia','required');
               
                
                
                if ($this->form_validation->run() == FALSE)
                {
                    $cuerpo=$this->load->view('Registrese_view','',true);
                    $this->load->view('Index', Array('cuerpo' => $cuerpo));
                }
                else
                {
                   if($_SESSION['modificando']==false ||$_SESSION['modificando']=="" )
                   {
                    
                    
                    //Recogemos los datos para insertar.
                    $login=$this->input->post('user');
                    $contrasena=$this->input->post('contrasena');
                    $email=$this->input->post('email');
                    $dni= $this->input->post('DNI');
                    $nombre=$this->input->post('nombre');
                    $direccion=$this->input->post('direccion');
                    $CP= $this->input->post('CP');
                    $provincia=$this->input->post('provincia');
                    //Metemos los datos en un array para la inserccion.
                    $datos=array(
                        'DNI'=>$dni,
                        'Nombre'=>$nombre,
                        'Nombre_usuario'=>$login,
                        'Contrasena'=>$contrasena,
                        'Correo'=>$email,
                        'Direccion'=>$direccion,
                        'CP'=>$CP,
                        'Provincias'=>$provincia
                        
                   );
                    //antes de insertar comprobamos que el login no es repetido
                    $repetido=$this->tienda->usuarioRepetido($login);
                    echo $repetido;
                    if($repetido==0){
                    $this->tienda->InsertUser($datos);
                    $_SESSION['usuario_correcto']=true;
                    $_SESSION['usuario']=$datos;
                    echo "datos de usuario";
                    print_r($_SESSION['usuario']);
                    $cuerpo=$this->load->view('Registrese_success','',true);
                    $this->load->view('Index', Array('cuerpo' => $cuerpo));
                    }
                    else
                    {
                        
                        //si esta repetido volvemos a cojer los datos de usuario.
                        $_SESSION['usuarioRepetido']=true;
                        $cuerpo=$this->load->view('Registrese_success','',true);
                        $this->load->view('Index', Array('cuerpo' => $cuerpo));
                    }
                   }else{
                       
                    $login=$this->input->post('user');
                    $email=$this->input->post('email');
                    $dni= $this->input->post('DNI');
                    $nombre=$this->input->post('nombre');
                    $direccion=$this->input->post('direccion');
                    $CP= $this->input->post('CP');
                    $provincia=$this->input->post('provincia');
                    
                       $datos=array(
                        'DNI'=>$dni,
                        'Nombre'=>$nombre,
                        'Nombre_usuario'=>$login,
                        'Correo'=>$email,
                        'Direccion'=>$direccion,
                        'CP'=>$CP,
                        'Provincias'=>$provincia 
                   );
                    print_r($_SESSION['usuario']);
                    $this->tienda->ModificarUser($_SESSION['usuario']['Nombre'],$datos);
                    $_SESSION['usuario_correcto']=true;
                    $_SESSION['usuario']=$datos;
                    $cuerpo=$this->load->view('Modificar_success','',true);
                    $this->load->view('Index', Array('cuerpo' => $cuerpo));
                   }
                       
                    
                 
                }
                
                $_SESSION['modificando']=false;
    }
    public function Salir(){
        $this->load->helper('url');
        
        $_SESSION['usuario']="";
        $_SESSION['usuario_correcto']=false;
        $this->load->library('carrito');
        $_SESSION['comprando']="";
        $_SESSION['ElementosSeleccionados']="";
        $this->carrito->destroy();
        $_SESSION['modificando']=false;
        redirect("","location",301);
         
    }
   public function ModificarUsuario(){
       
       $_SESSION['modificando']=true;
       $this->RecogerDatosUser();
   }
}
?>