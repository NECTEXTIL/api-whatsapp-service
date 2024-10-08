<?php

namespace Mnt\mantenedores\WhatsApp\Domain\Repository;

use App\Utils\Utils;
use App\Utils\Service\NewError;
use Mnt\mantenedores\WhatsApp\Domain\Response\WhatsAppResponse;
use Mnt\mantenedores\WhatsApp\Persistence\WhatsAppPersistence;

class WhatsAppRepository
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

    public function Buscar($id_empresa, $start, $length, $search, $order)
    {
        $data = WhatsAppPersistence::Buscar($id_empresa, $start, $length, $search, $order);

        $rs = new WhatsAppResponse($this->service);
        $data = $rs->ListaResponse($data);

        return  $data;
    }

    public function Listar($id_empresa, $start, $length, $search, $order)
    {
        $data = WhatsAppPersistence::Listar($id_empresa, $start, $length, $search, $order);

        $rs = new WhatsAppResponse($this->service);
        $data = $rs->ListaResponse($data);

        return  $data;
    }

    public function Crear($data)
    {
        // validators
        $res = WhatsAppPersistence::Crear($data);

        $rs = new WhatsAppResponse($this->service);
        //$rs->ListaResponse($res);
        //return $rs->SendMessage($data);

        return $rs->ListaResponse($res);
    }

    public function BuscarPorId($id)
    {
        $res = WhatsAppPersistence::BuscarPorId($id);

        $rs = new WhatsAppResponse($this->service);
        $data = $rs->ListaResponse($res);

        return  empty($data) ? NewError::__Log("El id no existe", 202) : $data[0];
    }

    public function Actualizar($id, $body)
    {
        // validators
        $data = WhatsAppPersistence::Actualizar($id, $body);

        //$rs = new WhatsAppResponse($this->service);
        $res = Utils::responseParamsUpdate($data, $id);
        return  $res;
    }

    public function Eliminar($id)
    {
        $res = WhatsAppPersistence::Eliminar($id);

        return  $res;
    }

    public function HabilitarDeshabilitar($id, $status)
    {
        return WhatsAppPersistence::HabilitarDeshabilitar($id, $status);
    }

    public function Codigo($id_empresa, $codigo)
    {
        $res = WhatsAppPersistence::Codigo($id_empresa, $codigo);

        if ($res === 1) {
            return true;
        }

        return false;
    }
}
