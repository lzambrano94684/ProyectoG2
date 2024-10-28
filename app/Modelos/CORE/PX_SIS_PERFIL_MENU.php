<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_PERFIL_MENU extends Model
{
    protected $table='PX_SIS_PerfilMenu';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdPerfil', 'IdMenu','FechaCreacion','FechaModificacion');
    public $incrementing = true;
    public $timestamps=false;

    public function Perfil()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_PERFIL','IdPerfil','Id');
    }

    public function Menu()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_MENU','IdMenu','Id');
    }
}
