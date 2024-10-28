<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_PERFIL_USUARIO extends Model
{
    protected $table='PX_SIS_PERFIL_USUARIO';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdUsuario', 'IdPerfil','FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function Usuario()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_USUARIO','IdUsuario','Id');
    }

    public function Perfil()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_PERFIL','IdPerfil','Id');
    }

}
