<?php   
error_reporting(0);
require_once('conf/cnegocios.php');
include_once("paginacion/PHPPaging.lib.php");
include_once("paginacion/conexion.php");

$objetoNegocios = new cnegocios("","");

?>

<!DOCTYPE html>
<html lang="es-MX">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Investigación</title>
      <link rel="shortcut icon" href="img/logos/tec.ico" type="image/ico"><!--Icono-->
      <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
    <style>
    #footer{
    height: 90px;
    background-color: #222d32;
}
#footer p{
    color: white;
}
    </style>
   </head>
   <body>
   <div class="container">

     <div class="row">

        <div class="col-md-4">
        <img  id="sep-logo" src="img/logos/sep.jpg" alt="sep-logo" class="img-rounded img-responsive" width="250" height="98">
        </div>
        <div class="col-md-8">
        <img id="banner-tec" src="img/logos/banner_tec.png" alt="banner-tec" class="img-rounded img-responsive" width="550" height="98">
        </div>

     </div><!-- finalizacion de un row donde va el banner-->
   
<div class="row">
<nav id="navbar" class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a id="nav-titulo" class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> ITMH - Investigación</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-left">
      <li><a id="nav-lista" href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
      <li><a id="nav-lista" href="investigaciones.php"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Investigaciones</a></li>
      <li><a id="nav-lista" href="Javascript: cargar('#contenedor','politica.html')" aria-expanded="true"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Politica de calidad</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a id="nav-lista" href="Javascript: cargar('#contenedor','contactanos.php')"><span class="glyphicon glyphicon-envelope"></span> Contactanos</a></li>
        <li class="dropdown">
          <a id="nav-lista" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Login <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li>
          <center><p id="txt-sesion">Inicia Sesión</p></center>
          <hr id="hr-sesion">
          <center>
          <form id="form-sesion" action="conf/redireccionar.php" method="post">
          <input name="usuario" id="input-sesion" type="text" class="form-control" placeholder="Usuario" REQUIRED>
          <input name="pass" id="input-sesion" type="password" class="form-control" placeholder="Contraseña" REQUIRED>
          <button id="input-sesionb" type="submit" class="btn btn-success btn-block">Iniciar Sesión</button>
          </form>
          </center>
          <a href="#" id="hipervinculo-sesion" class="navbar-right">Olvidó su contraseña?</a>
          <a href="Javascript: cargar('#contenedor','registro.php')" id="hipervinculo-sesion" class="navbar-right">Registrarse</a>
          </li>
          </ul> 
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
   </div><!-- finalizacion del row donde va el navbar -->

<div id="contenedor">
   <div class="row">
        <div class="col-md-9">
        <h1>Investigaciones</h1><br>

<?php
$pagina = new PHPPaging;

$pagina->agregarConsulta("SELECT DISTINCT i.folio_investigacion AS folio,i.id_investigacion AS id,i.titulo_investigacion AS inv FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.status_investigacion LIKE 'ACEPTADA' ORDER BY i.fecha_investigacion"); 
$pagina->ejecutar();
echo "<div class='row'>";
while($rs=$pagina->fetchResultado()){
   $folio = $rs['folio'];
   $autor = $objetoNegocios->presentadoInvestigaciones($folio);
   $aceptacion = $objetoNegocios->fechaAceptacionInvestigacion($folio);
               echo "<a id='inves' href='visor.php?inv=".$folio."' target='_blank' ><div class='col-md-12'>";

               echo "<div class='col-md-2'>";
                    echo "<p id='folio'>".$rs['folio']."</p>";
                    echo "<center><img id='icono-inv' src='img/elementos/icono_investigacion.png' class='img-responsive img-circle' alt='Investigacion'><center>";
               echo "</div>";

               echo "<div class='col-md-6'>";
                    echo "<br><b>".$rs['inv']."</b><br>PRESENTADO POR <b>".$autor."</b><br>";
               echo "</div>";

               echo "<div class='col-md-4'>";
                    echo "<br>FECHA: <b>".$aceptacion."</b></a>";
                    ?>
                    <a href="Javascript: cargar_var('#contenedor','info_investigacion.php','<?php echo $folio; ?>');"><button class='btn btn-info btn-block btn-lg'>Información</button></a><hr>
                    <?php 
               echo "</div>";

               echo "</div></a>";
}
echo "</div><br>";
echo "<center><label>Paginas ".$pagina->fetchNavegacion()."</center><br><br>";
?>

        </div>
   </div>

</div>

</div><!-- finalizacion del container principal-->

<div id="footer"><br>
<center><p>Oficina de investigación © 2016 | <a href="#">Instituto Tecnológico de Matehuala</a><br>
Alvarado Reyes Francisco Javier <a href="#">(AlidSoft)</a></p></center>
</div>

     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
      <script>
function cargar(div, destino){
            $(div).load(destino);
            $('html,body').animate({
                scrollTop: $("#contenedor").offset().top
            }, 1000);
        }
        function cargar_var(div, destino,data){
          var pagina = ""+destino+"?folio="+data;
            $(div).load(pagina);
        }
    </script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
   </body>
</html>