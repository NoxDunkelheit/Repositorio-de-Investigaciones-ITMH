<?php 
//PARA INICIAR SESIONES
error_reporting(0);
session_start();
include_once("../paginacion/PHPPaging.lib.php");
include_once("../paginacion/conexion.php");
require_once('cnegocios_alumnos.php');
if(empty($_SESSION)){
  session_destroy();
	header("location: ../index.php");
}else{
    $objetoNegocios = new cnegocios_alumnos( $_SESSION['usuario'],
						$_SESSION['pass']);

            $tipo_usuario = $objetoNegocios->tipo_usuario();
//PREGUNTA POR EL ROL DEL USUARIO
            if($tipo_usuario != "ALUMNO"){
                 session_destroy();
                 header("location: ../index.php");   
            }

            $id_alumno = $objetoNegocios->buscarIdAlumno();

}
 ?>
<!DOCTYPE html><!--DECLARACION DEL DOCTYPE -->
<html><!--INICIO DEL DOCUMENTO HTML -->
          <head><!--ABRIENDO ETIQUETA HEAD -->
                <meta charset="utf-8"><!--USO DE LA COLECCION DE CARACTERES UTF-8 -->
                <meta http-equiv="X-UA-Compatible" content="IE=edge"><!--COMPARTIBILIDAD CON NAVEGADORES IE EDGE -->
                <title>Alumnos</title><!--TITULO DE LA PAGINA -->
                <!--META VIEWPORT PARA LA CONFIGURACION PARA EL RESPONSIVE DESIGN -->
                <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                <!-- INCLUIMOS EL CSS DE BOOTSTRAP--> 
                <link rel="stylesheet" href="../css/bootstrap.css">
                <!-- INCLUIMOS EL CSS DE FONT AWESOME PARA EL USO DE FUENTES - ICONOS CDN-->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
                <!-- ICONOS DE IONICONS CDN-->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
                <!-- ESTILO DEL TEMA DE AdminLTE -->
                <link rel="stylesheet" href="../css/AdminLTE.min.css">
                <!-- INCLUIMOS EL CSS DE AdminLTE Skins PARA PODER CAMBIAR COLORES-->
                <link rel="stylesheet" href="../css/skins/alumnos_all-skins.min.css">

<!--ESTILO DEL MAPA -->
                <style type="text/css">
                  html, body { height: 350px; margin: 0; padding: 0; }
                  #map { height: 350px; }
                  #footer{
    height: 90px;
    background-color: #222d32;
}
#footer p{
    color: white;
}
              </style>


           </head>
           
           <body class="hold-transition skin-blue sidebar-mini"><!--INICIAMOS EL BODY EL CONTENIDO DE LA PAGINA -->


                 <div class="wrapper">
                     <!--CONTENEDOR DEL ENCABEZADO DE LA PAGINA LADO IZQUIERDO -->
                     <header class="main-header">
                     <!-- Logo -->
                     <a href="index.php" class="logo">
                     <!-- mini logo for sidebar mini 50x50 pixels -->
                     <span class="logo-mini"><li class="glyphicon glyphicon-text-background"></li></span>
                     <!-- logo for regular state and mobile devices -->
                     <span class="logo-lg"><b>Alumnos</b></span>
                     </a>
                     <!-- Header Navbar: style can be found in header.less -->
                     <nav class="navbar navbar-static-top">
                     <!-- Sidebar toggle button-->
                     <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                     <span class="sr-only">Toggle navigation</span>
                     </a>
                     <!--CONTENEDOR HEADER DERECHO -->
                     <div class="navbar-custom-menu">
                     <ul class="nav navbar-nav">


                     <!-- MENSAJES: style can be found in dropdown.less-->
                     <li class="dropdown messages-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-envelope-o"></i>
                     <!--HACE CONSULTAS DE CUANTOS MENSAJES TIENE -->
                     <span class="label label-success">4</span>
                     </a>
                     <ul class="dropdown-menu">
                     <li class="header">Tienes 4 mensajes</li>
                     <li>
                     <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- MUESTRA VISTA PREVIA DE LOS MENSAJES -->
                     <a href="#">
                      <div class="pull-left">
                       <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- TERMINA EL PRIMER MENSAJE -->
                  
                  
                </ul>
              </li>
              <li class="footer"><a href="Javascript: cargar('#contenedor','_mensajes.php')">Mostrar más mensajes</a></li>
            </ul>
          </li>
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $objetoNegocios->obtenerFotoAlumno($id_alumno); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $objetoNegocios->buscarNombreAlumno(); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $objetoNegocios->obtenerFotoAlumno($id_alumno); ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $objetoNegocios->buscarNombreAlumno(); ?>
                  <small>ESTATUS: <?php echo $objetoNegocios->buscarStatusAlumno(); ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="Javascript: cargar('#contenedor','_perfil.php')" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="../cerrarSesion.php" class="btn btn-default btn-flat">Cerrar Sesion</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $objetoNegocios->obtenerFotoAlumno($id_alumno); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $objetoNegocios->buscarNombreAlumno(); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENÚ</li>
        
       <li>
          <a href="index.php">
            <i class="glyphicon glyphicon-home"></i> <span>Home</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Acciones</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="Javascript: cargar('#contenedor','subir_pdf.php')" target="_self"><i class="fa fa-circle-o"></i> Enviar Investigación</a></li>
            <li><a href="Javascript: cargar('#contenedor','inv_tra.php')"><i class="fa fa-circle-o"></i> Trabajando con<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;otras investigaciones</a></li>
            <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li>
