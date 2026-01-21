<?php

$config = require __DIR__ . "/../config/config.php";

$mysqli = new mysqli($config['host'], $config['user'], $config['pass'], $config['db'], $config['port']);

if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

$mysqli->set_charset($config['charset']);
return $mysqli;
