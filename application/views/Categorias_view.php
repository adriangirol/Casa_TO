
   
      
 

          <?php foreach ($Categorias as $cat): ?>

              
                  <a class="btn btn-default btn-lg btn-block nav navbar-nav "
                     <?= anchor("Entrada/ver_categoria/{$cat->Codigo}", $cat->Nombre) ?></a>
                  <br>



              <?php endforeach; ?>

<!--proyecto final para la pagina Imagenes y texto para las categorias.-->
<!--  
 <div class="row">
            <div class="col-md-6 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="gatos.jpg" alt="">
                </a>
                <h3>
                    <a href="Gatos.php"><!--?= $cat->nombre ?></a>
                </h3>
                <p>En esta seccion tendremos la posibilidad de realizar calculos matematicos en nuestra calculadora personal.</p>
            </div>-->