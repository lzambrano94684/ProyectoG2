<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportSalesBon implements ToCollection
{
    var $idUsuarioCreacion;
    var $count = 0;
    public $repetidos=0;
    public $guardados=0;
    public $dataExcel = [];
    public $dataExcelRepetidos = [];

    public function collection(Collection $rows)
    {
    }
}
