

<?php foreach ($productos as $producto) : ?>
        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
                <img src=<?=  base_url()?><?= $producto->Imagen_Producto?> alt="">
                <div class="caption">
                    <h4 class="pull-right"><?=$producto->Precio?>€</h4>
                    <h4><a><?= anchor("Entrada/detalles_producto/{$producto->Codigo}", $producto->Nombre) ?></a>
                    </h4>
                </div>
                
            </div>
        </div>
    <?php endforeach; ?>
