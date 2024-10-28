<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_MODULO extends Model
{
    protected $table='PX_SIS_MODULO';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdSistema', 'Nombre','Descripcion','Icono','Imagen','FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function Menu()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_MENU','IdModulo','Id')->orderBy('Nombre','asc');
    }


    public function Perfil()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_PERFIL','IdModulo','Id')->orderBy('Nombre','asc');
    }

    public function Sistema()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_SISTEMA','IdSistema','Id');
    }

}
