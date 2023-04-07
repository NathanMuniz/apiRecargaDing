<?php

require __DIR__ . '/vendor/autoload.php';

use \App\DingConnect\Recarga;

$obRecarga = new Recarga();
$auth = $obRecarga->autenticacao("14604a70-eecd-4070-862f-0501d1cc617f", "cTvBbGe3dCXNDzffYXBGgCXZWUhjnRx9Q7aYgDruWXs=");
var_dump($auth);


/*

id:14604a70-eecd-4070-862f-0501d1cc617f
secret:cTvBbGe3dCXNDzffYXBGgCXZWUhjnRx9Q7aYgDruWXs=

 */
