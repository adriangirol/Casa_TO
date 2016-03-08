<h1>Registro :</h1>
<?php echo validation_errors(); ?>
<form action="" method="POST" >
        <HR width=100% align="center">
        <div class="col-sm-4 col-lg-4 col-md-4"></div>
            <div class="col-sm-8 col-lg-8 col-md-8">
            <div class="bootstrap-iso">
             <div class="container-fluid">
              <div class="row">
               <div class="col-md-6 col-sm-6 col-xs-12">
                <form method="post">
                 <div class="form-group ">
                  <label class="control-label requiredField" for="user">
                   Login
                   <span class="asteriskField">
                    *
                   </span>
                  </label>
                  <input class="form-control" id="name" name="user" type="text" value="<?php if(isset($_SESSION['modificando'])&&$_SESSION['modificando']==true)
                  {
                    echo $_SESSION['usuario']['Nombre_usuario'];}?>"/>
                 </div>
                    <div><?php if(isset($_SESSION['usuarioRepetido'])) echo "Este login no esta disponible."?></div>
                 <?php if(!isset($_SESSION['modificando'])||$_SESSION['modificando']==false){
                 echo '<div class="form-group ">';
                  echo '<label class="control-label requiredField" for="contrasena">';
                   echo 'Contrase&ntilde;a';
                   echo '<span class="asteriskField">';
                   echo " *";
                   echo "</span>";
                  echo "</label>";
                    echo' <input class="form-control" id="contrasena" name="contrasena" type="password"/>';
                 echo "</div>";
                 }?>
                 <div class="form-group ">
                  <label class="control-label requiredField" for="email">
                   Email
                   <span class="asteriskField">
                    *
                   </span>
                  </label>
                  <input class="form-control" id="email" name="email" type="text" value="<?php if($_SESSION['modificando']==true)
                  {
                     echo $_SESSION['usuario']['Correo'];}?>"/>
                 </div>
                 <div class="form-group ">
                  <label class="control-label requiredField" for="DNI">
                   DNI
                   <span class="asteriskField">
                    *
                   </span>
                  </label>
                  <input class="form-control" id="DNI" name="DNI" type="text" value="<?php if($_SESSION['modificando']==true)
                  {
                    echo $_SESSION['usuario']['DNI'];}?>"/>
                 </div>
                 <div class="form-group ">
                  <label class="control-label requiredField" for="nombre">
                   Nombre
                   <span class="asteriskField">
                    *
                   </span>
                  </label>
                  <input class="form-control" id="name3" name="nombre" type="text" value="<?php if($_SESSION['modificando']==true)
                  {
                    echo $_SESSION['usuario']['Nombre'];}?>" />
                 </div>
                 <div class="form-group ">
                  <label class="control-label requiredField" for="direccion">
                   Direccion
                   <span class="asteriskField">
                    *
                   </span>
                  </label>
                  <input class="form-control" id="direccion" name="direccion" placeholder="C/ -N&ordm;" type="text" value="<?php if($_SESSION['modificando']==true)
                  {
                    echo $_SESSION['usuario']['Direccion'];}?>"/>
                 </div>
                 <div class="form-group ">
                  <label class="control-label requiredField" for="CP">
                   Codigo Postal
                   <span class="asteriskField">
                    *
                   </span>
                  </label>
                  <input class="form-control" id="CP" name="CP" type="text" value="<?php if($_SESSION['modificando']==true)
                  {
                    echo $_SESSION['usuario']['CP'];}?>"/>
                 </div>
                 <div class="form-group ">
                   <label class="control-label requiredField" for="provincia">
                    Provincia
                    <span class="asteriskField">
                     *
                    </span>
                   </label>
                   <input class="form-control" id="direccion" name="provincia" placeholder="C/ -N&ordm;" type="text" value="<?php if($_SESSION['modificando']==true)
                  {
                     echo $_SESSION['usuario']['Provincias'];}?>"/>
                 </div>
                 <div class="form-group">
                  <div>
                   <button class="btn btn-primary " name="guardar" type="submit">
                    Guardar
                   </button>
                  </div>
                 </div>
                </form>
               </div>
              </div>
             </div>
            </div>
        </div>
        </HR>
</form>