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
    
$id_alumno = $objetoNegocios->buscarIdAlumno();

}
 ?>
 <section class="content-header">
      <h1>
        Mensajes
        <small>Investigaciónes - ITMH</small>
      </h1>
</section>

<section class="content">
<div class="container">
    <div class="row">

       <div class="col-md-5">
       <input class="form-control" type="text" name="asunto" placeholder="ASUNTO">
       <!--Llenar lista con profesores activados-->
       </div>
       
       <div class="col-md-3">
            <select class="form-control">
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
            </select>
       </div>
       
    </div>
    <div class="row">

         <div class="col-md-9">
            <textarea class="form-control" rows="15" cols="300"></textarea>
    </div>

    </div>
</div>
</section>
