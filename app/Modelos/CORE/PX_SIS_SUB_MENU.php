<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_SUB_MENU extends Model
{
    protected $table='PX_SIS_SUB_MENU';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdMenu','URL','Nombre','Descripcion','Icono','FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function Menu()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_MENU','IdMenu','Id');
    }

    public function RolesUsuario()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_ROLES_USUARIO','IdSubMenu','Id');
    }

}
