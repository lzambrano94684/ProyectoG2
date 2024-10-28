<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 20/07/2020
 * Time: 23:48
 */

namespace App\Http\Controllers\Sistema\Pointex\Modulo\BI;


use App\Http\Controllers\BaseController;
use App\Http\Controllers\Sistema\Pointex\Modulo\Promotion\ReportesController;
use App\Imports\ImportSalesBon;
use App\Modelos\BI\PX_BI_ArchivoSupply;
use App\Modelos\BI\PX_BI_Factura;
use App\Modelos\BI\PX_BI_FacturaDetalle;
use App\Modelos\BI\PX_BI_FacturaDetalleB;
use App\Modelos\BI\PX_BI_FacturaEncabezado;
use App\Modelos\BI\PX_BI_FacturaEncabezadoB;
use App\Modelos\BI\PX_BI_InputsReporte;
use App\Modelos\BI\PX_BI_Ventas;
use App\Modelos\CORE\PX_SIS_ENTIDAD;
use App\Modelos\CORE\PX_SIS_PAIS;
use App\Modelos\GestionProducto\PX_GP_Franquicia;
use App\Modelos\GestionProducto\PX_GP_Producto;
use App\Modelos\GestionProducto\PX_GP_ProductoCodigos;
use App\Modelos\SalesExpenses\PX_SEX_EncabezadoDoc;
use App\Modelos\VisitaMedica\MD_EntregaMM;
use App\Modelos\VisitaMedica\MD_Fichero;
use App\Modelos\VisitaMedica\MD_Menciones;
use App\Modelos\VisitaMedica\MD_Planificacion;
use App\Modelos\VisitaMedica\MD_ProductoLinea;
use App\Modelos\VisitaMedica\MD_Productos;
use App\Modelos\VisitaMedica\MD_Promocion;
use App\Modelos\VisitaMedica\MD_Representante;
use App\Modelos\VisitaMedica\MD_Visita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class PowerBiController extends BaseController
{

    public function index()
    {
        return  self::getOffice360AccessToken();
        if(!is_null($office360token)){

            $url = 'https://api.powerbi.com/v1.0/myorg/datasets/%s/tables/%s/rows';
            $url = sprintf($url, 'YOUR_DATA_SOURCE_ID', 'YOUR_TABLE_ID');

            //$header[] = "content-type: application/json";
            $header = [
                "Authorization:{$office360token->token_type} {$office360token->access_token}",
                "content-type: application/json"
            ];

            $result = self::processPowerbiHttpRequest($url, $header, json_encode([]), 'DELETE');

            $rows = array();

            $rows[] = [
                'Date' => $workforce_last->logged_on,
                'TOTAL EMPLOYEE' => 100,
                'ONDUTY' => 80,
                'ON_VACATION' => 10,
                'DAY_OFF' => 3,
                'ON_ESCORT' => 3,
                'RELIEVER' => 4
            ];

            $data = [
                "rows" => $rows
            ];
            $result = self::processPowerbiHttpRequest($url, $header, json_encode($data), 'POST');



        }
    }

    public static function processPowerbiHttpRequest($url, $header, $data, $method = 'POST')
    {
        $header[] = 'Content-Length:' . strlen($data);
        $context = [
            'http' => [
                'method'  => $method,
                'header'  => implode("\r\n", $header),
                'content' => $data
            ]
        ];
        $content = file_get_contents($url, false, stream_context_create($context));
        if ($content != false) {
            $content = json_decode($content);
        }
        return [
            'content'=> $content,
            'headers'=> $http_response_header,
        ];
    }


    public static function getOffice360AccessToken()
    {
        $data = http_build_query([
            'grant_type'    => 'password',
            'resource'      => 'https://analysis.windows.net/powerbi/api',
            'client_id'     => '7d7f73be-169a-4c6e-bf56-d9cad61a17ae',
            'client_secret' => 'c79aa799-7b2d-4388-9e26-bb548b534144',
            'username'      => 'ccasados@NewCOCG.onmicrosoft.com',
            'password'      => 'Inicio12345',
        ], '', '&');
        $header = [
            "Content-Type:application/x-www-form-urlencoded",
            "return-client-request-id:true",
        ];
        $result = self::processPowerbiHttpRequest('https://login.microsoftonline.com/common/oauth2/token', $header, $data);
        if ($result) {
            return $result['content'];
        }else{
            return null;
        }
    }


    public static function debugPrint($param)
    {
        print '<pre>';
        print_r($param);
        print '</pre>';
    }
}
