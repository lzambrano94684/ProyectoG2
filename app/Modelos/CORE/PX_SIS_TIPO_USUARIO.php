<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_TIPO_USUARIO extends Model
{
    protected $table='PX_SIS_TIPO_USUARIO';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre', 'FechaCreacion', 'Estado');
    public $incrementing = true;
    public $timestamps=false;


    public function Usuario()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_USUARIO','IdTipoUsuario','Id');
    }


}
