<?php
$code = $_GET['err'];

if($code == '1'){
echo "<script>
        alert('LA CUENTA NO ESTA ACTIVADA, CONTACTE CON EL ADMINISTRADOR');
        window.location = 'index.php';
        </script>";
}else if($code == '2'){
echo "<script>
        alert('USUARIO O CONTRASENIA INCORRECTA, VERIFIQUE NUEVAMENTE');
        window.location = 'index.php';
        </script>";
}else if($code == '3'){
echo "<script>
        alert('ERROR NO SE PUDO COMPROBAR LA VERIFICACIÓN DEL CAPTCHA');
        window.location = 'alumnos/index.php';
        </script>";
}else if($code == '4'){
echo "<script>
        alert('ACTUALIZADO CON EXITO');
        window.location = 'alumnos/index.php';
        </script>";
}else if($code == '5'){
echo "<script>
        alert('TU CUENTA A SIDO ACTIVADA');
        window.location = 'alumnos/index.php';
        </script>";
}else if($code == '6'){
echo "<script>
        alert('TU CUENTA A SIDO ACTIVADA');
        window.location = 'profesores/index.php';
        </script>";
}else if($code == '7'){
echo "<script>
        alert('ACTUALIZADO CON EXITO');
        window.location = 'profesores/index.php';
        </script>";
}else if($code == '8'){
echo "<script>
        alert('TU CUENTA A SIDO ACTIVADA');
        window.location = 'administradores/index.php';
        </script>";
}else if($code == '9'){
echo "<script>
        alert('ACTUALIZADO CON EXITO');
        window.location = 'administradores/index.php';
        </script>";
}
?>