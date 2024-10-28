<?php

/**
 * HTTP CLIENT Zf2
 * @Description
 * @author Roberto Castellanos <rcastellanos@renap.gob.gt>
 * @link 172.21.26.11:8080/svn/Renap_Web_Publicos/eadmin/trunk/master
 */

namespace App\Http\Funciones;

use Illuminate\Support\Facades\Config;

class ParserHtml
{
    /**
     * @param string $value
     * @return string
     */
    public static function Error($value = '')
    {
        $html = '<div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"> </span>
              <span class="sr-only"> Error:</span>
              ' . $value . '
            </div>';
        return $html;
    }

    /**
     * @param string $value
     * @return string
     */
    public static function successMessage($value = '')
    {
        $html = '<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Exito:</span>
    ' . $value . '
    </div>';
        return $html;
    }
}