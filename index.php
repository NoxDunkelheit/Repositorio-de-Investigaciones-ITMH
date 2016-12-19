<?php
error_reporting(0);
require_once('conf/cnegocios.php');

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

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="3000">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>
 
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img class="s-img" src="img/slideshow/1.png" alt="uno-1">
      <div class="carousel-caption">
      	<h3>INSTITUTO TECNOLÓGICO DE MATEHUALA</h3>
      </div>
    </div>
    <div class="item">
      <img class="s-img" src="img/slideshow/2.jpg" alt="dos-2">
      <div class="carousel-caption">
      	<h3>INVESTIGACIÓN</h3>
      </div>
    </div>
    <div class="item">
      <img class="s-img" src="img/slideshow/3.jpg" alt="tres-3">
      <div class="carousel-caption">
      	<h3>INVESTIGACIÓN - ITMH</h3>
      </div>
    </div>
  </div>
 
  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div> <!-- Carousel -->

</div>


   <div class="row">
        <div class="col-md-9">
        <h1>Ultimas investigaciones</h1><br>
<?php
$objetoNegocios->listarInvestigaciones();
?>             
        </div>
        <div class="col-md-3">
        
        <br><center>
        <!--RELOJ-->
<script language="Javascript">
var dayName = new Array ("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado")
var monName = new Array ("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septimbre", "Octubre", "Noviembre", "Diciembre")
var now = new Date
document.write("Hoy es " + dayName[now.getDay()] + ", " + now.getDate() + " de "+ monName[now.getMonth()] +".")
</script>

<form name="size">

<input name="Clock" size="11" type="text" DISABLED/>

</form>


<script>

function show(){
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var dn="AM"
if (hours>12){
dn="PM"
hours=hours-12
}
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
document.size.Clock.value=hours+":"+minutes+":"

+seconds+" "+dn

setTimeout("show()",1000)

}

show()
</script><hr></center>
<center>        
<img  id="copocyt-logo" src="img/logos/copocyt.png" alt="copocyt-logo" class="img-rounded img-responsive" width="90%" height="98">
<img  id="cenidet-logo" src="img/logos/cenidet.png" alt="cenidet-logo" class="img-rounded img-responsive" width="90%" height="98">
<img  id="ipn-logo" src="img/logos/ipn.png" alt="ipn-logo" class="img-rounded img-responsive" width="90%" height="98">
<img  id="academia-logo" src="img/logos/academia.png" alt="academia-logo" class="img-rounded img-responsive" width="90%" height="98">
</center>
        </div>
   </div>

</div>
</div><!-- finalizacion del container principal-->
<div id="footer"><br>
<center><p>Oficina de investigación © 2016 | <a href="#">Instituto Tecnológico de Matehuala</a><br>
Alvarado Reyes Francisco Javier <a href="https://github.com/NoxDunkelheit" target="_blank">(AlidSoft)</a></p></center>
</div>
<script>
  function mensaje(msg){
    alert(""+msg);
  }
</script>
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
        <script>
      $('.carousel').carousel({
		        interval: 3000
	         })
    </script>
   </body>
</html>