<?php

function isLoggedIn(){
    $config = array();
    include 'config.php';
    return isset($_COOKIE[$config['cookiename']]) && $_COOKIE[$config['cookiename']] == $config['key'];
}

function logAttempt($vocabid, $correct, $answer){
    $db = null;
    include 'config.php';
    $vocabid = mysqli_real_escape_string($db, $vocabid);
    $correct = $correct ? 1 : 0;
    $answer = mysqli_real_escape_string($db, $answer);

    $query = "INSERT INTO attempts (fk_vocabid, correct, answer) VALUES ('$vocabid', $correct, '$answer')";
    mysqli_query($db, $query);
}

?>