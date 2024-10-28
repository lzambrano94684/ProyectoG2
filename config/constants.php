<?php

return [
    'columns' => [
        "varchar" => "text",
        "nvarchar" => "text",
        "datetime" => "date",
        "date" => "date",
        "int" => "number"
    ],
    'sp_bi' => [
        "sp_productividadrep" => [
            "pais" => [
                "Parrillas" => "País"
            ]
        ],
        "sp_segmentacion" => [
            "marca" => [
                "franquicias" => "Clase_ATC"
            ],
            "pais" => [
                "total_atc" => "pais"
            ],
            "analisis" => [
                "Segmentacion" => ["Clase ATC" => "Clase ATC", "Molécula" => "Molécula"]
            ]
        ],
        "spsegmentacion_esp" => [
            "especialidad" => [
                "ENTRY_MARKET" => "cdg_esp1"
            ],
            "pais" => [
                "ENTRY_MARKET" => "pais"
            ]
        ],
        "spsegmentacion_franquicia" => [
            "franquicia" => [
                "Franquicias" => "Clase_ATC"
            ],
            "pais" => [
                "ENTRY_MARKET" => "Pais"
            ]
        ]
    ],
    "connection" => [
        "BI"=>"sqlsrvINegocios"
    ],

    "usoPais" => 1,

    "meses" => ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
        'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],

    "tipoGasto" =>[

        'capex' => 2,
        'opex' => 1,
        'marketing'=>3,
        ],

    "usoFinanzas" => 1,
];
