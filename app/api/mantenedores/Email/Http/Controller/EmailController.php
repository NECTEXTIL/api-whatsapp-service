<?php

namespace Mnt\mantenedores\Email\Http\Controller;

use Mnt\mantenedores\Email\Domain\Entities\EmailEntities;
use Mnt\mantenedores\Email\Domain\Repository\EmailRepository;
use App\Utils\Service\NewController;

class EmailController
{
    public function Buscar()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // validators
            $sv = new EmailEntities($service);
            $sv->validateParamsLista();
            $Ctx = $app->Context;

            // example request
            $start = $request->param('start');
            $length = $request->param('length');
            $search = $request->param('search');
            $order = $request->param('order');

            $repo = new EmailRepository();
            $data = $repo->Buscar($Ctx->id_empresa, $start, $length, $search, $order);

            return  $data;
        });
    }

    public function Listar()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // validators
            $sv = new EmailEntities($service);
            $sv->validateParamsLista();
            $Ctx = $app->Context;

            // example request
            $start = $request->param('start');
            $length = $request->param('length');
            $search = $request->param('search');
            $order = $request->param('order');

            $repo = new EmailRepository();
            $data = $repo->Listar($Ctx->id_empresa, $start, $length, $search, $order);

            return  $data;
        });
    }

    public function Crear()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // validators
            $sv = new EmailEntities($request, $response, $service);
            $sv->validateParamsCrear();

            $body = $sv->modelRequestBody();

            $repo = new EmailRepository();
            $data = $sv->parseParamsCrear($body);
            $res = $repo->Crear($data, 1);

            // if (isset($res[0]['id'])) {
            //     $res = $repo->BuscarPorId($res[0]['id']);
            //     return $res;
            // }
            return $res;
        });
    }

    public function BuscarPorId()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // example request, args
            $Ctx = $app->Context;
            // $service->validateParam('param_name1', 'Please enter a valid username s')->isLen(4, 6)->isChars('a-zA-Z0-9-');
            // $service->validateParam('param_name2')->notNull();
            $id = (int)$request->param('id');

            $repo = new EmailRepository();
            $res = $repo->BuscarPorId($id);

            return $res;
        });
    }

    public function Actualizar()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // validators
            $sv = new EmailEntities($request, $response, $service);
            $sv->validateParamsActualizar();

            // example request, args
            $id = (int)$request->param('id');
            $body = $sv->modelRequestBody();

            $repo = new EmailRepository();
            $res = $repo->Actualizar($id, $body);

            $res->data = $repo->BuscarPorId($id);
            return  $res;
        });
    }

    public function Eliminar()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service) {
            // example request, args
            $id = (int)$request->param('id');

            $repo = new EmailRepository();
            $res = $repo->Eliminar($id);

            return  $res;
        });
    }

    public function Habilitar()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service) {
            // example request, args
            $id = (int)$request->param('id');

            $repo = new EmailRepository();
            $res =  $repo->HabilitarDeshabilitar($id, true);

            return  $res;
        });
    }

    public function Deshabilitar()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service) {
            // example request, args
            $id = (int)$request->param('id');

            $repo = new EmailRepository();
            $res =  $repo->HabilitarDeshabilitar($id, 'false');

            return  $res;
        });
    }

    public function Codigo()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // validator
            // example request
            $Ctx = $app->Context;
            $codigo = $request->param('code');

            $repo = new EmailRepository();
            return $repo->Codigo($Ctx->id_empresa, $codigo);
        });
    }
}
