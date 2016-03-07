<table class="table table-condensed">

<tbody>
  <tr>
    <!-- Aplicadas en las filas -->
    <td></td>
    <td class="active">Nombre</td>
    <td class="success">Precio</td>
    <td class="warning">Cantidad</td>
    <td class="danger">Total</td>
 </tr>

<?php foreach ($productos as $producto) : ?>
      <tr>
          <td><a <?= anchor("Entrada/BorrarProductoCarrito/{$producto['unique_id']}"," ","class='glyphicon glyphicon-remove'")?></a></td>
          <td class="active"><?= $producto['info']->Nombre?> </td>  
          <td class="success"><?= $producto['info']->Precio?></td>
          <td class="warning"><?= $producto['cantidad']?></td>
          <td class="danger"><?= $producto['total']?>€</td>
          <?php $total=$total+$producto['total'];?>
            
           
      </tr> 
    <?php endforeach; ?>
      <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="danger" style="border-top-color: red; font-weight: bold;"><?= $total?>€</td>
      </tr> 
 </tbody>              
 </table>
<a class="btn btn-success "
    <?= anchor("Entrada/Comprar/"," Comprar ") ?>
</a>
<a class="btn btn-primary "
    <?= anchor("Entrada/Vaciar_carrito/"," Vaciar Carrito ") ?>
</a>
