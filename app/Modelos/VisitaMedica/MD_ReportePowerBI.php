<?php

namespace App\Modelos\VisitaMedica;

use Illuminate\Database\Eloquent\Model;

class MD_ReportePowerBI extends Model
{
    protected $table = 'MD_ReportePowerBI';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "Reporte",
        "Url",
        "FechaCreacion",
        "FechaModificacion",
        "UsuarioCreacion",
        "UsuarioModificacion"
    );
    public $incrementing = true;
    public $timestamps = false;
}
