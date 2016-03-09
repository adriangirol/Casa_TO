<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Pdf extends FPDF {

   //Cabecera de página
   function ImprimirPdf($pedido,$comprando=false)
   {   
       $image = "asset/plantilla/img/logo.jpg";
        
       $total=0;
       foreach ($pedido as $idx=>$p){
                $pdf= new Pdf();
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',14);
                
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Cell(70,100,"Pedido: ".$pedido[$idx]['codigo_pedido'],0);
                
                $pdf->Cell(70,100,"Estado: ".$pedido[$idx]['Estado'],0);
               
                $pdf->Cell(70,100,"Fecha: ".$pedido[$idx]['fecha'],0);
                
                $pdf->Ln();
                
                $pdf->Cell(70,10,"Nombre del producto",1);
                $pdf->Cell(26,10,"Cantidad",1); 
                $pdf->Cell(40,10,"Precio",1); 
                $pdf->Ln();
                
                foreach ($pedido[$idx]['lineas'] as $linea) {   
                $pdf->Cell(70,10,$linea['Nombre'],1);
              
                $pdf->Cell(26,10,$linea['Cantidad'],1); 
                
                $pdf->Cell(40,10,$linea['Precio'].iconv('UTF-8', 'windows-1252', '€'),1); 
                
                $pdf->Ln(); 
                $total=$total+$linea['Precio'];
                }  
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Cell(100,10,"Total del pedido: ".$total.iconv('UTF-8', 'windows-1252', '€'),1);
                
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
               $pdf->Image($image , 10 ,5, 180 , 50,'JPG');
               
                // diferenciamos si va para mostrar en navegador o para guardar en local y posteriormente enviar por correo.
                if($comprando==true){
                    $pdf->Output('F','asset/pedido.pdf',true);
                    
                    
                 }else{
                    $pdf->Output('I','pedido : '.$pedido[$idx]['codigo_pedido']);
                 }
        }
   }
}  