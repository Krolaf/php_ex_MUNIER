<?php

    $mode = rand(0, 1) ? 'dark-mode' : 'light-mode'; 
    define('SESSION_NAME','user_session');

    function user_is_connected(){
        //verifier la connexion
        return isset($_SESSION[SESSION_NAME]);
    }
    session_name(SESSION_NAME);
    session_start();

    require_once 'class/data.class.php';
    require_once 'param/route.php';
    require_once 'param/connection.php';

?>


