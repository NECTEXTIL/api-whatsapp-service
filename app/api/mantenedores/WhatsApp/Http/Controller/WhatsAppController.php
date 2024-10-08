<?php
namespace Mnt\mantenedores\WhatsApp\Http\Controller;

use Mnt\mantenedores\WhatsApp\Domain\Entities\WhatsAppEntities;
use Mnt\mantenedores\WhatsApp\Domain\Repository\WhatsAppRepository;
use App\Utils\Service\NewController;

class WhatsAppController
{
    public function Buscar()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // validators
            $sv = new WhatsAppEntities($service);
            $sv->validateParamsLista();
            $Ctx = $app->Context;

            // example request
            $start = $request->param('start');
            $length = $request->param('length');
            $search = $request->param('search');
            $order = $request->param('order');

            $repo = new WhatsAppRepository();
            $data = $repo->Buscar($Ctx->id_empresa, $start, $length, $search, $order);

            return  $data;
        });
    }

    public function Listar()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // validators
            $sv = new WhatsAppEntities($service);
            $sv->validateParamsLista();
            //$Ctx = $app->Context;

            // example request
            $start = $request->param('start');
            $length = $request->param('length');
            $search = $request->param('search');
            $order = $request->param('order');

            $repo = new WhatsAppRepository();
            $data = $repo->Listar(1, $start, $length, $search, $order);

            return  $data;
        });
    }

    public function Crear()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // validators
            $sv = new WhatsAppEntities($request, $response, $service);
            //$sv->validateParamsCrear();
            //$Ctx = $app->Context;

            // example
            // $service->validateParam('param_name1', 'Please enter a valid username s')->isLen(4, 6)->isChars('a-zA-Z0-9-');
            // $service->validateParam('param_name2')->notNull();
            $body = $sv->modelRequestBody();

            $repo = new WhatsAppRepository();
            $res = $repo->Crear($sv->FormatArray($body));
            
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

            $repo = new WhatsAppRepository();
            $res = $repo->BuscarPorId($id);
        
            return $res;
        });
    }

    public function Actualizar()
    {
        $ctr = new NewController();

        return $ctr->Controller(function ($request, $response, $service, $app) {
            // validators
            $sv = new WhatsAppEntities($request, $response, $service);
            $sv->validateParamsActualizar();

            // example request, args
            $id = (int)$request->param('id');
            $body = $sv->modelRequestBody();

            $repo = new WhatsAppRepository();
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

            $repo = new WhatsAppRepository();
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

            $repo = new WhatsAppRepository();
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

            $repo = new WhatsAppRepository();
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

            $repo = new WhatsAppRepository();
            return $repo->Codigo($Ctx->id_empresa, $codigo);
        });
    }
}
