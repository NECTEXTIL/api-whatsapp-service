<?php

namespace Cmd\Services;

use Throwable;
use App\Auth\AuthApp;
use Mnt\mantenedores\Usuario\UsuarioMnt;
use Mnt\mantenedores\Email\EmailMnt;
use Mnt\mantenedores\Empresa\EmpresaMnt;
use Mnt\mantenedores\WhatsApp\WhatsAppMnt;

class Enpoints
{
    /**
     * @endpoints... 
     * @param Throwable
     * validar si hay referencia de clasname y no hay archivo
     * */
    public static function initEndpoints($router)
    {
        AuthApp::Create($router);
        UsuarioMnt::Create($router);
        EmailMnt::Create($router);
        EmpresaMnt::Create($router);
        WhatsAppMnt::Create($router);
    }
}
