<?php

namespace App\Http\Controllers;

use HttpRequest;
use SoapClient;
use SimpleXMLElement;
use stdClass;
use Illuminate\Http\Request;
use XMLParser;

/*
 * https://askubuntu.com/questions/1160507/curl-not-working-in-the-latest-version-of-php-7-2
  * Guia de instalacion curl
 */

class CurrencyController extends Controller
{
    var $client;
    var $tags = "";
    var $ultimoTag = "";

    public function pruebas()
    {
        $body = array('urn:ZpedGuatemala' =>
            array(
                'DHeader' =>
                    array(
                        'Lifnr' => '12961',
                        'Ekorg' => 'ASGT',
                        'Ekgrp' => '682',
                        'Waers' => 'GTQ',
                        'Ihrez' => 'Ref. 123',
                        'Txline' => 'Texto Prueba',
                    ),
                'Return' =>
                    array(
                        'item' =>
                            array(
                                'Type' => '',
                                'Id' => '',
                                'Number' => '',
                                'Message' => '',
                                'LogNo' => '',
                                'LogMsgNo' => '',
                                'MessageV1' => '',
                                'MessageV2' => '',
                                'MessageV3' => '',
                                'MessageV4' => '',
                                'Parameter' => '',
                                'Row' => '',
                                'Field' => '',
                                'System' => '',
                            ),
                    ),
                'RutaPdf' => '\\\\dfs.insudpharma.com\\INTERFACES\\SAP-R3\\DES\\MM\\Guatemala\\PDFprueba.pdf',
                'TPosition' =>
                    array(
                        'item' =>
                            array(
                                'Ebelp' => '10',
                                'Txz01' => 'PRUEBA',
                                'Matkl' => 'S074',
                                'Eindt' => '2021-06-15',
                                'Bednr' => 'RQ143376',
                                'Kostl' => '3700106001',
                                'Txline' => 'TEXTO2',
                            ),
                        'item ' =>
                            array(
                                'Ebelp' => '20',
                                'Txz01' => 'PRUEBA2',
                                'Matkl' => 'S074',
                                'Eindt' => '2021-06-08',
                                'Bednr' => 'RQ143371',
                                'Kostl' => '3700106001',
                                'Txline' => 'Tpos2',
                            )
                    ),
                'TSercicios' =>
                    array(
                        'item' =>
                            array(
                                'Ebelp' => '10',
                                'Srvpos' => '74',
                                'Menge' => '3',
                                'Tbtwr' => '123456.12',
                            ),
                        'item ' =>
                            array(
                                'Ebelp' => '20',
                                'Srvpos' => '74',
                                'Menge' => '1',
                                'Tbtwr' => '1345.11',
                            ),
                    ),
            ),
        );

        $strInitial = str_replace("\r\n","",'<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:soap:functions:mc-style">
                           <soapenv:Header/>
                           <soapenv:Body>
                           '.$this->arrayToTags($body).'
                           </soapenv:Body>
                        </soapenv:Envelope>');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "8000",
            CURLOPT_URL => "10.10.120.5/sap/bc/srt/rfc/sap/zguatemala/310/zguatemala/zguatem_bind",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $strInitial,
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic Q09OX1BFRF9HVUFUOkluc3VkLjE0MDYkJA==",
                "cache-control: no-cache",
                "content-type: text/xml",
                "postman-token: c388d9e9-4722-2b61-10aa-a0d85713d0a7"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $xmlTransform = simplexml_load_string($response);
        $xmlTransform = collect(json_decode(json_encode(
            $xmlTransform
                ->children('soap-env', true)->Body
                ->children('n0', true)->ZpedGuatemalaResponse
                ->children('', true)
        )));
        $oc = $xmlTransform->first();
        dd($response, $oc, $xmlTransform);
    }


    public function cleanStr($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
    public function arrayToTags($array)
    {
        foreach ($array as $k => $v) {
            $k = trim($k);
            if ($k == "soapenv:Header") {
                $this->tags .= "<soapenv:Header/>";
            } else {
                if (is_array($v)) {
                    $this->tags .= "<$k>";
                    $this->ultimoTag = $k;
                    $this->arrayToTags($v);
                } else {
                    $this->tags .= "<$k>$v</$k>";
                }
                if (is_array($v)) {
                    $this->tags .= "</$k>";
                }
            }
        }
        return $this->tags;
    }

}