</ul><!-- SIDEBAR MENU -->


        
    </section>
    <!-- /.sidebar -->
  </aside>

<!-- CONTENIDO -->
  <!-- Content Wrapper. Contains page content -->
  <div id="contenedor" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bienvenido alumno
        <small>Investigaciónes - ITMH</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $objetoNegocios->contarInvestigacion(); ?></h3>

              <p>Investigacion(es) realizadas</p>
            </div>
            <a href="realizadas.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $objetoNegocios->contarInvestigacionAceptada(); ?></h3>

              <p>Investigacion(es) aceptadas</p>
            </div>
            <a href="aceptadas.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $objetoNegocios->contarInvestigacionRevision(); ?></h3>

              <p>Investigacion(es) en revisión</p>
            </div>
            <a href="revision.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 id="Clock"></h3>

              <p><!--RELOJ-->
<script language="Javascript">
var dayName = new Array ("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado")
var monName = new Array ("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septimbre", "Octubre", "Noviembre", "Diciembre")
var now = new Date
document.write("Hoy es " + dayName[now.getDay()] + ", " + now.getDate() + " de "+ monName[now.getMonth()] +".")
</script></p> 
            </div>
            <a href="#" class="small-box-footer" >Hora y Fecha </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- SUBCONTENEDOR ACTUALIZABLE Main row -->
      <div id="subcontenedor" class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="glyphicon glyphicon-book"></i> Investigaciones Realizadas</li>
            </ul>
            <div class="tab-content no-padding">
                <!-- AQUI VA LOS RESULTADOS -->
              <div class="table-responsive">
              
                  <?php

                  $pagina = new PHPPaging;
$pagina->agregarConsulta("SELECT DISTINCT i.folio_investigacion AS folio,i.titulo_investigacion AS inv,i.fecha_investigacion AS fecha FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE u.id_usuario = $id_alumno ORDER BY i.fecha_investigacion"); 
$pagina->ejecutar();
echo "<table class='table table-hover table-bordered table-striped'>";
echo "<thead><tr class='info'><th>Folio</th><th>Titulo de la Investigacion</th><th><center>Fecha</center></th></tr></thead>";
while($rs=$pagina->fetchResultado()){ 
    $folio = $rs['folio'];
echo "<tr>";
     echo "<td><b>".$rs['folio']."</b></td>";
     echo "<td><a id='inves' href='../visor.php?inv=".$folio."' target='_blank' >".$rs['inv']."</a></td>";
     echo "<td><center>".$rs['fecha']."</center></td>";

echo "</tr>"; 
}
echo "</table>";

?>
              </div>
                            <?php
              echo "<center>Paginas ".$pagina->fetchNavegacion()."</center>";
 ?>
          </div>

          <!-- /.nav-tabs-custom -->
        </section>
        <!-- right col -->

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>

<div id="footer"><br>
<center><p>Oficina de investigación © 2016 | <a href="#">Instituto Tecnológico de Matehuala</a><br>
Alvarado Reyes Francisco Javier <a href="#">(AlidSoft)</a></p></center>
</div>
</div>
<!-- ./wrapper -->



<!-- jQuery 2.2.3 -->
<script src="../js/jquery.js"></script>
      <script>
function cargar(div, destino){
            $(div).load(destino);
        }
function cargarConsulta(div, destino){
 var folio=document.getElementsByName("folio")[0].value;
 var pagina = ""+destino+"?folio="+folio;
            $(div).load(pagina);
        }
    </script>

<!-- JAVASCRIPT PARA MOSTRAR RELOJ -->
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
document.getElementById("Clock").innerText = hours+":"+minutes;

setTimeout("show()",1000)

}

show()
</script>



<!-- Bootstrap 3.3.6 -->
<script src="../js/bootstrap.js"></script>
<!-- Slimscroll -->
<script src="../js/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/app.min.js"></script>
</body>
</html>