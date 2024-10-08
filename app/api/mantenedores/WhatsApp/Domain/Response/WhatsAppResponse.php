<?php

namespace Mnt\mantenedores\WhatsApp\Domain\Response;

class WhatsAppResponse
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

}
