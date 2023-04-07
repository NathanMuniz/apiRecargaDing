<?php

require __DIR__ . '/vendor/autoload.php';

// Habilitando erro 
error_reporting(E_ALL);
ini_set('display_errors', 1);

use \App\DingConnect\Recarga;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$obRecarga = new Recarga();
$auth = $obRecarga->autenticacao($_ENV['CLIENT_ID'], $_ENV['CLIENT_SECRET']);

echo $auth;
