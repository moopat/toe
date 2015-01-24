<?php

$config['key'] = "";
$config['key_analytics'] = "";

$config['db_user'] = "";
$config['db_password'] = "";
$config['db_database'] = "";
$config['db_host'] = "";

$db = @new MySQLi($config['db_host'], $config['db_user'], $config['db_password'], $config['db_database']);

include 'properties.php';

?>