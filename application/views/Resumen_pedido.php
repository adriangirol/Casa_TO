<h3>Elementos del pedido :</h3>
<table class="table table-condensed">
    <tbody>
    
      <tr class="active">
        <!-- Aplicadas en las filas -->
        
        <td>Nombre</td>
        <td>Precio</td>
        <td>Cantidad</td>
        <td>Total</td>
     </tr>

    <?php foreach ($productos as $producto) : ?>
      <tr class="danger">
        <td><?= $producto['info']->Nombre?> </td>  
        <td><?= $producto['info']->Precio?></td>
        <td><?= $producto['cantidad']?></td>
        <td><?= $producto['total']?></td>
       </tr>



        <?php endforeach; ?>
     </tbody>              
 </table>
<h3>Datos del Comprador</h3>
<table class="table table-condensed">
    <tbody>
    
      <tr class="warning">
        <!-- Aplicadas en las filas -->
        
        <td>Nombre</td>
        <td>Dni</td>
        <td>Correo</td>
        <td>Dirección</td>
        <td>C.P</td>
        <td>Provincia</td>
        
     </tr>
          <tr class="warning">
            
              <td><?= $_SESSION['usuario']['Nombre']?> </td>  
              <td><?= $_SESSION['usuario']['DNI']?></td>
              <td><?= $_SESSION['usuario']['Correo']?></td>
              <td><?= $_SESSION['usuario']['Direccion']?></td>
              <td><?= $_SESSION['usuario']['CP']?></td>
              <td><?= $_SESSION['usuario']['Provincias']?></td>
          </tr>
         
     </tbody>              
 </table>
<a class="btn btn-danger glyphicon glyphicon-shopping-cart"
    <?= anchor("Entrada/Finalizar_compra/"," Finalizar ") ?>
</a>




