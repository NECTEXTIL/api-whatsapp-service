<?php
namespace Mnt\mantenedores\WhatsApp\Http\Routes;

use Mnt\mantenedores\WhatsApp\Http\Controller\WhatsAppController;

class WhatsAppRoutes
{
    public static function Routes($router)
    {
        $ctr = new WhatsAppController();
    
        // Rutas
        $router->get('/whatsapp-buscar', $ctr->Buscar());
        $router->get('/whatsapp', $ctr->Listar());
        $router->post('/whatsapp', $ctr->Crear());
        $router->get('/whatsapp/[i:id]', $ctr->BuscarPorId());
        $router->put('/whatsapp/[i:id]', $ctr->Actualizar());
        $router->delete('/whatsapp/[i:id]', $ctr->Eliminar());
        $router->patch('/whatsapp/[i:id]/habilitar', $ctr->Habilitar());
        $router->patch('/whatsapp/[i:id]/deshabilitar', $ctr->Deshabilitar());
        $router->get('/whatsapp-codigo', $ctr->Codigo());
    }
}
