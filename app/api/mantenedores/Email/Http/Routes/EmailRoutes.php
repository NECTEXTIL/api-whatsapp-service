<?php
namespace Mnt\mantenedores\Email\Http\Routes;

use Mnt\mantenedores\Email\Http\Controller\EmailController;

class EmailRoutes
{
    public static function Routes($router)
    {
        $ctr = new EmailController();
    
        // Rutas
        $router->get('/email-buscar', $ctr->Buscar());
        $router->get('/email', $ctr->Listar());
        $router->post('/email', $ctr->Crear());
        $router->get('/email/[i:id]', $ctr->BuscarPorId());
        $router->put('/email/[i:id]', $ctr->Actualizar());
        $router->delete('/email/[i:id]', $ctr->Eliminar());
        $router->patch('/email/[i:id]/habilitar', $ctr->Habilitar());
        $router->patch('/email/[i:id]/deshabilitar', $ctr->Deshabilitar());
        $router->get('/email-codigo', $ctr->Codigo());
    }
}
