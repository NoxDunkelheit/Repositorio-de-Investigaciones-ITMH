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
        Incluirse en investigación
        <small>Investigaciónes - ITMH</small>
      </h1>
    </section>
    <br>
<div class="container">
  
   <div class="row">
   <div class="col-md-6">
 <form action="Javascript: cargarConsulta('#micontenedor','consulta.php')">
 <input class="form-control" type="text" name="folio" placeholder="ESCRIBE EL FOLIO DE LA INVESTIGACION">
 <input class="btn btn-success btn-lg pull-right" type="submit" value="BUSCAR">
 </form>
   </div>
   </div>

 <div class="row">
 <div class="col-md-10">

<div id="micontenedor">
   <!--RESULTADOS-->
  </div>

  </div>
  </div>

</div>