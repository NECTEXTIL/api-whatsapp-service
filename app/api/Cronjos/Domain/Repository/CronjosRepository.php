<?php

namespace App\Cronjos\Domain\Repository;

use App\Utils\Utils;
use App\Utils\Service\NewError;
use App\Cronjos\Domain\Response\CronjosResponse;
use App\Cronjos\Persistence\CronjosPersistence;

class CronjosRepository
{
    private $request;
    private $response;
    private $service;

    public function __construct($request = null, $response = null, $service = null)
    {
        $this->request = $request;
        $this->response = $response;
        $this->service = $service;
    }

    public function CronWhatsApp()
    {
        // validators
        $res = CronjosPersistence::Listar(1);

        $rs = new CronjosResponse();
        $lista = $rs->ListaResponse($res);

        if (count($lista)) {
            foreach ($lista as $key => $value) {
                if (date('Y-m-d H:i', strtotime($value['fecha_envio'])) === Utils::DateTime('Y-m-d H:i')) {
                    $respuesta = $rs->SendMessage($value);
                    //echo $respuesta;
                    CronjosPersistence::Actualizar($value['id'],$respuesta);
                }
            }
        }
        // execute
        //return json_encode($lista);
    }

    public function BuscarPorId($id)
    {
        $res = CronjosPersistence::BuscarPorId($id);

        $rs = new CronjosResponse($this->service);
        $data = $rs->ListaResponse($res);

        return  empty($data) ? NewError::__Log("El id no existe", 202) : $data[0];
    }

    public function Actualizar($id, $body)
    {
        // validators
        $data = CronjosPersistence::Actualizar($id, $body);

        //$rs = new CronjosResponse($this->service);
        $res = Utils::responseParamsUpdate($data, $id);
        return  $res;
    }

    public function Eliminar($id)
    {
        $res = CronjosPersistence::Eliminar($id);

        return  $res;
    }

    public function HabilitarDeshabilitar($id, $status)
    {
        return CronjosPersistence::HabilitarDeshabilitar($id, $status);
    }

    public function Codigo($id_empresa, $codigo)
    {
        $res = CronjosPersistence::Codigo($id_empresa, $codigo);

        if ($res === 1) {
            return true;
        }

        return false;
    }
}
