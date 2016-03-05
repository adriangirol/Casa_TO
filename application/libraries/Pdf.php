<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends FPDF {

    
   //Cabecera de página
   function ImprimirPdf($pedido)
   {    $total=0;
       foreach ($pedido as $idx=>$p){
                $pdf= new Pdf();
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',14);
                $pdf->Cell(40,7,"Pedido: ".$pedido[$idx]['codigo_pedido'],0);
                
                $pdf->Cell(70,7,"Estado: ".$pedido[$idx]['Estado'],0);
               
                $pdf->Cell(70,7,"Fecha: ".$pedido[$idx]['fecha'],0);
                
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Cell(70,7,"Nombre del producto",1);
                $pdf->Cell(26,7,"Cantidad",1); 
                $pdf->Cell(40,7,"Precio",1); 
                $pdf->Ln();
                
                foreach ($pedido[$idx]['lineas'] as $linea) {   
                $pdf->Cell(70,7,$linea['Nombre'],1);
              
                $pdf->Cell(26,7,$linea['Cantidad'],1); 
                
                $pdf->Cell(40,7,$linea['Precio'].iconv('UTF-8', 'windows-1252', '€'),1); 
                
                $pdf->Ln(); 
                $total=$total+$linea['Precio'];
                }  
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Cell(100,7,"Total del pedido: ".$total.iconv('UTF-8', 'windows-1252', '€'),1);
                
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Cell(100,7,"* Impuestos y descuento aplicados ",0);
                // diferenciamos si va para mostrar en navegador o para guardar en local y posteriormente enviar por correo.
                if(isset($_SESSION['Fin_Compra'])){
                    $pdf->Output('F','asset/pedidos/pedido_'.$pedido[$idx]['codigo_pedido'].".pdf",true);
                 }else{
                    $pdf->Output('I','pedido : '.$pedido[$idx]['codigo_pedido']);
                 }
        }
   }
}  