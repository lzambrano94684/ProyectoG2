<?php

namespace App\Imports;

use App\Modelos\GestionProducto\PX_GP_ProductoCodigos;
use App\Modelos\SalesExpenses\PX_SEX_EncabezadoDoc;
use App\Modelos\SalesExpenses\PX_SEX_TipoGasto;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportEstadoCuentaTC implements ToModel
{
    public function __construct()
    {
        try {
        } catch (\Exception $e) {

        }

    }
    public function model(array $row)
    {

    }
}
