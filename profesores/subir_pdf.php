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

            //VERIFICA SI ESTA ACTIVADA LA CUENTA
            $status_profesor = $objetoNegocios->status_usuario(); 
}

if($status_profesor != 'ACTIVADO'){
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
            <label>Archivo PDF: <input name="upl" type="file" REQUIRED /></label>
            <input type="submit" class="btn btn-info" value="Subir">
       </div>
     </form>
  </div>
</section>