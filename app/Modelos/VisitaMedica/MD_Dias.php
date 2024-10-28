<?php

namespace App\Modelos\VisitaMedica;
use Illuminate\Database\Eloquent\Model;

class MD_Dias extends Model
{
    protected $table = 'MD_Dias';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdPais",
        "DiasCiclo",
        "DiasReales",
        "FechaInicio",
        "FechaFin",
        "CicloActual",
        "FechaCreacion",
        "FechaModificacion",
        "UsuarioCreacion",
        "UsuarioModificacion"

    );
    public $incrementing = true;
    public $timestamps = false;
}
