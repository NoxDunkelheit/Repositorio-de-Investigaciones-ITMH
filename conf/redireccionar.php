<?php 
session_start();
include_once ("cnegocios.php");
$_SESSION["usuario"] = $_POST['usuario'];
$_SESSION["pass"] = $_POST['pass'];


if(!empty($_SESSION)){
      $objetoNegocios = new cnegocios( $_SESSION['usuario'],
						$_SESSION['pass']);

						$flag = $objetoNegocios->existeCuenta();
						$id = $objetoNegocios->buscarId();
						$tipo = $objetoNegocios->buscarTipoUsuario();
						$status = $objetoNegocios->statusUsuario();
						/*echo "Bandera de existencia: ".$flag;
						echo "<br>ID: ".$id;
						echo "<br>TIPO DE USUARIO: ".$tipo;
						echo "<br>ESTATUS DEL USUARIO: ".$status;*/

						if($flag > 0){
							if($status == "ACTIVADO" || $status == "EN PROCESO"){
							  if($tipo == "ALUMNO"){
?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<script>
  if (navigator.geolocation){
    document.writeln("<p>Esperando la ubicacion del inicio de sesion, por favor espere...</p>"+
    "<p>Si no puede loguearse en <b>15s</b> verifique su <b>conexion de internet</b> y la <b>ubicacion activada</b> e intentelo de nuevo </p><a href='../cerrarSesion.php'>Regresar</a>");
    navigator.geolocation.getCurrentPosition(showPosition);
  }
else {
   document.writeln("<p>Lo sentimos, tu dispositivo no admite la geolocaización.</p>");
  }
  
function showPosition(position){
  latitud=position.coords.latitude;
  longitud=position.coords.longitude;
  location.href="../alumnos/insertar_historial.php?lat="+latitud+"&&long="+longitud+"";
  //document.writeln("<p>Latitud: "+latitud+"</p>"+"<p>Longitud: "+longitud+"</p>");
}

/*POR SI NO TENGO INTERNER ACTIVAR LA SIGUIENTE LINEA*/
//location.href="../alumnos/index.php?lat=1&&long=1";
</script>
<?php								  
							    }else if($tipo == "PROFESOR"){
										?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<script>
  if (navigator.geolocation){
    document.writeln("<p>Esperando la ubicacion del inicio de sesion, por favor espere...</p>"+
    "<p>Si no puede loguearse en <b>15s</b> verifique su <b>conexion de internet</b> y la <b>ubicacion activada</b> e intentelo de nuevo </p><a href='../cerrarSesion.php'>Regresar</a>");
    navigator.geolocation.getCurrentPosition(showPosition);
  }
else {
   document.writeln("<p>Lo sentimos, tu dispositivo no admite la geolocaización.</p>");
  }
  
function showPosition(position){
  latitud=position.coords.latitude;
  longitud=position.coords.longitude;
  location.href="../profesores/insertar_historial.php?lat="+latitud+"&&long="+longitud+"";
  //document.writeln("<p>Latitud: "+latitud+"</p>"+"<p>Longitud: "+longitud+"</p>");
}
</script>
<?php	
								}else if($tipo == "ADMINISTRADOR"){
?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<script>
  if (navigator.geolocation){
    document.writeln("<p>Esperando la ubicacion del inicio de sesion, por favor espere...</p>"+
    "<p>Si no puede loguearse en <b>15s</b> verifique su <b>conexion de internet</b> y la <b>ubicacion activada</b> e intentelo de nuevo </p><a href='../cerrarSesion.php'>Regresar</a>");
    navigator.geolocation.getCurrentPosition(showPosition);
  }
else {
   document.writeln("<p>Lo sentimos, tu dispositivo no admite la geolocaización.</p>");
  }
  
function showPosition(position){
  latitud=position.coords.latitude;
  longitud=position.coords.longitude;
  location.href="../administradores/insertar_historial.php?lat="+latitud+"&&long="+longitud+"";
  //document.writeln("<p>Latitud: "+latitud+"</p>"+"<p>Longitud: "+longitud+"</p>");
}
</script>
<?php	
								}
							}else if($status == "DESACTIVADO"){
								header("location:../mensaje.php?err=1");
							}else{
								header("location:../mensaje.php?err=1");
							}
						}else{
							    header("location:../mensaje.php?err=2");
						}
 }
?>