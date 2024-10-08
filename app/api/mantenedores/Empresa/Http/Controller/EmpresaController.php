<?php
namespace Mnt\mantenedores\Empresa\Http\Controller;

use Mnt\mantenedores\Empresa\Domain\Entities\EmpresaEntities;
use Mnt\mantenedores\Empresa\Domain\Repository\EmpresaRepository;
use App\Utils\Service\NewController;

class EmpresaController
{
    public function Buscar()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // validators
            $sv = new EmpresaEntities($service);
            $sv->validateParamsLista();
            $Ctx = $app->Context;

            // example request
            $start = $request->param('start');
            $length = $request->param('length');
            $search = $request->param('search');
            $order = $request->param('order');

            $repo = new EmpresaRepository();
            $data = $repo->Buscar($Ctx->id_empresa, $start, $length, $search, $order);

            return  $data;
        });
    }

    public function Listar()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // validators
            $sv = new EmpresaEntities($service);
            $sv->validateParamsLista();

            // example request
            $start = $request->param('start');
            $length = $request->param('length');
            $search = $request->param('search');
            $order = $request->param('order');

            $repo = new EmpresaRepository();
            $data = $repo->Listar($start, $length, $search, $order);

            return  $data;
        });
    }

    public function Crear()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // validators
            $sv = new EmpresaEntities($request, $response, $service);
            $sv->validateParamsCrear();

            $body = $sv->modelRequestBody();

            $repo = new EmpresaRepository();
            $res = $repo->Crear($body, 1);
            
            if (isset($res[0]['id'])) {
                $res = $repo->BuscarPorId($res[0]['id']);
                return $res;
            }
            return $res;
        });
    }

    public function BuscarPorId()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // example request, args
            $id = (int)$request->param('id');

            $repo = new EmpresaRepository();
            $res = $repo->BuscarPorId($id);
        
            return $res;
        });
    }

    public function Actualizar()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // validators
            $sv = new EmpresaEntities($request, $response, $service);
            $sv->validateParamsActualizar();

            // example request, args
            $id = (int)$request->param('id');
            $body = $sv->modelRequestBody();

            $repo = new EmpresaRepository();
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

            $repo = new EmpresaRepository();
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

            $repo = new EmpresaRepository();
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

            $repo = new EmpresaRepository();
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

            $repo = new EmpresaRepository();
            return $repo->Codigo($Ctx->id_empresa, $codigo);
        });
    }
}
