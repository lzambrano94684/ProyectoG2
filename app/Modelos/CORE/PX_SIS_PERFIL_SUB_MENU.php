<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_PERFIL_SUB_MENU extends Model
{
    protected $table='PX_SIS_PerfilSubMenu';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdPerfil', 'IdSubMenu','FechaCreacion','FechaModificacion');
    public $incrementing = true;
    public $timestamps=false;

    public function Perfil()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_PERFIL','IdPerfil','Id');
    }

    public function SubMenu()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_SUB_MENU','IdSubMenu','Id');
    }
}
