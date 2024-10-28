<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_ComboPar extends Model
{
    protected $table='PX_SIS_ComboPar';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'Funcion',
        'Query',
        'Json',
        'Parametro',
        'Iframe',
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
