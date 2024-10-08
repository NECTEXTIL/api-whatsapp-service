<?php
namespace Mnt\mantenedores\Email;

use Mnt\mantenedores\Email\Http\Routes\EmailRoutes;

class EmailMnt
{
    public static function Create($app)
    {
        EmailRoutes::Routes($app);
    }
}
