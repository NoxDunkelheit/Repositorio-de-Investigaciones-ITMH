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
     <head>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
<section class="content-header">
      <h1>
        Perfil del alumno
        <small>Investigaciónes - ITMH</small>
      </h1>
    </section>
<section class="content">
  <div class="row">
    <form enctype="multipart/form-data" action="_insertar_perfil.php" method="POST">
       <div class="col-md-7">
       
         <div class="row">
       <div class="col-md-2">
       *Nombre: 
       </div>
       <div class="col-md-5">
       <input type="text" class="form-control" name="nombre" placeholder="TU NOMBRE" value="<?php echo $objetoNegocios->data_perfilAlumno($id_alumno,'nombre_perfil'); ?>" REQUIRED>
       </div>
         </div>

         <div class="row">
       <div class="col-md-2">
       *Apellido Paterno:
       </div>
       <div class="col-md-5">
       <input type="text" class="form-control" name="ap" placeholder="TU APELLIDO PATERNO" value="<?php echo $objetoNegocios->data_perfilAlumno($id_alumno,'ap_perfil'); ?>" REQUIRED>
       </div>
         </div>

         <div class="row">
       <div class="col-md-2">
       Apellido Materno:
       </div>
       <div class="col-md-5">
       <input type="text" class="form-control" name="am" placeholder="TU APELLIDO MATERNO" value="<?php echo $objetoNegocios->data_perfilAlumno($id_alumno,'am_perfil'); ?>">
       </div>
         </div>

          <div class="row">
       <div class="col-md-2">
       *Calle:
       </div>
       <div class="col-md-5">
       <input type="text" class="form-control" name="calle" placeholder="TU CALLE" value="<?php echo $objetoNegocios->data_perfilAlumno($id_alumno,'calle_perfil'); ?>" REQUIRED>
       </div>
         </div>

            <div class="row">
       <div class="col-md-2">
       *Numero:
       </div>
       <div class="col-md-5">
       <input type="text" class="form-control" name="num" placeholder="TU #NUM. DE CASA" value="<?php echo $objetoNegocios->data_perfilAlumno($id_alumno,'num_perfil'); ?>" REQUIRED>
       </div>
         </div>

             <div class="row">
       <div class="col-md-2">
       *Colonia:
       </div>
       <div class="col-md-5">
       <input type="text" class="form-control" name="col" placeholder="TU COLONIA" value="<?php echo $objetoNegocios->data_perfilAlumno($id_alumno,'col_perfil'); ?>" REQUIRED>
       </div>
         </div>

               <div class="row">
       <div class="col-md-2">
       C.P.:
       </div>
       <div class="col-md-5">
       <input type="text" class="form-control" name="cp" placeholder="TU CÓDIGO POSTAL" value="<?php echo $objetoNegocios->data_perfilAlumno($id_alumno,'cp_perfil'); ?>">
       </div>
         </div>
 
                <div class="row">
       <div class="col-md-2">
       *Ciudad:
       </div>
       <div class="col-md-5">
       <input type="text" class="form-control" name="ciudad" placeholder="TU CIUDAD" value="<?php echo $objetoNegocios->data_perfilAlumno($id_alumno,'cd_perfil'); ?>" REQUIRED>
       </div>
         </div>

                 <div class="row">
       <div class="col-md-2">
       *Entidad: 
       </div>
       <div class="col-md-5">
       <input type="text" class="form-control" name="estado" placeholder="TU ENTIDAD FEDERATIVA" value="<?php echo $objetoNegocios->data_perfilAlumno($id_alumno,'estado_perfil'); ?>" REQUIRED>
       </div>
         </div>

                   <div class="row">
       <div class="col-md-2">
       *Nacionalidad: 
       </div>
       <div class="col-md-5">
       <input type="text" class="form-control" name="nacionalidad" placeholder="MEXICANO / EXTRANJERO" value="<?php echo $objetoNegocios->data_perfilAlumno($id_alumno,'nacionalidad_perfil'); ?>" REQUIRED>
       </div>
         </div>

                     <div class="row">
       <div class="col-md-2">
       Teléfono: 
       </div>
       <div class="col-md-5">
       <input type="text" class="form-control" name="tel" placeholder="TU TELÉFONO" value="<?php echo $objetoNegocios->data_perfilAlumno($id_alumno,'tel_perfil'); ?>">
       </div>
         </div>

                       <div class="row">
       <div class="col-md-2">
       *Correo: 
       </div>
       <div class="col-md-5">
       <input type="email" class="form-control" name="correo" placeholder="TU CORREO ELECTRÓNICO" value="<?php echo $objetoNegocios->data_perfilAlumno($id_alumno,'correo_perfil'); ?>" REQUIRED>
       </div>
         </div>

                         <div class="row">
       <div class="col-md-2">
       RFC: 
       </div>
       <div class="col-md-5">
       <input type="text" class="form-control" name="rfc" placeholder="TU RFC" value="<?php echo $objetoNegocios->data_perfilAlumno($id_alumno,'rfc_perfil'); ?>">
       </div>
         </div>

                           <div class="row">
       <div class="col-md-2">
       *Num. Control: 
       </div>
       <div class="col-md-5">
       <input type="text" class="form-control" name="control" placeholder="TU NÚMERO DE CONTROL" value="<?php echo $objetoNegocios->data_perfilAlumno($id_alumno,'num_control'); ?>" REQUIRED>
       </div>
         </div>

       </div>


       <div class="col-md-4">
         Foto: <input name="imagen" type="file" />
         <div class="row">
         <br>
         <div class="g-recaptcha pull-right" data-sitekey="6LdamAsUAAAAAPsvC-NgpVC2FUwYEsbHVLrZLKHg"></div>
         <input class="btn btn-primary pull-right" type="submit" value="Actualizar Datos" name="guardar">
         </div>
       </div>

       </div>
       
     </form>

</div>
</section>