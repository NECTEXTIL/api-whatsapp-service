<?php
namespace Mnt\mantenedores\WhatsApp;

use Mnt\mantenedores\WhatsApp\Http\Routes\WhatsAppRoutes;

class WhatsAppMnt
{
    public static function Create($app)
    {
        WhatsAppRoutes::Routes($app);
    }
}
