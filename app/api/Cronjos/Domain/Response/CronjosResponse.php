<?php

namespace App\Cronjos\Domain\Response;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class CronjosResponse
{
    private $request;
    private $response;
    private $service;
    private $app;
    private $model;

    public function __construct($request = null, $response = null, $service = null, $app = null)
    {
        $this->request = $request;
        $this->response = $response;
        $this->service = $service;
        $this->app = $app;

        $this->model = $request ?? $response ?? $service ?? $app;
    }

    /**
     * @param $data type array
     * @return array
     */
    public function ListaResponse($data)
    {
        if (count($data)) {
            foreach ($data as $key => $value) {
                $data[$key]['body'] = isset($value['body']) ? json_decode($value['body']) : null;
                $data[$key]['detalle'] = isset($value['body']) ? json_decode($value['detalle']) : null;
            }
        }

        return $data;
    }

    public function SendMessage($data)
    {

        $client = new Client();
        try {

            $response = $client->post($data['url'], [
                'headers' => [
                    'Authorization' => 'Bearer ' . $data['token'],
                    'Content-Type' => 'application/json',
                ],
                'json' => $data['body']
            ]);

            // OBTENEMOS EL CUERPO DE LA RESPUESTA
            $body = $response->getBody();
            $res = json_decode($body, true);
            return [
                "estado" => 'ENVIADO',
                "detalle" => json_encode($res),
            ];
            //return $res->getBody();
        } catch (RequestException $e) {
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);;
            return [
                "estado" => 'ERROR',
                "detalle" => json_encode($error),
            ];
        }
    }
}
