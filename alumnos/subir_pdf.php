<?php 
//PARA INICIAR SESIONES
error_reporting(0);
session_start();
require_once('cnegocios_alumnos.php');
if(empty($_SESSION)){
  session_destroy();
	header("location: ../index.php");
}else{
    $objetoNegocios = new cnegocios_alumnos( $_SESSION['usuario'],
						$_SESSION['pass']);

            //VERIFICA SI ESTA ACTIVADA LA CUENTA
            $status_alumno = $objetoNegocios->status_usuario(); 
}
if($status_alumno != 'ACTIVADO'){
              echo "<script>
               alert('Completa tu perfil para que tu cuenta se active y se habilite esta opcion');
               window.location = 'index.php';
               </script>";
            } 
 ?>
  <section class="content-header">
      <h1>
        Subir investigación
        <small>Investigaciónes - ITMH</small>
      </h1>
    </section>
<section class="content">
  <div class="row">
     <form enctype="multipart/form-data" action="upload.php" method="POST">
       <div class="col-md-5">
            <input type="text" class="form-control" placeholder="TITULO DE LA INVESTIGACIÓN" name="nombre" REQUIRED>
       <br>
       <!-- Tipo de investigacion -->
<select name="tipo_inv" class="form-control" REQUIRED>
  <option value="" selected>Tipo de Investigación</option> 
  <?php $objetoNegocios->listarTiposInvestigaciones(); ?>
</select>
<br> 
       <!-- asesor 1 -->
<select name="asesor_1" class="form-control">
  <option value="" selected>Primer Asesor</option> 
  <?php $objetoNegocios->listarProfesoresActivos(); ?>
</select>
<br> 
       <!-- asesor 2 -->
<select name="asesor_2" class="form-control">
  <option value="" selected>Segundo Asesor</option> 
  <?php $objetoNegocios->listarProfesoresActivos(); ?>
</select> 
<br> 
<label>Archivo PDF: <input name="upl" type="file" REQUIRED /></label>
       <input type="submit" class="btn btn-info btn-block" value="Subir">
       </div>
     </form>
  </div>
</section>