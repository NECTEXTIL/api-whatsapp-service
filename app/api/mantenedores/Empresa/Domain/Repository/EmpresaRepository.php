<?php
namespace Mnt\mantenedores\Empresa\Domain\Repository;

use App\Utils\Utils;
use App\Utils\Service\NewError;
use Mnt\mantenedores\Empresa\Domain\Response\EmpresaResponse;
use Mnt\mantenedores\Empresa\Persistence\EmpresaPersistence;

class EmpresaRepository
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
        $data = EmpresaPersistence::Buscar($id_empresa, $start, $length, $search, $order);

        $rs = new EmpresaResponse($this->service);
        $data = $rs->ListaResponse($data);

        return  $data;
    }

    public function Listar($start, $length, $search, $order)
    {
        $data = EmpresaPersistence::Listar($start, $length, $search, $order);

        $rs = new EmpresaResponse($this->service);
        $data = $rs->ListaResponse($data);

        return  $data;
    }

    public function Crear($body, $id_empresa)
    {
        // validators
        $res = EmpresaPersistence::Crear($body, $id_empresa);

        //$rs = new EmpresaResponse($this->service);
        
        return $res;
    }

    public function BuscarPorId($id)
    {
        $res = EmpresaPersistence::BuscarPorId($id);

        $rs = new EmpresaResponse($this->service);
        $data = $rs->ListaResponse($res);
        $data = $rs->decodeBase64($res);

        return  empty($data) ? NewError::__Log("El id no existe", 202) : $data[0];
    }

    public function Actualizar($id, $body)
    {
        // validators
        $data = EmpresaPersistence::Actualizar($id, $body);
        
        //$rs = new EmpresaResponse($this->service);
        $res = Utils::responseParamsUpdate($data, $id);
        return  $res;
    }

    public function Eliminar($id)
    {
        $res = EmpresaPersistence::Eliminar($id);

        return  $res;
    }

    public function HabilitarDeshabilitar($id, $status)
    {
        return EmpresaPersistence::HabilitarDeshabilitar($id, $status);
    }

    public function Codigo($id_empresa, $codigo)
    {
        $res = EmpresaPersistence::Codigo($id_empresa, $codigo);

        if ($res === 1) {
            return true;
        }

        return false;
    }

}
