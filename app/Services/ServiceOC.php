<?php

namespace App\Services;


class ServiceOC
{
    var $soapUrl;
    var $soapUser;
    var $soapPassword;
    var $bodyXML;
    private function _client($bodyXML)
    {
        $this->soapUrl = env("URL_WS_SAP_OC"); // asmx URL of WSDL
        $this->soapUser = env("WS_USER_SAP_OC");  //  username
        $this->soapPassword = env("WS_PASS_SAP_OC"); // password
        $this->bodyXML = $bodyXML;
    }

    public function getCurrency()
    {
        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
        $bodyXML = $this->bodyXML;
        $soapUrl = $this->soapUrl;
        $soapUser = $this->soapUser;
        $soapPassword = $this->soapPassword;
        $strInitial = str_replace("\r\n", "", '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:soap:functions:mc-style">
                           <soapenv:Header/>
                           <soapenv:Body>
                           ' . $bodyXML . '
                           </soapenv:Body>
                        </soapenv:Envelope>');

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($strInitial),
        );
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_URL, $soapUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $soapUser . ":" . $soapPassword); // username and password - declared at the top of the doc
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $strInitial); // the SOAP request
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // converting
            $response = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);
            dd($err, $response);
            return  $response;
            if (!$err){
                return $this->xmlToObject($response);
            }



        } catch (\Exception $e) {
            Log::info('Caught Exception :' . $e->getMessage());
            return $e;       // just re-throw it
        }
    }

    public function xmlToObject($xml)
    {
        try{
            $xmlTransform = simplexml_load_string($xml);
            $xmlTransform = collect(json_decode(json_encode(
                $xmlTransform
                    ->children('soap-env', true)->Body
                    ->children('n0', true)->ZpedGuatemalaResponse
                    ->children('', true)
            )));
        }catch (\Exception $e){
            return $e->getMessage();
        }

        return $xmlTransform;
    }
}
