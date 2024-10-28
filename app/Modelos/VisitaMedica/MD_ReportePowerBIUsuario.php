<?php

namespace App\Modelos\VisitaMedica;

use Illuminate\Database\Eloquent\Model;

class MD_ReportePowerBIUsuario extends Model
{
    protected $table = 'MD_ReportePowerBIUsuario';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdUsuario",
        "IdReporte",
        "FechaCreacion",
        "FechaModificacion",
        "UsuarioCreacion",
        "UsuarioModificacion"
    );
    public $incrementing = true;
    public $timestamps = false;
}
