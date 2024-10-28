<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Config;

class HttpRequest extends BaseController
{

    private $usuario='';
    private $psw='';
  //  private $apKey='';
    public $url;
    public $json;

    /**
     * HttpRequest constructor.
     */
    public function __construct()
    {
        //$this->url=Config::get('entorno.URL_APPI_CENTRAL');
        $this->usuario=Config::get('entorno.USUARIO_API');
        $this->psw=Config::get('entorno.PASS_API');
       // $this->apKey=Config::get('entorno.KEY_API_PHP');
    }


    /**
     * Método para consumir el api
     * @param string $url
     * @param string $json
     * @param null $deb
     * @param null $obj
     * @return bool|mixed|string
     */
    public function doRequest($metodo="POST",$deb=null,$obj=null)
    {


        if($deb!=null)
        {
            dd($this->json,$this->url);
        }



        if(!empty($this->url)&&!empty($this->json)){
            $ch = \curl_init($this->url);
            \curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $metodo);
            \curl_setopt($ch, CURLOPT_POSTFIELDS, $this->json);
            \curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
            \curl_setopt($ch, CURLOPT_USERPWD, $this->usuario . ":" .$this->psw);
            \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            \curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($this->json)
                    /*'API-KEY: '.$this->apKey*/)
            );
            \curl_setopt($ch, CURLOPT_TIMEOUT, 300000);
            \curl_setopt($ch, CURLOPT_TIMEOUT_MS, 300000);

            $data = \curl_exec($ch);

            $curl_errno = curl_errno($ch);
            $curl_error = curl_error($ch);

            if ($curl_errno > 0) {

               /* $body=array();
                $body['detalle']="cURL Error in url: $url ($curl_errno): $curl_error\n";
                $body['nota']="TIME OUT";*/

               // Mailer::sendEmailByAll(Config::get('entorno.Administrador'),'TimeOut de Conexión',ParserHtml::mailInformativoError($body));
            }
            \curl_close($ch);

            //dd($data, $curl_errno, $curl_error,$this->url);


           // dd(json_decode($data));
            return json_decode($data);

            //$data = ($obj!=null) ? json_decode($data) : json_decode($data,1);
           // return $data;
        }

        return false;
    }
}
