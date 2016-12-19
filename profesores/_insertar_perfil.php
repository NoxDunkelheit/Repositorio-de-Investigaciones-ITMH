<?php 
\error_reporting(E_ALL ^ E_NOTICE);
//PARA INICIAR SESIONES
error_reporting(0);
session_start();
require_once('cnegocios_profesores.php');
if(empty($_SESSION)){
  session_destroy();
	header("location: ../index.php");
}else{
   if(isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']){
    $objetoNegocios = new cnegocios_profesores( $_SESSION['usuario'],
						$_SESSION['pass']);
   }else{
     echo "<script>
        window.location = '../mensaje.php?err=3';
        </script>";
   }
}

$secret = "6LdamAsUAAAAAGMQwJuZHI6OIqI5qffRTWdrDoek";
    $ip = $_SERVER['REMOTE_ADDR'];

    $captcha = $_POST['g-recaptcha-response'];

    $result = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
$array = json_decode($result,TRUE);

if($array["success"]){
            
            $id_profesor = $objetoNegocios->buscarIdProfesor();
            $foto_profesor = $_SESSION['usuario'].".jpg";

$ruta="../img/profesores/";
$nom=$_SESSION['usuario'];
$archivo=$_FILES['imagen']['tmp_name'];
$nom_archivo=$_FILES['imagen']['name'];
//$ext=  pathinfo($nom_archivo);
$subir = move_uploaded_file($archivo,$ruta."/".$nom.".jpg");
if ($subir)
{   // echo 'El archivo se subio con exito';
}
else
{echo 'Error al subir ';}

//ANTES DE INSERTAR VERIFICAMOS SI ESTA EN LA TABLA DE PERFILES SI SE ENCUENTRA REGISTRADO ENTONCES ACTUALIZAMOS

     $existe = $objetoNegocios->existePerfilProfesor($id_profesor);
            if($existe>0){
                //ACTUALIZAR DATOS
                $objetoNegocios->actualizarPerfilProfesor($id_profesor,$_POST['nombre'],
                $_POST['ap'],$_POST['am'],$foto_profesor,$_POST['calle'],$_POST['num'],
                $_POST['col'],$_POST['cp'],$_POST['ciudad'],$_POST['estado'],
                $_POST['nacionalidad'],$_POST['tel'],$_POST['correo'],$_POST['rfc'],
                $_POST['control']);

                      echo "<script>
                        window.location = '../mensaje.php?err=7';
                            </script>";

            }else{
                //INSERTAR EN LA TABLA DE PERFILES
                $objetoNegocios->InsertarPerfil($id_profesor,$_POST['nombre'],
                $_POST['ap'],$_POST['am'],$foto_profesor,$_POST['calle'],$_POST['num'],
                $_POST['col'],$_POST['cp'],$_POST['ciudad'],$_POST['estado'],
                $_POST['nacionalidad'],$_POST['tel'],$_POST['correo'],$_POST['rfc'],
                $_POST['control']);

                $objetoNegocios->actualizarStatusProfesor();
                echo "<script>
                        window.location = '../mensaje.php?err=6';
                            </script>";
            }

    }else{
        echo "<script>
        window.location = 'index.php';
        </script>";
    }

 ?>
