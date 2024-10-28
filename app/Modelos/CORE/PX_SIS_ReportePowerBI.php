<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_ReportePowerBI extends Model
{
    protected $table='PX_SIS_ReportePowerBI';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'Nombre',
        'Descripcion',
        'URL'
    );
    public $incrementing = true;
    public $timestamps=false;

}
