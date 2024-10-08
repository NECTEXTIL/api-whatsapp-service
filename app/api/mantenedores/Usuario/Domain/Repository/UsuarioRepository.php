<?php

namespace Mnt\mantenedores\Usuario\Domain\Repository;

use App\Utils\Utils;
use App\Utils\Service\NewError;
use Mnt\mantenedores\Usuario\Persistence\UsuarioPersistence;
use Mnt\mantenedores\Usuario\Domain\Response\UsuarioResponse;

class UsuarioRepository
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

    public function Buscar($start, $length, $search, $order, $id_empresa)
    {
        $data = UsuarioPersistence::Buscar($start, $length, $search, $order, $id_empresa);

        $rs = new UsuarioResponse($this->service);
        $data = $rs->ListaUsuarioResponse($data);

        return  $data;
    }

    public function Listar($Ctx,$start, $length, $search, $order)
    {
        $data = UsuarioPersistence::Listar($Ctx, $start, $length, $search, $order);

        $rs = new UsuarioResponse($this->service);
        $data = $rs->ListaResponse($data);

        return  $data;
    }

    public function Crear($body, $id_empresa)
    {
        // validators
        $res = UsuarioPersistence::Crear($body, $id_empresa);

        //$rs = new UsuarioResponse($this->service);

        return $res;
    }

    public function BuscarPorId($id)
    {
        $res = UsuarioPersistence::BuscarPorId($id);

        $rs = new UsuarioResponse($this->service);
        $data = $rs->ListaResponse($res);
        return   empty($data) ? NewError::__Log("El id no existe", 202) : $data[0];
    }

    public function Actualizar($id, $body)
    {
        // validators
        $res = UsuarioPersistence::Actualizar($id, $body);

        $data = Utils::responseParamsUpdate($res, $id);

        return  $data;
    }

    public function Eliminar($id)
    {
        $res = UsuarioPersistence::Eliminar($id);

        return  $res;
    }

    public function HabilitarDeshabilitar($id, $status)
    {
        return UsuarioPersistence::HabilitarDeshabilitar($id, $status);
    }
}
