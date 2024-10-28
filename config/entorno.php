<?php
/**
 * Created by PhpStorm.
 * User: 2527887020201
 * Date: 04/05/2019
 * Time: 10:46 AM
 */
if(env('APP_ENV')=='local')
{
    return[

        'ENTORNO'   				=> 'PRODUCCIÓN',//ENTORNO DE TRABAJO
        'URL_APPI_CENTRAL'			=> env('API_CONEXION', 'http://192.168.220.147:99/pointex/'),//RUTA HACIA EL API CENTRAL DE EXELTIS
        'USUARIO_API' 			    => env('API_USER', 'WEB_CLIENT_POINTEX'),//LLAVE DE COMUNICACION AL API
        'PASS_API'   			    => env('API_PASS', 'wx9nobpbf9F4gg5TAvm6XteLOgR4oJ8g'),//PX_SIS_USUARIO DE COMUNICACION AL API
        'Administrador'         	=>  ['resendy82@gmail.com','julio.ramirez@exeltis.com'],
    ];
}
else
{
    return[

        'ENTORNO'   				=> 'PRODUCCIÓN',//ENTORNO DE TRABAJO
        'URL_APPI_CENTRAL'			=> env('API_CONEXION', 'http://192.168.220.147:99/pointex/'),//RUTA HACIA EL API CENTRAL DE EXELTIS
        'USUARIO_API' 			    => env('API_USER', 'WEB_CLIENT_POINTEX'),//LLAVE DE COMUNICACION AL API
        'PASS_API'   			    => env('API_PASS', 'wx9nobpbf9F4gg5TAvm6XteLOgR4oJ8g'),//PX_SIS_USUARIO DE COMUNICACION AL API
        'Administrador'         	=>  ['resendy82@gmail.com','julio.ramirez@exeltis.com'],
    ];
}
