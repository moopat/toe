<?php

$config['key'] = "";
$config['cookiename'] = "toekey";

$config['db_user'] = "";
$config['db_password'] = "";
$config['db_database'] = "";
$config['db_host'] = "";

$db = @new MySQLi($config['db_host'], $config['db_user'], $config['db_password'], $config['db_database']);

?>