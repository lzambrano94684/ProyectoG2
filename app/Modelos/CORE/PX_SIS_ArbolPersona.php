<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_ArbolPersona extends Model
{
    protected $table='PX_SIS_ArbolPersona';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdArbol',
        'IdPersona',
        "UsuarioCreacion",
        "UsuarioModificacion"
    );
    public $incrementing = true;
    public $timestamps=false;

}
