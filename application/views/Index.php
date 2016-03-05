<!DOCTYPE html>
<html lang="en">

<head>
   <!--Cabecera-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Versión compilada y comprimida del CSS de Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
 
     <!-- Tema opcional -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
 
    <!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

    <title>Business Casual - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=  base_url()?>asset/plantilla/css/bootstrap.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link href="<?=  base_url()?>asset/plantilla/css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="brand"><img src="<?=  base_url()?>asset/plantilla/img/logo.jpg"></div>
    <div class="address-bar">Venta de todo tipo de animales domesticos</div>
    
    <div align="center">
        <?php if(isset($_SESSION['usuario_correcto'])&& $_SESSION['usuario_correcto']==true ){
           echo "<h3><font color='Grey'>". $_SESSION['usuario']['Nombre']."</font></h3>";
             echo "&nbsp &nbsp &nbsp &nbsp ";
             echo anchor('Login/ModificarUsuario',"Modificar Usuario",array("class"=>"btn btn-danger"));   
             echo "&nbsp &nbsp &nbsp &nbsp ";
                echo anchor('Entrada/Verpedidos',' Mis pedidos', array("class"=>"btn btn-success"));
        }
        ?>              
        <br>
        <br>
    <!-- Menu-->
    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">Business Casual</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
                     <li>
                       <?php echo anchor('Entrada','Inicio');?>
                    </li>
                    
                    <li>
                         <?php echo anchor('Entrada/Destacados','Destacados');?>
                    </li>
                    <li>
                        <?php echo anchor('Entrada/Categorias','Categorias');?>
                    </li>

                    <li>
                        <?php if(!isset($_SESSION['usuario_correcto'])  || $_SESSION['usuario_correcto']==false)
                            echo anchor('Login/verificar','Identificate');?>
                    </li>
                    <li>
                        <?php if(!isset($_SESSION['usuario_correcto'])  ||$_SESSION['usuario_correcto']==false)
                            echo anchor('Login/RecogerDatosUser','Registrese');?>
                    </li>
                    <li>
                        <?php if(isset($_SESSION['usuario_correcto'])&& $_SESSION['usuario_correcto']==true ){
                            echo anchor('Login/Salir',' Salir ');
                        }?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!--Fin de menu-->
    
    <!--Encabezado-->
    <div class="container">
         <?php if(isset($cuerpo)) {
                        echo $cuerpo;
                    }else
                        redirect("/Entrada/Destacados","location",301);
                    ?>
        <!--Fin del encabezado-->

    </div>
    <!-- /.container -->
    <!-- Fin del cuerpo -->
    
    <!-- Pie de pagina-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p><?php echo anchor('GenerarXml/exportar','Exportar Xml',Array("class"=>"btn btn-success"));?>
                    <p><?php echo anchor('Entrada/importar','Importar Xml',Array("class"=>"btn btn-warning"));?>
                </div>
            </div>
        </div>
    </footer>
    <!--Fin del pie-->
    
    <!-- jQuery -->
    <script src="<?=  base_url()?>asset/plantilla/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=  base_url()?>asset/plantilla/js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
