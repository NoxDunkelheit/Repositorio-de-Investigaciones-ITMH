<?php 
//PARA INICIAR SESIONES
error_reporting(0);
require_once('conf/cnegocios.php');

    $objetoNegocios = new cnegocios( $_SESSION['usuario'],
						$_SESSION['pass']);
$folio = $_GET['folio'];
 ?>
<section class="content-header">
      <h1>
        Revision de investigación
        <small>Investigaciónes - ITMH</small>
      </h1>
    </section>
    <section class="content">
  <div class="row">
  <div class="col-md-12">
        <div class="col-md-6">
        <h3>Investigación - Folio: <?php echo $folio; ?></h3>
        <h4><?php echo $objetoNegocios->titulo_inv($folio); ?></h4>
        <center><a href="archivos/<?php echo $folio; ?>.pdf" target="_blank"><button class="btn btn-lg btn-info" name="ver_pdf">Ver investigación</button></a></center>
        </div>
        <div class="col-md-6">
              <h3>Integrantes de la investigación</h3>
              <?php $objetoNegocios->inte_inv($folio); ?>
              <h3>Asesores</h3>
              <?php $objetoNegocios->asesor1_inv($folio); ?>
              <?php $objetoNegocios->asesor2_inv($folio); ?>
              <h3>Revisores</h3>
              <?php $objetoNegocios->revisor1_inv($folio); ?>
              <?php $objetoNegocios->revisor2_inv($folio); ?>
          <br>
          <div id="cont">
              <?php echo "LA INVESTIGACIÓN SE ENCUENTRA ACTUALMENTE <b>".$objetoNegocios->buscarStatusInvestigacion($folio)."</b>" ?>
          </div>
        </div>
 </div> 
 </div>
  </section><br><br><br><br><br><br>