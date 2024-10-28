<?php
/**
 * Created by Luis Rivas.
 * User: 1924263381014
 * Date: 28/06/2016
 * Time: 12:45 PM
 */

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\HttpRequest as Api;
use App\Http\Controllers\BaseController;
use App\Modelos\CORE\PX_SIS_ROLES_USUARIO;
use App\Modelos\CORE\PX_SIS_USUARIO;
use Illuminate\Support\Facades\Config;


/**
 * Class AdminController
 * @package App\Http\Controllers\API
 */
class AdminController extends BaseController
{
    private $api;

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->api = new Api();

    }


    /**
     * Obteniendo los modulos del usuario por medio del Id
     * @param $id
     * @return bool|mixed|string
     */
    public function getModulos($id)
    {
        $this->setJsonModulos($id);
        $datos = $this->api->doRequest();
        return $datos;
    }


}
