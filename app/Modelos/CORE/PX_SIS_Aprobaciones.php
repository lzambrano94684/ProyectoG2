<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_Aprobaciones extends Model
{
    protected $table='PX_SIS_Aprobaciones';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdArbol',
        'IdPersonaSolicita',
        'IdPersonaAprueba',
        "IdTipoDoc" ,
        'IdDoc',
        'Nombre',
        'DocumentoUrl',
        'Estatus',
        'Observaciones',
        "UsuarioCreacion",
        "UsuarioModificacion"
    );
    public $incrementing = true;
    public $timestamps=false;

    public function Persona()
    {
        return $this->hasOne('App\Modelos\CORE\PX_SIS_PERSONA','Id','IdPersonaAprueba');
    }
}
