<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DafExport implements FromCollection, WithHeadingRow
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
        ini_set('memory_limit', '4096M');
        set_time_limit(5000);
        $head = $this->query->first()->keys();
        return $this->query->prepend($head);
    }
}
