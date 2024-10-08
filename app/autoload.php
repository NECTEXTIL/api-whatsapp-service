<?php

$sv = $_SERVER['REQUEST_URI'];
$request = explode("?", $_SERVER['REQUEST_URI']);
$phats = explode("/", $request[0]);
if ($sv === '/' || count($phats)  <= 2) {
    // Encabezados CORS
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Origin, Accept');

    // Generar un error 400
    header('HTTP/1.1 400 Bad Request');
    // Opcional: Mostrar una página de error personalizada
    echo "Error 400 - Solicitud Incorrecta";
    return;
}
//vendor
require_once __DIR__ . '/../vendor/autoload.php';


include_once(dirname(__FILE__) . '/config/config.php');

include_once(dirname(__FILE__) . '/app.php');
