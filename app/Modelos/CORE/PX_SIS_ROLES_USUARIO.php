<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_ROLES_USUARIO extends Model
{
    protected $table='PX_SIS_ROLES_USUARIO';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdUsuario','IdMenu', 'IdSubMenu','FechaCreacion','FechaMod','FechaBaja','Observaciones','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function Usuario()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_USUARIO','IdUsuario','Id');
    }

    public function Menu()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_MENU','IdMenu','Id');
    }

    public function SubMenu()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_SUB_MENU','IdSubMenu','Id');
    }



}
