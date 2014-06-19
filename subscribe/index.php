<?php

error_reporting(E_ALL^E_NOTICE);

include("connect.php");
include("function.php");

/*Igual podríamos usar Ajax para volverlo más dinámico y no usar cookies*/
try {

    if(isset($_POST['subscribe']) && $_SERVER["REQUEST_METHOD"] == "POST") {

        $expire = time()+5;

        if ( !empty($_POST['email'])) $email = sanitise_input($_POST['email']); else $error = true;

        if ( !empty($error)) setcookie("error", "Ocurrio un error al capturar el correo electrónico", $expire, "/");

        $datetime = date('Y-m-d H:i:s', strtotime("-9 hours"));

        $insert = $db->query("INSERT INTO subscribe(email, datetime) VALUES('$email', '$datetime')");

        if(isset($insert)) {
            
            /*Suscribe el correo a un lista existente en MailChimp*/
            include("mailchimp_subscribe.php");
            
            if(isset($retval))
                setcookie("success", "Muchas gracias por formar parte de MatchBlood", $expire, "/");
            
        } else {

            setcookie("error", "Ocurrio un error al ingresar el correo electrónico", "/");

        }

    } else {
        
        setcookie("error", "Ocurrio un error, es culpa nuestra :(", "/");
    
    }

} catch(Exception $ex) {

    setcookie("error", "Ocurrio un error, es culpa nuestra :(");
    
    header('location: ../');
    
}

header('location: ../');

?>