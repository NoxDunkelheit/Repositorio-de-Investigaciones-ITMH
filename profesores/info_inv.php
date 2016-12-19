<?php 
//PARA INICIAR SESIONES
error_reporting(0);
session_start();
require_once('cnegocios_profesores.php');
if(empty($_SESSION)){
  session_destroy();
	header("location: ../index.php");
}else{
    $objetoNegocios = new cnegocios_profesores( $_SESSION['usuario'],
						$_SESSION['pass']);
    
$id_profesor = $objetoNegocios->buscarIdProfesor();
$folio = $_GET['folio'];
}
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
        <center><a href="../archivos/<?php echo $folio; ?>.pdf" target="_blank"><button class="btn btn-lg btn-info" name="ver_pdf">Revisar investigación</button></a></center>
        </div>
        <div class="col-md-6">
              <h3>Integrantes de la investigación</h3>
              <?php $objetoNegocios->inte_inv($folio); ?>
              <h3>Asesores</h3>
              <?php $objetoNegocios->asesor1_inv($folio); ?>
              <?php $objetoNegocios->asesor2_inv($folio); ?>
              
              <h3>Revisores</h3>
<?php
          $revisor_1 = $objetoNegocios->revisor1_inv($folio);
          $revisor_2 = $objetoNegocios->revisor2_inv($folio);

          if($revisor_1 == ""){
          $revisor_1 = '<option value="" SELECTED>Primer Revisor</option>';
          }
          if($revisor_2 == ""){
          $revisor_2 = '<option value="" SELECTED>Segundo Revisor</option>';
          }
?>

                     <!-- revisor 1 -->
<select id="revisor_1" name="revisor_1" class="form-control" REQUIRED>
  <?php echo $revisor_1; ?>
  <?php $objetoNegocios->listarProfesoresActivos(); ?>
</select>
<br> 
       <!-- revisor 2 -->
<select id="revisor_2" name="revisor_2" class="form-control" REQUIRED>
  <?php echo $revisor_2; ?>
  <?php $objetoNegocios->listarProfesoresActivos(); ?>
</select> 
<br> 
              <h3>Aceptas esta investigación?</h3>
              <center> 
              <a href="Javascript: cargar_vars('#cont','est.php','<?php echo $folio; ?>','<?php echo 'ACEPTADA'; ?>')"><button class="btn btn-lg btn-block btn-success" name="ver_pdf">ACEPTAR</button></a>
              </center>
          <br>
          <div id="cont">
              <?php echo "LA INVESTIGACIÓN SE ENCUENTRA ACTUALMENTE <b>".$objetoNegocios->buscarStatusInvestigacion($folio)."</b>" ?>
          </div>
        </div>
 </div> 
 </div>
  </section>