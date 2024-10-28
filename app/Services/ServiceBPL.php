<?php

namespace App\Services;


class ServiceBPL
{
    var $UserBasicAut;
    var $PassBasicAut;
    var $Url;
    var $bodyOBJ;
    var $compania;

    public function __construct($method, $bodyOBJ)
    {
        $this->Url = env("PBL_URL") . $method;
        $this->UserBasicAut = env("BPL_BASIC_AUTH_USER");
        $this->PassBasicAut = env("BPL_BASIC_AUTH_PASS");
        $this->compania = env("PBL_KEY_COMPANY");
        $this->bodyOBJ = $bodyOBJ;
    }

    function conectionPost($debug = false)
    {
        if (!$debug) {
            $url = $this->Url;
            $obj = $this->bodyOBJ;
            $basicUSR = $this->UserBasicAut;
            $basicPSW = $this->PassBasicAut;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $obj);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $basicUSR . ':' . $basicPSW);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                [
                    'Accept: application/json',
                    'Content-Type: application/json'
                ]
            );
            $result = json_decode(curl_exec($ch));
            if (is_null($result)) {
                $result = (object)[
                    "Status" => 0
                    , "Message" => (object)[
                        "No se logro comunicación con el servidor de BPL"
                    ]
                ];
            } else {
                if (isset($result->Failed) && isset($result->TransactionMessage)) {
                    if (is_object($result->TransactionMessage) || is_array($result->TransactionMessage)) {
                        $result = (object)[
                            "Status" => 1
                            , "Message" => $result->TransactionMessage
                        ];
                    } else {
                        try {
                            $result = (object)[
                                "Status" => 10
                                , "Message" => (object)[
                                    $result->TransactionMessage
                                ]
                            ];
                        } catch (\Exception $e) {
                            $result = (object)[
                                "Status" => $e->getCode()
                                , "Message" => (object)[
                                    $e->getMessage()
                                ]
                            ];
                        }
                    }
                } else {
                    $result = (object)[
                        "Status" => 0
                        , "Message" => (object)[
                            "El objeto devuelto es distinto al de siempre (Failed y TransactionMessage validado): " . json_encode($result)
                        ]
                    ];
                }
            }
            return $result;
        } else {
            dd([$this->Url,
                $this->UserBasicAut,
                $this->PassBasicAut,
                $this->bodyOBJ]);
        }

    }

    function conectionGet($debug = false)
    {
        if (!$debug) {
            $url = $this->Url;
            $basicUSR = $this->UserBasicAut;
            $basicPSW = $this->PassBasicAut;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $basicUSR . ':' . $basicPSW);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
            return collect(json_decode($data));
        } else {
            dd([$this->Url,
                $this->UserBasicAut,
                $this->PassBasicAut,
                $this->bodyOBJ]);
        }

    }

    function conectionGetNoAut($debug = false)
    {
        $ch = curl_init($this->Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;

    }

}
