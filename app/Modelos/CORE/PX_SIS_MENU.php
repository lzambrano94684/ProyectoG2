<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_MENU extends Model
{
    protected $table='PX_SIS_MENU';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdModulo','URL', 'Nombre','Descripcion','Icono','FechaCrecion','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function Modulo()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_MODULO','IdModulo','Id');
    }

    public function RolesUsuario()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_ROLES_USUARIO','IdMenu','Id');
    }

    public function SubMenu()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_SUB_MENU','IdMenu','Id')->orderBy('Nombre','asc');
    }


}
