<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_FuncionesUsuariosParametros extends Model
{
    protected $table='PX_SIS_FuncionesUsuariosParametros';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'Funcion',
        'Parametros',
        'UsuarioCreacion'
    );
    public $incrementing = true;
    public $timestamps=false;

}
