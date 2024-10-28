<?php

namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_UniversoMedicoQuintalizacion extends Model
{
    protected $table = 'MD_UniversoMedicoQuintalizacion';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "Pais", "Distribuidor", "Nombre", "CodigoMed", "Especialidad", "Region", "Localidad", "Domicilio", "Quintil", "Version", "Activo",
        "FechaCreacion",
        "FechaModificacion",
        "UsuarioCreacion",
        "UsuarioModificacion"
    );
    public $incrementing = true;
    public $timestamps = false;
}
