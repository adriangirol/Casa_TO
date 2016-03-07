<div class="row">
<div class="col-sm-4 col-lg-4 col-md-4"></div>
 <form class="form-group" action="" method="POST">
<?php foreach ($detalles as $des) : ?>
        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
                <img src=<?=  base_url()?><?= $des->Imagen_Producto?> alt="">
                <div class="caption">
                    <input type="hidden"  name="id" value="<?=$des->Codigo?>">
                    
                    <input class="pull-right" style="border:none;" type="text" readonly="" name="precio" value="<?=$des->Precio?>">
                    <h4><a href="#"><?=$des->Nombre?></a>
                    </h4>
                    <p><?=$des->Descripcion?></p>
                </div>
               <div class="ratings">
                 <?php if ($des->Stock==0){
                 echo "<p>Sin Existencias</p>";}else
                     echo "<p>Stock</p>"?>
                     
                  <?php 
                    if($des->Stock >=5){
                       
                        $ran=5;
                        
                    }
                    else{
                        
                        $ran=$des->Stock;  
                    }
                    
                       for($i=0;$i<$ran;$i++){
                       
                       echo '<span class="glyphicon glyphicon-star"></span>';
                  }?>
                   </p>
                </div>
            </div>
        </div>
</div>
<div class="row">
 <div class="col-sm-4 col-lg-4 col-md-4"></div>
 <?php if($des->Stock>0): ?>
       <div class="col-sm-4 col-lg-4 col-md-4">
         <div class="thumbnail">
             <div class="caption">
                 <div class="col-xs-3">
                     <p>Cantidad </p>
                       </div> 
                       <div class="col-xs-3">
                        <input type="number" min="0" max="<?=$ran?>" name="cantidad"class="form-control" >
                       </div> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <input class="btn btn-danger" type="submit" name="compra" value="Comprar">
                    
                    
                </div>
            </div>
        </div>
 </form>
 <?php endif;?>
           
<?php endforeach; ?>
 
 