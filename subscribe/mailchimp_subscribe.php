<?php

/*Libreria de MailChimp*/
require_once 'lib/MCAPI.class.php';
/*Configuración de MailChimp*/
require_once 'lib/config.inc.php';

/*API KEY de MailChimp*/
$api = new MCAPI($apikey);

$merge_vars = array('EMAIL' => $email);

/*
    $listId = Id de la lista donde estan almacenados los correos.
    $my_email = El correo que uso para comunicarme y recibir (reenvios o responder).
    $merge_vars = La variable que trae el correo.
*/

$retval = $api->listSubscribe( $listId, $email, $merge_vars );

if ($api->errorCode){

    echo "Unable to load listSubscribe()!\n";
	echo "\tCode=".$api->errorCode."\n";
	echo "\tMsg=".$api->errorMessage."\n";

} else {

    echo "Subscribed - look for the confirmation email!\n";

}

?>