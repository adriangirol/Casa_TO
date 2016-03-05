<br>
<br>
<br>
<br>
<?php echo validation_errors(); ?>
<div class="col-sm-4 col-lg-4 col-md-4"></div>
<div class="col-sm-5 col-lg-5 col-md-5">
    <form class="form-inline" action="GenerarXml/procesa" method="POST">
      <div class="form-group">
        <label class="sr-only" for="login">Fichero a importar:</label>
        <input type="file" class="form-control" id="file" name="file" placeholder="archivo">
     
      <!-- Falta recoger paramentros y mandarlos al controlador-->
      
          <button class="btn btn-danger " name="Entrar" type="submit" >Importar</button>
        </div>        
          
       
    </form>
</div>
<br>
<br>
<br>
<br>
<br>
<br>

