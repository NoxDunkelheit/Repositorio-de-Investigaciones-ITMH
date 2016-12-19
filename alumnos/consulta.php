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
}

$buscar_folio = $_GET['folio'];
$id_usuario=$objetoNegocios->buscarIdAlumno();

echo "<h2>Resultados del folio <b>".$buscar_folio."</b></h2>";

$pagina = new PHPPaging;
$pagina->agregarConsulta("SELECT DISTINCT i.folio_investigacion AS folio,i.id_investigacion AS id,i.titulo_investigacion AS inv,i.fecha_investigacion AS fecha FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.folio_investigacion LIKE '$buscar_folio' ORDER BY i.fecha_investigacion"); 
$pagina->ejecutar();
echo "<div class='row'>";
while($rs=$pagina->fetchResultado()){ 
   $folio = $rs['folio'];
   $existe =$objetoNegocios->relacion_inv($id_usuario,$folio);
   $estado = $objetoNegocios->estatus_inv($id_usuario,$folio);
   $estado_sinrelacion = $objetoNegocios->obtener_estatusinv($folio);
  
  if($estado_sinrelacion != "ACEPTADA"){
   if($existe > 0){
     if($estado != "ACEPTADA"){
              $r = "<b>Tienes relacion con esta investigacion</b>";
              $btn = '<button onclick="javascript: unirse(\'#micontenedor\',\'darBaja.php\')" class="btn btn-danger btn-block btn-lg">Darse de baja en la investigación</button>';
          }else{
              $r = "<b>La Investigacion a sido $estado</b>";
              $btn = "";
          }
            }else{
              if($estado != "ACEPTADA"){
              $r = "<b>Te puedes unir siempre y cuando estas colaborando con esta investigacion</b>";
              $btn = '<button onclick="unirse(\'#micontenedor\',\'unirse.php\')"  class="btn btn-info btn-block btn-lg">Unirse a investigación</button>';
              }else{
              $r = "<b>La Investigacion a sido $estado</b>";
              $btn = "";
          }
            }
  }else{
    $r = "<b>La Investigacion a sido ACEPTADA</b>";
              $btn = "";
  }
   $integrantes = $objetoNegocios->presentadoInvestigaciones($folio);
               echo "<a id='inves' href='../visor.php?inv=".$folio."' target='_blank' ><div class='col-md-12'>";

               echo "<div class='col-md-2'>";
                    echo "<p name='folio' id='folio'>".$rs['folio']."</p>";
                    echo "<center><img src='../img/elementos/icono_investigacion.png' class='img-responsive img-circle' alt='Investigacion'><center>";
               echo "</div>";

               echo "<div class='col-md-6'>";
                    echo "<br><b>".$rs['inv']."</b><br>PRESENTADO POR <b>".$integrantes."</b><br>";
               echo "</div>";

               echo "<div class='col-md-4'>";
                    echo "<br>FECHA: <b>".$rs['fecha']."</b></a>";
                    //CONSULTA PARA CREAR BOTON DE UNIRSE O DARSE DE BAJA O DESACTIVAR SI ESTA ACEPTADA LA INVESTIGACION
                    echo "<br>".$r."<br>".$btn."</a>";
               echo "</div>";

               echo "</div></a>";
}
echo "</div><hr>";
echo "<center>Paginas ".$pagina->fetchNavegacion()."</center>";
 ?>
 <script>
 function unirse(div, destino){
             var folio=document.getElementsByName("folio")[0].value;
 var pagina = ""+destino+"?folio="+folio;
            $(div).load(pagina);
        }
 </script> 