<?php
// router.php

// Esta es la ruta al archivo index.php
define('APP_ENTRY_POINT', __DIR__ . '/app/autoload.php');

// Carpeta permitida
$allowed_folder = 'public';
$excel_tem = '/public/docs/excel/temp/';

// Si la solicitud es para un archivo existente, ignora la reescritura y sirve el archivo
$blocked_folders = glob('*', GLOB_ONLYDIR);

$request_uri = $_SERVER['REQUEST_URI'];
// Verifica si la solicitud es para una carpeta bloqueada
foreach ($blocked_folders as $folder) {
    if ($folder === $allowed_folder) {
        if (strpos($request_uri, $excel_tem) !== false) {
            $file = ".".str_replace('%20', ' ', $request_uri);
            if (file_exists($file)) {
                // Limpiar el buffer de salida
                // header('Content-Description: File Transfer');
                // header("Content-Type:  application/vnd.ms-excel");
                // header('Content-Disposition: attachment; filename="' . basename($file) . '"');
                // header('Expires: 0');
                // header('Cache-Control: must-revalidate');
                // header('Pragma: public');
                // header('Content-Length: ' . filesize($file));
                // // Limpiar el buffer de salida
                // ob_clean();
                // flush();

                // // Leer el archivo
                // readfile($file);

                // // Eliminar el archivo después de la descarga
                // unlink($file);
            }
        }
        return false;
    } else {
        if (strpos($request_uri, '/' . $folder . '/') === 0 || $request_uri === '/' . $folder) {
            // Devuelve un error 404 y termina el script
            http_response_code(404);
            echo 'Error 404 - Not Found';
            exit();
        }
    }
}

// Si la solicitud no es para un archivo existente, incluye el archivo index.php
require_once APP_ENTRY_POINT;
