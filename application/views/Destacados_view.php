<?php foreach ($destacados as $des) : ?>
        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
                <img src=<?=  base_url()?><?= $des->Imagen_Producto?> alt="">
                <div class="caption">
                    
                    <h4 class="pull-right"><?=$des->Precio?>€<h4>
                    <h4><a href="#"><?= anchor("Entrada/detalles_producto/{$des->Codigo}", $des->Nombre) ?></a></h4>
                    
                    
                </div>
                
            </div>
        </div>
    <?php endforeach; ?>
