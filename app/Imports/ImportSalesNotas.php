<?php
namespace App\Imports;

use App\Modelos\GestionProducto\PX_GP_ProductoCodigos;
use App\Modelos\SalesExpenses\PX_SEX_DetalleDoc;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use phpDocumentor\Reflection\Types\Collection;

class ImportSalesNotas implements ToModel
{
    var $idEncabezado = 0;

    public function __construct($id)
    {
        $this->idEncabezado = $id;
    }
    public function model(array $row)
    {

    }
}
