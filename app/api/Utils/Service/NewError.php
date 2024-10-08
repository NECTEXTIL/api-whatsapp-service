<?php

namespace App\Utils\Service;

use Klein\Klein;
use App\Utils\Utils;
use App\Utils\Errors;
use Cmd\Middleware\CorsMiddleware;
use Symfony\Component\HttpFoundation\Response;

class NewError
{

    /**
     * @param string $body  mesanje
     * @param number|null $StatusCode codigo de error 100.. | 200... | 300... | 400... | 500...
     * @param number|null $NewCodigo  nuevo codigo de error 1000.. | 2000... | 3000... | 4000... | 5000...
     * 
     */
    public static function __Log($body, $StatusCode = 200, $NewCodigo = 0)
    {
        $REQUEST_URI = explode("?", $_SERVER['REQUEST_URI']);
        $error = $StatusCode === null ? $body : Response::$statusTexts[$StatusCode];
        $StatusCode = ($StatusCode === null ? $NewCodigo : $StatusCode);
        $response = [
            "error" => $error,
            "code" => $StatusCode,
            "message" => "(#$StatusCode) " . $body,
            "statusCode" => $StatusCode,
            "timestamp" => Utils::Now(),
            "path" => $REQUEST_URI[0],
            "debug" => "(#$StatusCode)" . $body
        ];

        /*if (property_exists(Errors::List($body, $StatusCode), $NewCodigo)) {
            $response = Errors::List($body, $StatusCode)->{$NewCodigo};
                }
        */
        return  $response;
    }

    public function MmsqlError($err){

        $app = new Klein();
        $app->respond(CorsMiddleware::headers());
        echo json_encode($err);
        $app->dispatch();
        exit();
    }
}
