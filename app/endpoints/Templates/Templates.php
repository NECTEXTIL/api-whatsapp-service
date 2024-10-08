<?php

namespace Sv\Templates;

class Templates
{
    public static $routes = [
        //////////////endpoint login -
        [
            "endpoint" => "/v1/login",
            "method" => "POST",
            "querystring_params" => [],
            "headers_to_pass" => null,
            "url_pattern" => "/login"
        ],
        [
            "endpoint" => "/v1/logout",
            "method" => "POST",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/logout"
        ],
        //////////////endpoint usuario -
        [
            "endpoint" => "/v1/usuario", //crea
            "method" => "POST",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/usuario"
        ],
        [
            "endpoint" => "/v1/usuario", //lista todos los usuario
            "method" => "GET",
            "querystring_params" => ['start', 'length', 'search', 'order'],
            "headers_to_pass" =>  null,
            "url_pattern" => "/usuario"
        ],
        [
            "endpoint" => "/v1/usuario-buscar", //lista todos los usuario
            "method" => "GET",
            "querystring_params" => ['start', 'length', 'search', 'order'],
            "headers_to_pass" =>  null,
            "url_pattern" => "/usuario-buscar"
        ],
        [
            "endpoint" => "/v1/usuario/[i:id]", //busca por ID
            "method" => "GET",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/usuario/[i:id]"
        ],
        [
            "endpoint" => "/v1/usuario/[i:id]", //actualiza por id
            "method" => "PUT",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/usuario/[i:id]"
        ],
        [
            "endpoint" => "/v1/usuario/[i:id]/habilitar", //actualiza por id
            "method" => "PATCH",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/usuario/[i:id]/habilitar"
        ],
        [
            "endpoint" => "/v1/usuario/[i:id]/deshabilitar", //actualiza por id
            "method" => "PATCH",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/usuario/[i:id]/deshabilitar"
        ],
        [
            "endpoint" => "/v1/usuario/[i:id]", //elimina por id
            "method" => "DELETE",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/usuario/[i:id]"
        ],
        [
            "endpoint" => "/v1/usuario-password/[i:id]", //actualiza por id
            "method" => "PUT",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/usuario-password/[i:id]"
        ],
        //////////////endpoint EMPRESA -
        [
            "endpoint" => "/v1/empresa", //crea
            "method" => "POST",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/empresa"
        ],
        [
            "endpoint" => "/v1/empresa-buscar", //lista todos los empresa
            "method" => "GET",
            "querystring_params" => ['start', 'length', 'search', 'order'],
            "headers_to_pass" =>  null,
            "url_pattern" => "/empresa-buscar"
        ],
        [
            "endpoint" => "/v1/empresa", //lista todos los empresa
            "method" => "GET",
            "querystring_params" => ['start', 'length', 'search', 'order'],
            "headers_to_pass" =>  null,
            "url_pattern" => "/empresa"
        ],
        [
            "endpoint" => "/v1/empresa/[i:id]", //busca por ID
            "method" => "GET",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/empresa/[i:id]"
        ],
        [
            "endpoint" => "/v1/empresa/[i:id]", //actualiza por id
            "method" => "PUT",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/empresa/[i:id]"
        ],
        [
            "endpoint" => "/v1/empresa/[i:id]/habilitar", //actualiza por id
            "method" => "PATCH",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/empresa/[i:id]/habilitar"
        ],
        [
            "endpoint" => "/v1/empresa/[i:id]/deshabilitar", //actualiza por id
            "method" => "PATCH",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/empresa/[i:id]/deshabilitar"
        ],
        [
            "endpoint" => "/v1/empresa/[i:id]", //elimina por id
            "method" => "DELETE",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/empresa/[i:id]"
        ],
        [
            "endpoint" => "/v1/empresa-codigo", //elimina por id
            "method" => "GET",
            "querystring_params" => ['code'],
            "headers_to_pass" =>  null,
            "url_pattern" => "/empresa-codigo"
        ],
        //////////////endpoint email -
        [
            "endpoint" => "/v1/email", //crea
            "method" => "POST",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/email"
        ],
        [
            "endpoint" => "/v1/email-buscar", //lista todos los email
            "method" => "GET",
            "querystring_params" => ['start', 'length', 'search', 'order'],
            "headers_to_pass" =>  null,
            "url_pattern" => "/email-buscar"
        ],
        [
            "endpoint" => "/v1/email", //lista todos los email
            "method" => "GET",
            "querystring_params" => ['start', 'length', 'search', 'order'],
            "headers_to_pass" =>  null,
            "url_pattern" => "/email"
        ],
        [
            "endpoint" => "/v1/email/[i:id]", //busca por ID
            "method" => "GET",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/email/[i:id]"
        ],
        [
            "endpoint" => "/v1/email-detalle/[i:id]", //busca por ID
            "method" => "GET",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/email-detalle/[i:id]"
        ],
        [
            "endpoint" => "/v1/email/[i:id]", //actualiza por id
            "method" => "PUT",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/email/[i:id]"
        ],
        [
            "endpoint" => "/v1/email/[i:id]/habilitar", //habilitar por id
            "method" => "PATCH",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/email/[i:id]/habilitar"
        ],
        [
            "endpoint" => "/v1/email/[i:id]/deshabilitar", //deshabilitar por id
            "method" => "PATCH",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/email/[i:id]/deshabilitar"
        ],
        [
            "endpoint" => "/v1/email/[i:id]", //elimina por id
            "method" => "DELETE",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/email/[i:id]"
        ],
        [
            "endpoint" => "/v1/email-codigo", //elimina por id
            "method" => "GET",
            "querystring_params" => ['code'],
            "headers_to_pass" =>  null,
            "url_pattern" => "/email-codigo"
        ],
        //////////////endpoint whatsapp -
        [
            "endpoint" => "/v1/whatsapp", //crea
            "method" => "POST",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/whatsapp"
        ],
        [
            "endpoint" => "/v1/whatsapp-buscar", //lista todos los whatsapp
            "method" => "GET",
            "querystring_params" => ['start', 'length', 'search', 'order'],
            "headers_to_pass" =>  null,
            "url_pattern" => "/whatsapp-buscar"
        ],
        [
            "endpoint" => "/v1/whatsapp", //lista todos los whatsapp
            "method" => "GET",
            "querystring_params" => ['start', 'length', 'search', 'order'],
            "headers_to_pass" =>  null,
            "url_pattern" => "/whatsapp"
        ],
        [
            "endpoint" => "/v1/whatsapp/[i:id]", //busca por ID
            "method" => "GET",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/whatsapp/[i:id]"
        ],
        [
            "endpoint" => "/v1/whatsapp-detalle/[i:id]", //busca por ID
            "method" => "GET",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/whatsapp-detalle/[i:id]"
        ],
        [
            "endpoint" => "/v1/whatsapp/[i:id]", //actualiza por id
            "method" => "PUT",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/whatsapp/[i:id]"
        ],
        [
            "endpoint" => "/v1/whatsapp/[i:id]/habilitar", //habilitar por id
            "method" => "PATCH",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/whatsapp/[i:id]/habilitar"
        ],
        [
            "endpoint" => "/v1/whatsapp/[i:id]/deshabilitar", //deshabilitar por id
            "method" => "PATCH",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/whatsapp/[i:id]/deshabilitar"
        ],
        [
            "endpoint" => "/v1/whatsapp/[i:id]", //elimina por id
            "method" => "DELETE",
            "querystring_params" => [],
            "headers_to_pass" =>  null,
            "url_pattern" => "/whatsapp/[i:id]"
        ],
        [
            "endpoint" => "/v1/whatsapp-codigo", //elimina por id
            "method" => "GET",
            "querystring_params" => ['code'],
            "headers_to_pass" =>  null,
            "url_pattern" => "/whatsapp-codigo"
        ],
    ];
}
