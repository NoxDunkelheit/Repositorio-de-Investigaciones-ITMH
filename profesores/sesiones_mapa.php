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

            $tipo_usuario = $objetoNegocios->tipo_usuario();
//PREGUNTA POR EL ROL DEL USUARIO
            if($tipo_usuario != "PROFESOR"){
                 session_destroy();
                 header("location: ../index.php");   
            }

            $id_profesor = $objetoNegocios->buscarIdProfesor();
            $id_sesion = $_GET['id'];
            $latitud = $objetoNegocios->latitud_sesion($id_sesion);
            $longitud = $objetoNegocios->longitud_sesion($id_sesion);
            $hist_fecha = $objetoNegocios->fecha_sesion($id_sesion);
}
 ?>
 
 <!--JAVASCRIPT PARA EL MAPA DE GOOGLE -->
    <script type="text/javascript">
           var map;
             function initMap() {
               
               //VARIABLES PARA MOSTRAR INFORMACION
               var contentString = 'Sesión iniciada: '+'<?php echo $hist_fecha; ?>'; 
              
               var infowindow = new google.maps.InfoWindow({
               content: contentString
               });

               //TERMINA VARIABLES PARA MOSTRAR INFORMACION
               
               //VARIABLES DE LATITUD Y LOGITUD SELECCIONADA
               var latitud_actual = <?php echo $latitud; ?>;
               var longitud_actual = <?php echo $longitud; ?>;

               var myLatLng = {lat: latitud_actual, lng: longitud_actual};
               //TERMINA VARIABLES DE LATITUD Y LOGITUD ACTUAL

              map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: latitud_actual, lng: longitud_actual},
               zoom: 14 
             });

             //MARCADOR ACTUAL
             var marker = new google.maps.Marker({
               position: myLatLng,
               title: 'Estuvistes aqui'
              });
             marker.setIcon('http://maps.google.com/mapfiles/ms/icons/purple-dot.png');
             marker.setMap(map);
             //TERMINA MARCADOR ACTUAL

             //LISTENER DE CLICK EN EL MARCADOR ACTUAL
             marker.addListener('click', function() {
               //Hace zoom y muestra mensaje
               map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: latitud_actual, lng: longitud_actual},
               zoom: 16
             });
             var marker = new google.maps.Marker({
               position: myLatLng,
               title: 'Actualmente' 
              });
              marker.setIcon('http://maps.google.com/mapfiles/ms/icons/purple-dot.png');
              infowindow.open(map, marker);
              marker.setMap(map);
              marker.addListener('click', function() {
              infowindow.open(map, marker);
              });
             });
             //TERMINA LISTENER DE CLICK EN EL MARCADOR ACTUAL

             }

    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-71bpAiInqRDevFjJmpyn7t3LWqLaidI&callback=initMap">
    </script>
