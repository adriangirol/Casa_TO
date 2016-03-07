<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class GenerarXml extends CI_Controller {

    public function exportar() {
        $this->load->model('Model_tienda', "tienda");

        $micategoriaegorias = $this->tienda->Extraer('SELECT * FROM categorias');
       
        $xml = new SimpleXMLElement('<Productos_Con_sus_Categorias/>');//Creamos la entrada <categorias>
        //AQUI
        foreach ($micategoriaegorias as $micategoriaegoria) {
            $xml_cat = $xml->addChild('categoria'); //Creamos etiqueta <categoria> posicionada dentro de <categorias>
            foreach ($micategoriaegoria as $key => $value) {

                if ($key != 'Codigo') {
                    $xml_cat->addChild($key, utf8_encode($value)); //Añade los datos de cada categoria
                }
            }
            
            $this->XMLAddCategorias($xml_cat, $micategoriaegoria['Codigo']);//Añade a <categoria> sus <producto>
        }

        Header('Content-type: text/xml; charset=utf-8');
        Header('Content-type: octec/stream');
        Header('Content-disposition: filename="CategoriasYProductos.xml"');
        print($xml->asXML());
    }

    protected function XMLAddCategorias($xml_cat, $idCat) {
        $lista_categorias = $this->tienda->Traer_productos('Categoria_Codigo',$idCat);
        
        
        $xml_categorias = $xml_cat->addChild('Productos'); //Crea etiqueta <camisetas> dentro de <categoria>
        
        foreach ($lista_categorias as $micategoriaegoria) {
            $xml_categorias = $xml_categorias->addChild('Producto'); //Crea etiqueta <camiseta> dentro de <camisetas>

            foreach ($micategoriaegoria as $idx => $valor) {
                $xml_categorias->addChild($idx, utf8_encode($valor)); //Añade a la etiqueta <camiseta>
            }           
        }
    }

    public function Procesa() {
        
        $archivo = $_FILES['mifile'];  
        if (file_exists($archivo['tmp_name'])) {
            $contentXML = utf8_encode(file_get_contents($archivo['tmp_name']));
            $xml = simplexml_load_string($contentXML);

            $this->InsertaXML($xml);
            
            $cuerpo = $this->load->view('ImportandoXml', true);
            $this->load->view('Index', Array('cuerpo' => $cuerpo));
        } else {
            
            $cuerpo = $this->load->view('Error_importar', true);
            $this->load->view('Index', Array('cuerpo' => $cuerpo));
        }
       
    }
     function InsertaXML($xml) {
         
        $this->load->model('Model_tienda', "tienda");
        foreach ($xml as $micategoria) {

            
            $micategoria['Nombre'] = (string) $micategoria->Nombre;
            $micategoria['Descripcion'] = (string) $micategoria->Descripcion;
            
            $micategoria_id = $this->tienda->AñadirCategoria($micategoria);
            
            foreach ($micategoria->Productos->Producto as $articulo) {
                
                $miproducto['Nombre'] = (string) $articulo->Nombre;
                $miproducto['Precio'] = (string) $articulo->Precio;
                $miproducto['Imagen_Producto'] = (string) $articulo->Imagen;
                $miproducto['IVA'] = (string) $articulo->IVA;
                $miproducto['Descripcion'] = (string) $articulo->Descripcion; 
                $miproducto['Categoria_Codigo'] = $micategoria_id;
                $miproducto['Stock'] = (string) $articulo->Stock;
                $miproducto['Destacado'] = (string) $articulo->Destacado;
                
                $this->tienda->AñadirProducto($miproducto);
                
            $cuerpo = $this->load->view('ImportandoXml', true);
            $this->load->view('Index', Array('cuerpo' => $cuerpo));
            }
        }
    }
    
            }