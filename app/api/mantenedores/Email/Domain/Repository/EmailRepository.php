<?php

namespace Mnt\mantenedores\Email\Domain\Repository;

use App\Utils\Utils;
use App\Utils\Service\NewError;
use Mnt\mantenedores\Email\Persistence\EmailPersistence;
use Mnt\mantenedores\Email\Domain\Response\EmailResponse;
use Mnt\mantenedores\Empresa\Domain\Repository\EmpresaRepository;

class EmailRepository
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
        $data = EmailPersistence::Buscar($id_empresa, $start, $length, $search, $order);

        $rs = new EmailResponse($this->service);
        $data = $rs->ListaResponse($data);

        return  $data;
    }

    public function Listar($id_empresa, $start, $length, $search, $order)
    {
        $data = EmailPersistence::Listar($id_empresa, $start, $length, $search, $order);

        $rs = new EmailResponse($this->service);
        $data = $rs->ListaResponse($data);

        return  $data;
    }

    public function Crear($body, $id_empresa)
    {
        // validators
        $res = EmailPersistence::Crear($body, $id_empresa);

        $rs = new EmailResponse($this->service);
        $emails = $rs->ListaResponse($res);

        $repo = new EmpresaRepository();
        $empresa = $repo->BuscarPorId(1);

        //return $rs->SendEmail($res);

        if (count($emails)) {
            foreach ($emails as $key => $email) {
                $rs->SendEmail($email, $empresa);
            }
        }

        return $emails;
    }

    public function BuscarPorId($id)
    {
        $res = EmailPersistence::BuscarPorId($id);

        $rs = new EmailResponse($this->service);
        $data = $rs->ListaResponse($res);

        return  empty($data) ? NewError::__Log("El id no existe", 202) : $data[0];
    }

    public function Actualizar($id, $body)
    {
        // validators
        $data = EmailPersistence::Actualizar($id, $body);

        //$rs = new EmailResponse($this->service);
        $res = Utils::responseParamsUpdate($data, $id);
        return  $res;
    }

    public function Eliminar($id)
    {
        $res = EmailPersistence::Eliminar($id);

        return  $res;
    }

    public function HabilitarDeshabilitar($id, $status)
    {
        return EmailPersistence::HabilitarDeshabilitar($id, $status);
    }

    public function Codigo($id_empresa, $codigo)
    {
        $res = EmailPersistence::Codigo($id_empresa, $codigo);

        if ($res === 1) {
            return true;
        }

        return false;
    }
}
