<?php

function isLoggedIn(){
    include 'config.php';
    return isset($_COOKIE[$config['cookiename']]) && $_COOKIE[$config['cookiename']] == $config['key'];
}

?>