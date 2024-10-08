<?php

namespace Mnt\mantenedores\Empresa\Domain\Response;

class EmpresaResponse
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
                //$data[$key]['habilitado'] = boolval($value['habilitado']);
                $data[$key]['index'] = ($key + 1);
            }
        }

        return $data;
    }

    public function decodeBase64($data)
    {
        if (count($data)) {
            foreach ($data as $key => $value) {
                //$data[$key]['habilitado'] = $value['template_body'];
                $decoded_template = base64_decode($value['template_body']);
                 $data[$key]['template_body'] = $decoded_template;

                // if (json_last_error() !== JSON_ERROR_NONE) {
                //     $data[$key]['template_body']= 'Error al decodificar el JSON: ' . json_last_error_msg();
                // }
            }
        }

        return $data;
    }
}
