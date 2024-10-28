<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_ArbolAProbaciones extends Model
{
    protected $table='PX_SIS_ArbolAProbaciones';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdPadrePersona',
        'IdHijoPersona',
        'IdPerfil',
        'Nombre',
        'NombreArbol',
        'Estado',
        'Tipo',
        "UsuarioCreacion",
        "UsuarioModificacion"
    );
    public $incrementing = true;
    public $timestamps=false;

}
