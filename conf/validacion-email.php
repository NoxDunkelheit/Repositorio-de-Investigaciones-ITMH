	<?php
            if(isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']){
    //var_dump($_POST);
    $secret = "6LdamAsUAAAAAGMQwJuZHI6OIqI5qffRTWdrDoek";
    $ip = $_SERVER['REMOTE_ADDR'];

    $captcha = $_POST['g-recaptcha-response'];

    $result = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");

    //echo "<br>";
    //var_dump($result);

    $array = json_decode($result,TRUE);
    //echo "<br>";

    if($array["success"]){
            
            //echo "Tu variable its nombre: ".$_POST['nombre'];
        echo "<script>
        window.location = '../mail/mail_01.php?nombre=".$_POST['nombre']."&correo=".$_POST['correo']."&asunto=".$_POST['asunto']."&mensaje=".$_POST['mensaje']."';
        </script>";
    }else{
        echo "<script>
        alert('Mensaje no enviado');
        window.location = '../index.php';
        </script>";
    }
}else{
        echo "<script>
        alert('Mensaje no enviado');
        window.location = '../index.php';
        </script>";
    }

	?>