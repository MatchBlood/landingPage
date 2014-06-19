<?php

function sanitise_input($data) {
    
    $data = preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $data);
    $data = str_replace(
            array("\xe2\x80\x98", "\xe2\x80\x99", "\xe2\x80\x9c", "\xe2\x80\x9d", "\xe2\x80\x93", "\xe2\x80\x94", "\xe2\x80\xa6"),
            array("'", "'", '"', '"', '-', '--', '...'), 
            $data);
    $data = str_replace(
            array(chr(145), chr(146), chr(147), chr(148), chr(150), chr(151), chr(133)),
            array("'", "'", '"', '"', '-', '--', '...'),
            $data);
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlentities($data, ENT_QUOTES);
    $data = strip_tags($data);
    
    return $data;
    
}  	

?>