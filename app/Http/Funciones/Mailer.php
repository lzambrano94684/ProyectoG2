<?php

namespace App\Http\Funciones;

use App\Http\Controllers\API\HttpRequest;
use Illuminate\Support\Facades\Config;

class Mailer{

    /**
     * método de envío de correos
     * @param $emails
     * @param $subject
     * @param $body
     * @return mixed
     */
    public static function sendEmail($emails , $subject , $body){
        $receiver = array();
        foreach($emails as $e){
            $receiver[]['receiver'] = $e;
        }
        $a = array(
            "tipoSalida"  => 'json',
            "subject"     => $subject,
            "body"        => $body,
            "recipients"  => $receiver
        );

        //dd(json_encode($a));
        $url = Config::get("entorno.URL_SEND_EMAIL");

        return HttpRequest::doPostRequestJSON($url, json_encode($a));
        //$json = '"tipoSalida": "json","subject": "$subject","body": "$body","recipients": [{"receiver": "$email"}]';
    }

    /**
     * enviar correo a una sóla persona
     * @param $email
     * @param $subject
     * @param $body
     * @param null $file
     * @return mixed
     */

    public static function sendEmailByOne($email , $subject , $body,$file=null){

        $receiver = array(array("receiver"=>$email));
        $a = array(
            "tipoSalida"  => 'json',
            "subject"     => $subject,
            "body"        => $body,
            "recipients"  => $receiver
        );

        if($file){
            $a['file'] = $file;
        }

        //dd(json_encode($a));
        $url = Config::get("entorno.URL_SEND_EMAIL_FILE");

        #dd(array("1"=>$url,"2"=>json_encode($a)));
        return HttpRequest::doPostRequestJSON($url, json_encode($a));
        //$json = '"tipoSalida": "json","subject": "$subject","body": "$body","recipients": [{"receiver": "$email"}]';
    }

    /**
     * método para enviar correos a varias personas
     * @param $emails
     * @param $subject
     * @param $body
     * @param null $file
     * @return mixed
     */
    public static function sendEmailByAll($emails , $subject , $body,$file=null){
        $receiver = array();
        foreach($emails as $e){
            $receiver[]['receiver'] = $e;
        }
        $a = array(
            "tipoSalida"  => 'json',
            "subject"     => $subject,
            "body"        => $body,
            "recipients"  => $receiver
        );

        if($file){
            $a['file'] = $file;
        }

        //dd(json_encode($a));
        $url = Config::get("entorno.URL_SEND_EMAIL_FILE");

        #dd(array("1"=>$url,"2"=>json_encode($a)));
        return HttpRequest::doPostRequestJSON($url, json_encode($a));
        //$json = '"tipoSalida": "json","subject": "$subject","body": "$body","recipients": [{"receiver": "$email"}]';
    }
}