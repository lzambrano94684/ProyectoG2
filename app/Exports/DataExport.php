<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection
{
    var $query;

    function __construct($query)
    {
        $this->query= $query;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $exe = json_decode(base64_decode($this->query),true);
        array_unshift($exe, array_keys((array)$exe[0]));
        return collect($exe);
    }
}
